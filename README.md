PHPZxing - Wrapper for Zxing Java Library
===========================================
PHPZxing is a small php wrapper that uses the Zxing library to Create and read Barcodes.
Under the hood it still uses the [Zxing library](https://github.com/zxing/zxing) to encode and decode data.

Install using composer
--------------------

```json
{  
    "require": {
        "dsiddharth2/php-zxing": "dev-master"
    }  
}
```

Note
--------------------
* Only Decoder is programmed right now. Needs programming of Encoder.
* The Default location of java that is configured is /usr/bin/java


Basic Usage
----------
```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
$decodedData    = current($decoder->decode('../images/Code128Barcode.jpg'));
$decodedData->getImageValue();
$decodedData->getFormat();
$decodedData->getType();
```

The Decoded data is an Array of Objects of PHPZxing\ZxingImage if the bar code is found. If not found then it is an array of Objects PHPZxing\ZxingBarNotFound.

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
    'try_harder' => true, // Non mobile mode
    'multiple_bar_codes' => true, // If the image contains muliple bar codes
    'crop' => '100,200,300,300', // If you want to crop image in pixels
);
$decoder        = new PHPZxingDecoder($config);
$decodedData    = $decoder->decode('../images/'); // Reads images in complete directory
print_r($decodedData);
```

You can also use it with configurations. The Decoder has 3 configurations,

| Config Name           | Function                                                       |
| -------------         |--------------------------------------------------------------|
| try_harder            | If the image has bar/Qr code at unknown locations, then use this non mobile mode. |
| multiple_bar_codes    | If the image has multiple bar codes you want to read. |
| crop                  | Crop the image and it will read only the cropped portion |

More Examples
----------

You can pass array of images too,

```php
use PHPZxing\PHPZxingDecoder;

$decoder        = new PHPZxingDecoder();
// Images can be sent as an array
$imageArrays = array(
    '../images/Code128Barcode.jpg',
    '../images/Code39Barcode.jpg'
);
$decodedData    = $decoder->decode($imageArrays);
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

On Windows read the follwoing stackoverflow [Link](https://stackoverflow.com/questions/304319/is-there-an-equivalent-of-which-on-the-windows-command-line)

## Acknowledgments

* [Zxing library](https://github.com/zxing/zxing)

Contibution
----------
Please Contribute or suggest changes.

