<html>
<head>
	<style>
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

<body onload="window.print()">
	<?php  
    $arr_segment = $this->uri->segment_array();
    $last_segment = array_slice($arr_segment, 1);
    $str_segment = implode('/',$last_segment);

    ?>
	<table style="border-collapse: collapse;table-layout: fixed;width:100%" cellpadding="10" border="1">
		<tbody>
			<tr>
				<td align="middle" style="width:30%;">
					<img style="margin:10px; display: block" src="assets_old/frontend/image/northen_star_logo (1).png" height="70px">
				</td>
				<td align="middle">
					<h2>Vtc3pl Services Pvt. Ltd.</h2>
					Head Office : Vishal House, Sr. No. 166<br>Gajanan Nagar, Fursungi. Pune-412308.</td>	
					<td valign="top" style="width:25%;">
						<b>Voucher No.:- </b><?php echo $drsdata1->VoucherNo; ?><br><br>
						<b>Date :- </b><?php echo $drsdata1->VoucherDate; ?> 
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<b>Pay To :- VISHWANATH BALAJI SHINDE<br>&nbsp;<br> Driver Name :- <?php echo $drsdata->driver; ?></b>
					</td>
				</tr>
				<tr>
					<td align="middle" colspan="2"><b>Particulars</b>
					</td>
					<td align="middle"><b>Amount Rs</b>
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Advance Amount being paid against</b><br>&nbsp;<br>DRSNO :-  <?php echo $drsdata->DRSNO; ?><br>DRS Date :-  <?php echo $drsdata->drsdate; ?><br>Vehicle No.:-  <?php echo $drsdata->vehicleno; ?><br>DRS KM.:-  <?php echo $drsdata->drskm; ?><br> Disel Amount.:- <?php echo $drsdata->dieselamt; ?>
						<br> Advance.:- <?php echo $drsdata1->VAmount; ?>            
						<br>Online Transaction ID:- <br>
					</td>
					<td valign="top" align="middle"><?php echo $drsdata1->VAmount; ?></td>
				</tr>
				<tr>
					<td align="right" colspan="2">Total</td>
					<td align="middle"><?php echo $drsdata1->VAmount; ?></td>
				</tr>
				<tr>
					<td colspan="2">Paid By:- <br>Date<br>Prepared By :-<?php echo $drsdata->CreatedBy; ?></td>
					<td valign="bottom">Reciever Sign<br>Name:-</td>
				</tr>
			</tbody>
		</table>
	</body>
	</html> 