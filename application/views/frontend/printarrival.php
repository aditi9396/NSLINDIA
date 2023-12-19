<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.grid-cell {
			display: inline-block;
			border: 1px solid #ccc;
			padding: 5px;
			width: 22%;
			font-size: x-small;
		}

	</style>
</head>
<body >
	<center>
		<?php  
		$arr_segment = $this->uri->segment_array();
		$last_segment = array_slice($arr_segment, 1);
		$str_segment = implode('/', $last_segment);
		?>
		<?php
		$query = $this->db->query("SELECT * FROM `thc` WHERE `THCNO` = ?", array($str_segment));
		$data['thcdata1'] = $query->row();


		?>
		<p style="color:blue; font-size: 25px;">THC ARRIVAL <?php echo $str_segment;?> Created Successfully</p>
	</center>

	<div class="container">
		<div class="row">
			<div class="grid-cell">
				<strong>THC No.</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->THCNO;?></div>
			<div class="grid-cell">
				<strong>THC Date</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->drsdate;?></div>
		</div>
		<div class="row">
			<div class="grid-cell">
				<strong>Vehicle No.</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->vehicleno;?></div>
			<div class="grid-cell">
				<strong>Vendor Name</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->vendorname;?></div>
		</div>
		<div class="row">
			<div class="grid-cell">
				<strong>Driver Name</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->driver;?></div>
			<div class="grid-cell">
				<strong>Driver Mobile No.</strong>
			</div>
			<div class="grid-cell"><?php echo $data['thcdata1']->mobileno;?></div>
		</div>
	</div>
	<div>
		<div class="row">
			<div class="grid-cell">
				<strong>Closing KM:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->ClosingKM;?>
			</div>

			<div class="grid-cell">
				<strong>Arrival Date:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->ArrivalDate;?>
			</div>
		</div>
		<div class="row">
			<div class="grid-cell">
				<strong>Hamali vendor Name:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->THCArrivalHvendor;?>
			</div>
			<div class="grid-cell">
				<strong>Hamali Amount Paid To HVendor:</strong>&nbsp;
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->Hamali;?>
			</div>
		</div>
		<div class="row">
			<div class="grid-cell">
				<strong>Unloading Hamali Received From Driver:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->FinalHamali;?>
			</div>

			<div class="grid-cell">
				<strong>Payment Mode:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->paymentschedule;?>

			</div>
		</div>
		<div class="row">
			<div class="grid-cell">
				<strong>Transaction Id:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->TransactionID;?>
			</div>

			<div class="grid-cell">
				<strong>Are you Unloading Vehicle or Not:</strong>
			</div>
			<div class="grid-cell">
				<?php echo $data['thcdata1']->OverLoadingCharge;?>
			</div>
		</div>
	</div>
</body>
<script>
	window.print();
</script>
</html>
