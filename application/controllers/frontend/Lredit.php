<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

class Lredit extends CI_Controller {

    public function Editselectlr()
    {

        $this->load->model('Auth_model');

        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

        $this->load->view('frontend/Editselectlr', $data);
    }
        public function SelectReturnlr()
    {

        $this->load->model('Auth_model');

        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

        $this->load->view('frontend/SelectReturnlr', $data);
    }
    public function Editlr()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');

      $data3['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $Lrno = $this->input->get('Lrno');
        $data['lrdata'] = $this->DataModel->lrdataedit($Lrno);
        $data1['lrdata1'] = $this->DataModel->lrdataedit1($Lrno);
        $data2['lrdata2'] =$this->DataModel->Ewbill($Lrno);
        $view_data = array(
        'lrdata' => $data['lrdata'],
        'lrdata1' => $data1['lrdata1'],
        'lrdata2' =>$data2['lrdata2'],
        'user'=>$data3['user']
        );  
        $this->load->view('frontend/Editlr',$view_data);
    }   
   
    public function fetch_data1()
    {
        $this->load->model('DataModel');
        $conID = $this->input->post('ConID');
        $lrDate = $this->input->post('LRDate');
        $payType = $this->input->post('PayType');       
         $data = $this->DataModel->fetch_data12($conID, $payType, $lrDate);
        // $this->output
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode($data));
        echo json_encode($data);
    }
    public function fetch_dataEdit()
    {
        $this->load->model('DataModel');
        $ContractID=$this->input->post('ContractID');
        $Qty=$this->input->post('Qty');
        $ToPlace=$this->input->post('ToPlace');
        $MA=$this->input->post('MA');
        $data=$this->DataModel->fetch_dataEdit1($ContractID,$Qty,$ToPlace,$MA);
        echo json_encode($data);
    }

	public function checkcityEdit()
	{
	    $this->load->model('DataModel');
	    $term = $this->input->get('term');
	    $cityExists = $this->DataModel->checkcityEdit1($term);

	    if ($cityExists) {
	        echo "Success";
	    } else {
	        echo "Failed";
	    }
	}
    public function update()
    {
        $this->load->model('DataModel');
        $InvoiceNo=$this->input->post('invoiceno');
         if ($this->input->post('Consigneefrom') == "From Master") {
            $Consignee = $this->input->post('FMConsigneeName');
            $ConsigneeAdd = "";
            $ConsigneeMob = "";
            $ConsigneeId = $this->input->post('FMConsignee');
            $ConsigneeMar = "";
            $ConsigneeAddMar = "";
        } else {
            $Consignee =$this->input->post('WIConsignee');
            $ConsigneeAdd = $this->input->post('WIConsigneeadd');
            $ConsigneeMar = $this->input->post('WIConsigneeMar');
            $ConsigneeAddMar = $this->input->post('WIConsigneeaddMar');
            $ConsigneeMob =$this->input->post('WIConsigneemob');
            $ConsigneeId = "8888";
        }
        if ($this->input->post('Consignorfrom') == "From Master") {
            $Consignor = $this->input->post('FMConsignorName');
            $ConsignorAdd = "";
            $ConsignorMob = "";
            $ConsignorId = $this->input->post('FMConsignor');
        } else {
            $Consignor = $this->input->post('WIConsignor');
            $ConsignorAdd = $this->input->post('WIConsignoradd');
            $ConsignorMob = $this->input->post('WIConsignormob');
            $ConsignorId = "8888";
        }

        $Updatedata = array(
            'Lrno' => $this->input->post('LRNO'),
            'lrdate' => $this->input->post('lrdate'),
            'paytype' => $this->input->post('paytype'),
            'partyid' => $this->input->post('partyid'),
            'partyname' => $this->input->post('partyname'),
            'Origin' => $this->input->post('Origin'),
            'Destination' => $this->input->post('Destination'),
            'mot' => $this->input->post('mot'),
            'BookingType'=>$this->input->post('servicetype'),
            'servicetype' => $this->input->post('servicetype'),         
            'tomove' => $this->input->post('tomove'),
            'pickdeli' => $this->input->post('pickdeli'),
            'fromcity' => $this->input->post('fromcity'),
            'tocity' => $this->input->post('tocity'),
            'FMConsignor' =>$ConsignorId ,
            'FMConsignorName' => $Consignor,
            'WIConsignor' => $Consignor,
            'WIConsignoradd' =>$ConsignorAdd,
            'WIConsignormob'=>$ConsignorMob,
            'FMConsignee' => $ConsigneeId,
            'FMConsigneeName' =>$Consignee,
             'Consignee'=>$Consignee,
            'WIConsigneeMar' => $ConsigneeMar,
            'WIConsigneeadd' => $ConsigneeAdd,
            'WIConsigneeaddMar' => $ConsigneeAddMar,
            'WIConsigneemob' =>$ConsigneeMob,
            'InvoiceNos' => implode(",", $InvoiceNo),
            'NumberOfInvoices' => count($InvoiceNo),
            'invoicedate'=>$this->input->post('invoicedate'),
            'pkgtype'=>$this->input->post('pkgtype'),
            'ProductType'=>$this->input->post('prodtype'),
            'Invoicevalue'=>$this->input->post('declval'),
            'pkgno'=>$this->input->post('pkgno'),
            'tpkgno'=>$this->input->post('tpkgno'),
            'actwtperpkg'=>$this->input->post('actwtperpkg'),
            'actwt'=>$this->input->post('actwt'),
            'Exwtchrgs'=>$this->input->post('Exwtchrgs'),
            'tactwt'=>$this->input->post('tactwt'),
            'Exwtchrgs'=>$this->input->post('Exwtchrgs'),
            'freightotal'=>$this->input->post('freightotal'),
            'freightrate'=>$this->input->post('freightrate'),
            'freighttype'=>$this->input->post('freighttype'),
             'doccharge'=>$this->input->post('doccharge'),
            'hamalicharge'=>$this->input->post('hamalicharge'),
            'othercharge'=>$this->input->post('othercharge'),
            'doordelcharge'=>$this->input->post('doordelcharge'),
            'excesscharge'=>$this->input->post('excesscharge'),
            'csgstrate'=>$this->input->post('csgstrate'),
            'csgst'=>$this->input->post('csgst'),
            'grandtotal'=>$this->input->post('grandtotal'),
            'eddate'=>$this->input->post('eddate'),
            'EwbNos' => explode(",", $this->input->post('EWBNOS'))
        );

        $data=$this->DataModel->updatelrdata($Updatedata,$InvoiceNo);
        print_r($Updatedata);

    }
    public function SearchcustCode()
    {
        $this->load->model('DataModel');
        $term = $this->input->get('term');
        $customers=$this->DataModel->fetchcustCode($term);
        $data = [];
        foreach ($customers as $customer) {
            $data[] = [
                'CustCode' => $customer->CustCode,
                'CustName' => $customer->CustName,
            ];
        }
        echo json_encode($data);
    }
    public function FMConsignees1(){
        $this->load->model('DataModel');
        $term=$this->input->get('term');
        $partyid=$this->input->get('partyid');
        $city=$this->input->get('city');
        $fmconsignee=$this->DataModel->fmconsignee($term,$partyid,$city);
        $data = [];

              foreach ($fmconsignee as $consi) {
            $data[] = [
                'CustCode' => $consi->CustCode,
                'CustName' => $consi->CustName,
            ];
        }
        echo json_encode($data);
    }
    public function CityName()
    {
        $this->load->model('DataModel');
        $term=$this->input->get('term');
        $CityNamet=$this->DataModel->CityNameEng($term);
        $data = [];
              foreach ($CityNamet as $Name) {
            $data[] = [
                'CityNameEng' => $Name->CityNameEng,
                'District' => $Name->District,
            ];
        }
        echo json_encode($data);
    }
        public function RetrunLr()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');

      $data3['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $Lrno = $this->input->get('Lrno');
        $data['lrdata'] = $this->DataModel->lrdataedit($Lrno);
        $data1['lrdata1'] = $this->DataModel->lrdataedit1($Lrno);
        $data2['lrdata2'] =$this->DataModel->Ewbill($Lrno);
        $view_data = array(
        'lrdata' => $data['lrdata'],
        'lrdata1' => $data1['lrdata1'],
        'lrdata2' =>$data2['lrdata2'],
        'user'=>$data3['user']
        );  
        $this->load->view('frontend/RetrunLr',$view_data);
    }
        public function RetrunLrInsert()
    {       
        $this->load->model('DataModel');
        $userdepo='PNA';
        $InvoiceNo=$this->input->post('invoiceno');
         if ($this->input->post('Consigneefrom') == "From Master") {
            $Consignee = $this->input->post('FMConsigneeName');
            $ConsigneeAdd = "";
            $ConsigneeMob = "";
            $ConsigneeId = $this->input->post('FMConsignee');
            $ConsigneeMar = "";
            $ConsigneeAddMar = "";
        } else {
            $Consignee =$this->input->post('WIConsignee');
            $ConsigneeAdd = $this->input->post('WIConsigneeadd');
            $ConsigneeMar = $this->input->post('WIConsigneeMar');
            $ConsigneeAddMar = $this->input->post('WIConsigneeaddMar');
            $ConsigneeMob =$this->input->post('WIConsigneemob');
            $ConsigneeId = "8888";
        }
        if ($this->input->post('Consignorfrom') == "From Master") {
            $Consignor = $this->input->post('FMConsignorName');
            $ConsignorAdd = "";
            $ConsignorMob = "";
            $ConsignorId = $this->input->post('FMConsignor');
        } else {
            $Consignor = $this->input->post('WIConsignor');
            $ConsignorAdd = $this->input->post('WIConsignoradd');
            $ConsignorMob = $this->input->post('WIConsignormob');
            $ConsignorId = "8888";
        }

        $Updatedata = array(
            'Lrno' => $this->input->post('LRNO'),
            'lrdate' => $this->input->post('lrdate'),
            'CoastCenter'=>$this->input->post('CoastCenter'),
            'paytype' => $this->input->post('paytype'),
            'partyid' => $this->input->post('partyid'),
            'CurrentLocation'=>'PNA',
            'partyname' => $this->input->post('partyname'),
            'Origin' => $this->input->post('Origin'),
            'Destination' => $this->input->post('Destination'),
            'mot' => $this->input->post('mot'),
            'BookingType'=>$this->input->post('servicetype'),
            'servicetype' => $this->input->post('servicetype'),         
            'tomove' => $this->input->post('tomove'),
            'pickdeli' => $this->input->post('pickdeli'),
            'fromcity' => $this->input->post('fromcity'),
            'tocity' => $this->input->post('tocity'),
            'FMConsignor' =>$ConsignorId ,
            'FMConsignorName' => $Consignor,
            'WIConsignor' => $Consignor,
            'WIConsignoradd' =>$ConsignorAdd,
            'WIConsignormob'=>$ConsignorMob,
            'FMConsignee' => $ConsigneeId,
            'FMConsigneeName' =>$Consignee,
             'Consignee'=>$Consignee,
            'WIConsigneeMar' => $ConsigneeMar,
            'WIConsigneeadd' => $ConsigneeAdd,
            'WIConsigneeaddMar' => $ConsigneeAddMar,
            'WIConsigneemob' =>$ConsigneeMob,
            'InvoiceNos' => implode(",", $InvoiceNo),
            'NumberOfInvoices' => count($InvoiceNo),
            'invoicedate'=>$this->input->post('invoicedate'),
            'pkgtype'=>$this->input->post('pkgtype'),
            'ProductType'=>$this->input->post('prodtype'),
            'Invoicevalue'=>$this->input->post('declval'),
            'pkgno'=>$this->input->post('pkgno'),
            'tpkgno'=>$this->input->post('tpkgno'),
            'actwtperpkg'=>$this->input->post('actwtperpkg'),
            'actwt'=>$this->input->post('actwt'),
            'Exwtchrgs'=>$this->input->post('Exwtchrgs'),
            'tactwt'=>$this->input->post('tactwt'),
            'Exwtchrgs'=>$this->input->post('Exwtchrgs'),
            'freightotal'=>$this->input->post('freightotal'),
            'freightrate'=>$this->input->post('freightrate'),
            'freighttype'=>$this->input->post('freighttype'),
             'doccharge'=>$this->input->post('doccharge'),
            'hamalicharge'=>$this->input->post('hamalicharge'),
            'othercharge'=>$this->input->post('othercharge'),
            'doordelcharge'=>$this->input->post('doordelcharge'),
            'excesscharge'=>$this->input->post('excesscharge'),
            'csgstrate'=>$this->input->post('csgstrate'),
            'csgst'=>$this->input->post('csgst'),
            'grandtotal'=>$this->input->post('grandtotal'),
            'eddate'=>$this->input->post('eddate'),
            'EwbNos' => explode(",", $this->input->post('EWBNOS'))
        );

        $data=$this->DataModel->insertreturn($Updatedata,$InvoiceNo,$userdepo);

    }
    public function SearchlrnoReturn()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $data = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $userdepo=$data->Depot;
        $term=$this->input->get('query');
        $data=$this->DataModel->lrdataselect($term,$userdepo);
        echo json_encode($data);

    }
    public function Loadingsheet()
    {
        $this->load->model('Auth_model');

        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));

        $this->load->view('frontend/Loadingsheet', $data);
    }
    public function depotse()
    {
        $this->load->model('DataModel');
        $data=$this->DataModel->selectdepo();
        echo json_encode($data);

    }
    public function getlrdataJUNE()
    {
        $this->load->model('DataModel');
        $lrno=$this->input->post('LRNO');
        $data=$this->DataModel->fetchgetlrdataJUNE($lrno);
        if (!empty($data)) {
        foreach ($data as $row) {
            echo "<td><input type='hidden' name='LRNO[]' value='" . $row->LRNO . "'>" . $row->LRNO . "</td>";
            echo "<td>" . $row->LRDate . "</td>";
            echo "<td>" . $row->PayBasis . "</td>";
            echo "<td>" . $row->FromPlace . "</td>";
            echo "<td>" . $row->ToPlace . "</td>";
            echo "<td>" . $row->ArriveDate . "</td>";
            echo "<td>" . ($row->PkgsNo - $row->DeliveredQty) . "</td>";
            echo "<td>" . $row->ActualWeight . "</td>";
            echo "<td>" . $row->DocketTotal . "</td>";
          }
        }
         else {
            echo "No Data."; // Handle if no data is found
        }
    }
    public function InsertLsThc()
    {
        if ($this->input->is_ajax_request()) 
       {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $data = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $userdepot=$data->Depot;
            $Gp = $this->input->post('Gp');
           $lrlist = "'" . implode("','", $_POST['LRNO']) . "'";
           $totaltopay = $this->input->post('totaltopay');
           $Contract = $this->input->post('Contract');
           $data=$this->DataModel->InsertThcloading($userdepot,$lrlist,$totaltopay,$Contract,$Gp);
           echo $data;
        }
    }
    public function InsertLsDrs()
    {
        if ($this->input->is_ajax_request()) 
       {
            $this->load->model('DataModel');
            $this->load->model('Auth_model');
            $data = $this->Auth_model->user_data($this->session->userdata('user_id'));
            $userdepot=$data->Depot;
            $Gp = $this->input->post('Gp');
           $lrlist = "'" . implode("','", $_POST['LRNO']) . "'";
           $totaltopay = $this->input->post('totaltopay');
           $Contract = $this->input->post('Contract');
           $data=$this->DataModel->InsertDrsloading($userdepot,$lrlist,$totaltopay,$Contract,$Gp);
           echo $data;
        }
    }
    public function Viewloadingsheet()
    {
        $this->load->model('Auth_model');
        $this->load->model('DataModel');
        $data3['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $LSNO = trim($this->input->get('Lsno'));
        $data['lrdata'] = $this->DataModel->viewlssearch($LSNO);
        $view_data = array(
            'lrdata' => $data['lrdata'],
            'user' => $data3['user']
        );

        $this->load->view('frontend/Viewloadingsheet',$view_data);

    }


    public function MultiLr()
    {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/Multiplelrprint', $data);
    }
    public function fetchconsignor()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $userData = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $userDepot = $userData->Depot;
        $startDate = $this->input->get('startdate');
        $endDate = $this->input->get('enddate');
        $consignorData = $this->DataModel->fetchconsignor($userDepot, $startDate, $endDate);
        echo json_encode($consignorData);
    }
    public function SelectConsidata()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $depo = $data['user']->Depot;
        $dt1 = $this->input->post('startdate');
        $dt2 = $this->input->post('enddate');
        $Consigner = $this->input->post('Consigner');
        $data['Considata']=$this->DataModel->SelectConsidatafetch($dt1,$dt2,$Consigner,$depo);
        $this->load->view('frontend/Multiplelrprint', $data);
    }
    public function lrlazer()
    {
        $this->load->model('DataModel');
        $LRNO = $_GET['LRNO'];
        $barcode = generate_barcode($LRNO);
        $imagePath = FCPATH . 'barcode.png';
        file_put_contents($imagePath, $barcode);

        $this->load->helper('url');
        $imageURL = base_url('barcode.png');
        $data['lrlaz']=$this->DataModel->lrlazerprtint($LRNO);
        $data['lrlaz1']=$this->DataModel->lrlazerprtint1($LRNO);
        $array=[
            'lrlaz'=>$data['lrlaz'],
            'lrlaz1'=>$data['lrlaz1'],
            'imageURL'=>$imageURL
        ];
        $this->load->view('frontend/lrvolazer', $array);
        
    }
    public function Multiplelr()
    {
        $this->load->model('DataModel');

        if (!$this->input->post('Copies')) {
            exit("No LR Copies Selected.</body></html>");
        }

        if (!$this->input->post('LRNO')) {
            exit("No LRNOs Selected.</body></html>");
        }

        $copies = $this->input->post('Copies');
        $LRNO = $this->input->post('LRNO');
        
        $data['alldata'] = $this->DataModel->multiplelrdata($LRNO);
        $array = [
            'data' => $data['alldata'],
            'copies' => $copies
        ];

        $this->load->view('frontend/multilrlazer', $array);
    }
    public function createstate()
    {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/Createstatement', $data);
    }
   
   public function fetchconsignor1()
    {
        $this->load->model('DataModel');
        $startDate = $this->input->get('startdate');
        $endDate = $this->input->get('enddate');
        $Depot=$this->input->get('Depot');
        $consignorData = $this->DataModel->fetchConsignor1($Depot, $startDate, $endDate);        
        echo json_encode($consignorData);
    }
    public function SelectSatetment()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $d1 = $this->input->post('startdate');
        $d2 = $this->input->post('enddate');
        $Depot=$this->input->post('Depot');
        $Consigner=$this->input->post('Consigner');
        $data['Data']=$this->DataModel->datastatement($d1,$d2,$Depot,$Consigner);
        $this->load->view('frontend/Createstatement', $data);
    }
    public function Createstatement()
    {
        $this->load->model('DataModel');
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $userdepo = $data['user']->Depot;
        $user=$data['user']->UserName;
        $LRNO = $this->input->post('LRNO');
        $data=$this->DataModel->Insertstatement($LRNO,$userdepo,$user);
        $barcode = generate_barcode($data);
        $imagePath = FCPATH . 'barcode.png';
        file_put_contents($imagePath, $barcode);
        $this->load->helper('url');
        $imageURL = base_url('barcode.png');
        $datastat['Stat']=$this->DataModel->fetch_statement($data);
        $array=[
            'imageURL'=>$imageURL,
            'Stat'=>$datastat['Stat']
        ];
        $this->load->view('frontend/printstatement', $array);
 
       
    }
    public function VerifySattement()
    {
        $this->load->model('Auth_model');
        $data['user'] = $this->Auth_model->user_data($this->session->userdata('user_id'));
        $this->load->view('frontend/VerifyStatement', $data);
    }

    public function test(){
        print_r('i am here');
    }
 

}