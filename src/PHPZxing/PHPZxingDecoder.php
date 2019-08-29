<?php
/*
Descrition : PHPZing Decoder wrapper of Java Zxing

license: MIT-style

authors:
- Siddharth Deshpande (dsiddharth2@gmail.com)

requires:
- Zxing - core.jar
- Zxing - javase.jar

Provides: PHPZxingDecoder
- 
...
* PHPZxingDecoder
* Version 1.0.1
* Copyright (c) 2018 Siddharth Deshpande
*
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use,
* copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the
* Software is furnished to do so, subject to the following
* conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
* OTHER DEALINGS IN THE SOFTWARE.
*/

namespace PHPZxing;

use PHPZxing\PHPZxingBase;

class PHPZxingDecoder extends PHPZxingBase  {
    
    // Java De-coder Class that takes the Command line
    public $JAVA_DECODER_CLASS = 'com.google.zxing.client.j2se.CommandLineRunner';

    // Checks if the image is a single one
    private $_SINGLE_IMAGE = null;

    // Store for multiple array images
    private $_ARRAY_IMAGES = null;

    // Space while creating the command
    private $SPACE = " ";

    // Use the TRY_HARDER hint, default is normal (mobile) mode
    private $try_harder = false;

    // Scans image for multiple barcodes in single image
    private $multiple_bar_codes = false;

    // crop=left,top,width,height: Only examine cropped region of input image(s)
    private $crop = false;
    
    //Formats to decode, where format is any value in BarcodeFormat
    private $possible_formats = false;

    // Constructor for PHPZxingDecoder
    public function __construct($config = array()) {
        if(isset($config['try_harder']) && array_key_exists('try_harder', $config)) {
            $this->try_harder = boolval($config['try_harder']);
        }
        
        if(isset($config['multiple_bar_codes']) && array_key_exists('multiple_bar_codes', $config)) {
            $this->multiple_bar_codes = boolval($config['multiple_bar_codes']);
        }

        if(isset($config['crop']) && array_key_exists('crop', $config)) {
            $this->crop = strval($config['crop']);
        }

        if(isset($config['returnAs']) && array_key_exists('returnAs', $config)) {
            $this->returnAs = strval($config['returnAs']);
        }

        if(isset($config['possible_formats']) && array_key_exists('possible_formats', $config)) {
            $this->possible_formats = strval($config['possible_formats']);
        }
    }

    private function basePrepare() {
        $command = "";
        $command = $command . $this->getJavaPath() . $this->SPACE . "-cp" . $this->SPACE;
        $command = $command . $this->getJARPath() . PATH_SEPARATOR . $this->getCorePAth() . PATH_SEPARATOR . $this->getJcommanderPath() . $this->SPACE;
        $command = $command . $this->JAVA_DECODER_CLASS . $this->SPACE;
        return $command;        
    }

    private function prepareImageArray() {
        $image = array();
        foreach ($this->_ARRAY_IMAGES as $arrayImage) {
            try {
                if(!file_exists($arrayImage)) {
                    throw new \Exception($arrayImage . ": file does not exist");
                }

                $command = $this->basePrepare();
                $command = $command . $arrayImage . $this->SPACE;
                
                if($this->try_harder == true) {
                    $command = $command . "--try_harder" . $this->SPACE;
                }

                if($this->multiple_bar_codes == true) {
                    $command = $command . "--multi" . $this->SPACE;
                }

                if($this->crop != false) {
                    $command = $command . "--crop=" . $this->crop . $this->SPACE;
                }

                if ($this->possible_formats != false) {
                    $command = $command . "--possible_formats " . $this->possible_formats . $this->SPACE;
                }

                $script_output = "";
                exec($command, $script_output);
                $image[] = current($this->createImages($script_output));
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
        return $image;
    }

    private function prepareSingleImage() {
        $command = $this->basePrepare();
        $command = $command . $this->_SINGLE_IMAGE . $this->SPACE;
        
        if($this->try_harder == true) {
            $command = $command . "--try_harder" . $this->SPACE;
        }

        if($this->multiple_bar_codes == true) {
            $command = $command . "--multi" . $this->SPACE;
        }

        if($this->crop != false) {
            $command = $command . "--crop=" . $this->crop . $this->SPACE;
        }

        if ($this->possible_formats != false) {
            $command = $command . "--possible_formats " . $this->possible_formats . $this->SPACE;
        }

        exec($command, $script_output);
        return $this->createImages($script_output);
    }

    /**
     * Function creates images array that gives the decoded data in array
     */
    private function createImages($output) {
        $image = array();
        
        foreach ($output as $key => $singleLine) {
            if (preg_match('/\(format/', $singleLine)) {
                $imageInfo  = $singleLine;
                $startPos   = strpos($imageInfo, "(") + 1;
                $endPos     = strpos($imageInfo, ")");
                $dataStr   = substr($imageInfo, $startPos, $endPos - $startPos);

                $dataExplode    = explode(",", $dataStr);
                $contentFormat  = explode(":", $dataExplode[0]);
                $format         = $contentFormat[1];
                $contentFormat  = explode(":", $dataExplode[1]);
                $type         = $contentFormat[1];

                $imageValue = $output[$key + 2];

                $exploded = explode(" ", $singleLine);
                $imagePath = array_shift($exploded);

                $image[] = new ZxingImage($imagePath, $imageValue, $format, $type);

            } else if(preg_match('/No barcode found/', $singleLine)) {
                
                $exploded = explode(" ", $singleLine);
                $imagePath = array_shift($exploded);
                $image[] = new ZxingBarNotFound($imagePath, 101, "No barcode found");
            }
        }

        return $image;
    }

    /**
     * Function that creates a command using the options provided
     */
    public function prepare() {
        if(is_array($this->_ARRAY_IMAGES)) {
            return $this->prepareImageArray();
        } else {
            return $this->prepareSingleImage();
        }
    }

    public function setSingleImage($image) {
        $this->_SINGLE_IMAGE = $image;
    }

    public function setArrayImages($images) {
        $this->_ARRAY_IMAGES = $images;
    }

    /**
     * Send an image and returns an Object of ZxingImage
     * @return [Array]     ZxingImage   
     */
    public function decode($image = null) {
        try {
            
            if(is_array($image)) {
                $this->setArrayImages($image);

                if($this->_ARRAY_IMAGES == null) {
                    throw new \Exception("Nothing to decode");
                }

            } else {
                if(!file_exists($image)) {
                    throw new \Exception("File/Folder does not exist");
                }

                $this->setSingleImage($image);

                if($this->_SINGLE_IMAGE == null) {
                    throw new \Exception("Nothing to decode");
                }
            }

            $image = $this->prepare();

            if(empty($image)) {
                throw new \Exception("Is the java PATH set correctly ? Current Path set is : " . $this->getJavaPath());
            }

            // If the image is single then return the actual image
            if(count($image) == 1) {
                return current($image);
            }

            return $image;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
} // End Class
