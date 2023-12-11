<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barcodetest extends CI_Controller {

    public function set_barcode()
    {    
    	
        // Load the Zend library
        require_once APPPATH . 'libraries/Zend/Loader.php';
        Zend_Loader::loadClass('Zend_Barcode');

        $code = rand(10000, 99999);

        $barcodeOptions = array(
            'text' => $code,
        );

        $rendererOptions = array(
            'imageType' => 'png',
        );

        Zend_Barcode::render('code128', 'image', $barcodeOptions, $rendererOptions);
    }
}
