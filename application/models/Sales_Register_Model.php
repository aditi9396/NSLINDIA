<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_Register_Model extends CI_Model {

    public function get_lr_data1($Consignor, $from, $to)
    {
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
    if (!empty($selectedLRNOs)) {
        foreach ($selectedLRNOs as $lrNo) {
            $lrData = $this->getSelectedLRData($lrNo);
            if ($lrData && isset($lrData->PkgsNo) && $lrData->PkgsNo > 0) {
                for ($i = 0; $i < $lrData->PkgsNo; $i++) {
                    $qrCodeData = json_encode(['LRNO' => $lrData->LRNO, 'PkgsNo' => $lrData->PkgsNo]);
                    

                    $params['data'] = $qrCodeData;
                    $params['level'] = 's';
                    $params['size'] = 2;
                    $params['savename'] = FCPATH . 'assets_old/qrcodes/barcode_' . $lrNo . '_' . $i . '.png';
                    $this->ciqrcode->generate($params);

                    $barcodeImages[] = base_url('assets_old/qrcodes/barcode_' . $lrNo . '_' . $i . '.png');

                }
                $barcodeImages[$lrNo] = $barcodeImages;

            }
            
        }
    }
    return $barcodeImages;



<<<<<<< HEAD
}
=======
        }
// ==================================
 public function get_lr_data11($Consignor, $from, $to)
    {
        $this->db->select('lr.LRNO, lr.id, lr.LRDate, lr.LRDT, lr.ArriveDate, lr.FromPlace, lr.ToPlace, lr.PayBasis, lr.Consignor, lr.Consignee, lr.ConsigneeMar, lr.PkgsNo, lr.ActualWeight, lr.DocketTotal, lr.FRTRate, lr.Status, lr.InvoiceNo, lr.Origin, lr.CoastCenter, lr.Destination, lr.CurrentLocation, lr.NextLocation, lr.BookingType, lr.ConsignorId, lr.ConsigneeId, lr.FRTType, lr.DRS_THCNO, lr.ArriveQty, lr.CancelReason, lr.CancelDate, lr.CancelUser, lr.MOT, lr.ServiceType, lr.PickupDelType, lr.ConsigneeAdd, lr.ConsigneeAddMar, lr.ConsigneeMob, lr.DocCharge, lr.Hamali, lr.OtherCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.CSGSTRate, lr.CSGSTAmount, lr.CreatedBy, lr.FreightCharge, lr.BillingParty, lr.ConsignorAdd, lr.ConsignorMob, lr.EDD, lr.EWBNo, lr.EWBDate, lr.DeliveredQty, lr.Billgenerate, lr.DeliveryDate, lr.ReturnLR, lr.ManualLRNO, lr.LRedituser, lr.StatementNos, lr.LRHamalis, lr.Paidtype, lr.CPvaluesearch, lr.LSNO, lr.ManifestNo, lr.perbox');
        $this->db->from('lr');
        $this->db->join('cpvolumetricdetails', 'lr.LRNO = cpvolumetricdetails.LRNO', 'inner');
        $this->db->where('lr.Consignor', $Consignor);
        $this->db->where('lr.LRDate BETWEEN "' . $from . '" AND "' . $to . '"', NULL, FALSE);
        $this->db->where('lr.Status !=', 2);
>>>>>>> bf5fc4eaf6ebcc8bb52d127dafbe255a58f3d1e3

        $query = $this->db->get();
        return $query->result();
    }



 public function getSelectedLRDatacp($selectedLRNOs) {
    $this->db->select('lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.Consignee AS DuplicateConsignee, lr.ConsigneeMar, lr.ConsigneeAdd, lr.ConsigneeAddMar, CityMaster.CityNameEng, CityMaster.RouteNo, cpvolumetricdetails.id AS cpvolumetricdetails_id, cpvolumetricdetails.LRDate AS cpvolumetricdetails_LRDate, cpvolumetricdetails.LRNO AS cpvolumetricdetails_LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, cpvolumetricdetails.status');
        $this->db->from('lr');
    $this->db->join('CityMaster', 'lr.ToPlace = CityMaster.CityNameEng', 'left');
    $this->db->join('cpvolumetricdetails', 'lr.LRNO = cpvolumetricdetails.LRNO', 'left');
    $this->db->where('cpvolumetricdetails.LRNO', $selectedLRNOs);
    $query = $this->db->get();
     
 
    return $query->row();
}


       public function generateMultipleBarcodescp($selectedLRNOs)
{
    $this->load->library('ciqrcode');
    $barcodeImages1 = array();

    if (!empty($selectedLRNOs)) {

               
        foreach ($selectedLRNOs as $lrNo1) {
        //                     print_r($selectedLRNOs);
        // exit();

            $lrData1 = $this->getSelectedLRDatacp($lrNo1);

            if ($lrData1 && isset($lrData1->PkgsNo) && $lrData1->PkgsNo > 0) {
                $barcodeImages = array();

                for ($i = 0; $i < $lrData1->PkgsNo; $i++) {
                    $qrCodeData = json_encode(['LRNO' => $lrData1->str_lr_no, 'PkgsNo' => $lrData1->PkgsNo]);
                    $params['data'] = $qrCodeData;
                    $params['level'] = 's';
                    $params['size'] = 2;
                    $params['savename'] = FCPATH . 'assets_old/qrcodes/barcode_' . $lrNo1 . '_' . $i . '.png';

                    $this->ciqrcode->generate($params);

                    $barcodeImages1[] = base_url('assets_old/qrcodes/barcode_' . $lrNo1 . '_' . $i . '.png');

                }

                $barcodeImages1[$lrNo1] = $barcodeImages1;
            }
        }
    }

    return $barcodeImages1;
}



public function get_lr_data22($Consignor, $from, $to)
{
      $query = $this->db
    ->select('lr.*, cpvolumetricdetails.*')
    ->from('lr')
    ->join('cpvolumetricdetails', 'lr.LRNO = cpvolumetricdetails.LRNO')
    ->where('lr.Status !=', 2)
    ->where('lr.Consignor', $Consignor)
    ->where('lr.LRDate BETWEEN ' . $this->db->escape($from) . ' AND ' . $this->db->escape($to), '', false)
    ->get();


    return $query->result();
}
// =====================================================

public function get_lr_data23($Consignor, $from, $to)
{
    $query = $this->db
        ->select('lr.LRNO, lr.LRDate, vtcpod.DRSNO, vtcpod.DRSdate, vtcpod.Place, vtcpod.Consignee, vtcpod.VendorName, vtcpod.Status, vtcpod.FreightCharge, vtcpod.Advance, vtcpod.Hamali, vtcpod.FinalHamali, vtcpod.LaodingHamali, vtcpod.DriverName, vtcpod.Cosigner, vtcpod.DriverMobile, vtcpod.Verified, vtcpod.Penalty, vtcpod.DeliveryDate, VehicleNo, vtcpod.DRSKM, lr.EWBNo, lr.EWBDate')
        ->from('lr')
        ->join('vtcpod', 'lr.LRNO = vtcpod.LRNO')
        ->where('lr.Consignor', $Consignor)
        ->where('vtcpod.DRSdate BETWEEN ' . $this->db->escape($from) . ' AND ' . $this->db->escape($to))
        ->get();

    return $query->result();
}


// ===========================

public function get_lr_data24($Consignor, $from, $to)
{
    $query =$this->db->select('lr.LRNO, lr.LRDate, lr.FromPlace, lr.ToPlace, thc.THCNO, thc.THCdate, thc.VehicleNo, thc.DriverName, thc.DriverMobile, thc.VendorName, thc.Advance, thc.FreightCharge, thc.BalanceFreight, thc.LoadingHamali, thc.UnloadingHamali, thc.StartingKM, thc.ClosingKM, thc.ArrivalDate, thc.UpdatedHamali')
        ->from('lr')
       ->join('lrthcdetails', 'lr.LRNO = lrthcdetails.LRNO')
        ->join('thc', 'lrthcdetails.THCNO = thc.THCNO')
        ->where('lr.Consignor', $Consignor)
        ->where('thc.THCdate BETWEEN  ' . $this->db->escape($from) . ' AND ' . $this->db->escape($to))
        ->get();

    return $query->result();
}


}