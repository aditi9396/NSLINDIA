<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">CUSTOMER MASTER</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Forms</a></li>
					<li class="breadcrumb-item active" aria-current="page">CUSTOMER MASTER</li>
				</ol>
			</nav>
		</div>
		<div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
			<a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('custlistdata'); ?>">CustomerList</a>
		</div><br>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="customerMaster">
							<div class="form-group">
								<div class="heading">
									<h3 class="page-title">Customer Details</h3>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>GroupCode</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="number" id="GroupCode" name="GroupCode">
									</div>
									<div class="col-sm">
										<label>CustCode</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" id="CustCode" name="CustCode" value="<?php if(isset($requestdata)) echo $requestdata->CustCode; ?>">
									</div>
									<div class="col-sm">
										<label>CostCenter</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" id="CostCenter" name="CostCenter"
										value="<?php if(isset($requestdata)) echo $requestdata->CostCenter; ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>CustName</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" id="CustName" name="CustName"
										value="<?php if(isset($requestdata)) echo $requestdata->CustName; ?>">
									</div>
									<div class="col-sm">
										<label>Category</label>
									</div>
									<div class="col-sm">
										<select class="form-control" id="Category" name="Category" required>
											<option value="">Select</option>
											<option value="TBB" <?php if (isset($requestdata) && $requestdata->Type === 'TBB') echo 'selected'; ?>>TBB</option>
											<option value="TOPAY" <?php if (isset($requestdata) && $requestdata->Type === 'TOPAY') echo 'selected'; ?>>TOPAY</option>
											<option value="PAID" <?php if (isset($requestdata) && $requestdata->Type === 'PAID') echo 'selected'; ?> >PAID</option>
											<option value="FOC" <?php if (isset($requestdata) && $requestdata->Type === 'FOC') echo 'selected'; ?>>FOC</option>
										</select>
									</div>
									<div class="col-sm">
										<label>MobileNo</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="number" id="CustName" name="CustName"
										value="<?php if(isset($requestdata)) echo $requestdata->MobileNo; ?>">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>PAN</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="PAN" id="PAN"
										value="<?php if(isset($requestdata)) echo $requestdata->PAN; ?>" required>
									</div>
									<div class="col-sm-2">
										<label>City</label>
									</div>
									<div class="col-sm-2">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->City; ?>" type="text" name="City" id="City"
										required>
									</div>
									<div class="col-sm">
										<label>Pincode</label>
									</div>
									<div class="col-sm">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->Pincode; ?>" type="text" name="Pincode" id="Pincode"
										required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>Location</label>
									</div>
									<div class="col-sm">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->Location; ?>" type="text" name="Location" id="Location"
										required>
									</div>
									<div class="col-sm">
										<label>TelNo</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="TelNo" id="TelNo" value="<?php if(isset($requestdata)) echo $requestdata->TelNo; ?>"
										required>
									</div>
									<div class="col-sm">
										<label>Address</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" value="<?php if(isset($requestdata)) echo $requestdata->Address; ?>" name="Address" id="Address">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>IndType</label>
									</div>
									<div class="col-sm">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->IndType; ?>" type="text" name="IndType" id="IndType"
										required>
										<span class="error" id="Rerror"></span>
									</div>
									<div class="col-sm">
										<label>CustNameMar</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="CustNameMar" id="CustNameMar" value="<?php if(isset($requestdata)) echo $requestdata->CustNameMar; ?>" required>
										<span class="error" id="Regerror"></span>
									</div>
									<div class="col-sm">
										<label>AddressMar</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="AddressMar"id="AddressMar" value="<?php if(isset($requestdata)) echo $requestdata->AddressMar; ?>" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>BillAddressMar</label>
									</div>
									<div class="col-sm">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->BillAddressMar; ?>" type="text" name="BillAddressMar" id="BillAddressMar"
										required>
									</div>
									<div class="col-sm">
										<label>EmailId</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="EmailId" id="EmailId" value="<?php if(isset($requestdata)) echo $requestdata->EmailId; ?>" required>
										<span class="error" id="Regerror"></span>
									</div>
									<div class="col-sm">
										<label>BillingMail</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="BillingMail"id="BillingMail" value="<?php if(isset($requestdata)) echo $requestdata->BillingMail; ?>" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm">
										<label>Status</label>
									</div>
									<div class="col-sm">
										<input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->Status; ?>" type="text" name="Status" id="Status"
										required>
									</div>
									<div class="col-sm">
										<label>U_BP_Category</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="U_BP_Category" id="U_BP_Category" value="<?php if(isset($requestdata)) echo $requestdata->U_BP_Category; ?>" required>
										<span class="error" id="Regerror"></span>
									</div>
									<div class="col-sm">
										<label>DepotName</label>
									</div>
									<div class="col-sm">
										<input class="form-control" type="text" name="DepotName"id="DepotName" value="<?php if(isset($requestdata)) echo $requestdata->DepotName; ?>" required>
									</div>
								</div>
							</div>
							<?php if(isset($requestdata)){ ?>
								<input type="hidden" name="id" value="<?php echo $requestdata->id; ?>">
							<?php } ?>
							<button type="button"  class="btn btn-outline-dark btn-fw btn-check-key-press" id="<?php if (isset($requestdata)) echo "updatecust";else echo "submitcust"?>" <?php if (isset($requestdata)) echo ""; ?> >Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#submitcust").click(function(event) {
				event.preventDefault(); 
				var formData = new FormData($("#customerMaster")[0]); 
				$.ajax({
					url: base_url + "savecustdata",
					data: formData,
					async: true,
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					type: "POST",
					success: function(data) {
						if (data.success) {
							successToster('Customer Submitted Successfully');
							setTimeout(function(){
								window.location.replace("custlistdata");
							},2000);
						} else {
						}
					},
					error: function() {
						errorToster('Customer Not Submitted Successfully');
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#updatecust").click(function(event) {
				event.preventDefault(); 

				var formData = new FormData($("#customerMaster")[0]); 
				$.ajax({
					url: base_url + "cust-update",
					data: formData,
					async: true,
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					type: "POST",
					success: function(data) {
						if (data.success) {
							successToster('Customer Updated Successfully');
							setTimeout(function(){
								window.location.replace(base_url + "custlistdata");
							},2000);
						} else {
							errorToster("Customer Not Updated Successfully");
						}
					},
					error: function() {
						errorToster("An error occurred during submission.");
					}
				});
			});
		});
	</script>





