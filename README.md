PHPZxing - Wrapper for Zxing Java Library
===========================================
PHPZxing is a small php wrapper that uses the Zxing library to Create and read Barcodes.
Under the hood it still uses the [Zxing library](https://github.com/zxing/zxing) to encode and decode data.

Note
--------------------
* Only Decoder is programmed right now. Needs programming of Encoder.

Basic Configuration
--------------------

Html Code:

```json
{  
    "require": {
        ......
        "dsiddharth2/php-zxing": "dev-master"
        ......
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

How to Use
----------
```php
    
    use PHPZxing\PHPZxingDecoder;

    $decoder        = new PHPZxingDecoder();
    $decodedData    = $decoder->decode('../images/Code128Barcode.jpg');
    print_r($decodedData);

    $config = array(
        'try_harder' => true, // Non mobile mode
        'multiple_bar_codes' => true, // If the image contains muliple bar codes
        'crop' => '100,200,300,300', // If you want to crop image in pixels
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedData    = $decoder->decode('../images/'); // Reads images in complete directory
    print_r($decodedData);

    $decoder        = new PHPZxingDecoder();
    // Images can be sent as an array
    $imageArrays = array(
        '../images/Code128Barcode.jpg',
        '../images/Code39Barcode.jpg'
    );
    $decodedData    = $decoder->decode($imageArrays);
    print_r($decodedData);

    $config = array(
        'try_harder' => true,
        'multiple_bar_codes' => true
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedData    = $decoder->decode('../images/multiple_bar_codes.jpg');
    print_r($decodedData);
```

Contibution
--------------------
Please Contribute or suggest changes.