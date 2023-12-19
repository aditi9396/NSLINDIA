<html>
<head>
    <script src='js/jquery.js'></script>
    <script src="script.js"></script>
    <script src="menuscript.js"></script>
    <link rel="stylesheet" href="menustyle.css">
    <link rel="stylesheet" href="styles.css">
    <script type='text/javascript'>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function PrintDiv() {
            var divToPrint = document.getElementById('Printdrs');
            var popupWin = window.open('', '_blank', 'width=1200,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><style> @media print { * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important;} } </style><body onload=\"window.print()\">' + divToPrint.innerHTML + '<body></html>');
            popupWin.document.close();
        }
    </script>
    <style>
        #map-layer {
            max-width: 900px;
            min-height: 550px;
        }
        .lbl-locations {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .locations-option {
            display:inline-block;
            margin-right: 15px;
        }
        .btn-draw {
            background: blue;
            color: #ffffff;
        }
        #total {
            margin-top: 10px;
            padding: 10px;
            height: 50px;
        }
        #directions-panel1 {
            margin-top: 10px;
            padding: 10px;
            overflow: scroll;
            height: 174px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>

<body>

    <p>&nbsp;</p>
    <?php

    if (isset($_GET["DRSNO"]))
        $DRSNO = $_GET["DRSNO"];

/*$sqlloc = "SELECT LRNO, DRSNO, DATE_FORMAT(DRSdate, '%d-%b-%Y') DRSdate, time(DRSDT) as DRSDT, VehicleNo, DriverName, DriverMobile, VendorName, BalanceFreight, Hamali, FreightCharge, Advance,DRSKM,
LicenseNo, DATE_FORMAT(LicenseExp, '%d-%m-%Y') LicenseExp, DATE_FORMAT(BookingDate, '%d-%b-%Y') BookingDate,Cosigner,Place,InvoiceNo,Qty,Weight,Consignee,ToPay,getName(CreatedBy) FullName, CEWBNo,Dieselamt,paymentschedule,vehiclecapacitymodel,StartingKM,t2.Latitude as Latitude1,t2.Longitude as Longitude1
FROM vtcpod   t1 JOIN CityMaster t2 ON t1.`Place`=t2.CityNameEng  where DRSNO ='$DRSNO' ";
//$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);and t1.`Place` in('NIRA','SAKHARWADI')
$wayPoints=array();
$resultlat = mysqli_query($conn, $sqlloc);
    //$row = mysqli_fetch_row($result);
    while($rowlat = mysqli_fetch_assoc($resultlat))
    {
        $lat1 = $rowlat['Latitude1'];
        $lon1 = $rowlat['Longitude1'];
        //echo"<br>LATITUDE:$lat1,LONGITUDE:$lon1<br>";
        $latlog1=$lat1.",".$lon1;
     
        array_push($wayPoints,$latlog1);
    } */
//echo"<br>";
   // Print_r($wayPoints);
    ?>
    <?php
 //   foreach ($wayPoints as $wayPoint) {
    ?>
    <!-- <div class="locations-option"><input type="checkbox" name="way_points" class="way_points" style="display:none" checked="checked" value="<?php echo $wayPoint; ?>" ></div>-->
    <?php
  //  }
    ?>
<!--<div>
    <input type="button" id="drawPath" value="Draw Path" class="btn-draw" />
    </div>
 <div id="directions-panel"></div>
   <div id="total"></div>
   <div id="map-layer"></div>-->

   <?php
   if (isset($_POST['Submit'])) {
    $pattern1 = "/^[A-Z]{2}[0-9]{2}[A-Z]{0,2}[0-9]{4}$/";
    $pattern2 = "/^[A-Z]{3}[0-9]{4}$/";
    $pattern3 = "/^[A-Z]{2}[0-9]{3}[A-Z]{1}[0-9]{4}$/";
    $pattern4 = "/^[A-Z]{2}[0-9]{2}[A-Z]{3}[0-9]{4}$/";

    $DRSdate = $_POST['drsdate'];
    if (isset($_POST['vehicleno']))
        $VehicleNo = $_POST['vehicleno'];
    else
        $VehicleNo = $_POST['avehicleno'];
    if (isset($_POST['drskm']))
        $DRSKM = $_POST['drskm'];
    else
        $DRSKM = 0;
    if (isset($_POST['mreading']))
        $StartingKM = $_POST['mreading'];
    else
        $StartingKM = 0;
    $FreightType = trim($_POST['freighttype']);
    $DriverName = trim($_POST['drivername']);
    $DriverMobile = trim($_POST['mobileno']);
    $VendorName = trim($_POST['vendorname']);
    $FreightCharge = trim($_POST['contractamt']);
    $Advance = trim($_POST['advamt']);
    $BalanceFreight = $_POST['contractamt'] - $_POST['advamt'] - $_POST['totaltopay'];
    $Hamali = trim($_POST['hamali']);
    $LicenseNo = trim($_POST['licenseno']);
    $LicenseExp = $_POST['licexpdate'];
    $ToPay = $_POST['totaltopay'];
    $HamaliType = $_POST['hamalitype'];

    if (is_numeric($FreightCharge) == false)
        exit ("error : Please enter numeric value for Freight Charge.");
    if (is_numeric($Advance) == false)
        exit ("error : Please enter numeric value for Advance.");
    if (is_numeric($Hamali) == false)
        exit ("error : Please enter numeric value for Hamali.");
    if (is_numeric($ToPay) == false)
        exit ("error : totaltopay is not numeric.");
    if (is_numeric($DriverMobile) == false or strlen($DriverMobile) != 10)
        exit ("error : Please enter valid mobile number for Driver.");
    if (is_numeric($DRSKM) == false)
        exit ("error : Please enter numeric value for DRSKM.");
    if (!(preg_match($pattern1, $VehicleNo) OR preg_match($pattern2, $VehicleNo) OR preg_match($pattern3, $VehicleNo) OR preg_match($pattern4, $VehicleNo)))
        exit ("error : Invalid Vehicle No.");
    if (!validateDate($DRSdate))
        exit ("error : Invalid DRS Date.");
    if (!validateDate($LicenseExp))
        exit ("error : Invalid License Expiry Date.");
    if (count(array_unique($_POST['LRNO'])) < count($_POST['LRNO']))
        exit ("error : Duplicate LR No. Found in LR List.");

    $ewbobjarr = array();
    $lrlist = "(";
    foreach ($_POST['LRNO'] as $lr)
        $lrlist .= "'$lr',";

    $lrlist = rtrim($lrlist, ",") . ")";
    $sql = "SELECT EWBNo FROM EWBill where LRNO IN $lrlist";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result))
            array_push($ewbobjarr, array('ewbNo' => $row["EWBNo"]));
        $jsonobj = array('fromPlace' => $fromPlace[$userdepo], 'fromState' => "27", 'vehicleNo' => $VehicleNo,
            'transMode' => "1", 'TransDocNo' => null, 'TransDocDate' => null, 'tripSheetEwbBills' => $ewbobjarr);

        $AuthToken = "";
        $sql = "SELECT * FROM AuthToken";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $currentdate = new DateTime();
            $tokendate = DateTime::createFromFormat('Y-m-d H:i:s', $row['CreateDT']);
            $tokenexpiredate = $tokendate->add(new DateInterval('PT' . $row['Expires_In'] . 'S'));
            if ($tokenexpiredate > $currentdate)
                $AuthToken = $row['Access_Token'];
        }
        if ($AuthToken == "") {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://gsp.adaequare.com/gsp/authenticate?grant_type=token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "gspappid: 01F17CCDB5AB48AF9C24D9C65C4055FC",
                    "gspappsecret: D292C978G2962G4FC2G9941G87C79395CA42"
                )
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $tokenobj = json_decode($response, true);
                $AuthToken = $tokenobj['access_token'];
                $Expires_In = $tokenobj['expires_in'];
                $currentdate = new DateTime();
                $datestr = $currentdate->format('Y-m-d H:i:s');
                $updatesql .= "UPDATE AuthToken SET Access_Token = '$AuthToken',Expires_In = '$Expires_In', CreateDT = '$datestr';";
            }
        }

        $sql = "SELECT * FROM EWBReqID";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $LastRequestID = $row['LastRequestID'];

        $id = (int)substr($row['LastRequestID'], 3, 6) + 1;
        $requestid = "EWB" . str_pad($id, 6, 0, STR_PAD_LEFT);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gsp.adaequare.com/enriched/ewb/ewayapi?action=GENCEWB",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($jsonobj),
            CURLOPT_HTTPHEADER => array(
                "authorization: bearer " . $AuthToken,
                "cache-control: no-cache",
                "content-type: application/json",
                "gstin: 27AAECV0781E1ZD",
                "password: vtc3plewb2020",
                "requestid: " . $requestid,
                "username: VTC@3PL_API_pda"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $obj = json_decode($response, true);
            echo $obj['message'] . "<br><br>";
            if ($obj['success'] == true) {
                echo "Consolidated E-Way Bill No. = " . $obj['result']['cEwbNo'];
                $CEWBNo = $obj['result']['cEwbNo'];
            }
            $updatesql .= "UPDATE EWBReqID SET LastRequestID = '$requestid';";
        }
    } else
    echo "No Eway Bill No. found in given LR List for Consolidated E-Way Bill Generation.";

    $year = (date('m') > 3) ? date('y') : date('y') - 1;
    $fyear = $year . ($year + 1);

    $sql = "SELECT MAX(CAST(SUBSTRING(DRSNO, 13, 6) AS UNSIGNED)) FROM vtcpod where DRSNO LIKE '%$userdepo/$fyear%'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if ($row[0] == null)
        $id = 1;
    else
        $id = $row[0] + 1;

    $DRSNO = "DS/$userdepo/$fyear/" . str_pad($id, 6, 0, STR_PAD_LEFT);

    $sql = $updatesql;
    foreach ($_POST['LRNO'] as $lr) {
        $sql .= "INSERT INTO vtcpod(LRNO,DRSNO,DRSdate,DRSDT, Cosigner,Place,Consignee,VehicleNo,DriverName,DriverMobile,VendorName,FreightCharge,Advance,BalanceFreight,Hamali,HamaliType,FreightType, StartingKM, DRSKM, LicenseNo, LicenseExp,Location,CreatedBy,CEWBNo) 
        VALUES ('$lr','$DRSNO',STR_TO_DATE('$DRSdate', '%d / %m / %Y'),CONVERT_TZ(Now(),'+00:00','+05:30'),getConsignor('$lr'),getPlace('$lr'),getCosignee('$lr'),'$VehicleNo','$DriverName',
            '$DriverMobile','$VendorName','$FreightCharge','$Advance','$BalanceFreight','$Hamali','$HamaliType', '$FreightType', $StartingKM, $DRSKM, '$LicenseNo', STR_TO_DATE('$LicenseExp', '%d / %m / %Y'),'$userdepo','$User','$CEWBNo');";
        $sql .= "UPDATE LR SET Status = 3, CurrentLocation = '$userdepo', NextLocation='$userdepo', DRS_THCNO='$DRSNO' WHERE LRNO = '$lr';";
    }
    $sql .="INSERT INTO DRSNO(DRSNO) VALUES ('$DRSNO');";
    $sql .= "UPDATE vtcpod INNER JOIN LR ON vtcpod.LRNO = LR.LRNO 
    SET vtcpod.Qty = LR.PkgsNo-LR.DeliveredQty, vtcpod.Weight = LR.ActualWeight, vtcpod.InvoiceNo = LR.InvoiceNo, vtcpod.BookingDate = LR.LRDate,
    vtcpod.ToPay = IF(LR.PayBasis = 'TO PAY', LR.DocketTotal,0) WHERE DRSNO = '$DRSNO';";
    if ($VendorName == 'VTC 3 PL SERVICES LTD PUNE' OR $VendorName == 'VTC 3 PL SERVICES LTD AKOLA')
        $sql .= "UPDATE vtcpod INNER JOIN DriverMaster on vtcpod.DriverName = DriverMaster.DName 
    INNER JOIN Vehicle on vtcpod.VehicleNo = Vehicle.Vehicle_No set DriverMaster.CloseTrip=0, Vehicle.CloseTrip=0,vtcpod.CloseTrip = 0 WHERE DRSNO = '$DRSNO';";

    $flag = true;
    mysqli_autocommit($conn, false);

    $queryarr = explode(";", rtrim($sql, ";"));
    foreach ($queryarr as $query) {
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Error details: " . mysqli_error($conn);
            $flag = false;
            break;
        }
    }
    if ($flag) {
        mysqli_commit($conn);
        echo "<p style='color:green;text-align: center;font-size: 20px;'>DRS No. $DRSNO created successfully.</p>";
    } else {
        mysqli_rollback($conn);
        echo "<p style='color:red;text-align: center;font-size: 20px;'>Failed to create DRS.</p>";
    }
    /*if (mysqli_multi_query($conn, $sql)) {
        echo "<p style='color:green;text-align: center;font-size: 20px;'>DRS No. $DRSNO created successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }*/
    mysqli_close($conn);
}

$i = 1;
$topay = 0;
$totaltopay = 0;
$totalqty = 0;
$totalwt = 0;

if (isset($_GET["DRSNO"]))
    $DRSNO = $_GET["DRSNO"];

if (!isset($DRSNO))
    exit("DRS NO not Specified.");
$arrayA = array();

    $source='18.47%2C73.95';
    $Total=0;
    $travlT=0;
    $dist_val=0;
    $dist=0;
    $time1=0;
            echo "<input id='Button1' type='button' onclick='PrintDiv()' value='Print' />&nbsp;&nbsp;&nbsp;&nbsp;";

            echo "<input  type='button' onclick=\"window.open('voucheradvance.php?DRSNO=$DRSNO','_blank','width=1200,height=600');\" value='Print Voucher' />&nbsp;&nbsp;&nbsp;&nbsp;";
            $CEWBNo='';
            if ($CEWBNo != "0" && $CEWBNo != "")
                echo "<input type='button' onclick=\"window.open('CEWB/cewbno.php?CEWBNo=$CEWBNo', '_blank', 'width=1200,height=600');\" value='Consolidated E-Way Bill Print' /><br /><br />";
            echo "<div width='60%'>
            <div id='Printdrs' style='width:210mm;'>
            <p align='middle'><b>DELIVERY RUN SHEET</b></p>
            <table style='border-collapse: collapse;width:100%;font-size:0.60em;' border=1>
            <tr><td colspan=3 rowspan=3 align='middle'><img style='margin:10px; display: block' src='assets_old/frontend/image/northen_star_logo (1).png' height='50px'></td>
            <td colspan=3 valign='top' align='middle'><b>
            HO:VISHAL HOUSE,SR NO.166,GAJANAN NAGAR ,A/P FURSUNGI,<br>
            TAL;HAVELI, DIST:PUNE - 412308 ,TOLL FREE NO;1800 267 9797 ,<br>
            WEB: WWW.VTC3PL.COM</b></td><td colspan=2 rowspan=2><img alt='testing' src='barcode.php?codetype=Code128&size=40&text=" .$drsdata->DRSNO. "&sizefactor=1'/></td></tr>
            <tr><td colspan=3 rowspan=2 align='middle'><b>CIN NUMBER : U60200PN2012PTC142997<br>
            GST NUMBER : 27AAECV0781E1ZD</b></td></tr>                         
            <tr><td><b>DRS/THC NO</b></td><td style='font-size:1.5em;font-weight: bold;'>" .$drsdata->DRSNO. "</td>
            </tr>                               
            <!--<tr><td><b>BRANCH</b></td><td>PUNE</td></tr> -->
            <tr style='font-weight: bold;'><td><b>DATE</b></td><td>" . $drsdata->drsdate. "</td><td><b>TIME</b></td><td>" . $drsdata->drsdate. "</td><td><b>VEHICLE NO.</b></td><td>" . $drsdata->vehicleno. "</td><td><b>DRIVER MOBILE NO</b></td><td>" . $drsdata->mobileno. "</td></tr>
            </table>";

            $str = "<table style='border-collapse: collapse;width:100%;font-size:0.70em;' border=1>
            <tr><td><b>FREIGHT</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata->FreightCharge. "</td><td><b>VEHICLE OWNER NAME</b></td><td>" .$drsdata->vendorname. "</td><td width='10%'><b>DRSKM</b></td><td width='10%'>" . $drsdata->drskm. "</td></tr>           
            <tr><td><b>ADVANCE</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata1->VAmount. "</td><td><b>DRIVER NAME</b></td><td>" .$drsdata->driver. "</td><td><b>SIGN</b></td><td></td></tr>

            <tr><td><b>DIESEL AMOUNT</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata->dieselamt. "</td><td><b>VEHICLE TYPE</b></td><td>" .$drsdata->vehiclecapacitymodel. "</td><td><b>PAYMENT SCHEDULE</b></td><td>" . $drsdata->paymentschedule. "</td></tr>

            <tr><td><b>BALANCE FREIGHT</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata->BalanceFreight . "</td><td><b>LICENSE NUMBER</b></td><td>" .$drsdata->licenseno. "</td><td><b>CONSOLIDATED E-WAY BILL</b></td><td>" . $drsdata->CEWBNo. "</td></tr>
            <tr><td><b>COMMISSION</b></td><td></td><td><b>LICENSE EXPIRY DATE</b></td><td>" .$drsdata->licexpdate. "</td><td colspan=2 rowspan=2>" . $drsdata->CreatedBy. "</td></tr>
            <tr><td><b>WASULI CASH/BALANCE</b></td><td></td><td><b>VEHICLE READING</b></td><td>" .$drsdata->drskm. "</td></tr>
            <tr><td><b>HAMALI CASH/BALANCE</b></td><td style='font-size:1.3em;font-weight: bold;'>" .$drsdata->Hamali. "</td><td><b></b></td><td></td><td colspan=2 align='middle'>FOR VTC3PL SERVICE PVT.LTD.</td></tr>
            <!-- <tr><td colspan=6></td></tr> <tr><td colspan=6 align='middle'>NOTE : WE ACCEPTED TERMS AND CONDITION MENTIONED BACK SIDE OF THE DRS/THC.</td></tr>
            <tr><td colspan=6 align='middle'>डी.आर.एस. / टी.एस.सी. च्या मागील नियम व अटी आम्ही समजून घेतले व ते आम्हाला मान्य आहेत. </td></tr> -->
            </table>
            <table style='border-collapse: collapse;width:100%;font-size:0.70em;' border=1>
            <tr><td colspan=4 align='middle'><b>Terms & Conditions</b></td></tr>
            <tr><td>१)</td><td>सदरहू मोटार कोणत्याही कारणाने बिघडल्यास आम्ही मालाची खोटी न करता स्वतःच्या खर्चाने माल मेमोमध्ये लिहिलेल्या गावी मालधन्यास पोहोचविण्यास बंधनकारक आहोत व त्याची संपूर्ण जबाबदारी आमची आहे. </td>
            <td>1)</td><td>If the vehicle is damaged for any reason, we are obliged to deliver the goods to the village written in the goods memo at our own expense, without spoiling the goods.</td></tr>
            <tr><td>२)</td><td>सदरहू मालात कमी-जास्त झाल्यास त्याची नुकसान भरपाई करून देण्यास आम्ही तयार आहोत. </td>
            <td>2)</td><td>We are ready to compensate for the loss of the goods</td></tr>
            <tr><td>३)</td><td>सदर माल घेणाऱ्या मालधन्याशिवाय दुसऱ्या कोणत्याही जागेवर उतरविल्यास त्याची जबाबदारी आमचेवर असून खोटी न करता मालधन्यास पोहोचविण्यास तयार आहोत. </td>
            <td>3)</td><td>It is our responsibility if we land at any place other than the consignee and are ready to deliver the goods without any fuss.</td></tr>
            <tr><td>४)</td><td>आग, पाणी, हवा यापासून झालेल्या नुकसानीस संपूर्णपणे गाडीमालक जबाबदार राहील. </td>
            <td>4)</td><td>The owner of the vehicle will be solely responsible for any damage caused by fire, water, air.</td></tr>
            <tr><td>५)</td><td>सदरहू मालाचे आम्ही डाग मोजून घेतले आहेत. त्याचप्रमाणे मालाच्या बिलट्या समजून घेतल्या आहेत व वरील नियम आम्ही समजून घेतले आहेत व ते आम्हाला मान्य आहेत. </td>
            <td>5)</td><td>We have counted the Packages of the goods. Similarly, we have understood the bills of goods and we have understood the above rules and they are acceptable to us.</td></tr>
            <tr><td colspan=2>टी.एस.सी. च्या वरील नियम व अटी आम्ही समजून घेतले व ते आम्हाला मान्य आहेत. </td><td colspan=2>WE ACCEPTED TERMS AND CONDITION MENTIONED ABOVE OF THE THC</td></tr>
            <tr><td colspan=4><center><b>Emergancy No:-8282824545 </b><center></td></tr>
            </table><div style='float:right;'><table><tr><td style='border-bottom:1px;height:70px' valign='bottom'><b>Driver / Vendor Sign</b></td></tr></table></div>";

            echo "<table style='border-collapse: collapse;width:100%;font-size:0.70em;' border=1>
            <tr style='font-weight: bold;text-align: center;'><td width='20px'>SR NO.</td><td>PLACE</td><td>CONSIGNEE  NAME</td><td>LR NO</td><td>INVOICE NO</td><td width='20px'>QTY</td><td width='30px'>WEIGHT</td>
            <td width='40px'>TO PAY FREIGHT</td><td>CONSIGNOR NAME</td><td>BOOKING DATE</td><td>Distance</td><td>Time</td></tr>
            <tr><td>$i</td><td>" . $drsdata->Place. "</td><td>" . $drsdata->Consignee. "</td><td>" .$drsdata->LRNO. "</td><td>" .$drsdata->InvoiceNo. "</td><td>" . $drsdata->Qty. "</td>
            <td>" . $drsdata->Weight. "</td><td>" .$drsdata->ToPay . "</td><td>" . $drsdata->Consignor. "</td><td>" . $drsdata->BookingDate . "</td><td>$dist</td><td>".Round($time1,3)." hours</td></tr>";
            $totaltopay = $totaltopay + $drsdata1->ToPay;
            $totalqty = $totalqty + $drsdata->Qty;
            $totalwt = $totalwt +  $drsdata->Weight;
            // $i++;
   //          while ($drsdata =($result)) {
   //              $totaltopay = $totaltopay + $drsdata->ToPay;
   //              $totalqty = $totalqty + $drsdata->Qty;
   //              $totalwt = $totalwt +  $drsdata->Weight;
   //              // $lat = $row['Latitude'];
   //              $lon = $row['Longitude'];
   //              $latlog=$lat."%2C".$lon;
   //              array_push($arrayA, $latlog);

   //  $source='18.47%2C73.95';//18.475107969437342, 73.9579392902044
   //  $Total=0;
   //  $travlT=0;
   //  $dist_val=0;
   //  $dist=0;
   //  $time1=0;
   //  foreach($arrayA as $point) { 
   //      //echo "$point<br>";     
   //          //$distance=GetDrivingDistance($source, $point);    
   //      $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$source."&destinations=".$point."&key=AIzaSyBIAE4WaPolB4K0sCeKfauqh9RnnAIFXkk"; 
   // // echo"$url<br>";          
   //      //$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin."&destinations=".$destination."&key=AIzaSyBIAE4WaPolB4K0sCeKfauqh9RnnAIFXkk";
   //      $ch = curl_init($url);
   //     // curl_setopt($ch, CURLOPT_URL, $url);
   //      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //      curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
   //      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   //      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   //      $response = curl_exec($ch);
   //      curl_close($ch);
   //      $response_a = json_decode($response, true);
        
   //      $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
   //      $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
   //      $dist_val = ($response_a['rows'][0]['elements'][0]['distance']['value']/1000);
   //      $time_val = ($response_a['rows'][0]['elements'][0]['duration']['value']/3600);
   //      $time_val1 = ($response_a['rows'][0]['elements'][0]['duration']['value']);
   //      $t1=$time_val1+1800;
   //      $t2=$t1/3600;
   //      $time1=$t2;
   //      $Total+=$dist_val;
   //      $travlT+=$t2;
   //              $source=$point;  
   //          }
   //          echo "<tr><td>$i</td><td>" . $row["Place"] . "</td><td>" . $row["Consignee"] . "</td><td>" . $row["LRNO"] . "</td><td>" . $row["InvoiceNo"] . "</td><td>" . $row["Qty"] . "</td>
   //          <td>" . $row["Weight"] . "</td><td>" . $row["ToPay"] . "</td><td>" . $row["Cosigner"] . "</td><td>" . $row["BookingDate"] . "</td><td>$dist</td><td>".Round($time1,3)." hours</td></tr>";
   //          $i++;
   //      }
        echo "<tr style='font-size:1.3em;font-weight: bold;'><td colspan=4></td><td>Total</td><td>$totalqty</td><td>$totalwt</td><td>$totaltopay</td><td colspan=2></td><td>$Total km</td><td>".Round($travlT,3)." hours</td></tr></table>";
        echo $str . "</div></div>";

        function validateDate($date, $format = 'd/m/Y')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        ?>


        <script>
        </script>
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIAE4WaPolB4K0sCeKfauqh9RnnAIFXkk&callback=initMap&libraries=&v=weekly"
        async
        ></script>
    </body>
    </html>