
<!DOCTYPE html>
<html lang="en">
<head>
	<title>VTC INVOICE</title>
	<meta charset="utf-8">
</head>
<style>
	@media print{
		body{
			margin:0px;
		}
		@page {
			size:A5 landscape;
			margin: 5.588mm 4.572mm 5.334mm 4.572mm;
		}
	} 
	img{
		position: absolute; 
		margin:19.5% 114%;
	}
	img#vtclogo {
		margin: auto;
		position: relative;
	}
	.verticaltext {
		writing-mode: vertical-lr;
		text-align: left;
		white-space: nowrap;
		position: absolute;
		top: 50%;
		left: 148%;
		transform: translateY(-50%);
		font-weight: bold;
	}
	tr.tab td, th {
		border: 1px solid;
	}
	tr.noBorder td {
		border: 0;
	}
	th,td{
		text-align:center;
	}
	.watermark{
		position:relative;
	}
	.watermark{
		position:absolute;
		bottom:80;
		right:10;
		content:"COPYRIGHT";
		font-size:100px;
		font-weight:500px;
		display:grid;
		transform:rotate(-45deg);
	}

	table {
		border-collapse: collapse;
		width: 99%;
		height: 8%;
	}

	th, td {
		border: 1px solid black;
		padding: 5px;
	}

	.barcode-img {
		margin-left: 10px;
	}

</style>
<body onload="window.print()" >
	<?php 
	$rowgc="";
	?>

	<table>
		<tr>
			<td>
				<table style='border-collapse: collapse;width:100%;' border=1>
					<?php $isFirstRow = true; ?>
					<?php foreach ($lrData as $row): ?>
						<tr>
							<?php if ($isFirstRow): ?>
								<td rowspan="<?php echo count($lrData); ?>">
									<?php if ($rowgc == '0586') : ?>
										<b>NORTHEN STAR LOGISTICS</b><br>
										<img src='assets_old/frontend/image/northen_star_logo (1).png' id="vtclogo" height='50'>
									<?php else : ?>
										<img src='assets_old/frontend/image/northen_star_logo (1).png'  id="vtclogo" height='60'>
									<?php endif; ?>
								</td>
								<td rowspan="<?php echo count($lrData); ?>" width="40%">
									<b>CONSIGNMENT NOTE</b><br>H.O.: Vishal House,
									Sr.No.166, Gajanan Nagar,<br> A/P:Fursungi, Tal: Haveli, Dist: Pune-412308. <br>
									<?php if ($rowgc == '0586') : ?>
										CIN No: U60200PN2012PTC142997 <br>
										GST Code: 996511 PAN: BEIPA7237J
									<?php else : ?>
										CIN No: U60200PN2012PTC142997 <br>
										GST Code: 996511 PAN: AAECV0781E
									<?php endif; ?>
								</td>
							<?php endif; ?>
							<?php if ($isFirstRow): ?>
								<th rowspan="1" <?php echo count($lrData); ?>>CN/LR No.</th>
								<td rowspan="1" <?php echo count($lrData); ?>><?php echo $row['str_lr_no']; ?>
							</td>
						<?php endif; ?>
						<?php if ($isFirstRow): ?>
							<th rowspan="1"<?php echo count($lrData); ?>>CN/LR Date</th>
							<td rowspan="1"<?php echo count($lrData); ?>><?php echo $row['LRDate']; ?>
						</td>
					<?php endif; ?>
				</tr>
				<tr>
					<?php if ($isFirstRow): ?>
						<th rowspan="1"<?php echo count($lrData); ?>>Destination</th>
						<td rowspan="1"<?php echo count($lrData); ?>><?php echo $selectedDepot; ?></td>
					<?php endif; ?>
					<?php if ($isFirstRow): ?>
						<th rowspan="<?php echo count($lrData); ?>">Delivery Depot</th>
						<td rowspan="<?php echo count($lrData); ?>"><?php echo $row['ToPlace']; ?></td>
					<?php endif; ?>
				</tr>
				<?php $isFirstRow = false; ?>
			<?php endforeach; ?>
		</table>
	</td>
</tr>
</table>


<table>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): ?>
		<tr id="color">
			<?php if ($isFirstRow): ?>
				<th>Origin:</th>
				<td><?php echo $selectedDepot; ?></td>
				<th>EDD:</th>
				<td><?php echo $row['EDD']; ?></td>
				<th>Payment Type:</th>
				<td><?php echo $row['PayBasis']; ?></td>
				<td style="width: 25%;height: 68px;">
					<?php if (!empty($imageURL)) : ?>
						<img class="barcode-img" src="<?php echo $imageURL; ?>" alt="Barcode">
					<?php endif; ?>
				</td>
			<?php endif; ?>
		</tr>
		<?php $isFirstRow = false; ?>
	<?php endforeach; ?>
</table>

<table style='border-collapse: collapse;width:99%;' border=1>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): ?>
		<?php if ($isFirstRow): ?>
			<tr style="height:100px;font-size: 0.73em">
				<th style="text-align:left;vertical-align:top;" width="50%">
					<b>Consignor :- <br><?php echo str_replace("\n", "<br>", $row['Consignor']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorMob']); ?></b>
				</th>
				<th style="text-align:left;vertical-align:top;">
					<b>Consignee :- <br><?php echo str_replace("\n", "<br>", $row['Consignee']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeMob']); ?></b>
				</th>
			</tr>
			<?php $isFirstRow = false; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</table>


<?php
$str_lr_no = $_GET['LRNO'];

if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	$DocketTotal1 = $row->DocketTotal;
	$PkgsNo = $row->PkgsNo;
	$ActualWeight = $row->ActualWeight;

	if ($DocketTotal1 >= 50000) {
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab'>
		<td>{$row->PkgsNo}</td>
		<td>{$row->PkgType}</td>
		<td>{$row->ProductType}</td>
		<td>{$row->ActwtperPkg}</td>
		<td>{$row->ActualWeight}</td>
		<td>{$row->InvoiceNo}</td>
		<td>{$row->InvDate}</td>
		</tr>";

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	} else {
        // Display an empty table when $DocketTotal1 is less than 50000
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab' style='display:none;'>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>";


		$PkgsNo='';  
		$ActualWeight='';  
		$TotalWeight='';  

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	}
}
?>


<?php
$str_lr_no = $_GET['LRNO'];
if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	if ($row) {
		if (in_array($row->PayBasis, array("TO PAY", "PAID")) && $row->PayBasis != "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td>' . $row->FreightCharge . '</td></tr>';
			echo '<tr><td>Extra Weight</td><td>' . $row->Hamali . '</td></tr>';
			echo '<tr><td>Doc.Charges</td><td>' . $row->DocCharge . '</td></tr>';
			echo '<tr><td>Door Delivery</td><td>' . $row->DoordelCharge . '</td></tr>';
			echo '<tr><td>Other Charge</td><td>' . $row->OtherCharge . '</td></tr>';
			echo '<tr><td>GST</td><td>' . $row->CSGSTAmount . '</td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b>' . $row->DocketTotal . '</b></td></tr>';
			echo '</table>';
		} else if ($row->PayBasis == "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td></td></tr>';
			echo '<tr><td>Extra Weight</td><td></td></tr>';
			echo '<tr><td>Doc.Charges</td><td></td></tr>';
			echo '<tr><td>Door Delivery</td><td></td></tr>';
			echo '<tr><td>Other Charge</td><td></td></tr>';
			echo '<tr><td>GST</td><td></td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b></b></td></tr>';
			echo '</table>';
		} else {
			echo "PayBasis is not 'TO PAY', 'PAID', or 'TBB'.";
		}
	} 
}
?>


<table style='border-collapse: collapse;font-size:0.73em;width:75%;border: 1px solid;'>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b>Note - </b></td>
	</tr>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b><?php if ($row && isset($row->PayBasis) && ($row->PayBasis == "TO PAY" || ($row->PayBasis == "PAID" && isset($lrcopy) && $lrcopy == "Consigner Copy"))) echo "Amount in Words - " . getIndianCurrency($row->DocketTotal); ?>&nbsp;</b></td>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;"><b>*Special Instruction*</b></th>
		<th><img src="VTCLOGO/recommended stamp.png" alt="VTC Stamp" height="100" style="opacity: 0.2;filter: alpha(opacity=60);"></th>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;">Cheque/DD should be drawn in favor of <?php if ($rowgc == '0586') echo "NORTHERN STAR LOGISTICS"; else echo "VTC 3PL Services Pvt. Ltd"; ?>.</th>
	</tr>
	<tr class="noBorder">
		<th>GSTIN: <?php if ($rowgc == '0586') echo "27BEIPA7237J3ZC"; else echo "27AAECV0781E1ZD"; ?></th>
		<th>PAN: <?php if ($rowgc == '0586') echo "BEIPA7237J"; else echo "AAECV0781E"; ?> </th>
	</tr>
	<tr class="tab">
		<th colspan="2" id="color" style="text-align:left;">Booking Done as per Terms & Condition Accepted By Consignor, Subject to Pune Jurisdiction</th>
	</tr>
	<tr class="tab">
		<th style="text-align:left;">Entered By - <?php echo isset($empName) ? $empName : "Unknown"; ?></th>
		<th><?php echo isset($lrcopy) ? $lrcopy : "Consignee Copy"; ?></th>
	</tr>
	<?php
	if ($row && isset($row->Status) && $row->Status == 2) {
		echo '<tr><td colspan="2"><div class="watermark">CANCELLED</div></td></tr>';
	}
	?>
</table>
</td>
<div style='text-align: center;white-space: nowrap;vertical-align: right;width: 1.5em;'>
	<div class="verticaltext"><br><?php if($rowgc =='0586') echo"www.nslindia.co.in"; else echo "www.vtc3pl.com"; ?> &nbsp;&nbsp;&nbsp;&nbsp; Help Line No. 8282824545</div>
</div>
</tr>
</table>
<?php 
function getIndianCurrency($number)
{
	$decimal = round($number - ($no = floor($number)), 2) * 100;
	$hundred = null;
	$digits_length = strlen($no);
	$i = 0;
	$str = array();
	$words = array(0 => '', 1 => 'One', 2 => 'Two',
		3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
		7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
		10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
		13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
		16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
		19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
		40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
		70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
	$digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
	while( $i < $digits_length ) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += $divider == 10 ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
		} else $str[] = null;
	}
	$Rupees = implode('', array_reverse($str));
	$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
?>
<br>
<br>
<br>
<br>
<br>
<br>

<!-- Acknowledgement copy -->
<table>
	<tr>
		<td>
			<table style='border-collapse: collapse;width:100%;' border=1>
				<?php $isFirstRow = true; ?>
				<?php foreach ($lrData as $row): ?>
					<tr>
						<?php if ($isFirstRow): ?>
							<td rowspan="<?php echo count($lrData); ?>">
								<?php if ($rowgc == '0586') : ?>
									<b>NORTHEN STAR LOGISTICS</b><br>
									<img src='assets_old/frontend/image/northen_star_logo (1).png' id="vtclogo" height='50'>
								<?php else : ?>
									<img src='assets_old/frontend/image/northen_star_logo (1).png'  id="vtclogo" height='60'>
								<?php endif; ?>
							</td>
							<td rowspan="<?php echo count($lrData); ?>" width="40%">
								<b>CONSIGNMENT NOTE</b><br>H.O.: Vishal House,
								Sr.No.166, Gajanan Nagar,<br> A/P:Fursungi, Tal: Haveli, Dist: Pune-412308. <br>
								<?php if ($rowgc == '0586') : ?>
									CIN No: U60200PN2012PTC142997 <br>
									GST Code: 996511 PAN: BEIPA7237J
								<?php else : ?>
									CIN No: U60200PN2012PTC142997 <br>
									GST Code: 996511 PAN: AAECV0781E
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<?php if ($isFirstRow): ?>
							<th rowspan="1" <?php echo count($lrData); ?>>CN/LR No.</th>
							<td rowspan="1" <?php echo count($lrData); ?>><?php echo $row['str_lr_no']; ?>
						</td>
					<?php endif; ?>
					<?php if ($isFirstRow): ?>
						<th rowspan="1"<?php echo count($lrData); ?>>CN/LR Date</th>
						<td rowspan="1"<?php echo count($lrData); ?>><?php echo $row['LRDate']; ?>
					</td>
				<?php endif; ?>
			</tr>
			<tr>
				<?php if ($isFirstRow): ?>
					<th rowspan="1"<?php echo count($lrData); ?>>Destination</th>
					<td rowspan="1"<?php echo count($lrData); ?>><?php echo $selectedDepot; ?></td>
				<?php endif; ?>
				<?php if ($isFirstRow): ?>
					<th rowspan="<?php echo count($lrData); ?>">Delivery Depot</th>
					<td rowspan="<?php echo count($lrData); ?>"><?php echo $row['ToPlace']; ?></td>
				<?php endif; ?>
			</tr>
			<?php $isFirstRow = false; ?>
		<?php endforeach; ?>
	</table>
</td>
</tr>
</table>


<table>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): ?>
		<tr id="color">
			<?php if ($isFirstRow): ?>
				<th>Origin:</th>
				<td><?php echo $selectedDepot; ?></td>
				<th>EDD:</th>
				<td><?php echo $row['EDD']; ?></td>
				<th>Payment Type:</th>
				<td><?php echo $row['PayBasis']; ?></td>
				<td style="width: 25%;">
					<?php if (!empty($imageURL)) : ?>
						<img class="barcode-img" src="<?php echo $imageURL; ?>" alt="Barcode">
					<?php endif; ?>
				</td>
			<?php endif; ?>
		</tr>
		<?php $isFirstRow = false; ?>
	<?php endforeach; ?>
</table>

<table style='border-collapse: collapse;width:99%;' border=1>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): 
		?>
		<?php if ($isFirstRow): ?>
			<tr style="height:100px;font-size: 0.73em">
				<th style="text-align:left;vertical-align:top;" width="50%">
					<b>Consignor :- <br><?php echo str_replace("\n", "<br>", $row['Consignor']); ?></b>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorMob']); ?></b>
					<br>
				</th>
				<th style="text-align:left;vertical-align:top;">
					<b>Consignee :- <br><?php echo str_replace("\n", "<br>", $row['Consignee']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeMob']); ?></b>
				</th>
			</tr>
			<?php $isFirstRow = false; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</table>

<?php
$str_lr_no = $_GET['LRNO'];

if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	$DocketTotal1 = $row->DocketTotal;
	$PkgsNo = $row->PkgsNo;
	$ActualWeight = $row->ActualWeight;

	if ($DocketTotal1 >= 50000) {
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab'>
		<td>{$row->PkgsNo}</td>
		<td>{$row->PkgType}</td>
		<td>{$row->ProductType}</td>
		<td>{$row->ActwtperPkg}</td>
		<td>{$row->ActualWeight}</td>
		<td>{$row->InvoiceNo}</td>
		<td>{$row->InvDate}</td>
		</tr>";

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	} else {
        // Display an empty table when $DocketTotal1 is less than 50000
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab' style='display:none;'>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>";


		$PkgsNo='';  
		$ActualWeight='';  
		$TotalWeight='';  

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	}
}
?>

<?php
$str_lr_no = $_GET['LRNO'];
if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	if ($row) {
		if (in_array($row->PayBasis, array("TO PAY", "PAID")) && $row->PayBasis != "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td>' . $row->FreightCharge . '</td></tr>';
			echo '<tr><td>Extra Weight</td><td>' . $row->Hamali . '</td></tr>';
			echo '<tr><td>Doc.Charges</td><td>' . $row->DocCharge . '</td></tr>';
			echo '<tr><td>Door Delivery</td><td>' . $row->DoordelCharge . '</td></tr>';
			echo '<tr><td>Other Charge</td><td>' . $row->OtherCharge . '</td></tr>';
			echo '<tr><td>GST</td><td>' . $row->CSGSTAmount . '</td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b>' . $row->DocketTotal . '</b></td></tr>';
			echo '</table>';
		} else if ($row->PayBasis == "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td></td></tr>';
			echo '<tr><td>Extra Weight</td><td></td></tr>';
			echo '<tr><td>Doc.Charges</td><td></td></tr>';
			echo '<tr><td>Door Delivery</td><td></td></tr>';
			echo '<tr><td>Other Charge</td><td></td></tr>';
			echo '<tr><td>GST</td><td></td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b></b></td></tr>';
			echo '</table>';
		} else {
			echo "PayBasis is not 'TO PAY', 'PAID', or 'TBB'.";
		}
	} 
}
?>


<table style='border-collapse: collapse;font-size:0.73em;width:75%;border: 1px solid;'>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b>Note - </b></td>
	</tr>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b><?php if ($row && isset($row->PayBasis) && ($row->PayBasis == "TO PAY" || ($row->PayBasis == "PAID" && isset($lrcopy) && $lrcopy == "Consigner Copy"))) echo "Amount in Words - " . getIndianCurrency($row->DocketTotal); ?>&nbsp;</b></td>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;"><b>*Special Instruction*</b></th>
		<th><img src="VTCLOGO/recommended stamp.png" alt="VTC Stamp" height="100" style="opacity: 0.2;filter: alpha(opacity=60);"></th>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;">Cheque/DD should be drawn in favor of <?php if ($rowgc == '0586') echo "NORTHERN STAR LOGISTICS"; else echo "VTC 3PL Services Pvt. Ltd"; ?>.</th>
	</tr>
	<tr class="noBorder">
		<th>GSTIN: <?php if ($rowgc == '0586') echo "27BEIPA7237J3ZC"; else echo "27AAECV0781E1ZD"; ?></th>
		<th>PAN: <?php if ($rowgc == '0586') echo "BEIPA7237J"; else echo "AAECV0781E"; ?> </th>
	</tr>
	<tr class="tab">
		<th colspan="2" id="color" style="text-align:left;">Booking Done as per Terms & Condition Accepted By Consignor, Subject to Pune Jurisdiction</th>
	</tr>
	<tr class="tab">
		<th style="text-align:left;">Entered By - <?php echo isset($empName) ? $empName : "Unknown"; ?></th>
		<th><?php echo isset($lrcopy) ? $lrcopy : "Acknowledgement Copy"; ?></th>
</tr>
	<?php
	if ($row && isset($row->Status) && $row->Status == 2) {
		echo '<tr><td colspan="2"><div class="watermark">CANCELLED</div></td></tr>';
	}
	?>
</table>
</td>
<div style='text-align: center;white-space: nowrap;vertical-align: right;width: 1.5em;'>
	<div class="verticaltext"><br><?php if($rowgc =='0586') echo"www.nslindia.co.in"; else echo "www.vtc3pl.com"; ?> &nbsp;&nbsp;&nbsp;&nbsp; Help Line No. 8282824545</div>
</div>
</tr>
</table>

<!-- Consignor copy -->
<table>
	<tr>
		<td>
			<table style='border-collapse: collapse;width:100%;' border=1>
				<?php $isFirstRow = true; ?>
				<?php foreach ($lrData as $row): ?>
					<tr>
						<?php if ($isFirstRow): ?>
							<td rowspan="<?php echo count($lrData); ?>">
								<?php if ($rowgc == '0586') : ?>
									<b>NORTHEN STAR LOGISTICS</b><br>
									<img src='assets_old/frontend/image/northen_star_logo (1).png' id="vtclogo" height='50'>
								<?php else : ?>
									<img src='assets_old/frontend/image/northen_star_logo (1).png'  id="vtclogo" height='60'>
								<?php endif; ?>
							</td>
							<td rowspan="<?php echo count($lrData); ?>" width="40%">
								<b>CONSIGNMENT NOTE</b><br>H.O.: Vishal House,
								Sr.No.166, Gajanan Nagar,<br> A/P:Fursungi, Tal: Haveli, Dist: Pune-412308. <br>
								<?php if ($rowgc == '0586') : ?>
									CIN No: U60200PN2012PTC142997 <br>
									GST Code: 996511 PAN: BEIPA7237J
								<?php else : ?>
									CIN No: U60200PN2012PTC142997 <br>
									GST Code: 996511 PAN: AAECV0781E
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<?php if ($isFirstRow): ?>
							<th rowspan="1" <?php echo count($lrData); ?>>CN/LR No.</th>
							<td rowspan="1" <?php echo count($lrData); ?>><?php echo $row['str_lr_no']; ?>
						</td>
					<?php endif; ?>
					<?php if ($isFirstRow): ?>
						<th rowspan="1"<?php echo count($lrData); ?>>CN/LR Date</th>
						<td rowspan="1"<?php echo count($lrData); ?>><?php echo $row['LRDate']; ?>
					</td>
				<?php endif; ?>
			</tr>
			<tr>
				<?php if ($isFirstRow): ?>
					<th rowspan="1"<?php echo count($lrData); ?>>Destination</th>
					<td rowspan="1"<?php echo count($lrData); ?>><?php echo $selectedDepot; ?></td>
				<?php endif; ?>
				<?php if ($isFirstRow): ?>
					<th rowspan="<?php echo count($lrData); ?>">Delivery Depot</th>
					<td rowspan="<?php echo count($lrData); ?>"><?php echo $row['ToPlace']; ?></td>
				<?php endif; ?>
			</tr>
			<?php $isFirstRow = false; ?>
		<?php endforeach; ?>
	</table>
</td>
</tr>
</table>


<table>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): ?>
		<tr id="color">
			<?php if ($isFirstRow): ?>
				<th>Origin:</th>
				<td><?php echo $selectedDepot; ?></td>
				<th>EDD:</th>
				<td><?php echo $row['EDD']; ?></td>
				<th>Payment Type:</th>
				<td><?php echo $row['PayBasis']; ?></td>
				<td style="width: 25%;">
					<?php if (!empty($imageURL)) : ?>
						<img class="barcode-img" src="<?php echo $imageURL; ?>" alt="Barcode">
					<?php endif; ?>
				</td>
			<?php endif; ?>
		</tr>
		<?php $isFirstRow = false; ?>
	<?php endforeach; ?>
</table>

<table style='border-collapse: collapse;width:99%;' border=1>
	<?php $isFirstRow = true; ?>
	<?php foreach ($lrData as $row): ?>
		<?php if ($isFirstRow): ?>
			<tr style="height:100px;font-size: 0.73em">
				<th style="text-align:left;vertical-align:top;" width="50%">
					<b>Consignor :- <br><?php echo str_replace("\n", "<br>", $row['Consignor']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsignorMob']); ?></b>
				</th>
				<th style="text-align:left;vertical-align:top;">
					<b>Consignee :- <br><?php echo str_replace("\n", "<br>", $row['Consignee']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeAdd']); ?></b><br>
					<b><?php echo str_replace("\n", "<br>", $row['ConsigneeMob']); ?></b>
				</th>
			</tr>
			<?php $isFirstRow = false; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</table>


<?php
$str_lr_no = $_GET['LRNO'];

if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	$DocketTotal1 = $row->DocketTotal;
	$PkgsNo = $row->PkgsNo;
	$ActualWeight = $row->ActualWeight;

	if ($DocketTotal1 >= 50000) {
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab'>
		<td>{$row->PkgsNo}</td>
		<td>{$row->PkgType}</td>
		<td>{$row->ProductType}</td>
		<td>{$row->ActwtperPkg}</td>
		<td>{$row->ActualWeight}</td>
		<td>{$row->InvoiceNo}</td>
		<td>{$row->InvDate}</td>
		</tr>";

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	} else {
        // Display an empty table when $DocketTotal1 is less than 50000
		echo "
		<table style='border-collapse: collapse;width:75%;font-size:0.74em;float:left;border: 1px solid;'>
		<tr class='tab'>
		<th colspan='7' style='font-size: 1.10em'><b>INVOICE DETAILS</b></th>
		</tr>
		<tr>
		<th>Qty</th>
		<th>Pkg Type</th>
		<th>Said To</th>
		<th>Weight/Pkg</th>
		<th>Total Weight</th>
		<th>Invoice No</th>
		<th>Invoice Date</th>
		</tr>";

		echo "
		<tr class='tab' style='display:none;'>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>";


		$PkgsNo='';  
		$ActualWeight='';  
		$TotalWeight='';  

		echo "
		<tr class='tab'>
		<td><b>{$row->PkgsNo}</b></td>
		<td></td>
		<td>TOTAL</td>
		<td><b>{$row->ActwtperPkg}</b></td>
		<td><b>{$row->ActualWeight}</b></td>
		<td></td>
		<td></td>
		</tr>
		<tr class='noBorder'>
		<td colspan='7'>&nbsp;</td>
		</tr>
		</table>";
	}
}
?>



<?php
$str_lr_no = $_GET['LRNO'];
if ($str_lr_no) {
	$query = $this->db->query("SELECT cpvolumetricdetails.id, cpvolumetricdetails.LRDate, cpvolumetricdetails.LRNO, cpvolumetricdetails.str_lr_no, cpvolumetricdetails.InvoiceNo, cpvolumetricdetails.InvDate, cpvolumetricdetails.PkgType, cpvolumetricdetails.ProductType, cpvolumetricdetails.Invoicevalue, cpvolumetricdetails.PkgsNo, cpvolumetricdetails.LENGTH, cpvolumetricdetails.Width, cpvolumetricdetails.Height, cpvolumetricdetails.ActwtperPkg, cpvolumetricdetails.ActualWeight, cpvolumetricdetails.PerpkgsWeight, cpvolumetricdetails.PkgsWeightA, cpvolumetricdetails.ExcessRate, cpvolumetricdetails.EWBNo, cpvolumetricdetails.EWBExpdate, lr.LRDate, lr.PayBasis, lr.ToPlace, lr.EDD, lr.ConsignorMob, lr.Consignor, lr.ConsignorAdd, lr.ConsigneeMob, lr.Consignee, lr.ConsigneeMar, lr.FreightCharge, lr.DocCharge, lr.DoordelCharge, lr.ExcesswtCharge, lr.ConsigneeAdd, lr.OtherCharge, lr.Hamali, lr.DocketTotal, lr.CSGSTAmount, lr.ConsigneeAddMar, lr.PayBasis
		FROM cpvolumetricdetails 
		INNER JOIN lr ON cpvolumetricdetails.LRNO = lr.LRNO 
		WHERE cpvolumetricdetails.str_lr_no = ?", array($str_lr_no));

	$row = $query->row();

	if ($row) {
		if (in_array($row->PayBasis, array("TO PAY", "PAID")) && $row->PayBasis != "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td>' . $row->FreightCharge . '</td></tr>';
			echo '<tr><td>Extra Weight</td><td>' . $row->Hamali . '</td></tr>';
			echo '<tr><td>Doc.Charges</td><td>' . $row->DocCharge . '</td></tr>';
			echo '<tr><td>Door Delivery</td><td>' . $row->DoordelCharge . '</td></tr>';
			echo '<tr><td>Other Charge</td><td>' . $row->OtherCharge . '</td></tr>';
			echo '<tr><td>GST</td><td>' . $row->CSGSTAmount . '</td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b>' . $row->DocketTotal . '</b></td></tr>';
			echo '</table>';
		} else if ($row->PayBasis == "TBB") {
			echo '<table style="border-collapse: collapse;width: 24%;float: left;" border="1">';
			echo '<tr><th>Cost Head</th><th>Amount</th></tr>';
			echo '<tr><td>Freight Charge</td><td></td></tr>';
			echo '<tr><td>Extra Weight</td><td></td></tr>';
			echo '<tr><td>Doc.Charges</td><td></td></tr>';
			echo '<tr><td>Door Delivery</td><td></td></tr>';
			echo '<tr><td>Other Charge</td><td></td></tr>';
			echo '<tr><td>GST</td><td></td></tr>';
			echo '<tr><td><b>Total Charges</b></td><td><b></b></td></tr>';
			echo '</table>';
		} else {
			echo "PayBasis is not 'TO PAY', 'PAID', or 'TBB'.";
		}
	} 
}
?>


<table style='border-collapse: collapse;font-size:0.73em;width:75%;border: 1px solid;'>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b>Note - </b></td>
	</tr>
	<tr class="noBorder">
		<td colspan="2" style="text-align:left;"><b><?php if ($row && isset($row->PayBasis) && ($row->PayBasis == "TO PAY" || ($row->PayBasis == "PAID" && isset($lrcopy) && $lrcopy == "Consigner Copy"))) echo "Amount in Words - " . getIndianCurrency($row->DocketTotal); ?>&nbsp;</b></td>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;"><b>*Special Instruction*</b></th>
		<th><img src="VTCLOGO/recommended stamp.png" alt="VTC Stamp" height="100" style="opacity: 0.2;filter: alpha(opacity=60);"></th>
	</tr>
	<tr class="tab">
		<th colspan="2" style="text-align:left;">Cheque/DD should be drawn in favor of <?php if ($rowgc == '0586') echo "NORTHERN STAR LOGISTICS"; else echo "VTC 3PL Services Pvt. Ltd"; ?>.</th>
	</tr>
	<tr class="noBorder">
		<th>GSTIN: <?php if ($rowgc == '0586') echo "27BEIPA7237J3ZC"; else echo "27AAECV0781E1ZD"; ?></th>
		<th>PAN: <?php if ($rowgc == '0586') echo "BEIPA7237J"; else echo "AAECV0781E"; ?> </th>
	</tr>
	<tr class="tab">
		<th colspan="2" id="color" style="text-align:left;">Booking Done as per Terms & Condition Accepted By Consignor, Subject to Pune Jurisdiction</th>
	</tr>
	<tr class="tab">
		<th style="text-align:left;">Entered By - <?php echo isset($empName) ? $empName : "Unknown"; ?></th>
		<th><?php echo isset($lrcopy) ? $lrcopy : "Consignor Copy"; ?></th>
	</tr>
	<?php
	if ($row && isset($row->Status) && $row->Status == 2) {
		echo '<tr><td colspan="2"><div class="watermark">CANCELLED</div></td></tr>';
	}
	?>
</table>
</td>
<div style='text-align: center;white-space: nowrap;vertical-align: right;width: 1.5em;'>
	<div class="verticaltext"><br><?php if($rowgc =='0586') echo"www.nslindia.co.in"; else echo "www.vtc3pl.com"; ?> &nbsp;&nbsp;&nbsp;&nbsp; Help Line No. 8282824545</div>
</div>
</tr>
</table>

</body>
</html>