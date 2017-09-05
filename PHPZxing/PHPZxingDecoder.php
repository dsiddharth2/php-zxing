<?php
namespace PHPZxing;

require dirname(__FILE__) . DIRECTORY_SEPARATOR . "PHPZxingBase.php";

use PHPZxing\PHPZxingBase;

class PHPZxingDecoder extends PHPZxingBase  {
    
    public $JAVA_DECODER_CLASS = 'com.google.zxing.client.j2se.CommandLineRunner';

    private $_SINGLE_IMAGE = null;

    public $SPACE = " ";

    private function prepare() {
        $command = "";
        $command = $command . $this->getJavaPath() . $this->SPACE . "-cp";
        $command = $command . $this->getJavaPath() . $this->SPACE . "-cp";

        //java -cp javase-3.2.0.jar:core-3.2.0.jar com.google.zxing.client.j2se.CommandLineRunner ./pod/0531283107.jpg
    }

    public function setSingleImage($image) {
        $this->_SINGLE_IMAGE = $image;
    }

    public function decode($image = null) {
        try {
            $this->setSingleImage($image);

            if($this->_SINGLE_IMAGE == null) {
                throw new Exception("Nothing to decode");
            }

            $this->prepare();

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}

$decoder = new PHPZxingDecoder();
$decoder->getJavaPath();