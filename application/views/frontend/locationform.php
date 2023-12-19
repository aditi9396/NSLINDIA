 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
 <script src="assets/vendors/js/vendor.bundle.base.js"></script>
 <script src="assets/js/misc.js"></script>
 <div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">LOCATION MASTER</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">LOCATION MASTER</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
            <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('locationlistdata'); ?>">LocationList</a>
        </div><br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <div class="container">
                                <form method="post" id="location" name="form"><br>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Location Hierarchy</label>
                                            </div>
                                            <div class="col-sm">
                                                <select class="form-control" id="Hierarchy" name="Hierarchy">
                                                    <option value="">Select</option>
                                                    <option value="Branch Or Hub Office" <?php if (isset($requestdata) && isset($requestdata->Hierarchy) && $requestdata->Hierarchy === 'Branch Or Hub Office') echo 'selected'; ?>>Branch Or Hub Office</option>
                                                    <option value="VTC 3PL Services PVT.LMT:HQTR" <?php if (isset($requestdata) && isset($requestdata->Hierarchy) && $requestdata->Hierarchy === 'VTC 3PL Services PVT.LMT:HQTR') echo 'selected'; ?>>VTC 3PL Services PVT.LMT:HQTR</option>
                                                </select>
                                            </div>


                                            <div class="col-sm">
                                                <label>Reporting To</label>
                                            </div>
                                            <div class="col-sm">
                                                <select class="form-control" id="ReportingTo" name="ReportingTo" required>
                                                    <option value="">Select</option>
                                                    <option value="WMRO"<?php if (isset($requestdata) && isset($requestdata->ReportingTo) && $requestdata->ReportingTo === 'WMRO') echo 'selected'; ?> data-group="WMRO">WMRO</option>
                                                    <option value="VTC 3PL Services PVT.LMT:HQTR"<?php if (isset($requestdata) && isset($requestdata->ReportingTo) && $requestdata->ReportingTo === 'VTC 3PL Services PVT.LMT:HQTR') echo 'selected'; ?> data-group="HQRT">VTC 3PL Services PVT.LMT:HQTR</option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <label>Reporting Location</label>
                                            </div>
                                            <div class="col-sm">
                                                <select class="form-control" id="ReportingLocation" name="ReportingLocation" required>
                                                    <option value="">Select</option>
                                                    <option value="VTC 3PL Services PVT.LMT:HQTR"<?php if (isset($requestdata) && isset($requestdata->ReportingLocation) && $requestdata->ReportingLocation === 'VTC 3PL Services PVT.LMT:HQTR') echo 'selected'; ?>>VTC 3PL Services PVT.LMT:HQTR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Location Code</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" id="LocationCode" name="LocationCode" value="<?php if(isset($requestdata)) echo $requestdata->LocationCode; ?>" 
                                                required>
                                                <span id="location" class="error"></span>
                                            </div>
                                            <div class="col-sm">
                                                <label>Location Name</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" id="LocationName" name="LocationName" value="<?php if(isset($requestdata)) echo $requestdata->LocationName; ?>"
                                                required>
                                            </div>
                                            <div class="col-sm">
                                                <label>Branch Name</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" id="Branch" name="Branch" value="<?php if(isset($requestdata)) echo $requestdata->Branch; ?>" required>
                                                <span id="Berror" class="error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Pin Code</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" id="PinCode" name="PinCode" value="<?php if(isset($requestdata)) echo $requestdata->PinCode; ?>" required>
                                            </div>
                                            <div class="col-sm">
                                                <label>State</label>
                                            </div>
                                            <div class="col-sm">
                                                <select class="form-control" id="State" name="State" required>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <label>City</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" name="tocity" id="tocity" value="<?php if(isset($requestdata)) echo $requestdata->City; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-sm">
                                                <textarea class="form-control" rows="" cols="10" name="Address" id="Address"required><?php if(isset($requestdata)) echo $requestdata->Address; ?></textarea>
                                            </div>
                                            <div class="col-sm">
                                                <label>Fax No.</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" name="FaxNo" id="FaxNo"value="<?php if(isset($requestdata)) echo $requestdata->FaxNo; ?>" required>
                                            </div>
                                            <div class="col-sm">
                                                <label>Mobile No.</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" name="MobileNo" id="MobileNo" value="<?php if(isset($requestdata)) echo $requestdata->MobileNo; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>Email ID</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input style="text-transform: lowercase;" class="form-control" type="text"
                                                name="EmailID" id="EmailID" value="<?php if(isset($requestdata)) echo $requestdata->EmailId; ?>" required>
                                                <span id="mail" class="error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="heading">
                                            <h3 class="page-title">Other Information</h3>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Zone</label>
                                            </div>
                                            <div class="col-sm" id="Zone">
                                                <select class="form-control" required>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <label>Accounting Location</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" name="AccountingLocation" id="AccountingLocation" value="<?php if(isset($requestdata)) echo $requestdata->AccountLocation; ?>" required>
                                            </div>
                                            <div class="col-sm">
                                                <label>Data Entry Location</label>
                                            </div>
                                            <div class="col-sm">
                                                <input class="form-control" type="text" name="EntryLocation" id="EntryLocation" value="<?php if(isset($requestdata)) echo $requestdata->DataEntryLocation; ?>"
                                                required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>Location Start Date</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="date" name="StartDate" id="StartDate" value="" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Location End Date</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control" type="date" name="EndDate" id="EndDate" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm">
                                                <label>Computerised</label>
                                            </div>
                                            <div class="col-sm">
                                                <input type="checkbox" name="Comp" id="Comp" value="" checked>
                                            </div>
                                            <div class="col-sm">
                                                <label>Cut Off Time Flag</label>
                                            </div>
                                            <div class="col-sm">
                                                <input type="checkbox" name="TimeFlag" id="TimeFlag" value="" checked>
                                            </div>
                                            <div class="col-sm">
                                                <label>Active Flag</label>
                                            </div>
                                            <div class="col-sm">
                                                <input type="checkbox" name="Flag" id="Flag" value="" checked>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="heading">
                                          <h3 class="page-title">Operation Information</h3>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label>Default Next Location</label>
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="NextLocation" id="NextLocation" value="<?php if(isset($requestdata)) echo $requestdata->NextLocation; ?>"
                                            required>
                                        </div>
                                        <div class="col-sm">
                                            <label>Nearest Previous Location</label>
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="PreviousLocation" id="PreviousLocation" value="<?php if(isset($requestdata)) echo $requestdata->PreviousLocation; ?>"
                                            required>
                                        </div>
                                        <div class="col-sm">
                                            <label>Location Ownership</label>
                                        </div>
                                        <div class="col-sm">
                                            <select class="form-control" id="LocationOwnership" name="LocationOwnership" required>
                                                <option value="">select</option>
                                                <option value="own">own</option>
                                                <option value="Channel Partner">Channel Partner</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Delivery Control Location</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="text" name="ControlLocation" id="ControlLocation" value="<?php if(isset($requestdata)) echo $requestdata->ControlLocation; ?>"
                                            required>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Driver Advance Limit</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="text" name="AdvanceLimit" id="AdvanceLimit" value="<?php if(isset($requestdata)) echo $requestdata->AdvanceLimit; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="heading">
                                       <h3 class="page-title">Booking/Delivery Information</h3>
                                   </div>
                               </div>

                               <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Octroi/N-Form Require</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" id="Octroi" name="Octroi" required>
                                            <option value="">Select</option>
                                            <option value="Octroi">Octroi</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Billed At</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="BilledAt" id="BilledAt"
                                        onkeyup="this.value=this.value.toUpperCase()" onkeypress="return wordcheck(event)"
                                        required>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($requestdata)){ ?>
                                <input type="hidden" name="id" value="<?php echo $requestdata->id; ?>">
                            <?php } ?>
                            <button type="button"  class="btn btn-outline-dark btn-fw btn-check-key-press" id="<?php if (isset($requestdata)) echo "updatelocation";else echo "submitlocation"?>" <?php if (isset($requestdata)) echo ""; ?> >Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#submitlocation").click(function(event) {
            event.preventDefault(); 
            var formData = new FormData($("#location")[0]); 
            $.ajax({
                url: base_url + "savelocationdata",
                data: formData,
                async: true,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                type: "POST",
                success: function(data) {
                    if (data.success) {
                        successToster('location Submitted Successfully');
                        setTimeout(function(){
                            window.location.replace("locationlistdata");
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
        $("#updatelocation").click(function(event) {
            event.preventDefault(); 

            var formData = new FormData($("#location")[0]); 
            $.ajax({
                url: base_url + "location-update",
                data: formData,
                async: true,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                type: "POST",
                success: function(data) {
                    if (data.success) {
                        successToster('Location Updated Successfully');
                        setTimeout(function(){
                            window.location.replace(base_url + "locationlistdata");
                        },2000);
                    } else {
                        errorToster("Location Not Updated Successfully");
                    }
                },
                error: function() {
                    errorToster("An error occurred during submission.");
                }
            });
        });
    });
</script>
