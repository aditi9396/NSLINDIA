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

<body  onload="InitMap()">

<p>&nbsp;</p>
<?php
if (isset($_GET["DRSNO"]))
    $DRSNO = $_GET["DRSNO"];
echo"<input type='hidden' name='drsno' id='drsno' value='$drsdata->DRSNO";

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
		WEB: WWW.VTC3PL.COM</b></td><td colspan=2 rowspan=2><img alt='testing' src='barcode.php?codetype=Code128&size=40&text=" . $drsdata->DRSNO. "&sizefactor=1'/></td></tr>
		<tr><td colspan=3 rowspan=2 align='middle'><b>CIN NUMBER : U60200PN2012PTC142997<br>
							 GST NUMBER : 27AAECV0781E1ZD</b></td></tr>							
		<tr><td><b>DRS/THC NO</b></td><td style='font-size:1.5em;font-weight: bold;'>" . $drsdata->DRSNO. "</td>
							 </tr>								 
		<!--<tr><td><b>BRANCH</b></td><td>PUNE</td></tr> -->
		<tr style='font-weight: bold;'><td><b>DATE</b></td><td>" . $drsdata->drsdate. "</td><td><b>TIME</b></td><td>" .$drsdata->drsdate. "</td><td><b>VEHICLE NO.</b></td><td>" . $drsdata->vehicleno. "</td><td><b>DRIVER MOBILE NO</b></td><td>" .$drsdata->mobileno. "</td></tr>
		</table>";

$str = "<table style='border-collapse: collapse;width:100%;font-size:0.70em;' border=1>
			<tr><td><b>FREIGHT</b></td><td style='font-size:1.3em;font-weight: bold;'>" .$drsdata->FreightCharge. "</td><td><b>VEHICLE OWNER NAME</b></td><td>" . $drsdata->vendorname. "</td><td width='10%'><b>DRSKM</b></td><td width='10%'>" .$drsdata->drskm . "</td></tr>			
			<tr><td><b>ADVANCE</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata1->VAmount. "</td><td><b>DRIVER NAME</b></td><td>" . $drsdata->driver. "</td><td><b>SIGN</b></td><td></td></tr>

            <tr><td><b>DIESEL AMOUNT</b></td><td style='font-size:1.3em;font-weight: bold;'>" .$drsdata->dieselamt. "</td><td><b>VEHICLE TYPE</b></td><td>" .$drsdata->DRSNO. "</td><td><b>PAYMENT SCHEDULE</b></td><td>" . $drsdata->paymentschedule. "</td></tr>

			<tr><td><b>BALANCE FREIGHT</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata->BalanceFreight. "</td><td><b>LICENSE NUMBER</b></td><td>" .$drsdata->licenseno . "</td><td><b>CONSOLIDATED E-WAY BILL</b></td><td>" . $drsdata->CEWBNo. "</td></tr>
			<tr><td><b>COMMISSION</b></td><td></td><td><b>LICENSE EXPIRY DATE</b></td><td>" .$drsdata->licexpdate . "</td><td colspan=2 rowspan=2>" . $drsdata->CreatedBy. "</td></tr>
			<tr><td><b>WASULI CASH/BALANCE</b></td><td></td><td><b>VEHICLE READING</b></td><td>" . $drsdata->drskm. "</td></tr>
			<tr><td><b>HAMALI CASH/BALANCE</b></td><td style='font-size:1.3em;font-weight: bold;'>" . $drsdata->Hamali. "</td><td><b></b></td><td></td><td colspan=2 align='middle'>FOR VTC3PL SERVICE PVT.LTD.</td></tr>
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
		<tr><td></td><td>" .  $drsdata->Place. "</td><td>" . $drsdata->Consignee. "</td><td>" . $drsdata->LRNO . "</td><td>" . $drsdata->InvoiceNo. "</td><td>" . $drsdata->Qty. "</td>
                <td>" . $drsdata->Weight. "</td><td>" . $drsdata->ToPay. "</td><td>" .$drsdata->Consignor. "</td><td>" . $drsdata->BookingDate. "</td><td></td><td>".Round(3)." hours</td></tr>";


    // echo "<tr><td>$id</td><td>" . $drsdata->Place. "</td><td>" . $drsdata->Consignee. "</td><td>" . $drsdata->LRNO. "</td><td>" . $drsdata->InvoiceNo. "</td><td>" .$drsdata->Qty. "</td>
	// 	<td>" . $drsdata->Weight. "</td><td>" . $drsdata->ToPay . "</td><td>" . $drsdata->Consignor . "</td><td>" . $drsdata->BookingDate . "</td><td></td><td>".Round(3)." hours</td></tr>";
    // $i++;
echo "<tr style='font-size:1.3em;font-weight: bold;'>
<td colspan=4></td>
<td>Total</td><td></td>
<td></td>
<td></td>
<td colspan=2></td>
<td></td>
<td>".Round(3)." hours</td>
</tr>
</table>";
echo $str . "
</div></div>";

function validateDate($date, $format = 'd/m/Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>
 
<script>
    var locations = new Array();
var a=document.getElementById('drsno').value;
        $.ajax({
            url: 'MultipleLocations.php',
            type: 'GET',
            datatype:'json',
            data: {
                DRSNO:document.getElementById('drsno').value
            }, 
            success: function (response) {
                for (var i = 0; i < 50; i++) {
                    if (response[i].Latitude1 != 0){
                        locations.push([response[i].Place, response[i].Latitude1, response[i].Longitude1, i + 7]);
                       }
                    }
            },
            error:function(error){
                console.log('Error');
                console.log(error);
            }
        });
    alert(locations+"Add Marker OK");
    console.log(locations);

    var map;
    var waypoints

    function InitMap() {

            var map = new google.maps.Map(document.getElementById('map-layer'), {
                zoom: 7,
                center: new google.maps.LatLng(18.547, 73.8317),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

var contentstring="PickupPoint, FURSUNGI";
marker = new google.maps.Marker({
                    position: new google.maps.LatLng(18.471,73.959),
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
                    map: map
                });
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(contentstring);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }

       
  </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIAE4WaPolB4K0sCeKfauqh9RnnAIFXkk&callback=InitMap&libraries=&v=weekly"
      async
    ></script>
</body>
</html>