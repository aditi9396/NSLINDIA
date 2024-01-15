<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$this->set_directory("frontend");
$route['default_controller'] = 'Home';
$route['loader'] = 'Home/loader';

//DASHBOARD
$route['dashboard'] = 'Home/dashboard';

// DASHBOARD CPVOLUMETRIC LR
$route['lr-generataion'] = 'Home/lrgeneration';
$route['Cp_lrgenerataion'] = 'Home/Cp_lrgenerataion';
$route['CPVOLUMETRICdata'] = 'Home/CPVOLUMETRICdata';
$route['delete_LR'] = 'Home/deleteLR';
$route['printlr'] = 'Home/printlr';
$route['printlr/(:any)'] = 'Home/printlr/$1';
$route['lr-generataion/(:any)'] = 'Home/lrgeneration/$1';

// DASHBOARD SIMPLE LR 
$route['createlr'] = 'Autocomplete/createlr';
$route['SimpleLR'] = 'Autocomplete/SimpleLR';
$route['fetch_data'] = 'Autocomplete/fetch_data';
$route['step2click'] = 'Autocomplete/step2click';
$route['fetch_contract'] = 'Autocomplete/fetch_contract';
$route['printsimplelr'] = 'Vehicle/printsimplelr';
$route['printsimplelr/(:any)'] = 'Vehicle/printsimplelr/$1';
$route['searchCustomers'] = 'Autocomplete/searchcustomers';
$route['simplelazervolumetric'] = 'Vehicle/simplelazervolumetric';
$route['LRstickerprint'] = 'Vehicle/LRstickerprint';

// DASHBOARD DRS 
$route['createdrs'] = 'Lrgeneration/Create_DRS';
$route['drscreate'] = 'Lrgeneration/drscreate';
$route['hamaliVendorCode'] = 'Lrgeneration/hamalibranch';
$route['fetch_vendor'] = 'Lrgeneration/fetch_vendor';
$route['validate'] = 'Lrgeneration/validate';
$route['validateVehicle'] = 'Lrgeneration/validateVehicle';
$route['fetch_driver'] = 'Lrgeneration/fetch_driver';
$route['fetch_vendor1'] = 'Lrgeneration/fetch_vendor1';
$route['fetch_vendor2'] = 'Lrgeneration/fetch_vendor2';
$route['createdrsdemo1branch'] = 'Lrgeneration/createdrsdemo1branch';
$route['getdiliverykm'] = 'Lrgeneration/getdiliverykm';
$route['getcapacity'] = 'Lrgeneration/getcapacity';
$route['controller'] = 'Lrgeneration/controller';
$route['fuel-vendors'] = 'Lrgeneration/fuel-vendors';
$route['getlrdataJUNE'] = 'Lrgeneration/getlrdataJUNE1';
$route['checkdrsthcfright'] = 'Lrgeneration/checkdrsthcfright';
$route['get_charges'] = 'Lrgeneration/getCharges';
$route['getCustomers'] = 'Lrgeneration/getCustomers1';
$route['get-cities'] = 'Lrgeneration/getCities';
$route['calamt'] = 'Lrgeneration/calamt';
$route['lrtotal'] = 'Lrgeneration/lrtotal';
$route['driver_data'] = 'Lrgeneration/driver_data';
$route['str_lr_no'] = 'Lrgeneration/str_LR_no';
$route['str_LRNO'] = 'THCarrival/str_LRNO';
$route['createdrsdemo1accountno'] = 'Lrgeneration/createdrsdemo1accountno';
$route['createdrsdemo1ifsc'] = 'Lrgeneration/createdrsdemo1ifsc';
$route['createdrsdemo1bank'] = 'Lrgeneration/createdrsdemo1bank';
$route['createdrsdemo1branch'] = 'Lrgeneration/createdrsdemo1branch';
$route['hamaliaccount'] = 'Lrgeneration/hamaliaccount';
$route['hamaliifsc'] = 'Lrgeneration/hamaliifsc';
$route['hamalibank'] = 'Lrgeneration/hamalibank';
$route['hamalibranch'] = 'Lrgeneration/hamalibranch';
$route['hamaliVendorCode'] = 'Lrgeneration/hamalibranch';
$route['printdrs'] = 'Home/printdrs';
$route['printdrs/(:any)'] = 'Home/printdrs/$1';
$route['printdrs/(:any)/(:any)/(:any)/(:any)'] = 'Home/printdrs/$1/$2/$3/$4';
$route['lrlazervolumetric'] = 'Home/lrlazervolumetric';
$route['stickerprint'] = 'Home/stickerprint';
$route['printdrsdemo'] = 'Home/printdrsdemo';
$route['printthc'] = 'Home/printthc';
$route['printthc/(:any)'] = 'Home/printthc/$1';
$route['printthc/(:any)/(:any)/(:any)/(:any)'] = 'Home/printthc/$1/$2/$3/$4';
$route['printthcdemo'] = 'Home/printthcdemo';
$route['printdrsvoucher'] = 'Home/printdrsvoucher';
$route['printdrskmtimeroute'] = 'Home/printdrskmtimeroute';
$route['printdrskmtimemarkeradd'] = 'Home/printdrskmtimemarkeradd';
$route['printdrsvoucher/(:any)'] = 'Home/printdrsvoucher/$1';
$route['printthckmtimeroute'] = 'Home/printthckmtimeroute';
$route['printthckmtimemarkeradd'] = 'Home/printthckmtimemarkeradd';
$route['printarrival'] = 'Home/printarrival';
$route['printarrival/(:any)'] = 'Home/printarrival/$1';
$route['printarrival/(:any)/(:any)/(:num)/(:any)'] = 'Home/printarrival/$1/$2/$3/$4';

// DASHBOARD LOGIN CODE
$route['login'] = 'Auth/login';
$route['auth_login'] = 'Auth/auth_login';
$route['login/(:any)'] = 'Auth/login/$1';
$route['check-login'] = 'Auth/checkLogin';
$route['logout'] = 'Auth/logout';

// USER REGISTER CODE
$route['register'] = 'Auth/register';
$route['fetchempid'] = 'Auth/fetchempid';
$route['auth_register'] = 'Auth/auth_register';
$route['virtual_login'] = 'Auth/virtual_login';
$route['register-user'] = 'Auth/registerUser';

// DASHBOARD THC ARRIVAL
$route['thcarrival'] ='THCarrival/thc_arrival';
$route['thcarrivalupdate'] ='THCarrival/thcarrivalupdate';
$route['UPADTETHC'] ='THCarrival/UPADTETHC';

// DASHBOARD THC CANCEL
$route['thc_cancel'] = 'THCarrival/search';
$route['thccancel'] = 'THCarrival/thccancel';

// DASHBOARD DRS CANCEL
$route['drs_cancel'] = 'THCarrival/search1';
$route['drscancel'] = 'THCarrival/drscancel';

// DASHBOARD LR CANCEL
$route['LR_cancel'] = 'THCarrival/search4';
$route['lrcancel'] = 'THCarrival/lrcancel';

// DASHBOARD VERIFY POD AND THC
$route['verify_POD'] = 'THCarrival/search2';
$route['verify_THC'] = 'THCarrival/search3';

// DASHBOARD MASTER VEHICLE
$route['vehiclemaster'] = 'Vehicle/vehicle_form';
$route['save_data'] = 'Vehicle/savedata';
$route['listdata'] = 'Vehicle/vehicle_listdata';
$route['vehicle-update'] = 'Vehicle/updatevehicle';
$route['edit-vehicle/(:num)'] = 'Vehicle/editvehicle/$1';
$route['deletevehicle'] = 'Vehicle/deletevehicle';

// DASHBOARD MASTER CUSTOMER
$route['customermaster'] = 'Vehicle/customer_form';
$route['savecustdata'] = 'Vehicle/savecust_data';
$route['custlistdata'] = 'Vehicle/customer_listdata';
$route['cust-update'] = 'Vehicle/updatecust';
$route['edit-customer/(:num)'] = 'Vehicle/editcustomer/$1';
$route['deletecustomer'] = 'Vehicle/deletecustomer';

// DASHBOARD MASTER VENDOR 
$route['vendormaster'] = 'Vehicle/vendor_form';
$route['savevendordata'] = 'Vehicle/savevendor_data';
$route['vendorlistdata'] = 'Vehicle/vendor_listdata';
$route['vendor-update'] = 'Vehicle/updatevendor';
$route['edit-vendor/(:num)'] = 'Vehicle/editvendor/$1';
$route['deletevendor'] = 'Vehicle/deletevendor';

// DASHBOARD MASTER LOCATION
$route['locationmaster'] = 'Vehicle/location_form';
$route['savelocationdata'] = 'Vehicle/savelocation_data';
$route['locationlistdata'] = 'Vehicle/location_listdata';
$route['location-update'] = 'Vehicle/updatelocation';
$route['edit-location/(:num)'] = 'Vehicle/editlocation/$1';
$route['deletelocation'] = 'Vehicle/deletelocation';

// DASHBOARD CITY MASTER 
$route['citymaster'] = 'Vehicle/city_form';


// DASHBOARD TRIPSHEET EXPENSES
$route['tripsheet'] = 'Vehicle/tripsheet';
$route['Submittripsheet'] = 'Vehicle/Submittripsheet';
$route['Submittripsheet1'] = 'Vehicle/Submittripsheet1';
$route['Submittripsheet2'] = 'Vehicle/Submittripsheet2';
$route['Submitnaturexp'] = 'Vehicle/Submitnaturexp';
$route['Submitnaturexp1'] = 'Vehicle/Submitnaturexp1';
$route['Submitnaturexp2'] = 'Vehicle/Submitnaturexp2';
$route['Submitplace'] = 'Vehicle/Submitplace';
$route['Submitplace1'] = 'Vehicle/Submitplace1';
$route['Submitplace2'] = 'Vehicle/Submitplace2';
$route['Submitdriverdata'] = 'Vehicle/Submitdriverdata';
$route['Submitdriverdata1'] = 'Vehicle/Submitdriverdata1';
$route['Submitdriverdata2'] = 'Vehicle/Submitdriverdata2';
$route['DRSsearch'] = 'Vehicle/DRSsearch';
$route['DRSsearch1'] = 'Vehicle/DRSsearch1';
$route['THCsearch'] = 'Vehicle/THCsearch';
$route['THCsearch1'] = 'Vehicle/THCsearch1';
$route['DRSNext'] = 'Vehicle/DRSNext';
$route['THCNext'] = 'Vehicle/THCNext';
$route['showDRSTHCTables'] = 'Vehicle/showDRSTHCTables';

// POD SATAMEMENT
$route['PODSTATEMENT'] = 'Vehicle/podstatement';
$route['podsearch'] = 'Vehicle/podsearch';

//DEPO SELECT
$route['cpall_depo'] = 'Auth/cpall_depo';

// SAMPLE CRUD OPERATION VEHICLE
$route['vehicle'] = 'Vehicle/registration_form';
$route['vehicle/save'] = 'Vehicle/save';
$route['vehicle/list'] = 'Vehicle/vehicle_list';
$route['vehicle/view/(:any)'] = 'Vehicle/view/$1';
$route['vehicle/edit/(:num)'] = 'Vehicle/edit/$1';
$route['vehicle/update/(:num)'] = 'Vehicle/update/$1';
$route['vehicle/delete/(:num)'] = 'Vehicle/delete/$1';

// $route['edit-reward/(:any)'] = 'Reword/editReward/$1';
$route['delete-reward'] = 'Reword/deletereward';
$route['create-reward-list'] = 'Reword/addreward_view';
$route['create-reward-list/(:any)'] = 'Reword/addreward_view/$1';

$route['barcode'] = 'BarcodeController/generateBarcode';
$route['verifypodvouchertest'] = 'Home/verifypodvouchertest';
$route['getDistricts'] = 'Lrgeneration/getdistricts';
$route['getcity'] = 'Lrgeneration/getcity';

//DRS generation
$route['sendotp'] = 'Lrgeneration/sendotp';
$route['verify_otp'] = 'Lrgeneration/verify_otp';
$route['uploadImage'] = 'Lrgeneration/uploadImage';
$route['thccreate'] = 'Lrgeneration/thccreate';
// $route['getLRDetail'] ='THCarrival/getLRDetail';
$route['hamali_data'] = 'THCarrival/hamali_data';
$route['delete/(:any)'] = 'THCarrival/deletedrs/$1';

// API
$route['GetLocation']='Home/getlocation';
$route['GetLocation']='Home/location';
$route['Apiewaybill']='Home/Apiewaybill';
$route['Ewaybill']='Home/Ewaybill';
$route['GetEwayBillInfo']='Home/GetEwayBillInfo';

//6 may 2023 TMS module
$route['paytypechange'] = 'Lrgeneration/paytypechange';
$route['step1click'] = 'Lrgeneration/step1click';
$route['checkcity'] = 'Autocomplete/checkcity';
$route['consigneeac'] = 'Lrgeneration/consigneeac';
$route['search_fields'] = 'Autocomplete/search_fields';
// $route['cpactest1'] = 'Lrgeneration/cpactest1';

//THC Route
$route['sendotpthc'] = 'THCarrival/sendotpthc';
$route['verify_otpthc'] = 'THCarrival/verify_otpthc';
$route['getlrdataJUNETHC'] = 'THCarrival/getlrdataJUNETHC';

// attendence app
$route['Attendence'] = 'THCarrival/Attendence';
$route['take_photo'] = 'THCarrival/photoupload';
$route['save_photo'] = 'THCarrival/save_photo';
$route['manifest.json'] = 'ManifestController/manifest';

//CREATE PRN 

$route['Createprn'] = 'CreateAndArrivalPRN/Createprn';
$route['get_vehicle_data'] = 'CreateAndArrivalPRN/get_vehicle_data';
$route['serchprnwise'] = 'CreateAndArrivalPRN/serchprnwise';
$route['get_customer_data'] = 'CreateAndArrivalPRN/get_customer_data';
$route['getLRNumbersdata'] = 'CreateAndArrivalPRN/getLRNumbersdata';
$route['savePrn'] = 'CreateAndArrivalPRN/saveprn';
$route['createprnview'] = 'CreateAndArrivalPRN/createprnview';
$route['fetchprnwise'] = 'CreateAndArrivalPRN/fetchprnwise';
$route['UpdatePrnStock'] = 'CreateAndArrivalPRN/UpdatePrnStock';
$route['prnarrivaldetails'] = 'CreateAndArrivalPRN/prnarrivaldetails';

// DRS PROFIT APPROVAL

$route['CreateDrsProfitApprovalForm'] = 'CreateAndArrivalPRN/DrsProfitApprovalForm';
$route['insertDRSProfitApproval'] = 'CreateAndArrivalPRN/insertDRSProfitApproval';
$route['UpdateDRSProfitApproval'] = 'CreateAndArrivalPRN/UpdateDRSProfitApproval';
$route['edit_drsapproval'] = 'CreateAndArrivalPRN/edit_drsapproval';
$route['delete_drsapproval'] = 'CreateAndArrivalPRN/delete_drsapproval';
$route['DRSProfitApprovalReport'] = 'CreateAndArrivalPRN/DRSProfitApprovalReport';

// SPARE DETAILS
$route['spare_view'] = 'InsertController/part';
$route['submitpart'] = 'InsertController/submitpart';
$route['filterByDate'] = 'InsertController/filterByDate';

// SPART PART 
$route['user_view'] = 'UserCrud/user_view';
$route['create'] = 'UserCrud/create';
$route['Store'] = 'UserCrud/store'; 
$route['singleUser/(:num)'] = 'UserCrud/singleUser/$1'; 
$route['delete1/(:num)'] = 'UserCrud/delete1/$1';

//VehicleIncidentTracker

$route['VehicleIncidentTracker_view'] = 'UserCrud/VehicleIncidentTracker_view';
$route['create1'] = 'UserCrud/create1';
$route['Store1'] = 'UserCrud/store1'; 
$route['singleUser1/(:num)'] = 'UserCrud/singleUser1/$1'; 
$route['delete2/(:num)'] = 'UserCrud/delete2/$1';
$route['xlsxdata1'] = 'UserCrud/xlsxdata1';

///  Sales Register
$route['sales_register'] = 'Sales_Register_Controller/sales_register';
$route['searchdata'] = 'Sales_Register_Controller/searchdata';
$route['xlsxdata'] = 'Sales_Register_Controller/xlsxdata';
$route['allstickerprint'] = 'Sales_Register_Controller/allstickerprint';

<<<<<<< HEAD
// cp Sales Register
$route['cp_sales_register'] = 'Sales_Register_Controller/cp_sales_register';
$route['searchdata1'] = 'Sales_Register_Controller/searchdata1';
$route['allstickerprintcp'] = 'Sales_Register_Controller/allstickerprintcp';
$route['xlsxdata1'] = 'Sales_Register_Controller/xlsxdata1';

// DRS Sales Register
$route['DRS_sales_register'] = 'Sales_Register_Controller/DRS_sales_register';
// THC Sales Register
$route['THC_sales_register'] = 'Sales_Register_Controller/THC_sales_register';


//lrtracking
$route['lrtracking'] = 'Lrtracking_Controller/lrtracking';
$route['searchlrdata'] = 'Lrtracking_Controller/searchlrdata';
$route['lrtracking_controller/insert'] = 'Lrtracking_Controller/insert';
$route['tracklr/(:any)'] = 'lrtracking_controller/trackLR/$1';
$route['ViewFeedback'] = 'Lrtracking_Controller/ViewFeedback';
$route['viewcustfeedbackdata'] = 'Lrtracking_Controller/viewcustfeedbackdata';
$route['sendDailyReport'] = 'Lrtracking_Controller/sendDailyReport';

//mail
$route['send-daily-report'] = 'dailyreport/send_daily_report';
$route['send-email'] = 'MessageController/sendEmail';







=======
// EXCEL UPLOAD  TO CREATE LR
$route['ExcelLR'] = 'ExcelController/excellr';
$route['Exceldownload'] = 'ExcelController/exceldownload';
$route['Excelforminsert'] = 'ExcelController/Excelforminsert';

// PAGE ACCESS
$route['Pageaccess'] = 'PageAccess/pageaccess';
>>>>>>> 73d31ce82ecd7070bf508a4a83cb8b3dbdbe8d19







