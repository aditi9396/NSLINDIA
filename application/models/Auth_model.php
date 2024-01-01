 <?php
 class Auth_model extends CI_Model
 {
 	public function get_data()
 	{
 		$this->load->database();
 		$country=$this->db->query("SELECT `CPCODE`,`DEPO_NAME` from cpall_depo");
 		return $country->result_array();

    }

    public function user_data($user_id)
    {
        $this->load->database();
        $user=$this->db->query("SELECT `EmpName`,`UserName`,`Depot`,`Designation` from employee where EmpID = ".$user_id."");
        return $user->row();
    }

    public function customerspod() {
      $this->db->select('Consignor');
        $this->db->from('vtcpod1');
        $this->db->where('Verified', 1);
        $this->db->where('Uploaded', 1);
        $this->db->group_by('Consignor');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function updateUserDepot($user_id, $depot)
    {
        $data = array(
            'Depot' => $depot
        );

        $this->db->where('EmpID', $user_id);
        $this->db->update('employee', $data);

        return $this->db->affected_rows() > 0;
    }

    public function getVendorsByType($vendorType)
    {

        $this->db->where('vendor_type', $vendorType);
        $query = $this->db->get('vendor');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function vendor_data()
    {
        $this->load->database();
        $vendor = $this->db->query("SELECT `VendorCode`, `VendorName` FROM vendor");
        return $vendor->result_array();
    }
    public function str_lr_no($keyword){
       $this->db->like('LRNO', $keyword);
       $query = $this->db->get('lr');
       return $query->result();
   }

   public function LRNO($keyword){
       $this->db->like('LRNO', $keyword);
       $query = $this->db->get('lr');
       return $query->result();
   }

   public function fetchLRData($lr_no)
   {
    $this->db->select('*');
    $this->db->from('cpvolumetricdetails');
    $this->db->join('lr', 'cpvolumetricdetails.str_lr_no = lr.str_lr_no');
    $this->db->where('cpvolumetricdetails.str_lr_no', $lr_no);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

public function getFuelVendors() {
    $this->load->database();
    $fuel = $this->db->query("SELECT `petrolpumpName`, `Location` FROM petrolpump");
    return $fuel->result_array();
}

public function getTHCResults($searchType, $searchValue, $d1, $d2) {
    $this->db->select('THCNO, drsdate, vehicleno , Place');
    $this->db->from('thc');

    if ($searchType === 'Bydate') {
        $this->db->where('drsdate >=', date('Y-m-d', strtotime($d1)));
        $this->db->where('drsdate <=', date('Y-m-d', strtotime($d2)));
    } elseif ($searchType === 'THCNO') {
        $this->db->where('THCNO', $searchValue);
    }

    $query = $this->db->get();
    return $query->result_array();
}


public function countTHCResults($searchType, $searchValue, $d1, $d2) {
    $this->db->from('thc');

    if ($searchType === 'Bydate') {
        $this->db->where('drsdate >=', date('Y-m-d', strtotime($d1)));
        $this->db->where('drsdate <=', date('Y-m-d', strtotime($d2)));
    } elseif ($searchType === 'THCNO') {
        $this->db->where('THCNO', $searchValue);
    }

    return $this->db->count_all_results();
}

public function getTHCDetails($THCNO) {
    $this->db->select('*');
    $this->db->from('thc');
    $this->db->where('THCNO', $THCNO);
    $query = $this->db->get();

    return $query->row_array();
}

public function getDRSDetails($drsno) {
    $this->db->select('*');
    $this->db->from('vtcpod1');
    $this->db->where('DRSNO', $drsno);
    $query = $this->db->get();

    return $query->row_array();
}
public function getLRDetails($LRNO) {
    $this->db->select('*');
    $this->db->from('lr');
    $this->db->where('LRNO', $LRNO);
    $query = $this->db->get();

    return $query->row_array();
}

public function getLrDate($str_lr_no) {
    $this->db->select('lrdate');
    $this->db->where('str_lr_no', $str_lr_no);
    $query = $this->db->get('LR');

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->lrdate;
    } else {
        return null;
    }
}


public function getToCity($id) {
    $this->db->select('tocity');
    $this->db->where('id', $id);
    $query = $this->db->get('cpdetails');

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->tocity;
    } else {
        return null;
    }
}


public function executeQueries($sql) {
    $this->db->trans_begin();
    $this->db->multi_query($sql);
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return false;
    } else {
        $this->db->trans_commit();
        return true;
    }
}


public function vendor_data1(){
    $this->load->database();
    $sql= $this->db->query("SELECT * FROM Vendor ");
    return $sql->result_array();
}

public function driver_data($keyword)
{
    $this->db->like('DName', $keyword);
    $query = $this->db->get('drivermaster');
    return $query->result();
}


public function getdistrictscity($keyword) {
    $this->db->select('District, CityNameEng');
    $this->db->like('District', $keyword);
    $this->db->or_like('CityNameEng', $keyword);
    $this->db->group_by('District, CityNameEng');
    $query = $this->db->get('cityMaster');
    return $query->result();
}


public function drs($keyword) {
    $this->db->select('DRSNO');
    $this->db->like('DRSNO', $keyword);
    $query = $this->db->get('vtcpod1');
    return $query->result(); 
}


public function thc($keyword) {
    $this->db->select('THCNO');
    $this->db->like('THCNO', $keyword);
    $query = $this->db->get('thc');
    return $query->result(); 
}

public function getcity1($keyword) {
    $this->db->select('District, CityNameEng');
    $this->db->like('District', $keyword);
    $this->db->or_like('CityNameEng', $keyword);
    $this->db->group_by('District, CityNameEng');
    $query = $this->db->get('cityMaster');
    return $query->result(); 
}



public function License_data()
{
  $this->load->database();
  $driverlicense=$this->db->query("SELECT `LicenseNo` from drivermaster where DNAME='DNAME'");
  return $driverlicense->result_array();
}
public  function vehicle_data()
{
    $this->load->database();
    $vehicleno=$this->db->query("SELECT `Vehicle_No` FROM Vehicle WHERE VendorName = 'VTC 3 PL SERVICES LTD (KALBHOR)'");
    return $vehicleno->result_array();
}
public  function vehicle_data1()
{
    $this->load->database();
    $vehicleno1=$this->db->query("SELECT `Vehicle_No` FROM Vehicle WHERE VendorName = 'VTC 3 PL SERVICES LTD AKOLA'");
    return $vehicleno1->result_array();
}
public  function vehicle_data2()
{
    $this->load->database();
    $vehicleno2=$this->db->query("SELECT `Vehicle_No` FROM Vehicle WHERE VendorName = 'VTC 3 PL SERVICES LTD PUNE'");
    return $vehicleno2->result_array();
}

public function vendor_Name()
{
    $this->load->database();
    $vehiclevendor=$this->db->query("SELECT `VendorName` from vehicle");
    return $vehiclevendor->result_array();
}


public function getAuthToken() {
    $sql = "SELECT `Access_Token`, `Expires_In`, `CreateDT` FROM `authtoken` LIMIT 1";
    $result = $this->db->query($sql);

    if ($result->num_rows() > 0) {
        $row = $result->row();
        $currentdate = new DateTime();
        $tokendate = DateTime::createFromFormat('Y-m-d H:i:s', $row->CreateDT);
        $tokenexpiredate = $tokendate->add(new DateInterval('PT' . $row->Expires_In . 'S'));

        if ($tokenexpiredate > $currentdate) {
            return $row->Access_Token;
        }
    }

    return "";
}

public function getCustomers($userDepot, $searchTerm) {
    $sql = "SELECT CustCode, CustName FROM customers WHERE Status = 1 AND (Location LIKE '%$userDepot%') AND (CustName LIKE '%$searchTerm%' OR CustCode LIKE '%$searchTerm%') LIMIT 0,10";
    $query = $this->db->query($sql);
    return $query->result();
}

public function updateAuthToken($accessToken, $expiresIn, $createDT) {
    $data = array(
        'Access_Token' => $accessToken,
        'Expires_In' => $expiresIn,
        'CreateDT' => $createDT
    );

    $this->db->update('authtoken', $data);
}

public function getLastRequestId() {
    $query = $this->db->get('ewbreqids');
    $row = $query->row();
    return $row->LastRequestID;
}

public function updateLastRequestId($requestId) {
    $data = array('LastRequestID' => $requestId);
    $this->db->update('ewbreqids', $data);
}

public function saveEwayBillInfo($ewbInfo, $requestId) {
    $data = array(
        'EwbNo' => $ewbInfo['ewbNo'],
        'EwbDate' => date('Y-m-d H:i:s', strtotime($ewbInfo['ewayBillDate'])),
        'CEwbNo' => '0',
        'EwbBy' => $ewbInfo['userGstin'],
        'DocNo' => $ewbInfo['docNo'],
        'DocDate' => date('Y-m-d', strtotime($ewbInfo['docDate'])),
        'Value' => $ewbInfo['totInvValue'],
        'ToPlace' => $ewbInfo['toPlace'],
        'ToPincode' => $ewbInfo['toPincode'],
        'FromState' => $ewbInfo['fromStateCode'],
        'ToState' => $ewbInfo['toStateCode'],
        'Validtill' => $ewbInfo['validUpto'] != "" ? date('Y-m-d H:i:s', strtotime($ewbInfo['validUpto'])) : null,
        'Distance' => $ewbInfo['actualDist'],
        'LastLocation' => $ewbInfo['validUpto'] != "" ? $ewbInfo['VehiclListDetails'][0]['fromPlace'] : "",
        'LastVehicleNo' => $ewbInfo['validUpto'] != "" ? $ewbInfo['VehiclListDetails'][0]['vehicleNo'] : ""
    );

    $this->db->insert('ewbnos', $data);
    $this->db->update('ewbnos', $data, array('EwbNo' => $ewbInfo['ewbNo']));

    $this->updateLastRequestId($requestId);
}


public function hamaliaccount($Hvendor)
{
    $this->db->select('HAccountNO');
    $this->db->from('hamalivendor');
    $this->db->where('Hvendor', $Hvendor);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->HAccountNO;
    } else {
        return '';
    }
}

public function hamaliifsc($Hvendor)
{
    $this->db->select('HIFSC');
    $this->db->from('hamalivendor');
    $this->db->where('Hvendor', $Hvendor);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->HIFSC;
    } else {
        return '';
    }
}

public function hamalibranch($Hvendor)
{
    $this->db->select('Hbranch');
    $this->db->from('hamalivendor');
    $this->db->where('Hvendor', $Hvendor);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->Hbranch;
    } else {
        return '';
    }
}

public function hamaliVendorCode($Hvendor)
{
    $this->db->select('VendorCode');
    $this->db->from('hamalivendor');
    $this->db->where('Hvendor', $Hvendor);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->VendorCode;
    } else {
        return '';
    }
}

public function hamalibank($Hvendor)
{
    $this->db->select('Hbank');
    $this->db->from('hamalivendor');
    $this->db->where('Hvendor', $Hvendor);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->Hbank;
    } else {
        return '';
    }
}

public function getAccountNO($ownername)
{
    $this->db->select('AccountNO');
    $this->db->from('drsaccountno');
    $this->db->where('ownername', $ownername);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->AccountNO;
    } else {
        return '';
    }
}

public function getIFSC($ownername)
{
    $this->db->select('IFSC');
    $this->db->from('drsaccountno');
    $this->db->where('ownername', $ownername);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->IFSC;
    } else {
        return '';
    }
}

public function getBankName($ownername)
{
    $this->db->select('BankName');
    $this->db->from('drsaccountno'); 
    $this->db->where('ownername', $ownername);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->BankName;
    } else {
        return '';
    }
}

public function getBranch($ownername)
{
    $this->db->select('branch');
    $this->db->from('drsaccountno'); 
    $this->db->where('ownername', $ownername);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->branch;
    } else {
        return '';
    }
}


public function searchByTHCNo($thcNo) {
    $this->db->where('THCNO', $thcNo);
    $query = $this->db->get('thc');

    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return array();
    }
}


public function searchByDRSNo($DRSNO) {
    $this->db->where('DRSNO', $DRSNO);
    $query = $this->db->get('vtcpod1');

    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return null;
    }
}

public function searchByLR($LRNO) {
    $this->db->where('LRNO', $LRNO);
    $query = $this->db->get('lr');

    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return null;
    }
}



public function deleteByTHCNo($thcNo) {
    $this->db->trans_start(); 

    $this->db->where('THCNO', $thcNo);
    $this->db->delete('thcno');

    $this->db->where('THCNO', $thcNo);
    $this->db->delete('thc');

    $this->db->trans_complete(); 

    if ($this->db->trans_status() === FALSE) {
        echo $this->db->error(); 
        return false;
    } else {
        return true;
    }
}

public function deleteByDRSNo($drsNo) {
    $this->db->trans_start(); 

    $this->db->where('DRSNO', $drsNo);
    $this->db->delete('drsno');

    $this->db->where('DRSNO', $drsNo);
    $this->db->delete('drs1');

    $this->db->trans_complete(); 

    if ($this->db->trans_status() === FALSE) {
        echo $this->db->error(); 
        return false;
    } else {
        return true;
    }
}
public function get_lr_data($str_lr_no) {
    $this->db->where('lr_no', $str_lr_no);
    $query = $this->db->get('lr');
    return $query->row();
}

public function updateReasonForTHCNO($thcno, $newReason) {
    $data = array(
        "Reason" => $Reason,
    );

    $this->db->where('THCNO', $thcno);
    $this->db->update('thc', $data);
}

// PRN

public function getVehicle($searchTerm) {
    $sql = $this->db->query("SELECT Vehicle_No FROM `vehiclemaster` WHERE `Vehicle_No` LIKE '%$searchTerm%'");
    $result = $sql->result_array();
    return $result;
}

public function getCustomerData($searchTerm) {
    try {
        $sql = $this->db->query("SELECT CustCode, CustName FROM customers WHERE CustCode LIKE '%$searchTerm%' LIMIT 10");
        $result = $sql->result_array();
        return $result;
    } catch (Exception $e) {
        log_message('error', 'Exception in getCustomerData: ' . $e->getMessage());
        
    }
}

public function getLRNumbers($partyId, $selectedDate, $fromDate) {
        $data = array();

        $sql = "SELECT LRNO FROM lr WHERE 
                Status = '1' 
                AND Consignor LIKE '%$partyId%' 
                AND Origin = 'PNA' 
                AND CurrentLocation = 'PNA' 
                AND LRDate BETWEEN '$fromDate' AND '$selectedDate' 
                AND DRS_THCNO = ''";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row['LRNO'];
            }
            return $data;
        } else {
            return false;
        }
    }


    public function getMaxId() {
        $this->db->select_max('CAST(SUBSTRING(`PRNId`, 14) AS UNSIGNED)', 'maxId');
        $result = $this->db->get('PRNvehicle');
        return $result->row_array();
    }

    public function insertPrnVehicle($data) {
        $this->db->insert('prnvehicle', $data);
        return $this->db->insert_id();
    }

    public function insertPrnApp($lrData) {
    if ($this->db->insert('prnapp', $lrData)) {
        return true;
    } else {
        // Log SQL error
        log_message('error', 'SQL Error: ' . $this->db->error());
        return false;
    }
}


    public function updateLrTable($lrnoValue) {
    $this->db->set('Status', '7');
    $this->db->where('LRNO', $lrnoValue);
    if ($this->db->update('lr')) {
        return true;
    } else {
        // Log SQL error
        log_message('error', 'SQL Error: ' . $this->db->error());
        return false;
    }
}


/*public function getFilteredRecordsprn($fromDate, $toDate, $THCNO) {
      
        $this->db->where('PRNDate >=', $fromDate);
        $this->db->where('PRNDate <=', $toDate);
        $this->db->where('PRNId', $THCNO);
        $query = $this->db->get('prnvehicle');

        return $query->result(); 
    }*/

    public function searchByDatePRN($dateFrom, $dateTo) {
    $result = $this->db->query("SELECT * FROM `prnvehicle` WHERE `PRNDate` BETWEEN ? AND ? AND ArrivalDate = '0000-00-00'", array($dateFrom, $dateTo));
    return $result->result();
}

public function searchByPrnNo($prnNo) {
    $result = $this->db->query("SELECT * FROM `prnvehicle` WHERE `PRNId` = ? AND ArrivalDate = '0000-00-00'", array($prnNo));
    return $result->result();
}


public function get_UpdatePrnStock_details($Edit_PrnStock)
{    
    $result = $this->db->query("SELECT * FROM `prnvehicle` WHERE `PRNId` = ?", array($Edit_PrnStock));
    return $result->result();
}

public function get_UpdatePrnStock_alldetails($Edit_PrnStock)
{    
    $result = $this->db->query("SELECT T1.LRNO, DATE_FORMAT(LRDate, '%d-%b-%Y') LRDate, ToPlace, PkgsNo, RecievedQty, Reason FROM prnapp T1 INNER JOIN LR T2 ON T1.LRNO = T2.LRNO WHERE PRNId = ?", array($Edit_PrnStock));

    return $result->result();
}

public function updatePrnDetails($data) {
        $this->db->trans_start();

        $this->db->set('ArrivalDate', 'NOW()', false);
        $this->db->set('PrnArrivalDateTime', 'NOW()', false);
        $this->db->set('ArrivalUser', $data['User1']);
        $this->db->set('LoadingUnloading', $data['Unloadingornot']);
        $this->db->set('VendorHamaliName', $data['Hvendor']);
        $this->db->set('HamaliAmount', $data['hamali']);
        $this->db->where('PRNId', $data['thcno']);
        $this->db->update('PRNvehicle');

        if (!empty($data['LRDetails']) && is_array($data['LRDetails'])) {
            foreach ($data['LRDetails'] as $lrow) {
                $this->db->set('ADate', 'NOW()', false);
                $this->db->set('RecievedQty', $lrow['received_qty']);
                $this->db->set('Reason', $lrow['reason']);
                $this->db->where('LRNO', $lrow['LRNO']);
                $this->db->where('PRNId', $data['thcno']);
                $this->db->update('Prnapp');

                $updateStatus = ($lrow['received_qty'] !== $lrow['qty_']) ? 10 : 1;
                $this->updateLRStatus($lrow['LRNO'], $updateStatus, $data['thcno']);

                // Send email when LR quantity does not match
                if ($updateStatus === 10) {
                    $this->sendEmailOnQuantityMismatch($data['thcno'], $data['Vehicleno'], $lrow);
                }
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return false;
        }

        return true;
    }

    public function sendEmailOnQuantityMismatch($thcno, $vehicleno, $lrData) {
        $to = "ashok.kadam@swatpro.co";
        $subject = "Regarding PRN material not arrived";
        $message = "<tr><td>$thcno</td><td>$vehicleno</td><td>{$lrData['LRNO']}</td><td>{$lrData['qty_']}</td><td>{$lrData['received_qty']}</td><td>{$lrData['reason']}</td></tr>";

        $message = "
            <table border=1 cellpadding='5' cellspacing='5' style='margin-top:30px; border-color: black; '>
            <tr><th>PRN NO</th><th>Vehicle No</th><th>LR NO</th><th>PkgsNo</th><th>Arrival Qty</th><th>Reason</th></tr>
            $message
        </table>";

        $headers = array(
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf-8',
            'From: ashokkadam7795@gmail.com',
            'Cc: ashokadam2000@gmail.com,ashokkadam7795@gmail.com',
            'Bcc: anotheremail@example.com'
        );

        $headers = implode("\r\n", $headers);
        $retval = mail($to, $subject, $message, $headers);

        if ($retval === true) {
            echo "<script>alert('Mail sent successfully...')</script>";
        } else {
            echo "Error sending the email.";
        }
    }


public function updateLRStatus($lrno, $status, $thcno) {
    if ($status === 10) {
        $this->db->set('Status', '1');
    } else {
        $this->db->set('Status', $status);
        $this->db->set('DRS_THCNO', $thcno);
    }
    $this->db->where('LRNO', $lrno);
    $this->db->update('LR');
}


// DRS APPROVAL

public function getFilteredRecords($fromDate, $toDate) {
    $this->db->select('id, vendorName, vehicleNo, date, reason, approvalUser');
    $this->db->from('drsprofitapproval');
       
    $this->db->where('date >=', $fromDate);
    $this->db->where('date <=', $toDate);

    $query = $this->db->get();

    if ($query) {
        return $query->result();
    } else {
     
        echo $this->db->error();
        return false;
    }
}


public function delete_Drsapproval($Delete_Approval)
{
    $this->db->where('id', $Delete_Approval);
$this->db->delete('drsprofitapproval');
}


public function get_Drsapproval_details($edit_Approval)
{

    $query = $this->db->get_where('drsprofitapproval', array('id' => $edit_Approval));

    return $query->row_array();

}


public function insertDrsProfitApproval($formArray)
{

$result  = $this->db->insert('drsprofitapproval',$formArray);

    if($result)
    {  

        return true;

    }
    else{
        return false;
    }


}

 public function edit_drsapproval($editdrsid, $formdata)
{
    $this->db->where('id', $editdrsid);
    $this->db->update('drsprofitapproval', $formdata);
}



}




