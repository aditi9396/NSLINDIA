<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

    public function lrdata($Lrno)
    {
        $query = $this->db->query("SELECT `LRNO`,`LRDate` FROM `lr` WHERE `LRNO`='$Lrno' AND Status = 1 and CancelReason=''");
        return $query->result_array();
    }

    public function lrdataedit($Lrno)
    {
        $query = $this->db->query("SELECT * FROM `lr` WHERE `LRNO`='$Lrno' AND Status = 1 and CancelReason=''");
        return $query->result_array();
    }
        public function lrdatareturn($Lrno)
    {
        $query = $this->db->query("SELECT * FROM `lr` WHERE `LRNO`='$Lrno'");
        return $query->result_array();
    }
        public function Ewbill($Lrno)
    {
                $EWBNO = array();
                $sql = "SELECT EWBNo FROM EWBill WHERE LRNO = ?";
                $result = $this->db->query($sql, array($Lrno));
                foreach ($result->result_array() as $row) {
                    array_push($EWBNO, $row["EWBNo"]);
                }

        return implode(',', $EWBNO);
    }
    
        public function lrdataedit1($Lrno)
    {
        $query = $this->db->query("SELECT `LRNO`, `InvoiceNo`, `InvDate`, `PkgType`, `ProductType`, `Invoicevalue`, `PkgsNo`, `ActwtperPkg`, `ActualWeight`, `ExcessRate`, `EWBNo`, `EWBExpdate` FROM `LRDetails` WHERE `LRNO`='$Lrno'");
        return $query->result_array();
    }
       public function fetch_data12($ConsignorID, $PayType, $LRDate)
    {
        // First query to get ContractID
        $this->db->select('ContractID');
        $this->db->where('ConsignorID', $ConsignorID);
        $this->db->where('Status', 1);
        $this->db->where('ContractType', $PayType);
        $this->db->where("('$LRDate' BETWEEN StartDate AND EndDate)", null, false);
        $query = $this->db->get('contract');

        $results = $query->result();

        if (count($results) > 0) {
            $row = $results[0];
            $ContractID = $row->ContractID;

            // Second query to get Service details
            $this->db->select('ServiceType, DocumentCharges, MatricesAllowed, PickupDelivery, SlabRangeType');
            $this->db->where('ContractID', $ContractID);
            $query = $this->db->get('Serviceselection');
            $row = $query->row_array();

            // Third query to get rates
            $query = $this->db->select('FromWeight, ToWeight, Rate')
                ->where('ContractID', $ContractID)
                ->get('ExcessWeight');
            $rates = $query->result_array();

            $jsonobj = array(
                'status'          => 'success',
                'ContractID'      => $ContractID,
                'DocumentCharges' => $row['DocumentCharges'],
                'ServiceType'     => $row['ServiceType'],
                'SlabRangeType'   => $row['SlabRangeType'],
                'MatricesAllowed' => $row['MatricesAllowed'],
                'PickupDelivery'  => $row['PickupDelivery'],
                'Rates'           => $rates
            );

            return $jsonobj;
        } else {
            $jsonobj = array('status' => 'error', 'message' => 'Contract Not Exist.');
            return $jsonobj;
        }
    }
    public function fetch_dataEdit1($ContractID,$Qty,$ToPlace,$MA)
    {

        $query = $this->db->query("SELECT Doordeliverycharge FROM serviceselection WHERE ContractID = '$ContractID'");
        $row = $query->row_array();

        if ($row['Doordeliverycharge'] == 1) {
            $query = $this->db->query("SELECT Rate FROM Doordeliverycontract WHERE ContractId = '$ContractID' and ToPlace = '$ToPlace'");

            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $DDCharge = $row["Rate"];
            } else {
                $DDCharge = 0;
            }
        } else {
            $DDCharge = 0;
        }

    $query = $this->db->query("SELECT `ContractID`, `ConsignorCode`, `ConsignorName`, `ContractType`, `Slab1from`, `Slab1to`, `Slab2from`, `Slab2to`, `Slab3from`, `Slab3to`, `Slab4from`, `Slab4to`, `Slab5from`, `Slab5to`, `Slab6from`, `Slab6to`, `Slab7from`, `Slab7to`, `Slab8from`, `Slab8to`, `Slab1ratetype`, `Slab2ratetype`, `Slab3ratetype`, `Slab4ratetype`, `Slab5ratetype`, `Slab6ratetype`, `Slab7ratetype`, `Slab8ratetype` FROM  Multislabrate WHERE ContractID = '$ContractID'");

    if ($query->num_rows() > 0) {
        $row = $query->row_array();

        for ($i = 1; $i < 9; $i++) {
            if ($Qty >= $row["Slab${i}from"] && $Qty <= $row["Slab${i}to"]) {
                $RateType = $row["Slab${i}ratetype"];
                $SlabNo = "Slab" . $i;
                break;
            }
        }

        $query = $this->db->query("SELECT CityNameEng, Taluka, District, Pincode FROM CityMaster WHERE CityNameEng = '$ToPlace'");
        $row = $query->row_array();

        switch ($this->input->post('MA')) {
            case "citytodistrict":
                $ToPlace = $row["District"];
                break;
            case "citytotaluka":
                $ToPlace = $row["Taluka"];
                break;
            case "citytopincode":
                $ToPlace = $row["Pincode"];
                break;
            default:
                $ToPlace = $ToPlace;
                break;
        }

        $query = $this->db->query("SELECT $SlabNo, TransitDay FROM LTLSlab WHERE ContractID = '$ContractID' AND ToPlace = '$ToPlace'");
        $row = $query->row_array();
        $jsonobj = array(
            'Rate' => $row[$SlabNo],
            'RateType' => $RateType,
            'TransitDay' => $row['TransitDay'],
            'DDCharge' => $DDCharge
        );
        return $jsonobj; 
    }
}
        
     public function checkcityEdit1($term)
    {
        $query = $this->db->query("SELECT CityNameEng FROM citymaster WHERE Active = 1 AND CityNameEng = ?", array($term));
        $results = $query->result();

        return (count($results) > 0);
    }


    public function updatelrdata($Updatedata,$InvoiceNo)
     {
         $LRNO = $Updatedata['Lrno'];
              $InvoiceNos=$Updatedata['InvoiceNos'];
              $NumberOfInvoices=$Updatedata['NumberOfInvoices'];
              $InvDate =  $Updatedata['invoicedate'];
              $PkgType=$Updatedata['pkgtype'];
              $ProductType=$Updatedata['ProductType'];
              $Invoicevalue=$Updatedata['Invoicevalue'];
              $PkgsNo=$Updatedata['pkgno'];
              $ActwtperPkg=$Updatedata['actwtperpkg'];
              $ActualWeight=$Updatedata['actwt'];
              $ExcessRate=$Updatedata['Exwtchrgs'];
              $FromPlace=$Updatedata['fromcity'];
              $ToPlace =$Updatedata['tocity'];
               $PayBasis=$Updatedata['paytype'];
               $Consignee=$Updatedata['Consignee'];
               $ConsigneeMar=$Updatedata['WIConsigneeMar'];
                $TPkgsNo=$Updatedata['tpkgno'];
                $TActualWeight=$Updatedata['tactwt'];
                $FRTType=$Updatedata['tactwt'];
                $DocketTotal=$Updatedata['grandtotal'];
                $FRTRate=$Updatedata['freightrate'];
                $FRTType=$Updatedata['freighttype'];
                $MOT=$Updatedata['mot'];
                $ServiceType=$Updatedata['servicetype'];
                $PickupDelType=$Updatedata['pickdeli'];
                $DocCharge=$Updatedata['doccharge'];
                $Hamali=$Updatedata['hamalicharge'];
                $OtherCharge=$Updatedata['othercharge'];
                $DoordelCharge=$Updatedata['doordelcharge'];
                $ExcesswtCharge=$Updatedata['excesscharge'];
                $CSGSTRate=$Updatedata['csgstrate'];
                $CSGSTAmount=$Updatedata['csgst'];
                $FreightCharge=$Updatedata['freightotal'];
                $ConsigneeAdd=$Updatedata['WIConsigneeadd'];
                $ConsigneeAddMar=$Updatedata['WIConsigneeaddMar'];
                $ConsigneeMob=$Updatedata['WIConsigneemob'];
                $ConsigneeId=$Updatedata['FMConsignee'];
                $ConsignorAdd=$Updatedata['WIConsignoradd'];
                $ConsignorMob=$Updatedata['WIConsignormob'];
                $ConsignorId=$Updatedata['FMConsignor'];
                $BillingParty=$Updatedata['partyid'];
                $BookingType=$Updatedata['BookingType'];
                $EDD=$Updatedata['eddate'];
                $Consignor = $Updatedata['FMConsignorName'];
                $EwbNos=$Updatedata['EwbNos'];
                $User='PNA2115';
                $this->db->trans_start(); // Start transaction

                // Delete LRDetails
                $this->db->query("DELETE FROM `lrdetails` WHERE `LRNO`=?", array($LRNO));

                // Insert new LRDetails records
                for ($i = 0; $i < $NumberOfInvoices; $i++) {
                    $data = array(
                        'LRNO' => $LRNO,
                        'InvoiceNo' => $InvoiceNo[$i],
                        'InvDate' => date('Y-m-d', strtotime($InvDate[$i])),
                        'PkgType' => $PkgType[$i],
                        'ProductType' => $ProductType[$i],
                        'Invoicevalue' => $Invoicevalue[$i],
                        'PkgsNo' => $PkgsNo[$i],
                        'ActwtperPkg' => $ActwtperPkg[$i],
                        'ActualWeight' => $ActualWeight[$i],
                        'ExcessRate' => $ExcessRate[$i],
                    );

                    $this->db->insert('LRDetails', $data);
                }
              $data = array(
                'FromPlace' => $FromPlace,
                'ToPlace' => $ToPlace,
                'PayBasis' => $PayBasis,
                'Consignor' => $Consignor,
                'Consignee' => $Consignee,
                'ConsigneeMar' => $ConsigneeMar,
                'PkgsNo' => $TPkgsNo,
                'InvoiceNo' => $InvoiceNos,
                'ActualWeight' => $TActualWeight,
                'DocketTotal' => $DocketTotal,
                'FRTRate' => $FRTRate,
                'FRTType' => $FRTType,
                'MOT' => $MOT,
                'ServiceType' => $ServiceType,
                'PickupDelType' => $PickupDelType,
                'DocCharge' => $DocCharge,
                'Hamali' => $Hamali,
                'OtherCharge' => $OtherCharge,
                'DoordelCharge' => $DoordelCharge,
                'ExcesswtCharge' => $ExcesswtCharge,
                'CSGSTRate' => $CSGSTRate,
                'CSGSTAmount' => $CSGSTAmount,
                'FreightCharge' => $FreightCharge,
                'ConsigneeAdd' => $ConsigneeAdd,
                'ConsigneeAddMar' => $ConsigneeAddMar,
                'ConsigneeMob' => $ConsigneeMob,
                'ConsigneeId' => $ConsigneeId,
                'ConsignorAdd' => $ConsignorAdd,
                'ConsignorMob' => $ConsignorMob,
                'ConsignorId' => $ConsignorId,
                'BillingParty' => $BillingParty,
                'BookingType' => $BookingType,
                'EDD' => $EDD
            );

            $this->db->where('LRNO', $LRNO);
            $this->db->update('LR', $data);


            for ($i = 0; $i < count($EwbNos); $i++) {
                $query = "INSERT IGNORE INTO EWBill(LRNO, EWBNo) VALUES ('$LRNO','$EwbNos[$i]')";
                $result = $this->db->query($query);

                if (!$result) {
                    echo "Error: " . $this->db->error;
                }
            }


            $this->db->trans_complete(); // Complete transaction

            if ($this->db->trans_status() === FALSE) {
                // Handle transaction failure
                echo 'Transaction failed!';
            } else {
                // Transaction successful
                echo 'Transaction successful!';
            }
     }
     public function fetchcustCode($term){
        $sql=$this->db->query("SELECT CustCode,CustName FROM Customers WHERE Status = 1 and (CustName LIKE '%$term%' or CustCode LIKE '%$term%') LIMIT 0,10");
        $results = $sql->result();
        return $results;
     }   
     public function fmconsignee($term,$partyid,$city)
     {
        $sql=$this->db->query("SELECT CustCode,CustName FROM Customers WHERE (CustName LIKE '%$term%' or CustCode LIKE '%$term%') 
        and City = '$city' and GroupCode = '$partyid' LIMIT 0,10");
         $results = $sql->result();
        return $results;
     }
     public function CityNameEng($term)
     {
        $sql=$this->db->query("SELECT CityNameEng,District FROM CityMaster WHERE Active = 1 and CityNameEng LIKE '%$term%' LIMIT 0,10");
        $query=$sql->result();
        return $query;
     }
     public function insertreturn($Updatedata,$InvoiceNo,$userdepo)
     {
        $sql = "SELECT MAX(CAST(SUBSTRING(LRNO, " . (strlen($userdepo) + 1) . ", 10) AS UNSIGNED)) AS max_value FROM LR WHERE LRNO LIKE '%$userdepo%'";
        $query = $this->db->query($sql);

        $row = $query->row();

        if (empty($row->max_value)) {
            $id = 1;
        } else {
            $id = $row->max_value + 1;
        }

        $LRNO = "$userdepo" . str_pad($id, 10, 0, STR_PAD_LEFT);

              $InvoiceNos=$Updatedata['InvoiceNos'];
              $NumberOfInvoices=$Updatedata['NumberOfInvoices'];
              $CoastCenter=$Updatedata['CoastCenter'];
              $lrdate=$Updatedata['lrdate'];
              $InvDate =  $Updatedata['invoicedate'];
              $PkgType=$Updatedata['pkgtype'];
              $Origin=$Updatedata['Origin'];
              $ProductType=$Updatedata['ProductType'];
              $Invoicevalue=$Updatedata['Invoicevalue'];
              $CurrentLocation=$Updatedata['CurrentLocation'];
              $Destination=$Updatedata['Destination'];
              $PkgsNo=$Updatedata['pkgno'];
              $ActwtperPkg=$Updatedata['actwtperpkg'];
              $ActualWeight=$Updatedata['actwt'];
              $ExcessRate=$Updatedata['Exwtchrgs'];
              $FromPlace=$Updatedata['fromcity'];
              $ToPlace =$Updatedata['tocity'];
               $PayBasis=$Updatedata['paytype'];
               $Consignee=$Updatedata['Consignee'];
               $ConsigneeMar=$Updatedata['WIConsigneeMar'];
                $TPkgsNo=$Updatedata['tpkgno'];
                $TActualWeight=$Updatedata['tactwt'];
                $FRTType=$Updatedata['tactwt'];
                $DocketTotal=$Updatedata['grandtotal'];
                $FRTRate=$Updatedata['freightrate'];
                $FRTType=$Updatedata['freighttype'];
                $MOT=$Updatedata['mot'];
                $ServiceType=$Updatedata['servicetype'];
                $PickupDelType=$Updatedata['pickdeli'];
                $DocCharge=$Updatedata['doccharge'];
                $Hamali=$Updatedata['hamalicharge'];
                $OtherCharge=$Updatedata['othercharge'];
                $DoordelCharge=$Updatedata['doordelcharge'];
                $ExcesswtCharge=$Updatedata['excesscharge'];
                $CSGSTRate=$Updatedata['csgstrate'];
                $CSGSTAmount=$Updatedata['csgst'];
                $FreightCharge=$Updatedata['freightotal'];
                $ConsigneeAdd=$Updatedata['WIConsigneeadd'];
                $ConsigneeAddMar=$Updatedata['WIConsigneeaddMar'];
                $ConsigneeMob=$Updatedata['WIConsigneemob'];
                $ConsigneeId=$Updatedata['FMConsignee'];
                $ConsignorAdd=$Updatedata['WIConsignoradd'];
                $ConsignorMob=$Updatedata['WIConsignormob'];
                $ConsignorId=$Updatedata['FMConsignor'];
                $BillingParty=$Updatedata['partyid'];
                $BookingType=$Updatedata['BookingType'];
                $EDD=$Updatedata['eddate'];
                $Consignor = $Updatedata['FMConsignorName'];
                $EwbNos=$Updatedata['EwbNos'];
                $User='PNA2115';
                $ReturnLR=$Updatedata['Lrno'];
                $this->db->trans_start(); // Start transaction

                // Insert new LRDetails records
                for ($i = 0; $i < $NumberOfInvoices; $i++) {
                    $data = array(
                        'LRNO' => $LRNO,
                        'InvoiceNo' => $InvoiceNo[$i],
                        'InvDate' => date('Y-m-d', strtotime($InvDate[$i])),
                        'PkgType' => $PkgType[$i],
                        'ProductType' => $ProductType[$i],
                        'Invoicevalue' => $Invoicevalue[$i],
                        'PkgsNo' => $PkgsNo[$i],
                        'ActwtperPkg' => $ActwtperPkg[$i],
                        'ActualWeight' => $ActualWeight[$i],
                        'ExcessRate' => $ExcessRate[$i],
                    );

                    $this->db->insert('LRDetails', $data);
                }
             $data = array(
                    'LRNO' => $LRNO,
                    'LRDate' => $lrdate,
                    'LRDT' => date('Y-m-d H:i:s'), // Assuming you want the current date and time
                    'FromPlace' => $FromPlace,
                    'ToPlace' => $ToPlace,
                    'CoastCenter' => $CoastCenter,
                    'PayBasis' => $PayBasis,
                    'CurrentLocation' => $CurrentLocation,
                    'Destination' => $Destination,
                    'Consignor' => $Consignor,
                    'Consignee' => $Consignee,
                    'ConsigneeMar' => $ConsigneeMar,
                    'PkgsNo' => $TPkgsNo,
                    'InvoiceNo' => $InvoiceNos,
                    'ActualWeight' => $TActualWeight,
                    'DocketTotal' => $DocketTotal,
                    'FRTRate' => $FRTRate,
                    'Status' => 1, // Fixed typo, changed '=' to '=>'
                    'CreatedBy' => $User,
                    'Origin' => $Origin, // Fixed typo, changed '=' to '=>'
                    'FRTType' => $FRTType,
                    'MOT' => $MOT,
                    'ServiceType' => $ServiceType,
                    'PickupDelType' => $PickupDelType,
                    'DocCharge' => $DocCharge,
                    'Hamali' => $Hamali,
                    'OtherCharge' => $OtherCharge,
                    'DoordelCharge' => $DoordelCharge,
                    'ExcesswtCharge' => $ExcesswtCharge,
                    'CSGSTRate' => $CSGSTRate,
                    'CSGSTAmount' => $CSGSTAmount,
                    'FreightCharge' => $FreightCharge,
                    'ConsigneeAdd' => $ConsigneeAdd,
                    'ConsigneeAddMar' => $ConsigneeAddMar,
                    'ConsigneeMob' => $ConsigneeMob,
                    'ConsigneeId' => $ConsigneeId,
                    'ConsignorAdd' => $ConsignorAdd,
                    'ConsignorMob' => $ConsignorMob,
                    'ConsignorId' => $ConsignorId,
                    'BillingParty' => $BillingParty,
                    'BookingType' => $BookingType,
                    'EDD' => $EDD,
                    'ReturnLR' => $ReturnLR
                );

                $this->db->insert('LR', $data);



            for ($i = 0; $i < count($EwbNos); $i++) {
                $query = "INSERT IGNORE INTO EWBill(LRNO, EWBNo) VALUES ('$LRNO','$EwbNos[$i]')";
                $result = $this->db->query($query);

                if (!$result) {
                    echo "Error: " . $this->db->error;
                }
            }


            $this->db->trans_complete(); // Complete transaction

            if ($this->db->trans_status() === FALSE) {
                // Handle transaction failure
                echo 'Transaction failed!';
            } else {
                // Transaction successful
                echo 'Transaction successful!';
            }

         return  $LRNO;

     }
      public function lrdataselect($term,$userdepo)
    {
        $query = $this->db->query("SELECT `LRNO` FROM `lr` WHERE `LRNO` LIKE '%$term%' AND (Status = 1 or Status = 6) and CurrentLocation='$userdepo' and CancelReason='' LIMIT 0,10");
        return $query->result_array();
    }
    public function selectdepo()
    {
        try {
        $query=$this->db->query("SELECT `CPCODE`, `DEPO_NAME` FROM `CPAll_Depo` UNION All SELECT `CPCODE`, `cpdeponame` FROM CPDEPO");

        $result=$query->result();
        return $result;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }
    public function fetchgetlrdataJUNE($lrno)
    {
        try{
            $sql=$this->db->query("SELECT `LRNO`,`LRDate`,`PayBasis`,`FromPlace`,`ToPlace`,`ArriveDate`,`PkgsNo`,`DeliveredQty`,`ActualWeight`,`DocketTotal` FROM LR where `LRNO`='$lrno'");
            $query=$sql->result();
            return $query;

        }
        catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }
    public function InsertThcloading($userdepot, $lrlist, $totaltopay, $Contract, $Gp)
    {
        $year = (date('m') > 3) ? date('y') : date('y') - 1;
        $fyear = $year . ($year + 1);

        try {
            $query = $this->db->query("
                SELECT MAX(CAST(SUBSTRING(LSNO, 17, 6) AS UNSIGNED)) AS max_value
                FROM loadingthc
                WHERE LSNO LIKE '%$userdepot/$fyear%'
            ");

            if ($query->num_rows() == 0) {
                $id = 1;
            } else {
                $row = $query->row(); // Fetch the result as an object
                $maxValue = $row->max_value;
                $id = is_null($maxValue) ? 1 : $maxValue + 1;
            }

            $LSNO = "LSVH/$userdepot/$fyear/" . str_pad($id, 6, 0, STR_PAD_LEFT);
            $this->db->trans_start();
            $this->db->query("
                INSERT INTO loadingthc (LRNO, LSDate, LSDT, LSNO, totaltopay, Contract, Depot, Gp)
                SELECT LRNO, NOW(), NOW(), '$LSNO', '$totaltopay', '$Contract', '$userdepot', '$Gp'
                FROM LR
                WHERE LRNO IN ($lrlist)
            ");
            $this->db->query("UPDATE LR SET LSNO = '$LSNO', Status = 8 WHERE LRNO IN ($lrlist)");

            // Complete transaction
            $this->db->trans_complete();

            // if ($this->db->trans_status() === FALSE) {
            //     // Handle transaction failure
            //     echo 'Transaction failed!';
            // } else {
            //     // Transaction successful
            //     echo 'Transaction successful!';
            // }

            return $LSNO;

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', $e->getMessage());
            throw new \Exception('Error inserting data into loadingthc and updating LSNO in Lr');
        }
    }
    public function InsertDrsloading($userdepot, $lrlist, $totaltopay, $Contract, $Gp)
    {
        $year = (date('m') > 3) ? date('y') : date('y') - 1;
        $fyear = $year . ($year + 1);

        try {
            $query = $this->db->query("
                SELECT MAX(CAST(SUBSTRING(LSNO, 17, 6) AS UNSIGNED)) AS max_value
                FROM loadingdrs
                WHERE LSNO LIKE '%$userdepot/$fyear%'
            ");

            if ($query->num_rows() == 0) {
                $id = 1;
            } else {
                $row = $query->row(); // Fetch the result as an object
                $maxValue = $row->max_value;
                $id = is_null($maxValue) ? 1 : $maxValue + 1;
            }

            $LSNO = "LSDS/$userdepot/$fyear/" . str_pad($id, 6, 0, STR_PAD_LEFT);
            $this->db->trans_start();
            $this->db->query("
                INSERT INTO loadingdrs (LRNO, LSDate, LSDT, LSNO, totaltopay, Contract, Depot, Gp)
                SELECT LRNO, NOW(), NOW(), '$LSNO', '$totaltopay', '$Contract', '$userdepot', '$Gp'
                FROM LR
                WHERE LRNO IN ($lrlist)
            ");
            $this->db->query("UPDATE LR SET LSNO = '$LSNO', Status = 9 WHERE LRNO IN ($lrlist)");

            // Complete transaction
            $this->db->trans_complete();

            // if ($this->db->trans_status() === FALSE) {
            //     // Handle transaction failure
            //     echo 'Transaction failed!';
            // } else {
            //     // Transaction successful
            //     echo 'Transaction successful!';
            // }

            return $LSNO;

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', $e->getMessage());
            throw new \Exception('Error inserting data into loadingthc and updating LSNO in Lr');
        }
    }
    public function viewlssearch($LSNO)
    {
        $query = $this->db->query("SELECT `LRNO`, `LSNO`, `LRDT`, `FromPlace`, `Toplace`, `PayBasis`, `InvoiceNo`, `PkgsNo`, `ActualWeight`, `DocketTotal`, `Consignor`, `Consignee`, `LRDate`, `ArriveDate`, `FreightCharge`,IF(LR.PayBasis = 'TO PAY', LR.DocketTotal,0) as pay, `CreatedBy`, `CurrentLocation`, `Status`, `DeliveredQty`, `Origin`,`EDD` FROM `LR` WHERE `LSNO`='$LSNO'");
        return $query->result_array();
    }
    public function Sapthcadvance($date,$Enddate,$depot){
        if($depot=='All'){
       $this->db->select('th.THCNO, th.Advance, th.THCdate, th.THCDT, vnd.VendorCode, vnd.VendorName, th.VehicleNo, th.Location, th.Status1, th.Hamali, th.Hvendor, th.HVendorCode, th.StartingKM, th.liter, th.Rate, th.Dieselamt, th.Dieselvendorname, th.Dieselbillno, pp.DVendorCode, loc.LocationCode, sapcc.CenterCode');
            $this->db->from('THC as th');
            $this->db->join('vendordrivermaster as vnd', 'vnd.VendorName = th.DriverName OR vnd.VendorName = th.VendorName');
            $this->db->join('PetrolPump as pp', 'pp.PetrolPumpName = th.Dieselvendorname', 'left');
            $this->db->join('sapcitycoastcenter as sapcc', 'sapcc.CenterName = th.Location');
            $this->db->join('SapLocationcoastcenter as loc', 'loc.CenterCode = th.Location');
            $this->db->where('th.Status1', 0);
            $this->db->where('th.THCdate >=', $date);
            $this->db->where('th.THCdate <=', $Enddate);
            $this->db->where('th.Canceluser !=', 'PNA2195');
            $this->db->where('th.VendorName !=', 'ADHOC');
            $this->db->where('th.Canceluser !=', 'PNA80');
            $this->db->where('th.Canceluser !=', 'PNA2052');
            $this->db->group_by('THCNO');

            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        else{
            $this->db->select('th.THCNO, th.Advance, th.THCdate, th.THCDT, vnd.VendorCode, vnd.VendorName, th.VehicleNo, th.Location, th.Status1, th.Hamali, th.Hvendor, th.HVendorCode, th.StartingKM, th.liter, th.Rate, th.Dieselamt, th.Dieselvendorname, th.Dieselbillno, pp.DVendorCode, loc.LocationCode, sapcc.CenterCode');
            $this->db->from('THC as th');
            $this->db->join('vendordrivermaster as vnd', 'vnd.VendorName = th.DriverName OR vnd.VendorName = th.VendorName');
            $this->db->join('PetrolPump as pp', 'pp.PetrolPumpName = th.Dieselvendorname', 'left');
            $this->db->join('sapcitycoastcenter as sapcc', 'sapcc.CenterName = th.Location');
            $this->db->join('SapLocationcoastcenter as loc', 'loc.CenterCode = th.Location');
            $this->db->where('th.Status1', 0);
            $this->db->where('th.THCdate >=', $date);
            $this->db->where('th.THCdate <=', $Enddate);
            $this->db->where('th.Canceluser !=', 'PNA2195');
            $this->db->where('th.VendorName !=', 'ADHOC');
            $this->db->where('th.Canceluser !=', 'PNA80');
            $this->db->where('th.Canceluser !=', 'PNA2052');
            $this->db->where('th.`Location`=',$depot);
            $this->db->group_by('THCNO');

            $query = $this->db->get();
            $result = $query->result();
            return $result; 
        }
 
    }
    public function insertsapthc($selectedDataArray)
    {
        foreach ($selectedDataArray as $rowData) {
            // Access the data for each field in the row
            $THCNO = $rowData['THCNO'];
            $VendorName = $rowData['VendorName'];
            $Location= $rowData['Location'];  
            $VendorCode=$rowData['VendorCode'];  
            $THCdate=$rowData['THCdate'];  
            $Advance=$rowData['Advance'];  
            $VehicleNo=$rowData['VehicleNo'];
            $Hamali =$rowData['Hamali']; 
            $Hvendor=$rowData['Hvendor']; 
            $HVendorCode=$rowData['HVendorCode'];  
            $StartingKM=$rowData['StartingKM'];  
            $liter=$rowData['liter'];  
            $Rate=$rowData['Rate'];
            $Dieselamt=$rowData['Dieselamt'];
            $Dieselvendorname =$rowData['Dieselvendorname'];
            $Dieselbillno=$rowData['Dieselbillno'];
            $DVendorCode =$rowData['DVendorCode'];
            try{
            $this->db->trans_start();
            $this->db->query("INSERT INTO `sapthcmaster`(`THCNO`,`THCdate`,`Advance`,`VehicleNo`,`Location`,`VendorName`,`VendorCode`,`Hamali`,`Hvendor`,`HVendorCode`,`StartingKM`,`liter`,`Rate`,`Dieselamt`,`Dieselvendorname`,`Dieselbillno`,`DVendorCode`,`currentDatetime`) VALUES ('$THCNO','$THCdate','$Advance','$VehicleNo','$Location','$VendorName','$VendorCode','$Hamali','$Hvendor','$HVendorCode','$StartingKM','$liter','$Rate','$Dieselamt','$Dieselvendorname','$Dieselbillno','$DVendorCode', NOW())");


                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    throw new \Exception('Error inserting data into sapthcmaster');
                } else {
                    $this->db->trans_commit();
                }
            } catch (\Exception $e) {
                log_message('error', $e->getMessage());
                throw new \Exception('Error inserting data into sapthcmaster and updating LSNO in Lr');
            }
        }
    }
    public function fetchConsignor($userDepot, $startDate, $endDate)
    {
        try {
        $query=$this->db->query("SELECT DISTINCT(Consignor) FROM LR 
        WHERE LRDate >= '$startDate'
        AND LRDate <= '$endDate' AND LRNO LIKE '%$userDepot%'");


        $result=$query->result();
        return $result;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }
    public function SelectConsidatafetch($dt1,$dt2,$Consigner,$depo)
    {
        $sql=$this->db->query("SELECT LRNO,DATE_FORMAT(LRDate, '%d-%m-%Y') LRDate,Consignor,Consignee,PkgsNo,ActualWeight,InvoiceNo FROM LR WHERE LRDate >= '$dt1' and LRDate <= '$dt2' AND CancelUser='' AND  Consignor='$Consigner' and LRNO like '%$depo%'");
        $query=$sql->result();
        return $query;
    }
    public function lrlazerprtint($LRNO)
    {
        // First Query
        $sql1 = $this->db->query("SELECT LRNO, DATE_FORMAT(LRDate, '%d-%m-%Y') LRDate, FromPlace, ToPlace, PayBasis, Consignor, 
             Consignee, ConsigneeAdd, ConsigneeMob, PkgsNo, ActualWeight, DocketTotal, FRTRate, Status, Origin, Destination, CurrentLocation, FRTType, MOT, ServiceType,
            PickupDelType, DocCharge, Hamali, OtherCharge, DoordelCharge, FreightCharge, DATE_FORMAT(EDD, '%d-%m-%Y') EDD, ExcesswtCharge, DocketTotal, CSGSTRate, CSGSTAmount,NextLocation as Deliverydepot, 
             CreatedBy  FROM LR WHERE LRNO = ?", array($LRNO));

        // Second Query
        $sql2 = $this->db->query("SELECT GroupCode FROM LR t1 JOIN Customers t2 ON t1.ConsignorId = t2.CustCode WHERE LRNO = ?", array($LRNO));

        // Check if the first query returned any rows
        if ($sql1->num_rows() > 0) {
            // Fetch the result of the first query as an associative array
            $result1 = $sql1->row_array();

            // Check if the second query returned any rows
            if ($sql2->num_rows() > 0) {
                $result2 = $sql2->row_array();

                $mergedResult = array_merge($result1, $result2);

                return $mergedResult;
            }
        }
        return array();
    }

    public function lrlazerprtint1($LRNO)
    {
        $query = $this->db->query("SELECT `LRNO`, `InvoiceNo`, `InvDate`, `PkgType`, `ProductType`, `Invoicevalue`, `PkgsNo`, `ActwtperPkg`, `ActualWeight`, `ExcessRate`, `EWBNo`, `EWBExpdate` FROM `LRDetails` WHERE `LRNO`='$LRNO'");
        return $query->result_array();
    } 

    public function multiplelrdata($LRNO)
    {
        $results = array();

        foreach ($LRNO as $single_LRNO) {
            $sql1 = $this->db->query("SELECT LRNO, DATE_FORMAT(LRDate, '%d-%m-%Y') LRDate, FromPlace, ToPlace, PayBasis, Consignor, 
                     Consignee, ConsigneeAdd, ConsigneeMob, PkgsNo, ActualWeight, DocketTotal, FRTRate, Status, Origin, Destination, CurrentLocation, FRTType, MOT, ServiceType,
                    PickupDelType, DocCharge, Hamali, OtherCharge, DoordelCharge, FreightCharge, DATE_FORMAT(EDD, '%d-%m-%Y') EDD, ExcesswtCharge, DocketTotal, CSGSTRate, CSGSTAmount,NextLocation as Deliverydepot, 
                     CreatedBy  FROM LR WHERE LRNO = ?", array($single_LRNO));
            $sql2 = $this->db->query("SELECT GroupCode FROM LR t1 JOIN Customers t2 ON t1.ConsignorId = t2.CustCode WHERE LRNO = ?", array($single_LRNO));

            if ($sql1->num_rows() > 0 && $sql2->num_rows() > 0 ) {
                $result1 = $sql1->row_array();
                $result2 = $sql2->row_array();
                
                $mergedResult = array_merge($result1, $result2);
                $results[] = $mergedResult;
            }
        }

        return $results;
    }
        public function fetchConsignor1($Depot, $startDate, $endDate)
    {
        try {
        $query=$this->db->query("SELECT Cosigner FROM vtcpod 
        WHERE BookingDate >= '$startDate'
        AND BookingDate <= '$endDate' AND Uploaded = 1 AND Verified = 1 AND DRSNO LIKE '%$Depot%' group by Cosigner");


        $result=$query->result();
        return $result;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }
    public function datastatement($d1,$d2,$Depot,$Consigner)
    {
        try{       
            $this->db->select('DISTINCT(LRNO), Cosigner, Path, DRSNO, Uploadtime');
            $this->db->from('vtcpod');
            $this->db->where('Uploaded', 1);
            $this->db->where('Verified', 1);
            $this->db->where('BookingDate >=', $d1);
            $this->db->where('BookingDate <=', $d2);
            $this->db->like('DRSNO', $Depot);
            $this->db->like('LRNO', $Depot);
            $this->db->where('Cosigner', $Consigner);
            $this->db->where('StatementNo', '');
            $this->db->group_by('LRNO');
            $this->db->order_by('LRNO', 'ASC');
        
            $query = $this->db->get();
            return $query->result();
        }
        
        catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }
    public function Insertstatement($LRNO,$userdepo,$user)
    {
        try{
            $query = $this->db->query("
            SELECT MAX(CAST(SUBSTRING(StatementNo, 4, 6) AS UNSIGNED)) StatMax FROM vtcpod where StatementNo != '' and DRSNO LIKE '%$userdepo%'
        ");

        if ($query->num_rows() == 0) {
            $id = 1;
        } else {
            $row = $query->row(); // Fetch the result as an object
            $maxValue = $row->StatMax;
            $id = is_null($maxValue) ? 1 : $maxValue + 1;
        }

        $StatementNo = "$userdepo" . str_pad($id, 6, 0, STR_PAD_LEFT);
        foreach ($LRNO as $lr) {         
            $this->db->trans_start();
            $this->db->query("UPDATE vtcpod SET StatementNo = '$StatementNo', StatementDate = Now(), StatementUser= '$user' where LRNO='$lr'");
            $this->db->query("UPDATE LR SET StatementNos = '$StatementNo' where LRNO='$lr'"); // Use $lr instead of $LRNO
            
            $this->db->trans_complete();
        
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new \Exception('Error inserting data into sapthcmaster');
            } else {
                $this->db->trans_commit();
            }
        }
        return $StatementNo;
        }
        catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', $e->getMessage());
            throw new \Exception('Error inserting data into loadingthc and updating LSNO in Lr');
        }  
    }
    public function fetch_statement($data)
    {
        $query = $this->db->query("SELECT DISTINCT(LRNO), BookingDate, Place, Cosigner, Consignee, Qty, InvoiceNo, StatementNo FROM vtcpod where StatementNo = '$data' order by LRNO");
        return $query->result_array();
    } 
}
