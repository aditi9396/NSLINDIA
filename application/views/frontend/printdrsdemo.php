<html>
<head>
    <style>
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            #PrintDiv {
                display: block;
            }
        }

        #bg-text {
            color: red;
            height: 300px;
            font-size: 120px;
            transform: rotate(360deg);
            -webkit-transform: rotate(300deg);
        }

        img#vtclogo {
            position: relative;
            margin: 1%;
            width: unset;
        }

        img {
            position: absolute;
            margin:13% 70%;
            width: 25%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 0.70em;
            border: 1px solid black; 
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            font-weight: bold;
            text-align: center;
        }

    </style>
</head>

<?php  
$arr_segment = $this->uri->segment_array();
$last_segment = array_slice($arr_segment, 1);
$str_segment = implode('/',$last_segment);

$DRSNO = $_GET['DRSNO'];

$query = $this->db->query("SELECT id, LRNO, DRSNO,Consignee,Consignor,FreightCharge, drsdate, Uploaded, Uploadtime, Verifytime, Consignor, WebXUploaded, Place, InvoiceNo, Qty, Weight, Consignee, BookingDate, vendorname, Delivered, DeliveryDate, DeliveryDT, CnoteUpdated, FreightCharge, Advance, BalanceFreight, PayScheduled, Paydate,  vehicleno, freighttype, mreading, drskm, ToPay, Reason, Hamali, UpdatedToPay, TopayMOP, TopayTransID, LRHamali, UpdatedQty, StatementNo, StatementDate, VerifyUser, DeliverUser, DRSKMUser, Remark, StatementUser, TransactionID, MOP, HamaliType, DRSDT, Location, driver, mobileno, FTLType, licenseno, licexpdate, CloseTrip, CreatedBy, CancelReason, Canceluser, CancelDT, CEWBNo, FinalHamali, IMPSCharges, HaltingCharge, OverLoadingCharge, ExtraDeliveryCharge, Penalty, OtherCharges, FinalRemark, vehiclecapacitymodel, paymentschedule, dieselamt, statementimagestatus, Advancecashbank, Dieselvendorname, liter, Rate, Status1, Status2, created_at, updated_at
    FROM vtcpod1 WHERE DRSNO =?", array($DRSNO));
$data['drsdata1'] = $query->row();

?>

<body >
    <p align="middle"><b>DELIVERY RUN SHEET</b></p>
    <!-- <div id="PrintDiv">
        <p id="bg-text">Cancelled</p>
    </div> -->

    <input type="button" value="Print" onclick="window.print()">
    <input type="button" onclick="window.open('<?php echo base_url('printdrsvoucher?DRSNO=' . $data['drsdata1']->DRSNO); ?>','_blank','width=1200,height=600');" value="Print Voucher">
    <input type="button" onclick="window.open('<?php echo base_url('consolidated-eway-bill?DRSNO=' . $data['drsdata1']->DRSNO); ?>','_blank','width=1200,height=600');" value="Consolidated E-Way Bill Print">
    <br>

    <table class="mt-4">
        <tbody>
            <tr>
                <td colspan="3" rowspan="3" align="middle">
                    <img src='assets_old/frontend/image/northen_star_logo (1).png' id="vtclogo" height='50'>
                </td>
                <td colspan="3" valign="top" align="middle">
                    <b>HO:VISHAL HOUSE, SR NO.166, GAJANAN NAGAR, A/P FURSUNGI,<br>TAL;HAVELI, DIST:PUNE - 412308 , TOLL FREE NO;1800 267 9797,<br>WEB: WWW.VTC3PL.COM</b>
                </td>
                <td colspan="3"><?php if (!empty($imageURL)) : ?>
                <img  style="position: absolute!important;" src="<?php echo $imageURL1; ?>" alt="testing">
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="2" align="middle">
            <b>CIN NUMBER : U60200PN2012PTC142997<br>GST NUMBER : 27AAECV0781E1ZD</b>
        </td>
    </tr>
    <tr>
        <td><b>DRS/THC NO</b></td>
        <td><?php echo $data['drsdata1']->DRSNO; ?></td>
    </tr>
    <tr style="font-weight: bold;">
        <td><b>DATE</b></td>
        <td><?php echo $data['drsdata1']->drsdate; ?></td>
        <td><b>TIME</b></td>
        <td><?php echo $data['drsdata1']->DRSDT; ?></td>
        <td><b>VEHICLE NO.</b></td>
        <td><?php echo $data['drsdata1']->vehicleno; ?></td>
        <td><b>DRIVER MOBILE NO</b></td>
        <td><?php echo $data['drsdata1']->mobileno; ?></td>
    </tr>
</tbody>
</table>

<table>
    <tbody>
        <tr style="font-weight: bold; text-align: center;">
            <td width="20px">SR NO.</td>
            <td>PLACE</td>
            <td>CONSIGNEE NAME</td>
            <td>LR NO</td>
            <td>INVOICE NO</td>
            <td width="20px">QTY</td>
            <td width="30px">WEIGHT</td>
            <td width="40px">TO PAY FREIGHT</td>
            <td>CONSIGNOR NAME</td>
            <td>BOOKING DATE</td>
        </tr>
        <?php foreach ($drsdata as $record): ?>
            <tr>
                <td>1</td>
                <td><?php echo $record->Place; ?></td>
                <td><?php echo $record->Consignee; ?></td>
                <td><?php echo $record->LRNO; ?></td>
                <td><?php echo $record->InvoiceNo; ?></td>
                <td><?php echo $record->Qty; ?></td>
                <td><?php echo $record->Weight; ?></td>
                <td><?php echo $record->FreightCharge; ?></td>
                <td><?php echo $record->Consignor; ?></td>
                <td><?php echo $record->drsdate; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table>
    <tbody>
        <tr>
            <td colspan="4" align="middle"><b>Terms &amp; Conditions</b></td>
        </tr>
        <tr>
            <td>१)</td>
            <td>सदरहू मोटार कोणत्याही कारणाने बिघडल्यास आम्ही मालाची खोटी न करता स्वतःच्या खर्चाने माल मेमोमध्ये लिहिलेल्या गावी मालधन्यास पोहोचविण्यास बंधनकारक आहोत व त्याची संपूर्ण जबाबदारी आमची आहे.</td>
            <td>1)</td>
            <td>If the vehicle is damaged for any reason, we are obliged to deliver the goods to the village written in the goods memo at our own expense, without spoiling the goods.</td>
        </tr>
        <tr>
            <td>२)</td>
            <td>सदरहू मालात कमी-जास्त झाल्यास त्याची नुकसान भरपाई करून देण्यास आम्ही तयार आहोत.</td>
            <td>2)</td>
            <td>We are ready to compensate for the loss of the goods</td>
        </tr>
        <tr>
            <td>३)</td>
            <td>सदर माल घेणाऱ्या मालधन्याशिवाय दुसऱ्या कोणत्याही जागेवर उतरविल्यास त्याची जबाबदारी आमचेवर असून खोटी न करता मालधन्यास पोहोचविण्यास तयार आहोत.</td>
            <td>3)</td>
            <td>It is our responsibility if we land at any place other than the consignee and are ready to deliver the goods without any fuss.</td>
        </tr>
        <tr>
            <td>४)</td>
            <td>आग, पाणी, हवा यापासून झालेल्या नुकसानीस संपूर्णपणे गाडीमालक जबाबदार राहील.</td>
            <td>4)</td>
            <td>The owner of the vehicle will be solely responsible for any damage caused by fire, water, air.</td>
        </tr>
        <tr>
            <td>५)</td>
            <td>सदरहू मालाचे आम्ही डाग मोजून घेतले आहेत. त्याचप्रमाणे मालाच्या बिलट्या समजून घेतल्या आहेत व वरील नियम आम्ही समजून घेतले आहेत व ते आम्हाला मान्य आहेत.</td>
            <td>5)</td>
            <td>We have counted the Packages of the goods. Similarly, we have understood the bills of goods and we have understood the above rules and they are acceptable to us.</td>
        </tr>
        <tr>
            <td colspan="2">टी.एस.सी. च्या वरील नियम व अटी आम्ही समजून घेतले व ते आम्हाला मान्य आहेत.</td>
            <td colspan="2">WE ACCEPTED TERMS AND CONDITION MENTIONED ABOVE OF THE THC</td>
        </tr>
        <tr>
            <td colspan="4">
                <center><b>Emergency No: - 8282824545</b></center>
            </td>
        </tr>
    </tbody>
</table>

<div >
    <table>
        <tbody>
            <tr>
                <td style="border-bottom:1px;height:70px" valign="bottom">
                    <b>Driver / Vendor Sign</b>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-4">
   <input type="button" onclick="window.open('<?php echo base_url('printdrskmtimeroute?DRSNO=' . $data['drsdata1']->DRSNO); ?>','_blank','width=1200,height=600');" value="CALCULATE DISTANCE AND TIME">
   <input type="button" onclick="window.open('<?php echo base_url('printdrskmtimemarkeradd?DRSNO=' . $data['drsdata1']->DRSNO); ?>','_blank','width=1200,height=600');" value="ADD MARKERS">
   <input type="button" onclick="window.open('multirequestroute.php?DRSNO=DS/PNA/2324/001898','_blank','width=1200,height=600');" value="DRAW MULTI ROUTE">
</div>
</body>
</html>
