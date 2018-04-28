<?php
/*
Descrition : ZxingImage - returns the decoded images in ZxingImage Object

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

use PHPZxing\PHPZxingInterface;

class ZxingImage implements PHPZxingInterface {
    // Decoded Value from source
    private $imageValue     = null;

    // Format of decoded data - CODE_39 etc..
    private $format         = null;

    // Type of decoded data - TEXT, URI etc..
    private $type           = null;   

    // Path of the image decoded
    private $imagePath      = null;

    public function __construct($imagePath, $imageValue , $format, $type) {
        $this->imageValue   = $imageValue;
        $this->format       = $format;
        $this->type         = $type;
        $this->imagePath    = $imagePath;
    }

    public function isFound() {
        return true;
    }

    public function getImageValue() {
        return $this->imageValue;
    }

    public function getFormat() {
        return $this->format;
    }

    public function getType() {
        return $this->type;
    }

    public function getImagePath() {
        return $this->imagePath;
    }
}