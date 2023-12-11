<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<style type="text/css">
	.table-container {
		width: 100%;
		overflow-x: auto;
	}
	#invtab {
		border-collapse: collapse;
		width: 100%;
	}
	#invtab th, #invtab td {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: center;
	}
	#invtab th {
		background-color: #2c2d58a3;
	}
	#invtab input[type="text"], #invtab select {
		width: 100%;
		padding: 5px;
		box-sizing: border-box;
	}
	@media (max-width: 768px) {
		#invtab {
			font-size: 12px;
		}
	}
	.grid-cell {
		border: 1px solid #ccc;
		padding: 10px;
		text-align: left;
	}

</style>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">VERIFY THC</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Forms</a></li>
					<li class="breadcrumb-item active" aria-current="page">Verify THC</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="thc">
							<form name="myForm" method="get" action="<?php echo base_url('verify_THC'); ?>">
								THC NO
								<input type="text" id="THCNO" class="form-control" name="searchby"><br><br>
								<input type="submit" id="submitqry" class="btn btn-outline-dark btn-fw" name="submitqry" value="Search"><br><br>
							</form>
						</div>

						<div class="row">
							<form method="post"  id="formTHCverify" action="">
								<?php if (!empty($results)): ?>
									<div  class="container">
										<?php $i = 1; ?>
										<?php foreach ($results as $row): ?>
											<div class="row">
												<div class="col-md-3 grid-cell">
													<strong>THC No.<strong>
													</strong>
												</strong>
											</div>
											<div class="col-md-3 grid-cell"><?php echo $row["THCNO"]; ?></div>
											<div class="col-md-3 grid-cell">
												<strong>THC Date</strong>
											</div>
											<div class="col-md-3 grid-cell"><?php echo $row["drsdate"]; ?></div>
										</div>
										<div class="row">
											<div class="col-md-3 grid-cell">
												<strong>Vehicle No.<strong>
												</strong>
											</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["vehicleno"]; ?></div>
										<div class="col-md-3 grid-cell">
											<strong>Vendor Name</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["vendorname"]; ?></div>
									</div>
									<div class="row">
										<div class="col-md-3 grid-cell">
											<strong>Driver Name</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["driver"]; ?></div>
										<div class="col-md-3 grid-cell">
											<strong>Driver Mobile No.</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["mobileno"]; ?></div>
									</div>
									<div class="row">
										<div class="col-md-3 grid-cell">
											<strong>FROM</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["Place"]; ?></div>
										<div class="col-md-3 grid-cell">
											<strong>TO</strong>
										</div>
										<div class="col-md-3 grid-cell"><?php echo $row["Place"]; ?></div>
									</div>
									<?php $i++; ?>
								<?php endforeach; ?>
							</div>
						<?php else: ?>
						<?php endif; ?>
						<br>
						<?php if (!empty($thcNoData)): ?>
							<div class="table-container">
								<table  id="invtab" cellpadding="4" border="1" style="overflow:auto;">
									<thead>
										<tr>
											<th style="width: 1%; white-space: nowrap;">Sr No.</th>
											<th>CONSIGNEE NAME</th>
											<th>LR NO</th>
											<th>PLACE</th>
											<th>QTY</th>
											<th>UPDATED QTY</th>
											<th>REASON</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($thcNoData as $thcData): ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $thcData->Consignor; ?></td>
												<td><?php echo $thcData->LRNO; ?></td>
												<td><?php echo $thcData->ToPlace; ?> </td>
												<td><?php echo $thcData->Qty; ?></td>
												<td><input type="number" class="form-control" name="updated_qty" value="1" disabled></td>
												<td></td>
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?>
									</tbody>

								</table>
							</div>
							<br>
						<?php else: ?>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

