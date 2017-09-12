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
    },
    "repositories": [
        {
            "type": "package",
            "package": {
                "name": "dsiddharth2/php-zxing",
                "version": "dev-master",
                "source": {
                    "url": "https://github.com/dsiddharth2/php-zxing.git",
                    "type": "git",
                    "reference": "master"
                },
                "autoload": {
                    "psr-0" : {
                        "PHPZxing" : "src"
                    }
                }
            }
        }
    ]  
}
```

Note
--------------------
* Only Decoder is programmed right now. Needs programming of Encoder.
* The Default location of java that is configured is /usr/bin/java.


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

The Dcooded data is an Array of Objects of PHPZxing\ZxingImage if the bar code is found.

If not found then it is an array of Objects PHPZxing\ZxingBarNotFound.

The Public methods that we can use in PHPZxing\ZxingImage are,

| Method Name       | Function                                                       |
| -------------     |:--------------------------------------------------------------:|
| getImageValue     | Get the value decoded in the image passed                      |
| getFormat         | Get the format of the image that is encoded, example : CODE_39 |
| getType           | Get the type of the image decoded, example : URL, TEXT etc     |
| getImagePath      | Get Path of the image                                          |

The Public methods that we can use in PHPZxing\ZxingImage are,

| Method Name           | Function                                                       |
| -------------         |:--------------------------------------------------------------:|
| getImageErrorCode     | Get the error code for the image not found                     |
| getErrorMessage       | Error Message                                                  |
| getImagePath          | Get Path of the image                                          |

Contibution
--------------------
Please Contribute or suggest changes.