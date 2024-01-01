<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
use BaconQrCode\Encoder\QrCode;


function generate_barcode($code)
{
    $generator = new BarcodeGeneratorPNG();
    $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
    return $barcode;
}
function generate_barcode1($code, $type = 'CODE_128')
{
    $generator = new BarcodeGeneratorPNG();
    
    if ($type == 'QR_CODE') {
        $barcode = QrCode::encode($code)->getMatrix()->toArray();
        $barcode = $generator->getBarcode(implode(',', $barcode), $generator::TYPE_CODE_128);
    } else {
        $barcode = $generator->getBarcode($code, constant("Picqer\Barcode\BarcodeGenerator::$type"));
    }

    return $barcode;
}
