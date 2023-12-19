<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<style type="text/css">
	.table{
		width: 100%;
		overflow-x: auto;
	}
	#lrdetails {
		border-collapse: collapse;
		width: 100%;
	}
	#lrdetails th, #lrdetails td {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: center;
	}
	#lrdetails th {
		background-color: #2c2d58a3;
	}
	#lrdetails input[type="text"], #lrdetails select {
		width: 100%;
		padding: 5px;
		box-sizing: border-box;
	}
	@media (max-width: 768px) {
		#lrdetails {
			font-size: 12px;
		}
	}
	#zoomWindow:hover{
		margin-left: 15px;
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
			<h3 class="page-title">VERIFY POD</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Forms</a></li>
					<li class="breadcrumb-item active" aria-current="page">Verify Pod</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class ="verify_pod">
							<form name="myForm" method="get" action="">
								DRS NO
								<input type="text" class="form-control" id="DRSNO" name="searchby1"><br><br>
								<input type="submit" id="submitqry" class="btn btn-outline-dark btn-fw" name="submitqry" value="Search"><br><br>
							</form>
						</div>
						<?php if (!empty($results)): ?>
							<div  class="container">
								<?php $i = 1; ?>
								<?php foreach ($results as $row): ?>
									<div class="row">
										<div class="col-md-3 grid-cell">
											<strong>DRS No.<strong>
											</strong>
										</strong>
									</div>
									<div class="col-md-3 grid-cell"><?php echo $row["DRSNO"]; ?></div>
									<div class="col-md-3 grid-cell">
										<strong>DRS Date</strong>
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
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>
				<?php else: ?>
				<?php endif; ?>
				<br>
				<br>
				<?php if (!empty($results)): ?>
					<div style="overflow:auto;">
						<table class="table" id="lrdetails" cellpadding="4" border="1">
							<thead>
								<tr>
									<th style="width: 1%; white-space: nowrap;">Sr No.</th>
									<th>Cosigner Name</th>
									<th>LR NO</th>
									<th>PLACE</th>
									<th>IMAGE</th>
									<th>ROTATE</th>
									<th>VERIFY</th>
									<th>QTY</th>
									<th>HAMALI</th>
									<th>TO PAY RATE</th>
									<th>LATE REASON</th>
									<th>DELIVERY</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($results as $row): ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row["Consignor"]; ?></td>
										<td><?php echo $row["LRNO"]; ?></td>
										<td><?php echo $row["Place"]; ?></td>
										<td>
											<img id="zoom_01" src="assets_old/images/logo192.png" width="200px" height="150px" style="z-index: 999; overflow: hidden;margin-left: 0px;margin-top: -13px;position:relative;background-position: 71.0069px -411.203px;width: 89px;height: 66px;float: left;" >
										</td>

										<td>
											<div id="imageEditor">
												<input type="button" onclick="rotateImage('90');" value="Rotate Left"><br>
												<input type="button" onclick="rotateImage('-90');" value="Rotate Right"><br>
												<input type="button" onclick="rotateImage('0');" value="Reset Image" >
											</div>
										</td>


										<td>
											<input type="radio" name="LRNO[0][mark]" style="display:none" value="Good" onclick="goodclick('0')"><br>
											<input type="radio" name="LRNO[0][mark]" style="display:none" value="Bad" onclick="badclick('0')"><br>
											<input type="radio" name="LRNO[0][mark]" style="display:none" value="Dispute" onclick="disputeclick('0')"><br>
											<input id="radio1" style="display: none;" type="radio" name="LRNO[0][mark]" value="Other" checked="">
										</td>

										<td>
											1<br><input type="number" name="LRNO[0][qty]" value="1" style="width:60px" >
										</td>
										<td>
											<input type="number" name="LRNO[0][lrhamali]" value="0" style="width:60px" >
										</td>
										<td>
											<input type="radio" name="LRNO[0][topaymop]" value="Cash" onclick="cashclick('0')" checked="">Cash<br>
											<input type="radio" name="LRNO[0][topaymop]" value="Bank" onclick="bankclick('0')">Bank<br>
											2100<br><input type="number" id="txtid0" name="LRNO[0][topay]" value="2100" style="width:60px" disabled=""><br>
											Ref No.<br><input type="text" id="topayref0" name="LRNO[0][topaytransid]" style="width:60px;display:none" disabled="">
											<input type="hidden" name="LRNO[0][value]" value="PNA0000781645">
											<input type="hidden" name="LRNO[0][path]" value=""><input type="hidden" name="LRNO[0][drsno]" value=""><input type="hidden" name="LRNO[0][Uploadtime]" value="0000-00-00 00:00:00">
										</td>
										<td>Reason: <select id="selid0" name="LRNO[0][reason]" style="width:200px; display:none;">
											<option value="">SELECT REASON</option>
											<option value="(Undelivery Reason)ACKNOWLEDGMENT NOT RECIVED">(Undelivery Reason)ACKNOWLEDGMENT NOT RECIVED</option>
											<option value="(Undelivery Reason)BOOKING TO OTHER TRANSPORT">(Undelivery Reason)BOOKING TO OTHER TRANSPORT</option>
											<option value="(Undelivery Reason)BY MISTECH MATERIAL LOADED IN VEHICLE.">(Undelivery Reason)BY MISTECH MATERIAL LOADED IN VEHICLE.</option>
											<option value="(Undelivery Reason)CROSSING TO OTHER VEHICLE/TRANSPORT">(Undelivery Reason)CROSSING TO OTHER VEHICLE/TRANSPORT</option>
											<option value="(Undelivery Reason)In correct address">(Undelivery Reason)In correct address</option>
											<option value="(Undelivery Reason)MATERIAL NOT IN VEHICLE">(Undelivery Reason)MATERIAL NOT IN VEHICLE</option>
											<option value="(Undelivery Reason)OTHER TRANSPORT BOOKING">(Undelivery Reason)OTHER TRANSPORT BOOKING</option>
											<option value="(Undelivery Reason)Premises locked">(Undelivery Reason)Premises locked</option>
											<option value="(Undelivery Reason)Prohibited Area">(Undelivery Reason)Prohibited Area</option>
											<option value="(Undelivery Reason)Refuse by customer">(Undelivery Reason)Refuse by customer</option>
											<option value="(Undelivery Reason)UNDELIVERED DUE TO NO ORDER,">(Undelivery Reason)UNDELIVERED DUE TO NO ORDER,</option>
											<option value="(Undelivery Reason)VEHICLE NOT REACHED">(Undelivery Reason)VEHICLE NOT REACHED</option>
											<option value="(Undelivery Reason)WRONG LR GENERATED">(Undelivery Reason)WRONG LR GENERATED</option>
											<option value="(Undelivery Reason)WRONG LR GENERATED">(Undelivery Reason)WRONG LR GENERATED</option>
											<option value="(Part Delivery Reason)As per customer request">(Part Delivery Reason)As per customer request</option>
											<option value="(Part Delivery Reason)Expire date is over for shipment">(Part Delivery Reason)Expire date is over for shipment</option>
											<option value="(Part Delivery Reason)Material get damage in transit">(Part Delivery Reason)Material get damage in transit</option>
											<option value="(Part Delivery Reason)PARTIALLY UNDELIVERED DUE TO LEAKAGES BOX">(Part Delivery Reason)PARTIALLY UNDELIVERED DUE TO LEAKAGES BOX</option>
											<option value="(Part Delivery Reason)RETURN DUE TO WRONG MATERIAL DELIVERED">(Part Delivery Reason)RETURN DUE TO WRONG MATERIAL DELIVERED</option>
											<option value="(Part Delivery Reason)Shipment get stolen from godown">(Part Delivery Reason)Shipment get stolen from godown</option>
											<option value="(Part Delivery Reason)Shipment received in less  quantity">(Part Delivery Reason)Shipment received in less  quantity</option>		
										</select><textarea name="LRNO[0][remark]" rows="3" cols="25" ></textarea>
									</td>
									<td>
										<input type="hidden" name="LRNO[0][delmark]" value="No"><input type="checkbox" name="LRNO[0][delmark]" value="Yes">Delivered<br>		
										Delivery Date:<br><input type="text" id="datetxt0" name="LRNO[0][ddate]" value="24/06/2023" readonly="" class="hasDatepicker">
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<br>
				<br>
				<input type="submit" name="Submit" class="btn btn-outline-dark btn-fw" onclick="return validateForm()" value="Submit">
				<input type="submit" name="Submit" class="btn btn-outline-dark btn-fw" value="Submitdelivery info">
				<input type="button" class="btn btn-outline-dark btn-fw" onclick="window.open('<?php echo base_url('verifypodvouchertest?DRSNO=' . $row["DRSNO"]); ?>','_blank','width=1200,height=600');" value="Open Voucher">

			<?php else: ?>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
</div>
<script src="assets_old/easyzoom.js"></script>
<!-- <script>
	imageZoom("myimage", "myresult");
</script> -->

<script>
	// document.addEventListener("DOMContentLoaded", function() {
	// 	function imageZoom(imgID, resultID) {
	// 		var img, lens, result, cx, cy;
	// 		img = document.getElementById(imgID);
	// 		result = document.getElementById(resultID);
	// 		lens = document.createElement("DIV");
	// 		lens.setAttribute("class", "img-zoom-lens");
	// 		img.parentElement.insertBefore(lens, img);
	// 		cx = result.offsetWidth / lens.offsetWidth;
	// 		cy = result.offsetHeight / lens.offsetHeight;
	// 		result.style.backgroundImage = "url('" + img.src + "')";
	// 		result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
	// 		lens.addEventListener("mousemove", moveLens);
	// 		img.addEventListener("mousemove", moveLens);
	// 		lens.addEventListener("touchmove", moveLens);
	// 		img.addEventListener("touchmove", moveLens);
	// 		function moveLens(e) {
	// 			var pos, x, y;
	// 			e.preventDefault();
	// 			pos = getCursorPos(e);
	// 			x = pos.x - (lens.offsetWidth / 2);
	// 			y = pos.y - (lens.offsetHeight / 2);
	// 			if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
	// 			if (x < 0) {x = 0;}
	// 			if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
	// 			if (y < 0) {y = 0;}
	// 			lens.style.left = x + "px";
	// 			lens.style.top = y + "px";
	// 			result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
	// 		}
	// 		function getCursorPos(e) {
	// 			var a, x = 0, y = 0;
	// 			e = e || window.event;
	// 			a = img.getBoundingClientRect();
	// 			x = e.pageX - a.left;
	// 			y = e.pageY - a.top;
	// 			x = x - window.pageXOffset;
	// 			y = y - window.pageYOffset;
	// 			return {x : x, y : y};
	// 		}
	// 	}
	// });

</script>
<!-- <script>
	let currentRotation = 0;
	function rotateImage(degrees) {
		currentRotation += degrees;
		thumbnail.style.transform = `rotate(${currentRotation}deg)`;
		zoomImage.style.transform = `rotate(${currentRotation}deg)`;
	}
	function resetImage() {
		currentRotation = 0;
		thumbnail.style.transform = `rotate(${currentRotation}deg)`;
		zoomImage.style.transform = `rotate(${currentRotation}deg)`;
	}
</script> -->
<script src="<?php echo base_url('assets/js/jquery.elevatezoom.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.elevateZoom-3.0.8.min.js'); ?>"></script>
<script>
	$('#zoom_01').elevateZoom({
		zoomType: "inner",
		cursor: "crosshair",
		zoomWindowFadeIn: 900,
		zoomWindowFadeOut: 750
	}); 
</script>
