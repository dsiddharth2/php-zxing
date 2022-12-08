PHPZxing - Wrapper for Zxing Java Library
===========================================
PHPZxing is a small php wrapper that uses the Zxing library to Create and read Barcodes.
Under the hood it still uses the [Zxing library](https://github.com/zxing/zxing) to encode and decode data.

Install using composer
--------------------

```json
{  
    "require": {
        "dsiddharth2/php-zxing": "1.0.3"
    }  
}
```

Note
--------------------
* Only Decoder is programmed right now. Needs programming of Encoder.
* The Default location of java that is configured is /usr/bin/java

Changes in version 1.0.3
--------------------
* Functionality added for possible_formats to work

Changes in version 1.0.2
--------------------
* Updated the new jars and tested on windows system

Changes in version 1.0.1
--------------------
* Added a isFound function that will tell if the bar code is found.
* If the image has one bar code detected, then it returns the object instead of array of a single object.

Basic Usage
----------
```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
$data           = $decoder->decode('../images/Code128Barcode.jpg');
if($data->isFound()) {
    $data->getImageValue();
    $data->getFormat();
    $data->getType();        
}
```

The Decoded data is an Array of Objects of PHPZxing\ZxingImage if the bar code is found. If not found then it is an array of Objects PHPZxing\ZxingBarNotFound.

Checking for existence of Barcode
----------
The Existance of bar code can be found using the functoin isFound()

```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
$data           = $decoder->decode('../images/Code128Barcode.jpg');
if($data->isFound()) {
    $data->getImageValue();
    $data->getFormat();
    $data->getType();        
}
```

You can also check using the instanceof object,
```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
$data           = $decoder->decode('../images/Code128Barcode.jpg');
if($data instanceof PHPZxing\ZxingImage) {
    $data->getImageValue();
    $data->getFormat();
    $data->getType();
}
```
The Public methods that we can use in PHPZxing\ZxingImage are,

| Method Name       | Function                                                       |
| -------------     |--------------------------------------------------------------|
| getImageValue     | Get the value decoded in the image passed                      |
| getFormat         | Get the format of the image that is encoded, example : CODE_39 |
| getType           | Get the type of the image decoded, example : URL, TEXT etc     |
| getImagePath      | Get Path of the image                                          |

The Public methods that we can use in PHPZxing\ZxingImage are,

| Method Name           | Function                                                       |
| -------------         |--------------------------------------------------------------|
| getImageErrorCode     | Get the error code for the image not found                     |
| getErrorMessage       | Error Message                                                  |
| getImagePath          | Get Path of the image                                          |


Setting the configurations
----------
```php
use PHPZxing\PHPZxingDecoder;

$config = array(
    'try_harder'            => true,
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
```

You can also use it with configurations. The Decoder has 4 configurations,

| Config Name           | Function                                                       |
| -------------         |--------------------------------------------------------------|
| try_harder            | If the image has bar/Qr code at unknown locations, then use this non mobile mode. |
| multiple_bar_codes    | If the image has multiple bar codes you want to read. |
| crop                  | Crop the image and it will read only the cropped portion |
| possible_formats      | List of formats to decode, where format is any value in BarcodeFormat |

More Examples
----------

You can pass array of images too,

```php
use PHPZxing\PHPZxingDecoder;

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
```

Reading multiple bar codes,

```php
use PHPZxing\PHPZxingDecoder;

$config = array(
    'try_harder' => true,
    'multiple_bar_codes' => true
);
$decoder        = new PHPZxingDecoder($config);
$decodedData    = $decoder->decode('../images/multiple_bar_codes.jpg');
print_r($decodedData);
```


Set Java Path
----------
If your java PATH is not set properly, the decoder will not work. You need to set path of java variable.

```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
$decoder->setJavaPath('/your/path/to/java');
$decodedData    = $decoder->decode('../images/Code128Barcode.jpg');
print_r($decodedData);
```

Where is my java located ?
----------
If you do not know the path to java, then you can use the following on *nix enviromnents
```
$ which java
```

On Windows environment,
```
> where java
```

For more info, on Windows read the follwoing stackoverflow [Link](https://stackoverflow.com/questions/304319/is-there-an-equivalent-of-which-on-the-windows-command-line)

## Acknowledgments

* [Zxing library](https://github.com/zxing/zxing)

Contibution
----------
Please Contribute or suggest changes.

