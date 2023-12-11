<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">VENDOR MASTER</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">VENDOR MASTER</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
            <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('vendorlistdata'); ?>">VendorList</a>
        </div><br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                       <div class="bs-example">
                        <div class="">
                            <form method="post" name="form" id="vendor"><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label>Vendor Code</label>
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="Code" id="Code" value="<?php if(isset($requestdata)) echo $requestdata->VendorCode; ?>">
                                        </div>
                                        <div class="col-sm">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="Name" id="Name" value="<?php if(isset($requestdata)) echo $requestdata->VendorName; ?>">
                                        </div>
                                        <div class="col-sm">
                                            <label>Vendor Type</label>
                                        </div>
                                        <div class="col-sm">
                                            <select class="form-control" name="Type" id="Type" value="" >
                                                <option value="">select</option>
                                                <option value="Attached" <?php if (isset($requestdata) && $requestdata->Type === 'Attached') echo 'selected'; ?>>Attached</option>
                                                <option value="Own" <?php if (isset($requestdata) && $requestdata->Type === 'Own') echo 'selected'; ?>>Own</option>
                                                <option value="Vendor Fuel Pump" <?php if (isset($requestdata) && $requestdata->Type === 'Vendor Fuel Pump') echo 'selected'; ?>>Vendor Fuel Pump</option>
                                                <option value="Vendor Maintainance" <?php if (isset($requestdata) && $requestdata->Type === 'Vendor Maintainance') echo 'selected'; ?>>Vendor Maintainance</option>
                                                <option value="Spare Part" <?php if (isset($requestdata) && $requestdata->Type === 'Spare Part') echo 'selected'; ?>>Spare Part</option>
                                                <option value="Vendor Crossing" <?php if (isset($requestdata) && $requestdata->Type === 'Vendor Crossing') echo 'selected'; ?>>Vendor Crossing</option>
                                                <option value="Asset" <?php if (isset($requestdata) && $requestdata->Type === 'Asset') echo 'selected'; ?>>Asset</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-sm-2">
                                           <textarea class="form-control" cols="20" rows="2" name="Address" id="Address" required><?php if(isset($requestdata)) echo $requestdata->Address; ?></textarea>

                                       </div>
                                       <div class="col-sm-2">
                                        <label>Vendor Locations(Comma Seperated)</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="Location" id="Location" value="" 
                                        onkeyup="this.value=this.value.toUpperCase();"  required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm">
                                        <label>Vehicle Type</label>
                                    </div>
                                    <div class="col-sm">
                                        <div class="multiselect">
                                            <label for="all">
                                                <input type="checkbox" id="selectall"  />Select All</label>
                                                <label>
                                                    <input type="checkbox" class="chk" name="chk[]"
                                                    value="20 FT MULTI EXLE 13 TO 21 MT" />20 FT MULTI EXLE 13 TO 21 MT</label>
                                                    <label>
                                                        <input type="checkbox" class="chk" name="chk[]"
                                                        value="20 FT MULTI EXLE 21 TO 26 MT" />20 FT MULTI EXLE 21 TO 26 MT
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="chk" name="chk[]"
                                                        value="20 FT MULTI EXLE UPTO 13 MT" />20 FT MULTI EXLE UPTO 13 MT
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="chk" name="chk[]"
                                                        value="40 FT MULTI EXLE 13 TO 21 MT" />40 FT MULTI EXLE 13 TO 21 MT
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="chk" name="chk[]"
                                                        value="40 FT MULTI EXLE 21 TO 26 MT" />40 FT MULTI EXLE 21 TO 26
                                                        MT
                                                    </label>
                                                </label>
                                                <label>
                                                    <input type="checkbox" class="chk" name="chk[]"
                                                    value="40 FT MULTI EXLE UPTO 13 MT" />40 FT MULTI EXLE UPTO 13 MT</label>
                                                    <label>
                                                        <input type="checkbox" class="chk" name="chk[]"
                                                        value="MINI TEMPO UPTO 1 MT" />MINI TEMPO UPTO 1 MT</label>
                                                        <label>
                                                            <input type="checkbox" class="chk" name="chk[]"
                                                            value="PICK UP 1 MT TO 2 MT" />PICK UP 1 MT TO 2 MT</label>
                                                            <label>
                                                                <input type="checkbox" class="chk" name="chk[]"
                                                                value="TAURAS 9 MT TO 16 MT" />TAURAS 9 MT TO 16 MT</label>
                                                                <label>
                                                                    <input type="checkbox" class="chk" name="chk[]"
                                                                    value="TEMPO 2 MT TO 3.5 MT" />TEMPO 2 MT TO 3.5 MT
                                                                </label>
                                                                <label>
                                                                    <input type="checkbox" class="chk" name="chk[]"
                                                                    value="TEMPO 3.5 MT TO 5 MT" />TEMPO 3.5 MT TO 5 MT
                                                                </label>
                                                                <label>
                                                                    <input type="checkbox" class="chk" name="chk[]"
                                                                    value="TRUCK 5 MT TO 7 MT" />TRUCK 5 MT TO 7 MT
                                                                </label>
                                                                <label>
                                                                    <input type="checkbox" class="chk" name="chk[]"
                                                                    value="TRUCK 7 MT TO 9 MT" />TRUCK 7 MT TO 9 MT
                                                                </label>
                                                            </div>
                                                            <span class="error"><?php //echo $check; ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <label>Vendor City</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <select class="form-control" name="City" id="City" value="" required>
                                                                <option value="">select</option>
                                                                <option value="Pune"  <?php if (isset($requestdata) && $requestdata->City === 'Pune') echo 'selected'; ?>>Pune</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label>Pin Code</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="PinCode" id="PinCode"
                                                            onkeypress="return IsNumeric(event)" value="<?php if(isset($requestdata)) echo $requestdata->Pincode; ?>" required>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label>Vendor Mobile No.</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="MobileNo" id="MobileNo"
                                                            onkeypress="return ValidateMobile(event)" value="<?php if(isset($requestdata)) echo $requestdata->Mobile_No; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label>E-mail</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input style="text-transform: lowercase;" class="form-control" type="text" name="Email"
                                                            id="Email" onkeyup="ValidateEmail()" value="<?php if(isset($requestdata)) echo $requestdata->Email; ?>" required>
                                                            <span id="error" class="error"></span>
                                                            <span class="error"><?php if(isset($_POST['save'])) {echo $msg;} ?></span>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>Active Flag</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="checkbox" name="Flag" id="Flag" value="" checked>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="heading">
                                                        <label class="label label-primary">Other Information</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <label>PAN NO.</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="PAN" id="PAN"
                                                            onkeyup="return ValidatePan()" value="<?php if(isset($requestdata)) echo $requestdata->PAN_No; ?>">
                                                            <span id="Perror" class="error"></span>
                                                            <span class="error"><?php if(isset($_POST['save'])) {echo $panmsg;} ?></span>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label>GST NO.</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="GST" id="GST"
                                                            onkeyup="return ValidateGst()" value="<?php if(isset($requestdata)) echo $requestdata->GSTNO; ?>">
                                                            <span id="Gerror" class="error"></span>
                                                            <span class="error"><?php if(isset($_POST['save'])) {echo $gstmsg;} ?></span>
                                                        </div>
                                                        <div class="col-sm">
                                                            <label>Bank Name</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="Bank" id="Bank"
                                                            onkeyup="this.value=this.value.toUpperCase();" onkeypress="return wordcheck(event)" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <label>Account No.</label>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input class="form-control" type="text" name="AccountNo" id="AccountNo" onkeyup="return IsNumeric(event)">
                                                            <span id="Aerror" class="error"></span>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>IFSC Code</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input class="form-control" type="text" name="IFSC" id="IFSC"
                                                            onkeyup="return ValidateIfsc()">
                                                            <span id="Ierror" class="error"></span>
                                                            <span class="error"><?php if(isset($_POST['save'])) {echo $ifscmsg;} ?></span>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>Remarks</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <textarea class="form-control" rows="2" cols="20" name="Remark" id="Remark"
                                                            onkeypress="return wordcheck(event)" ></textarea>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php if(isset($requestdata)){ ?>
                                                    <input type="hidden" name="id" value="<?php echo $requestdata->id; ?>">
                                                <?php } ?>
                                                <button type="button"  class="btn btn-outline-dark btn-fw btn-check-key-press" id="<?php if (isset($requestdata)) echo "updatevendor";else echo "submitvendor"?>" <?php if (isset($requestdata)) echo ""; ?> >Save</button>
                                            </form>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $("#submitvendor").click(function(event) {
                                    event.preventDefault(); 
                                    var formData = new FormData($("#vendor")[0]); 
                                    $.ajax({
                                        url: base_url + "savevendordata",
                                        data: formData,
                                        async: true,
                                        dataType: "json",
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: "POST",
                                        success: function(data) {
                                            if (data.success) {
                                                successToster('Vendor Submitted Successfully');
                                                setTimeout(function(){
                                                    window.location.replace("vendorlistdata");
                                                },2000);
                                            } else {
                                            }
                                        },
                                        error: function() {
                                            errorToster('vendor Not Submitted Successfully');
                                        }
                                    });
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#updatevendor").click(function(event) {
                                    event.preventDefault(); 

                                    var formData = new FormData($("#vendor")[0]); 
                                    $.ajax({
                                        url: base_url + "vendor-update",
                                        data: formData,
                                        async: true,
                                        dataType: "json",
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        type: "POST",
                                        success: function(data) {
                                            if (data.success) {
                                                successToster('Vendor Updated Successfully');
                                                setTimeout(function(){
                                                    window.location.replace(base_url + "vendorlistdata");
                                                },2000);
                                            } else {
                                                errorToster("Vendor Not Updated Successfully");
                                            }
                                        },
                                        error: function() {
                                            errorToster("An error occurred during submission.");
                                        }
                                    });
                                });
                            });
                        </script>