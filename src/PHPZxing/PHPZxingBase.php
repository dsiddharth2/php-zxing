<?php
/*
Descrition : PHPZxingBase Base class that has all base stuff stored

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
namespace PHPZxing;

class PHPZxingBase  {
    
    // name of the javase.jar file located in /src/bin directory
    private $_JAVASE_PATH = 'javase-3.3.3.jar';

    // name of the core.jar file located in /src/bin directory
    private $_CORE_PATH = "core-3.3.3.jar";

    // name of the jcommander.jar file located in /src/bin directory
    private $_JCOMMANDER_PATH = "jcommander-1.72.jar";

    // location of java in your machine
    private $_JAVA_PATH = "/usr/bin/java";

    public function getJavaPath() {
        return $this->_JAVA_PATH;
    }

    public function getJARPath() {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR  . 'bin' . DIRECTORY_SEPARATOR . $this->_JAVASE_PATH;
    }

    public function getCorePAth() {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR  . 'bin' . DIRECTORY_SEPARATOR . $this->_CORE_PATH;
    }

    public function getJcommanderPath() {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR  . 'bin' . DIRECTORY_SEPARATOR . $this->_JCOMMANDER_PATH;
    }

    /**
     * Set the default java path which we will use for decoding
     */
    public function setJavaPath($javaPath = "/usr/bin/java") {
        $this->_JAVA_PATH = $javaPath;
    }
}