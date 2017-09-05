<?php
namespace PHPZxing;

class PHPZxingBase  {
    
    private $_JAVASE_PATH = 'javase-3.2.0.jar';

    private $_JAVA_PATH = "/usr/bin/java";

    public function getJavaPath() {
        echo __DIR__;
        return $this->_JAVA_PATH;
    }

    public function getJARPath() {
        return $this->_JAVASE_PATH;
    }
}