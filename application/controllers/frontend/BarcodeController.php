<?php

defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function generateBarcode()
    {

        $code = '1234567890'; 
        $barcode = generate_barcode($code);

        $imagePath = FCPATH . 'barcode.png';
        file_put_contents($imagePath, $barcode);

        $this->load->helper('url');
        $imageURL = base_url('barcode.png');
        echo '<img src="'.$imageURL.'" alt="Barcode">';

    }

}
