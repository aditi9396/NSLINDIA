<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function generate_barcode($code)
{
    $generator = new BarcodeGeneratorPNG();
    $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
    return $barcode;
}
