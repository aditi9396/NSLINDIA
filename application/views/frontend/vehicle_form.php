<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">VEHICLE MASTER</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">VEHICLE MASTER</li>
        </ol>
      </nav>
    </div>
    <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
      <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('listdata'); ?>">VehicleList</a>
    </div><br>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form id="vehicleMaster">
              <div class="form-group">
                <div class="heading">
                  <h3 class="page-title">Vehicle Details</h3>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                    <label>Vehicle Type</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="VehicleType" name="VehicleType" required>
                      <option value="">Select</option>
                      <option value="EICHER 11.10"<?php if (isset($requestdata) && $requestdata->VehicleType === 'EICHER 11.10') echo 'selected'; ?>>EICHER 11.10</option>
                      <option value="TATA ACE" <?php if (isset($requestdata) && $requestdata->VehicleType === 'TATA ACE') echo 'selected'; ?>>TATA ACE</option>
                      <option value="BHARAT BENZ 3123"<?php if (isset($requestdata) && $requestdata->VehicleType === 'BHARAT BENZ 3123') echo 'selected'; ?>>BHARAT BENZ 3123</option>
                      <option value="BHARAT BENZ 1214"<?php if (isset($requestdata) && $requestdata->VehicleType === 'BHARAT BENZ 1214') echo 'selected'; ?>>BHARAT BENZ 1214"</option>
                      <option value="SWARAJ MAZDA SARTAJ"<?php if (isset($requestdata) && $requestdata->VehicleType === 'SWARAJ MAZDA SARTAJ') echo 'selected'; ?>>SWARAJ MAZDA SARTAJ</option>
                      <option value="EICHER 10.95"<?php if (isset($requestdata) && $requestdata->VehicleType === 'EICHER 10.95') echo 'selected'; ?>>EICHER 10.95</option>
                      <option value="EICHER 10.59"<?php if (isset($requestdata) && $requestdata->VehicleType === 'EICHER 10.59') echo 'selected'; ?>>EICHER 10.59</option>
                      <option value="EICHER 10.90"<?php if (isset($requestdata) && $requestdata->VehicleType === 'EICHER 10.90') echo 'selected'; ?>>EICHER 10.90</option>
                      <option value="ASHOK LEYLAND DOST"<?php if (isset($requestdata) && $requestdata->VehicleType === 'ASHOK LEYLAND DOST') echo 'selected'; ?>>ASHOK LEYLAND DOST</option>
                      <option value="SWARAJ MAZDA SAMRAT"<?php if (isset($requestdata) && $requestdata->VehicleType === 'SWARAJ MAZDA SAMRAT') echo 'selected'; ?>>SWARAJ MAZDA SAMRAT</option>
                      <option value="TATA 12.10"<?php if (isset($requestdata) && $requestdata->VehicleType === 'TATA 12.10') echo 'selected'; ?>>TATA 12.10</option>
                      <option value="TATA 407"<?php if (isset($requestdata) && $requestdata->VehicleType === 'TATA 407') echo 'selected'; ?>>TATA 407</option>
                      <option value="BHARAT BENZ 1617"<?php if (isset($requestdata) && $requestdata->VehicleType === 'BHARAT BENZ 1617') echo 'selected'; ?>>BHARAT BENZ 1617</option>
                      <option value="MAHINDRA PICKUP"<?php if (isset($requestdata) && $requestdata->VehicleType === 'MAHINDRA PICKUP') echo 'selected'; ?>>MAHINDRA PICKUP</option>
                      <option value="POLO" <?php if (isset($requestdata) && $requestdata->VehicleType === 'POLO') echo 'selected'; ?>>POLO</option>
                      <option value="FORTUNER" <?php if (isset($requestdata) && $requestdata->VehicleType === 'FORTUNER') echo 'selected'; ?>>FORTUNER</option>
                      <option value="FORCE" <?php if (isset($requestdata) && $requestdata->VehicleType === 'FORCE') echo 'selected'; ?>>FORCE</option>
                    </select>
                  </div>
                  <div class="col-sm">
                    <label>Controlling Branch</label>
                  </div>
                  <div class="col-sm">
                    <input class="form-control" type="text" id="ControllingBranch" name="ControllingBranch"
                    onkeypress="return wordcheck(event)" value="HQTR" required>
                  </div>
                  <div class="col-sm">
                    <label>Vehicle No.</label>
                  </div>
                  <div class="col-sm">
                    <input class="form-control" type="text" id="VehicleNo" name="VehicleNo"
                    value="<?php if(isset($requestdata)) echo $requestdata->Vehicle_No; ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                    <label>Asset Type</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="AssetType" name="AssetType" >
                      <option value="">Select</option>
                      <option value="ASSET" <?php if (isset($requestdata) && $requestdata->AssetType === 'ASSET') echo 'selected'; ?>>ASSET</option>
                      <option value="SPARE PARTS" <?php if (isset($requestdata) && $requestdata->AssetType === 'SPARE PARTS') echo 'selected'; ?>>SPARE PARTS</option>
                    </select>
                  </div>
                  <div class="col-sm">
                    <label>Vendor Type</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="VendorType" name="VendorType" required>
                      <option value="">Select</option>
                      <option value="ATTACHED" <?php if (isset($requestdata) && $requestdata->VendorType === 'ATTACHED') echo 'selected'; ?>>ATTACHED</option>
                      <option value="SERVICE PROVIDER"<?php if (isset($requestdata) && $requestdata->VendorType === 'SERVICE PROVIDER') echo 'selected'; ?>>SERVICE PROVIDER</option>
                      <option value="3PL"<?php if (isset($requestdata) && $requestdata->VendorType === '3PL') echo 'selected'; ?>>3PL</option>
                      <option value="OCTROI AGENT"<?php if (isset($requestdata) && $requestdata->VendorType === 'OCTROI AGENT') echo 'selected'; ?>>OCTROI AGENT</option>
                      <option value="Own" <?php if (isset($requestdata) && $requestdata->VendorType === 'Own') echo 'selected'; ?>>Own</option>
                      <option value="BUISINESS ASSOCIATES" <?php if (isset($requestdata) && $requestdata->VendorType === 'BUISINESS ASSOCIATES') echo 'selected'; ?>>BUISINESS ASSOCIATES</option>
                      <option value="VENDOR-FUEL PUMP" <?php if (isset($requestdata) && $requestdata->VendorType === 'VENDOR-FUEL PUMP') echo 'selected'; ?>>VENDOR-FUEL PUMP"</option>
                      <option value="VENDOR-FUEL COMPANY" <?php if (isset($requestdata) && $requestdata->VendorType === 'VENDOR-FUEL COMPANY') echo 'selected'; ?>>VENDOR-FUEL COMPANY</option>
                      <option value="VENDOR MAINTENANCE" <?php if (isset($requestdata) && $requestdata->VendorType === 'VENDOR MAINTENANCE') echo 'selected'; ?>>VENDOR MAINTENANCE</option>
                      <option value="SPARE PART" <?php if (isset($requestdata) && $requestdata->VendorType === 'SPARE PART') echo 'selected'; ?>>SPARE PART</option>
                      <option value="VENDOR CROSSING" <?php if (isset($requestdata) && $requestdata->VendorType === 'VENDOR CROSSING') echo 'selected'; ?>>VENDOR CROSSING</option>
                    </select>
                  </div>
                  <div class="col-sm">
                    <label>Vendor Name</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="VendorName" name="VendorName" required>
                      <option value="">Select</option>
                      <option value="VTC 3 PL SERVICES LTD PUNE" <?php if (isset($requestdata) && $requestdata->VendorName === 'VTC 3 PL SERVICES LTD PUNE') echo 'selected'; ?>>VTC 3 PL SERVICES LTD PUNE</option>
                      <option value="VTC 3 PL SERVICES LTD AKOLA"<?php if (isset($requestdata) && $requestdata->VendorName === 'VTC 3 PL SERVICES LTD AKOLA') echo 'selected'; ?>>VTC 3 PL SERVICES LTD AKOLA</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                    <label>No. of Drivers</label>
                  </div>
                  <div class="col-sm">
                    <input class="form-control" type="text" name="NoOfDrivers" id="NoOfDrivers"value="<?php if(isset($requestdata)) echo $requestdata->NoOfDrivers; ?>" required>
                  </div>
                  <div class="col-sm-2">
                    <label>No. of Tyres Attached with vehicle</label>
                  </div>
                  <div class="col-sm-2">
                    <input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->NoOfTyres; ?>" type="text" name="NoOfTyres" id="NoOfTyres"
                    required>
                  </div>
                  <div class="col-sm">
                    <label>Permit States</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="PermitStates" name="PermitStates" required>
                      <option value="">Select</option>
                      <option value="NATIONAL PERMIT" <?php if (isset($requestdata) && $requestdata->PermitStates === 'NATIONAL PERMIT') echo 'selected'; ?>>NATIONAL PERMIT</option>
                      <option value="ANDRA PRADESH"<?php if (isset($requestdata) && $requestdata->PermitStates === 'VTC 3 PL SERVICES LTD AKOLA') echo 'selected'; ?>>ANDRA PRADESH</option>
                      <option value="ASSAM"<?php if (isset($requestdata) && $requestdata->PermitStates === 'ASSAM') echo 'selected'; ?>>ASSAM</option>
                      <option value="BIHAR"<?php if (isset($requestdata) && $requestdata->PermitStates === 'BIHAR') echo 'selected'; ?>>BIHAR</option>
                      <option value="HYDERABAD"<?php if (isset($requestdata) && $requestdata->PermitStates === 'HYDERABAD') echo 'selected'; ?>>HYDERABAD</option>
                      <option value="MAHARASHTRA"<?php if (isset($requestdata) && $requestdata->PermitStates === 'MAHARASHTRA') echo 'selected'; ?>>MAHARASHTRA</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                    <label>FTL Type</label>
                  </div>
                  <div class="col-sm">
                    <select class="form-control" id="FTLType" name="FTLType" required>
                      <option value="">SELECT</option>
                      <option  value="20 FT MULTI EXLE 13 TO 21 MT"<?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE 13 TO 21 MT') echo 'selected'; ?>>20 FT MULTI EXLE 13 TO 21 MT</option>
                      <option value="20 FT MULTI EXLE 21 TO 26 MT"<?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>>20 FT MULTI EXLE 21 TO 26 MT</option>
                      <option value="40 FT MULTI EXLE 21 TO 26 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '40 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>>40 FT MULTI EXLE 21 TO 26 MT</option>
                      >20 FT MULTI EXLE 21 TO 26 MT</option>
                      <option value="20 FT MULTI EXLE UPTO 13 MT"<?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE UPTO 13 MT') echo 'selected'; ?>>20 FT MULTI EXLE UPTO 13 MT</option>
                      <option value="40 FT MULTI EXLE 13 TO 21 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '40 FT MULTI EXLE 13 TO 21 MT') echo 'selected'; ?>>40 FT MULTI EXLE 13 TO 21 MT</option>
                      <option value="40 FT MULTI EXLE 21 TO 26 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '40 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>>40 FT MULTI EXLE 21 TO 26 MT</option>
                      <option value="40 FT MULTI EXLE UPTO 13 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '40 FT MULTI EXLE UPTO 13 MT') echo 'selected'; ?>  >40 FT MULTI EXLE UPTO 13 MT</option>
                      <option value="MINI TEMPO UPTO 1 MT" <?php if (isset($requestdata) && $requestdata->FTLType === 'MINI TEMPO UPTO 1 MT') echo 'selected'; ?>  >MINI TEMPO UPTO 1 MT</option>
                      <option value="PICK UP 1 MT TO 2 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>  >PICK UP 1 MT TO 2 MT</option>
                      <option value="TAURAS 9 MT TO 16 MT" <?php if (isset($requestdata) && $requestdata->FTLType === 'TAURAS 9 MT TO 16 MT') echo 'selected'; ?>  >TAURAS 9 MT TO 16 MT</option>
                      <option value="TEMPO 2 MT TO 3.5 MT" <?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>  >TEMPO 2 MT TO 3.5 MT</option>
                      <option value="TEMPO 3.5 MT TO 5 MT" <?php if (isset($requestdata) && $requestdata->FTLType === 'TEMPO 3.5 MT TO 5 MT') echo 'selected'; ?>  >TEMPO 3.5 MT TO 5 MT</option>
                      <option value="TRUCK 5 MT TO 7 MT"
                      <?php if (isset($requestdata) && $requestdata->FTLType === '20 FT MULTI EXLE 21 TO 26 MT') echo 'selected'; ?>  >TRUCK 5 MT TO 7 MT</option>
                      <option value="TRUCK 7 MT TO 9 MT"
                      <?php if (isset($requestdata) && $requestdata->FTLType === 'TRUCK 7 MT TO 9 MT') echo 'selected'; ?>  >TRUCK 7 MT TO 9 MT</option>
                    </select>
                  </div>
                  <div class="col-sm">
                    <label>Vehicle Broker</label>
                  </div>
                  <div class="col-sm">
                    <input class="form-control" type="text" name="VehicleBroker" id="VehicleBroker" value="VTC 3PL Services Private Limited"
                    required>
                  </div>
                  <div class="col-sm">
                    <label>GPS Device Enabled</label>
                  </div>
                  <div class="col-sm">
                    <input class="" type="checkbox" value="<?php if(isset($requestdata)) echo $requestdata->GPSDeviceEnabled; ?>" name="GPSDeviceEnabled" id="GPSDeviceEnabled"
                    checked>
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
                  <label>RC Book No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" value="<?php if(isset($requestdata)) echo $requestdata->RCBookNo; ?>" type="text" name="RCBookNo" id="RCBookNo"
                  required>
                  <span class="error" id="Rerror"></span>
                </div>
                <div class="col-sm">
                  <label>Registration No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="RegistrationNo" id="RegistrationNo" value="<?php if(isset($requestdata)) echo $requestdata->RegistrationNo; ?>" required>
                  <span class="error" id="Regerror"></span>
                </div>
                <div class="col-sm">
                  <label>Registration Date</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="RegistrationDate" placeholder="DD-MM-YYYY"
                  id="RegistrationDate" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Vehicle Insurance Company Name</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="InsuranceCompany" id="InsuranceCompany" required>
                </div>
                <div class="col-sm">
                  <label>Vehicle Insurance Validity Date</label>
                </div>
                <div class="col-sm">
                  <input type="date" class="form-control" name="VehicleInsuranceDate"
                  placeholder="DD-MM-YYYY" id="VehicleInsuranceDate" value="" required>
                </div>
                <div class="col-sm">
                  <label>Fitness Certificate Date</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="FitnessCertificateDate"
                  placeholder="DD-MM-YYYY" id="FitnessCertificateDate" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Date Of Attaching</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="DateOfAttaching" id="DateOfAttaching"
                  placeholder="DD-MM-YYYY" required>
                </div>
                <div class="col-sm">
                  <label>Vehicle Permit Validity Date</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="VehiclePermitDate"
                  placeholder="DD-MM-YYYY" id="VehiclePermitDate" required>
                </div>
                <div class="col-sm">
                  <label>Chasis No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="ChasisNo" id="ChasisNo"
                  required>
                  <span class="error" id="Cerror"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Tax Valid Date.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="taxvalidatedate" id="taxvalidatedate"
                  placeholder="DD-MM-YYYY" required>
                </div>

                <div class="col-sm">
                  <label>PUCC Valid Date.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="puccdate" id="puccdate"
                  placeholder="DD-MM-YYYY" required>
                </div>


                <div class="col-sm">
                  <label>Fitness Valid Date.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="date" name="fitessvaliddate" id="fitessvaliddate"
                  placeholder="DD-MM-YYYY" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Engine No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="EngineNo" id="EngineNo"
                  required>
                  <span class="error" id="Eerror"></span>
                </div>
                <div class="col-sm">
                  <label>Certificate No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="CertificateNo" id="CertificateNo"  required>
                  <span class="error" id="Cererror"></span>
                </div>
                <div class="col-sm">
                  <label>Insurance No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="InsuranceNo" id="InsuranceNo"
                  required>
                  <span class="error" id="Ierror"></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>RTO No.</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="RTONo" id="RTONo" required>
                  <span class="error" id="Rerror"></span>
                </div>
                <div class="col-sm-2">
                  <label>Rate/Km</label>
                </div>
                <div class="col-sm-2">
                  <input class="form-control" type="text" name="RateKm" id="RateKm" required>
                </div>
                <div class="col-sm-2">
                  <label>Active Flag</label>
                </div>
                <div class="col-sm-2">
                  <input type="checkbox" name="ActiveFlag" id="ActiveFlag" value="" checked>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Per Km/Rate</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="PerKmRate1" id="PerKmRate1"required>
                  <span class="error" id="Rerror"></span>
                </div>
                <div class="col-sm-2">
                  <label>Milage</label>
                </div>
                <div class="col-sm-2">
                  <input class="form-control" type="text" name="Milage" id="Milage" required>
                </div>
                <div class="col-sm-2">
                  <label>Fulat Tank Capacity</label>
                </div>
                <div class="col-sm-2">
                  <input class="form-control" type="text" name="FuelTankCapacity" id="FuelTankCapacity" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="heading">
                <h3 class="page-title">Inner Dimension in ft</h3>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm">
                  <label>Length</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="Length" id="num" value="" required>
                </div>
                <div class="col-sm">
                  <label>Width</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="Width" id="num" value="" required>
                </div>
                <div class="col-sm">
                  <label>Height</label>
                </div>
                <div class="col-sm">
                  <input class="form-control" type="text" name="Height" id="num" value="" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label>CFT</label>
                </div>
                <div class="col-sm-2">
                  <input class="form-control" type="text" name="CFT" value="" id="CFT" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="heading">
               <h3 class="page-title">Payload Capacity as per RC in Ton</h3>
             </div>
           </div>

           <div class="form-group">
            <div class="row">
              <div class="col-sm">
                <label>GVW</label>
              </div>
              <div class="col-sm">
                <input class="form-control" type="text" name="GVW" id="GVW" required>
              </div>
              <div class="col-sm">
                <label>Unladen</label>
              </div>
              <div class="col-sm">
                <input class="form-control" type="text" name="Unladen" id="Unladen" required>
              </div>
              <div class="col-sm">
                <label>Capacity</label>
              </div>
              <div class="col-sm">
                <input class="form-control" type="text" name="Capacity" id="Capacity" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm">
                <label>GVW:Gross Vehicle Weight As Per RC Book</label><br>
                <label>Unladen Weight:Empty Vehicle Weight As Per RC Book</label>
              </div>
            </div>
          </div>

          <?php if(isset($requestdata)){ ?>
            <input type="hidden" name="id" value="<?php echo $requestdata->id; ?>">
          <?php } ?>
          <button type="button"  class="btn btn-outline-dark btn-fw btn-check-key-press" id="<?php if (isset($requestdata)) echo "update_button";else echo "submit_button"?>" <?php if (isset($requestdata)) echo ""; ?> >Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#submit_button").click(function(event) {
      event.preventDefault(); 

      var formData = new FormData($("#vehicleMaster")[0]); 
      $.ajax({
        url: base_url + "save_data",
        data: formData,
        async: true,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(data) {
          if (data.success) {
            successToster('Vehicle Submitted Successfully');
            setTimeout(function(){
             window.location.replace("listdata");
           },2000);
          } else {
          }
        },
        error: function() {
          errorToster('Vehicle Not Submitted Successfully');
        }
      });
    });
  });



  $(document).ready(function() {
    $("#update_button").click(function(event) {
      alert('hello');
      event.preventDefault(); 

      var formData = new FormData($("#vehicleMaster")[0]); 
      $.ajax({
        url: base_url + "vehicle-update",
        data: formData,
        async: true,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(data) {
          if (data.success) {
            successToster('Vehicle Updated Successfully');
            setTimeout(function(){
             window.location.replace(base_url+"listdata");
           },2000);
          } else {
            errorToster("Vehicle Not Updated Successfully");
          }
        },
        error: function() {
          errorToster("An error occurred during submission.");
        }
      });
    });
  });
</script>
