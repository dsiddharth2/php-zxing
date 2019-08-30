<?php 
/*
Descrition : PHPZxing Example file

license: MIT-style

authors:
- Siddharth Deshpande (dsiddharth2@gmail.com)
...
* PHPZxing
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

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "PHPZxingBase.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "PHPZxingInterface.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "PHPZxingDecoder.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "ZxingImage.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "ZxingBarNotFound.php";    

    use PHPZxing\PHPZxingDecoder;

    // Bar Code Found
    $decoder        = new PHPZxingDecoder();
    $data           = $decoder->decode('../images/Code128Barcode.jpg');
    if($data->isFound()) {
        $data->getImageValue();
        $data->getFormat();
        $data->getType();        
    }

    // Bar Code Not Found
    $decoder        = new PHPZxingDecoder();
    $data           = $decoder->decode('../images/no_bar_code_found.jpeg');
    if($data->isFound()) {
        $data->getImageValue();
        $data->getFormat();
        $data->getType();        
    } else {
        echo "No Bar Code Found";
    }

    // Bar Code Options
    $config = array(
        'try_harder'            => true,
        'crop'                  => '100,200,300,300',
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedArray   = $decoder->decode('../images');
    if(is_array($decodedArray)){
        foreach ($decodedArray as $data) {
            if($data->isFound()) {
                print_r($data);
            }
        }
    }

    // Send Multiple Images
    $decoder        = new PHPZxingDecoder();
    $imageArrays = array(
        '../images/Code128Barcode.jpg',
        '../images/Code39Barcode.jpg'
    );
    $decodedArray  = $decoder->decode($imageArrays);
    foreach ($decodedArray as $data) {
        if($data instanceof PHPZxing\ZxingImage) {
            print_r($data);
        } else {
            echo "Bar Code cannot be read";
        }
    }

    // Bar Code options for reading multiple bar codes in the same image
    $config = array(
        'try_harder' => true,
        'multiple_bar_codes' => true
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedData    = $decoder->decode('../images/multiple_bar_codes.jpg');
    print_r($decodedData);

    // Bar Code options for reading multiple bar codes in the same image and restrict to CODE_128 and PDF_417
    $config = array(
        'try_harder' => true,
        'multiple_bar_codes' => true,
        'possible_formats' => ' CODE_128,PDF_417'
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedData    = $decoder->decode('../images/multiple_bar_codes.jpg');
    print_r($decodedData);
?>