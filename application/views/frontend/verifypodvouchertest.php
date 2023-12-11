<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>VERIFY POD VOUCHER</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 0;
		}

		form {
			max-width: 800px;
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		table, th, td {
			border: 1px solid #ddd;
		}

		th, td {
			padding: 10px;
			text-align: left;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		input[type="text"],
		input[type="number"],
		textarea,
		select {
			width: 75%;
			padding: 0px;
			margin: 0px 0 0 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
			border-radius: 4px;
		}
	</style>
</head>
<body>
	<form method="POST" >
		<p>&nbsp;</p>
		<div id="ftype" style="display:none">
			<input type="radio" id="ftperkm" name="freighttype" value="perKM" onclick="kmclick()" required="" disabled="">Rate Per KM &nbsp;&nbsp;
			<input type="radio" id="ftfix" name="freighttype" value="Fix" onclick="fixclick()" required="" disabled="" checked="">Fixed Rate 
		</div>
		<table  class="blueTable" cellpadding="4" border="1">
			<tbody>
				<tr>
					<?php foreach ($drsdata as $record): ?>
						<td><strong>DRS NO</strong></td>
						<td><?php echo $record->DRSNO; ?></td>
					</tr>

					<tr>
						<td>
							<strong>Total LR Hamali</strong>
						</td>
						<td><?php echo $record->LRHamali; ?></td>

					</tr>
					<tr>
						<td>
							<strong>Freight</strong>
						</td>
						<td><?php echo $record->FreightCharge; ?>
					</td>
					<td>
						<strong>Bank Charges</strong>
					</td>
					<td><?php echo $record->Advancecashbank; ?></td>
				</tr>


				<tr>
					<td>
						<strong>DRS KM</strong>
					</td>
					<td>
						<?php echo $record->drskm; ?>
					</td>
					<td>
						<strong>Penalty</strong>
					</td>
					<td><?php echo $record->Penalty; ?></td>
				</tr>
				<tr>
					<td>
						<strong>Total Qty</strong>
					</td>
					<td><?php echo $record->Qty; ?>
				</td>
				<td>
					<strong>Hamali Received From Driver:</strong>
				</td>
				<td><?php echo $record->Hamali; ?></td>
			</tr>

			<tr>
				<td>
					<strong>Freight Type</strong>
				</td>
				<td><?php echo $record->freighttype; ?></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="Submit" value="Submit DRS KM" required="" style="display:none" disabled="">
				</td>
			</tr>

			<tr>
				<td>
					<strong>Actual Freight</strong>
				</td>
				<td><?php echo $record->FreightCharge; ?></td>
			</tr>

			<tr>
				<td>
					<strong>Other </strong>
				</td>
				<td><?php echo $record->OtherCharges; ?></td>
			</tr>

			<tr>
				<td>
					<strong>Mode of Payment</strong>
				</td>
				<td>
					<select id="paytype" name="paytype" onchange="payclick()" disabled="">
						<option value="Cash" selected="">Cash</option>
						<option value="Cash">Cash</option>
						<option value="Bank">Bank</option>
					</select>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			<tr>
				<td>
					<strong>Transaction ID</strong>
				</td>
				<td>
					<input type="text" id="transid" name="transid" style="display:none" disabled="">
				</td>
			</tr>

			<tr>
				<td>
					<strong>Unloading Hamali</strong>
				</td>
				<td><?php echo $record->TransactionID; ?></td>
			</tr>

			<tr>
				<td>
					<strong>Halting Charges</strong>
				</td>
				<td><?php echo $record->HaltingCharge; ?></td>
			</tr>

			<tr>
				<td>
					<strong>OverLoading Charges</strong>
				</td>
				<td><?php echo $record->OverLoadingCharge; ?></td>
			</tr>

			<tr>
				<td>
					<strong>ExtraDelivery Charges</strong>
				</td>
				<td><?php echo $record->ExtraDeliveryCharge; ?></td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			<tr>
				<td>
					<strong>Other Charges</strong>
				</td>
				<td><?php echo $record->OtherCharges; ?></td>
			</tr>

			<tr>
				<td>
					<strong>Remark</strong>
				</td>
				<td><?php echo $record->Remark; ?></td>
			</tr>
			<tr>
				<td>
					<strong>Total Expenses</strong>
				</td>
				<td><?php echo $record->dieselamt; ?></td>
				<td>
					<strong>Total Receipts</strong>
				</td>
				<td>
					<input type="number" name="totalreceipts" value="0" id="totalreceipts" disabled="" readonly="" required="">
					<span id="totalreceipts">
					</span>
				</td>
			</tr>
			<tr>
				<td> 
					<strong>Total </strong>
				</td>
				<td><?php echo $record->dieselamt; ?></td>
			</tr>
			<tr>
				<td>
					<strong>Advance</strong>
				</td>
				<td><?php echo $record->Advance; ?></td>
			</tr>
			<tr>
				<td>
					<strong>Total (updated) ToPay</strong>
				</td>
				<td><?php echo $record->ToPay; ?></td>
			</tr>
			<input type="hidden" id="drsno" name="drsno" value="DS/PNA/2324/001621">
			<tr>
				<td>
					<strong>Balance</strong>
				</td>
				<td><?php echo $record->dieselamt; ?></td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input type="hidden" onchange="sum()" name="Balance" id="Balance" value="1300" readonly="" disabled="">
					<span id="Balance">
					</span>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>

			<tr>
				<td>
					<input type="Submit" name="Submit" value="Submit Payment details" disabled="">&nbsp;&nbsp;
					<input type="button" class="btn btn-outline-dark btn-fw" value="Voucher Print" onclick="window.open('vouchernew.php?DRSNO=DS/PNA/2324/001621','_blank','width=1200,height=600');">
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</form>
</body>
</html>