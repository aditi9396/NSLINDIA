<!DOCTYPE>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <style type='text/css'>
        @media print {
            * {
                -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
                color-adjust: exact !important; /*Firefox*/
            }
        }
    </style>
</head>
<body onload="window.print()">
<table style='border-collapse: collapse;margin-top: 20px;' width='95%' height='250px'>
        <tr>
            <td colspan="4"><center><img src="<?php echo $qrCodeImage; ?>" style="  position: absolute; margin: 9% 6%;width: 13%; height: 9%;" alt="QR Code"></center></td>
        </tr>
        <tr>
            <td><strong>PLACE</strong></td>
            <td>:</td>
            <td style='font-size: 28px;' colspan=2><?php echo substr($lrData->ToPlace, 0, 60); ?></td>
        </tr>
        <tr>
            <td><strong>PARTY</strong></td>
            <td>:</td>
            <td style='font-size: 14px;'> <?php echo substr($lrData->Consignee, 0, 14); ?></td>
            <td style=' width = 40%; text-align: center;border: 1px solid;'><strong>Route No.</strong></td>
        </tr>
        <tr>
            <td><strong>QTY</strong></td>
            <td>:</td>
            <td style='font-size: 70px; text-align: center;border: 1px solid'> <?php echo $lrData->id; ?></td>
            <td style='font-size: 60px; text-align: center;border: 1px solid;margin: 10px 10px;'><?php echo "P" . $lrData->id; ?></td>
        </tr>
        <tr>
            <td style='font-size: 10px;'><strong>INVOICE NO.</strong></td>
            <td>:</td>
            <td style='font-size: 16px;'> <?php echo substr($lrData->PkgsNo,0, 14); ?></td>
            <td align='middle'><b><?php echo $lrData->InvDate; ?></b></td>
        </tr>
        <tr>
            <td><strong>LR NO.</strong></td>
            <td>:</td>
            <td style='font-size: 14px;'><?php echo $lrData->str_lr_no; ?></td>
            <td>
                <center><img src='assets_old/frontend/image/northen_star_logo (1).png' height='40'/></center>
            </td>
        </tr>
    </table>
    
    <?php
//     if ($i != $row["PkgsNo"])
//         echo "<div style='page-break-before: always; page-break-after: always'></div>";
// }
// mysqli_close($conn);
?>
