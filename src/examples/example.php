<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "PHPZxingBase.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "PHPZxingDecoder.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "ZxingImage.php";
    require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "PHPZxing" . DIRECTORY_SEPARATOR . "ZxingBarNotFound.php";

    use PHPZxing\PHPZxingDecoder;

    $decoder        = new PHPZxingDecoder();
    $decodedData    = current($decoder->decode('../images/Code128Barcode.jpg'));
    $decodedData->getImageValue();
    $decodedData->getFormat();
    $decodedData->getType();

    $config = array(
        'try_harder' => true,
        'multiple_bar_codes' => true,
        'crop' => '100,200,300,300',
    );
    $decoder        = new PHPZxingDecoder($config);
    $decodedData    = $decoder->decode('../images/');
    print_r($decodedData);

    $decoder        = new PHPZxingDecoder();
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
?>