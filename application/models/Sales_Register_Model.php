<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_Register_Model extends CI_Model {

public function get_lr_data1($Consignor, $from, $to)
{
    // echo('arg1');
$query = $this->db->query('SELECT * FROM lr WHERE Consignor = ? AND LRDate BETWEEN ? AND ? AND Status != 2', array($Consignor, $from, $to));
    return $query->result();
}


public function get_lr_data2($Consignor, $from, $to)
{
    // $query = $this->db->query("SELECT * FROM lr WHERE `Consignor`='SUMITOMO CHEMICAL INDIA LIMITED(SPL)' and `LRDate` BETWEEN '2023-12-16' and '2023-12-25'");
      $query = $this->db
    ->select('lr.*, lrdetails.*')
    ->from('lr')
    ->join('lrdetails', 'lr.LRNO = lrdetails.LRNO')
    ->where('lr.Status !=', 2)
    ->where('lr.Consignor', $Consignor)
    ->where('lr.LRDate BETWEEN ' . $this->db->escape($from) . ' AND ' . $this->db->escape($to), '', false)
    ->get();


    return $query->result();
}

public function getSelectedLRData($selectedLRNOs) {
    $this->db->select('lrdetails.id, lrdetails.InvDate, lrdetails.LRNO, lrdetails.LRNO AS DuplicateLRNO, lrdetails.InvoiceNo, lrdetails.InvDate, lrdetails.PkgType, lrdetails.ProductType, lrdetails.Invoicevalue, lrdetails.PkgsNo, lrdetails.ActualWeight, lrdetails.ExcessRate, lrdetails.EWBNo, lrdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace,lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.Consignee AS DuplicateConsignee, lr.ConsigneeMar, lr.ConsigneeAdd, lr.ConsigneeAddMar, CityMaster.CityNameEng, CityMaster.RouteNo');
    $this->db->from('lrdetails');
    $this->db->join('lr', 'lrdetails.LRNO = lr.LRNO', 'left');
    $this->db->join('CityMaster', 'lr.ToPlace = CityMaster.CityNameEng', 'left');
    $this->db->where('lrdetails.LRNO', $selectedLRNOs);

    $query = $this->db->get();
    return $query->row();   

     }



          public function generateMultipleBarcodes($selectedLRNOs)
        {
            $this->load->library('ciqrcode');
            // $barcodeImages = array();


            if (!empty($selectedLRNOs)) {
                foreach ($selectedLRNOs as $lrNo) {

                    $lrData = $this->getSelectedLRData($lrNo);
                     


                    if ($lrData && isset($lrData->PkgsNo) && $lrData->PkgsNo > 0) {
                         // print_r( $lrData);
                            // exit();
                        for ($i = 0; $i < $lrData->PkgsNo; $i++) {
                            $qrCodeData = json_encode(['LRNO' => $lrData->LRNO, 'PkgsNo' => $lrData->PkgsNo]);
                                         

                            $params['data'] = $qrCodeData;
                            $params['level'] = 's';
                            $params['size'] = 2;
                            $params['savename'] = FCPATH . 'assets_old/qrcodes/barcode_' . $lrNo . '_' . $i . '.png';

                            // echo "Generating QR code for LRNO: $lrNo, Package No: $i\n";
                            // echo "File path: " . $params['savename'] . "\n";
                             //secho "Image URL: " . base_url('assets_old/qrcodes/barcode_' . $lrNo . '_' . $i . '.png') . "\n";
                            $this->ciqrcode->generate($params);

                            $barcodeImages[] = base_url('assets_old/qrcodes/barcode_' . $lrNo . '_' . $i . '.png');
                            // print_r( $barcodeImages);
                            // exit();

                        }
                  $barcodeImages[$lrNo] = $barcodeImages;

                    }
                
                }
            }
                return $barcodeImages;



        }


}
