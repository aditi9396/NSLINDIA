<body onload="window.print()">

<?php
$StickerCount = 0;

if (is_array($lrData1)) {

    foreach ($lrData1 as $lrDataItem) {
        if (is_object($lrDataItem)) {
            if (isset($barcodeImages1[$lrDataItem->str_lr_no])) {
                foreach ($barcodeImages1[$lrDataItem->str_lr_no] as $index => $barcodeImages1) {

                    $qrCodeImageExists1 = file_exists(FCPATH . 'assets_old/qrcodes/barcode_' . $lrDataItem->str_lr_no . '_' . $index . '.png');

                    if (!$qrCodeImageExists1) {
                        continue;
                    }
                    ?>

                    <div style='display:inline; font-family: Arial; width:42%; margin-bottom: 43px;<?php if (($StickerCount + 1) % 2 == 0) echo "margin-left: 50px;"; ?>float: left;'>
                        <table style='border-collapse: collapse;' width='100%' height='230px'>
                            <tr>
                                <td><strong>PLACE</strong></td>
                                <td>:</td>
                                <td style='font-size: 28px;' colspan="2">
                                    <?php
                                    $placeText = $lrDataItem->ToPlace;
                                    $maxLength = mb_detect_encoding($placeText, 'ASCII', true) ? 13 : 35;
                                    echo substr($placeText, 0, $maxLength);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PARTY</strong></td>
                                <td>:</td>
                                <td style='font-size: 14px;'><?PHP mb_substr($lrDataItem->Consignee, 0, 14) ?></td>
                                <td style='width:40%; text-align: center; border: 1px solid;'><strong>Route No.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>QTY</strong></td>
                                <td>:</td>
                                <td colspan="2" style="font-size: 50px; border: 1px solid; text-align: center;">
                                    <?php echo $lrDataItem->PkgsNo; ?>
                                    <?php
                                    $qrCodeImageURL = base_url('assets_old/qrcodes/barcode_' . $lrDataItem->str_lr_no . '_' . $index . '.png');
                                    //print_r($index);

                                    echo '<img src="' . $qrCodeImageURL . '" alt="QR Code Image">';
                                    echo 'P' . $lrDataItem->RouteNo;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size: 10px;'><strong>INVOICE NO.</strong></td>
                                <td>:</td>
                                <td style='font-size: 16px;'><?php echo $lrDataItem->InvoiceNo; ?></td>
                                <td align='middle'><b><?php echo $lrDataItem->LRDate; ?></b></td>
                            </tr>
                            <tr>
                                <td><strong>LR NO.</strong></td>
                                <td>:</td>
                                <td style='font-size: 14px;'><?php echo $lrDataItem->str_lr_no; ?></td>
                                <td>
                                    <center><img src='assets_old/frontend/image/northen_star_logo (1).png' height='40'/></center>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <?php
                }
            } else {
                echo '<p>Error: Barcode images not found for LR No ' . $lrDataItem->str_lr_no . '</p>';
            }
        } else {
            echo '<p>Error: $lrDataItem is not an object.</p>';
        }
    }



?>

    <div style='display:inline; font-family: Arial; width:40%; margin-bottom: 40px;<?php if (($StickerCount + 1) % 2 == 0) echo "margin-left: 50px;"; ?>float: left;'>

        <table style='border-collapse: collapse;' width='100%' height='230px'>
            <tr>
                <td style='font-size: 24px;text-align: center;' colspan=4><strong>Transport Copy</strong></td>
            </tr>
            <tr>
                <td><strong>LR NO.</strong></td>
                <td>:</td>
                <td style='font-size: 20px;'><?php echo $lrDataItem->str_lr_no ; ?></td>
            </tr>
            <tr>
                <td><strong>PLACE</strong></td>
                <td>:</td>
                <td style='font-size: 28px;' colspan=2><?php echo $lrDataItem->ToPlace; ?></td>
            </tr>
            <tr>
                <td colspan="4">
              <?php 
//                       $barcodeImageURL = base_url('barcode_' . $lrDataItem->str_lr_no . '_0.png');
// $barcodeImageExists = file_exists(FCPATH . 'barcode_' . $lrDataItem->str_lr_no . '_0.png');
            $barcodeImageURL = base_url('barcode.png');
            $barcodeImageExists = file_exists(FCPATH . 'barcode.png');



                    if ($barcodeImageExists): ?>
                        <img src="<?php echo $barcodeImageURL; ?>" alt="Barcode Image"><br>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><strong>QTY</strong></td>
                <td>:</td>
                <td colspan="2" style="font-size: 30px;text-align: center;">
                  <?php echo $lrDataItem->PkgsNo; ?>
 &nbsp;&nbsp;&nbsp;<img src='assets_old/frontend/image/northen_star_logo (1).png' height='40'/>
                </td>
            </tr>
        </table>
    </div>


</div>
<?php
} else {
    echo '<p>Error: $lrData is not an array.</p>';
}
                    $StickerCount++;
                    if ($StickerCount % 8 === 0) {
                        echo '</div>'; 
                        echo '<div style="page-break-after: always;"></div>';
                        echo '<div>';
                    }
?>