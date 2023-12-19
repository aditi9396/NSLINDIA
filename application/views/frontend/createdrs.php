<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<style type="text/css">
    .table-container {
        width: 100%;
        overflow-x: scroll;
    }
    #lrdetails,#lrdetails1 {
        border-collapse: collapse;
        width: 100%;
    }
    #lrdetails th, #lrdetails td ,#lrdetails1 th,#lrdetails1 td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    #lrdetails th,#lrdetails1 th {
        background-color: #2c2d58a3;
    }
    #lrdetails input[type="text"], #lrdetails1 input[type="text"], #lrdetails select, #lrdetails1 select {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    @media (max-width: 768px) {
        #lrdetails ,#lrdetails1 {
          font-size: 12px;
      }
  }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">CREATE DRS</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">CREATEDRS Form</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="form-sample" method="post_data" id="form1" name="form1" enctype="multipart/form-data" action="Lrgeneration.php">
                    <div class="col-md-12 col-12 pb-2">
                        <label style="color:red;" id="err_msg"></label> 
                    </div>
                    <div id="step0">
                        <center>  
                            <div class= "container" style=" border-top:hidden!important; text-align: start; "  width="100%"  >
                                <div class=" row" style="border-bottom:hidden!important;border-top:hidden!important;">
                                    <div class="col-md-3">DRS DATE :</div>
                                    <div class="col-md-3" >
                                        <input class="form-control" type="date" name="drsdate" id="drsdate" size="10">
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                                    <div class="col-md-3">VENDOR TYPE :</div>
                                    <div class="col-md-3">
                                        <select  class="form-control" id="vendortype" name="vendortype" onchange="vendortypechange()" style="height:50px;">
                                            <option value="">SELECT VENDOR TYPE</option>
                                            <option value="Attached">Attached</option>
                                            <option value="Own">Own</option>
                                        </select>                       
                                    </div>
                                    <div class="col-md-3">SELECT VENDOR NAME :</div>
                                    <div class="col-md-3">
                                       <select class="form-control" id="attachedvendor" onchange="attachedvendorname()" name="vendorname" style="display:none; height: 50px;">
                                        <option value="">SELECT VENDOR NAME</option>
                                        <?php foreach ($vendor as $vendor) { ?>
                                            <option value="<?php echo $vendor['VendorCode']; ?>"><?php echo $vendor['VendorCode'] . '-' . $vendor['VendorName']; ?></option>
                                        <?php } ?>
                                    </select>

                                    <select class="form-control" onchange="attachedvendorname()" id="vendor-options" name="vendorname"  oninvalid="this.setCustomValidity('select')" oninput="this.setCustomValidity('')" style="display:none;">
                                        <option value="">Select</option>
                                        <option id="KALBHOR" value="VTC 3 PL SERVICES LTD (KALBHOR)">-VTC 3 PL SERVICES LTD (KALBHOR)</option>
                                        <option id="AKOLA" value="VTC 3 PL SERVICES LTD AKOLA">-VTC 3 PL SERVICES LTD AKOLA</option>
                                        <option id="PUNE" value="VTC 3 PL SERVICES LTD PUNE">-VTC 3 PL SERVICES LTD PUNE</option>
                                    </select>


                                    <div id="dialog1" title="Dialog Title" style="display: none;">
                                        <div id="abc"></div>
                                    </div>

                                    <div id="dialog2" title="Dialog Title" style="display: none;">
                                        <div id="xyz"></div>
                                    </div>

                                    <div id="dialog3" title="Dialog Title" style="display: none;">
                                        <div id="pqr"></div>
                                    </div>
                                </div>
                            </div>
                            <br>  
                            <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                                <div class="col-md-3" >Owner Name As Per Bank Details :<span style='color:red'>*</span>
                                </div> 
                                <div class="col-md-3">
                                    <input  class="form-control" id="ownername" name="ownername" pattern="[a-zA-Z\s]+"onchange="fetch_ownername(this)"onkeyup="this.value=this.value.toUpperCase()" oninvalid="this.setCustomValidity('Please Enter Driver Name.')" oninput="this.setCustomValidity('')"maxlength="40" >
                                </div>
                            </div>
                            <br>
                            <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                                <div class="col-md-3">VEHICLE NO.</div>
                                <div class="col-md-3">
                                    <select class="form-control" onchange="ownvehicle()" id="vehicle-options-KALBHOR"   name="vehicleno" style="display: none;">
                                        <option value=''>SELECT VEHICLE NO.</option>
                                        <?php 
                                        foreach ($vehicleno as $vehicleno){ 
                                            echo "<option value = ".$vehicleno['Vehicle_No'].">".$vehicleno['Vehicle_No']."</option>";
                                        }?>
                                    </select>
                                    <select class="form-control" onchange="ownvehicle()"  id="vehicle-options-AKOLA" name="vehicleno"  style="display: none;">
                                        <option value=''>SELECT VEHICLE NO.</option>
                                        <?php 
                                        foreach ($vehicleno1 as $vehicleno1){ 
                                            echo "<option value = ".$vehicleno1['Vehicle_No'].">".$vehicleno1['Vehicle_No']."</option>";
                                        }?>
                                    </select>
                                    <select   class="form-control" onchange="ownvehicle()" id="vehicle-options-PUNE"  name="vehicleno"  style="display: none;" >
                                        <option value=''>SELECT VEHICLE NO.</option>
                                        <?php 
                                        foreach ($vehicleno2 as $vehicleno2){ 
                                            echo "<option value = ".$vehicleno2['Vehicle_No'].">".$vehicleno2['Vehicle_No']."</option>";
                                        }?>
                                    </select>
                                    <input class="form-control" onchange="ownvehicle()" type="text" id='avehicleno' name='vehicleno' placeholder="Enter Vehicle Number" style="display:none;">
                                    <span id="vehtxt"
                                    style='color:red;'>
                                </span>
                                <a style='display:none;' id="podpending" href="" target="_blank" onclick="this.href='http://vtc3pl.esy.es/pendingpod.php?avehicleno='+document.getElementById('avehicleno').value">
                                    <u>Pending POD's :</u>
                                </a>
                                <a id="target">
                                </a>
                            </div>

                            <div class="col-md-3">FREIGHT TYPE :</div>
                            <div class="col-md-3" >
                                <div id="ftype" style='display:none;'><input  type='radio'
                                    id="ftperkm"
                                    name='freighttype'
                                    value='perKM'
                                    onclick="kmclick()">Rate
                                    Per KM &nbsp;&nbsp;
                                    <input  type='radio' id="ftfix" name='freighttype'
                                    value='Fix' onclick="fixclick()" checked>Fixed
                                    Rate
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                            <div class="col-md-3">VEHICLE METER READING:</div>
                            <div class="col-md-3">
                                <input class="form-control" type="number" id="mreading" name="mreading"
                                pattern="[0-9]+" maxlength=10
                                oninvalid="this.setCustomValidity('Please enter Vehicle Meter Reading.')"
                                oninput="this.setCustomValidity('')" required></div>
                                <div class="col-md-3">DRS KM</div>
                                <div class="col-md-3">
                                    <input class="form-control" type="number" id='drskm' name='drskm' maxlength=4
                                    pattern="[0-9]+" onclick="rateclick()"
                                    oninvalid="this.setCustomValidity('Please enter DRS KM.')"
                                    oninput="this.setCustomValidity('')" 
                                    required><input type='hidden' name='responsekm' id='responsekm' >
                                </div>
                            </div>
                            <br>
                            <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                                <div class="col-md-3">DRIVER NAME:</div>
                                <div class="col-md-3">
                                    <select id='driver' name='driver' onchange="fetch_driver()"
                                    style='display:none;width:200px'
                                    oninvalid="this.setCustomValidity('Please select Driver Name.')"
                                    oninput="this.setCustomValidity('')" disabled
                                    required>
                                    <option value=''>SELECT DRIVER NAME:</option>
                                    <?php
                                    $sql
                                    = "SELECT DName  FROM DriverMaster WHERE Active='1' and CloseTrip = 1 AND EmpId !='' ORDER BY DName ASC;";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["DName"] . "'>" . $row["DName"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control" type="text"  name="drivername" id="drivername" placeholder="Enter Driver Name" list="drivername-list" required>
                                <datalist id="drivername-list" style="width: 200px;"></datalist>
                            </div>
                            <div class="col-md-3">VEHICLE CAPACITY MODEL NO:</div>
                            <div class="col-md-3">
                                <select id="FTLType" class="form-control h-100" name="FTLType" 
                                oninvalid="this.setCustomValidity('Please select Vehicle Capacity.')"
                                oninput="this.setCustomValidity('')" required>
                                <option value="">SELECT</option>
                                <option value="MINI TEMPO UPTO 1 MT">MINI TEMPO UPTO 1 MT</option>
                                <option value="PICK UP 1 MT TO 2 MT">PICK UP 1 MT TO 2 MT</option>
                                <option value="TEMPO 2 MT TO 3.5 MT">TEMPO 2 MT TO 3.5 MT</option>
                                <option value="TEMPO 3.5 MT TO 5 MT">TEMPO 3.5 MT TO 5 MT</option>
                                <option value="TEMPO 5 MT TO 7 MT">TEMPO 5 MT TO 7 MT</option>
                                <option value="TRUCK 7 MT TO 9 MT">TRUCK 7 MT TO 9 MT</option>
                                <option value="TAURAS 9 MT TO 16 MT">TAURAS 9 MT TO 16 MT
                                </option>
                                <option value="TAURAS 16 MT TO 21 MT">TAURAS 16 MT TO 21 MT
                                </option>
                                <option value="20 FT MULTI EXLE 13 TO 21 MT">20 FT MULTI EXLE 13 TO 21 MT
                                </option>
                                <option value="20 FT MULTI EXLE 21 TO 26 MT">20 FT MULTI EXLE 21 TO 26 MT
                                </option>
                                <option value="20 FT MULTI EXLE UPTO 13 MT">20 FT MULTI EXLE UPTO 13 MT
                                </option>
                                <option value="40 FT MULTI EXLE 13 TO 21 MT">40 FT MULTI EXLE 13 TO 21 MT
                                </option>
                                <option value="40 FT MULTI EXLE 21 TO 26 MT">40 FT MULTI EXLE 21 TO 26 MT
                                </option>
                                <option value="40 FT MULTI EXLE UPTO 13 MT">40 FT MULTI EXLE UPTO 13 MT
                                </option>
                            </select>  
                        </div>
                    </div>
                    <br>
                    <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                        <div class="col-md-3">LICENSE NO:</div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" id="licenseno" name="licenseno"
                            placeholder="MH1420110062821"
                            onchange="patfunction()"
                            oninvalid="this.setCustomValidity('Please enter License Number.')"
                            oninput="this.setCustomValidity('')" required>
                        </div>
                        <div class="col-md-3">LICENSE EXPIRY DATE :</div>
                        <div class="col-md-3">
                            <input class="form-control" type="date" id="licexpdate" name="licexpdate" />
                        </div>
                    </div>

                    <br>
                    <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                        <div class="col-md-3">ACCOUNT NUMBER:</div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" id="AccountNO" name="AccountNO"  placeholder="Account Number">
                        </div>
                        <div class="col-md-3">IFSC CODE:</div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" id="IFSC" name="IFSC" 
                            style="  text-transform: uppercase;"
                            placeholder="ABCD0000123 "
                            
                            >
                        </div>
                    </div>
                    <br>
                    <div class="row" >
                        <div class="col-md-3">BANK:</div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" id="BankName" name="BankName"
                            placeholder="BANK NAME "
                            >
                        </div>
                        <div class="col-md-3">BRANCH</div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" id="branch" name="branch">
                        </div>
                    </div>
                    <tr>
                        <td class="col-md-3">
                            <input class="form-control" type="hidden" id="HAccountNO" name="HAccountNO">
                        </td>
                        <td class="col-md-3">
                            <input  class="form-control" type="hidden" id="HIFSC" name="HIFSC">
                        </td>
                        <td class="col-md-3">
                            <input class="form-control" type="hidden" id="Hbank" name="Hbank">
                        </td>
                        <td class="col-md-3">
                            <input class="form-control" type="hidden" id="Hbranch" name="Hbranch">
                        </td>
                        <td class="col-md-3">
                            <input class="form-control" type="hidden" id="HVendorCode" name="HVendorCode">
                        </td>
                    </tr>
                </div>
                <br>
                <input type="button" id="btnstep1" class="btn btn-outline-dark btn-fw" value="step1">
            </div>
            <div id="step1" style='display:none;'>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col" >Driver Mobile No.:</div>
                        <div class="col">
                            <input class="form-control" type="number" id="mobileno" name="mobileno" pattern="[0-9]+" required="">
                        </div>
                        <div class="col">
                            <input  type="button" id="btnsendotp" value="Send OTP" onclick="sendotp()">
                        </div>
                        <div  class="col" id="mobtxt" align="center" style="border-radius: 10px;">
                        </div>
                        <div class="col" style="text-align:;color:red"><input class="form-control" type="number" id="otp" name="otp" pattern="[0-9]+"></div>
                        <div class="col"><input  type="button" id="btnverifyotp" value="Verify" maxlength="6" onclick="verifyotp()">
                        </div>
                    </div>
                </div>
                <center>
                    <br>
                    <p><b>Enter LR Number</b></p>
                    <input class="form-control" type="text" id="txtlrno" maxlength=15 placeholder="Search LR Number" list="search-txtlrno-list" name="txtlrno" style="width:23%;" required>
                    <datalist id="search-txtlrno-list" name="search-txtlrno-list" style="width: 200px;">
                    </datalist>
                    <br>
                    <br>
                    <center>
                        <input  type="button" id="btnaddrow" value="Add Row" onclick="add_row()" required>
                        <span id="warntext" style="margin-left: 5px; color: red;"></span>
                    </center>
                    <br>
                    <div class="table" style="overflow:auto">
                        <table id="lrdetails" align='center' class="table-responsive col-12">
                            <thead>
                                <th>LR NO</th>
                                <th>LR Date</th>
                                <th>Pay Basis</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Arrive Date</th>
                                <th>PkgsNo</th>
                                <th>Actual Weight</th>
                                <th>Docket Total</th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th>DELETE</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <td colspan=5></td>
                                <td align='right'><b>Total</b></td>
                                <td id="totalqty">0.00</td>
                                <td><span id="totalwt">0</span></td>
                                <td colspan=4></td>
                            </tfoot>
                        </table>
                    </div>
                    <div class="container" id="GPDRS" style="text-align:start;">
                        <div class="row">
                            <div>
                                <input class="form-control" type="hidden" id="totaldockettotal" onchange="contrcheck()" name="totaldockettotal"
                                value="0" readonly>
                                <span id="totaldockettotal">
                                </span>
                            </div>
                            <div>
                                <input class="form-control" type="hidden" id="totaldockettotalthc" name="totaldockettotalthc"
                                value="0" readonly>
                            </div>
                            <div class="col-md-2">
                                GP For This DRS : 
                                <input class="form-control" type="text" id="percentage"  name="percentage"  readonly>
                                <span id="gppercentage"> &nbsp %</span>
                            </div>
                        </div> 
                        <span>पोच भाडे 10% राहणार</span>
                        <br>
                        <div class="row"  style="border-bottom:hidden!important;border-top:hidden!important;">
                            <input class="form-control" type='hidden'  name='wtones1' id='wtones1'>
                            <input class="form-control" type='hidden' name='capicitynew' id="capicitynew">
                            <div class="col-md-2">Total ToPay :</div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" id="totaltopay" name="totaltopay"
                                value="0" readonly>
                            </div>
                            <div class="col-md-2">Contract Amount :<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" id="contractamt" name="contractamt"
                                pattern="[0-9]+"
                                oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
                                oninput="this.setCustomValidity('')" onchange="contrcheck()" required
                                >
                            </div>
                            <div class="col-md-2"> Hamali Received From Driver:<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="text" id="advancetype" name="advancetype">
                            </div>
                        </div>
                        <br>
                        <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
                            <div class="col-md-2">Advance Amount :<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" id="advamt" name="advamt"
                                pattern="[0-9]+"
                                oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
                                oninput="this.setCustomValidity('')" 
                                onchange="contrcheck1()" required
                                >
                                <span id="advamt">
                                </span>
                            </div>
                            <div class="col-md-2">Fuel Quantity (ltr/kg) :<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" id="liter" name="liter"
                                oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
                                oninput="this.setCustomValidity('')" 
                                onchange="sum()" 
                                >
                                <span id="liter">
                                </span>
                            </div>
                            <div class="col-md-2"> Fuel Rate (ltr/kg) :<span style='color:red'>*</span></div>
                            <div class="col-md-2"><input class="form-control" type="number" id="Rate" name="Rate"  
                                oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
                                oninput="this.setCustomValidity('')"  onchange="sum()"
                                ><span id="Rate">
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Fuel Amount:</div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" id="dieselamt" name="dieselamt"
                                pattern="[0-9]+" 
                                oninvalid="this.setCustomValidity('Please enter Diesel Amount.')"
                                oninput="this.setCustomValidity('')"  readonly  >
                                <span id="dieselamt">
                                </span>
                            </div>
                            <div class="col-md-2">
                                <label>Upload Image Fuel Bill:<span style='color:red'>*</span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <input type="file" class="form-control" id="defaultFile" name="thumbnail" onchange="readURL(this,'ImagePreview');" >
                                <br><br>
                            </div>
                            <div class="col-md-2">Fuel Vendor Name :<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <select id="dieselvendorname" style="height:50px;" name="dieselvendorname" class="form-control">
                                    <option value="1" required>SELECT VENDOR NAME</option>
                                    <option value="" required>No Fuel Vendor</option>
                                    <?php
                                    $user_id = $this->session->userdata('user_id');
                                    $user_query = $this->db->get_where('employee', array('EmpID' => $user_id));
                                    $user_data = $user_query->row();

                                    if ($user_data) {
                                        $Depot = $user_data->Depot;
                                        $fuel_query = $this->db->get('petrolpump');
                                        $fuel_data = $fuel_query->result();

                                        $found = false;
                                        $matchingPetrolPumps = array();

                                        foreach ($fuel_data as $row) {
                                            $locations = explode(',', $row->Location);

                                            if (in_array($Depot, $locations)) {
                                                $matchingPetrolPumps[] = $row->PetrolPumpName;
                                                $found = true;
                                            }
                                        }

                                        if ($found) {
                                            foreach ($matchingPetrolPumps as $petrolPumpName) {
                                                echo '<option value="' . $petrolPumpName . '">' . $petrolPumpName . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" required>Depot not found in any location</option>';
                                        }
                                    } else {
                                        echo '<option value="" required>User not found</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">Fuel Bill No<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="text" id="Dieselbillno" name="Dieselbillno"
                                pattern="[0-9]+"
                                oninvalid="this.setCustomValidity('Please enter Hamali.')"
                                oninput="this.setCustomValidity('')">
                            </div>
                            <div class="col-md-2"> Loading Hamali Vendor Name :<span style='color:red'>*</span>
                            </div>
                            <div class="col-md-2">
                                <select id="Hvendor" style="height:50px;font-size: smaller;" class="form-control" name="Hvendor" onchange="fetch_hamali(this)">
                                    <option value="0" required>Select Hamali Vendor</option>
                                    <option value="1" required>No Hamali Vendor</option>
                                    <?php
                                    $user_id = $this->session->userdata('user_id');
                                    $user_query = $this->db->get_where('employee', array('EmpID' => $user_id));
                                    $user_data = $user_query->row();

                                    if ($user_data) {
                                        $Depot = $user_data->Depot;
                                        $hamali_query = $this->db->get('hamalivendor');
                                        $hamali_data = $hamali_query->result();

                                        $found = false;
                                        $matchinghamali = array();

                                        foreach ($hamali_data as $row) {
                                            $DEPOT = $row->DEPOT;
                                            if ($Depot == $DEPOT) {
                                                $matchinghamali[] = $row->Hvendor;
                                                $found = true;
                                            }
                                        }

                                        if ($found) {
                                            foreach ($matchinghamali as $Hvendor) {
                                                echo '<option value="' . $Hvendor . '">' . $Hvendor . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" required>Depot not found in any location</option>';
                                        }
                                    } else {
                                        echo '<option value="" required>User not found</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">Loading Hamali Amount :<span style='color:red'>*</span>
                            </div>
                            <div  class="col-md-2">
                                <input class="form-control" type="number" id="hamali" name="hamali"
                                pattern="[0-9]+"
                                oninvalid="this.setCustomValidity('Please enter Loading Hamali Amount.')"
                                oninput="this.setCustomValidity('')" required>
                            </div>
                        </div>
                    </div>

                </center>
                <br>
                <div class="d-flex justify-content-center">
                    <input  type="submit" id="CreateDRS" name="CreateDRS" value="CREATEDRS"  class="btn btn-outline-dark btn-fw">
                    <input  type="hidden" name="CreateDRS" value="Create DRS">
                    <div id="loader" class="text-center" style="display: none;">
                        <div class="loader"></div>
                    </div> 
                </div>

                <div class="d-flex justify-content-center my-2">
                    <input class="btn btn-outline-dark btn-fw"  type="button" id="btnstep2"  value="step2">
                </div>
            </div>
        </form>





        <script>
    // $(document).ready(function() {
    //     $("#totalwt").on("mouseover", function () {
    //         var hText = $("#totalwt").text();
    //         var vehicleNumbers = ['MH12TV5860', 'MH12TV5861', 'MH12TV5862' , 'MH12TV5863' , 'MH12TV5864', 'MH12TV5865', 
    //             'MH12TV5866' , 'MH12TV5867' , 'MH12TV5868', 'MH12TV5869', 'MH12TV5870'];
    //         var vehicleno = document.getElementById('vehicleno').value;
    //         let exists = false;

    //         for (let i = 0; i < vehicleNumbers.length; i++) {
    //             if (vehicleNumbers[i] === vehicleno) {
    //                 exists = true;
    //                 break;
    //             }
    //         }
    //         if(document.getElementById('vendortype').value == "Own")
    //         {
    //             if (exists && 2000<=parseInt(hText)) {
    //                 console.log(`${vehicleno} exists in the array`);
    //                 alert("Actual Weight Is More Than Capacity 2000 KG"+hText);

    //                 document.getElementById("Submit").disabled = true;
    //                 document.getElementById('advamt').disabled = true; 
    //                 document.getElementById('advancetype').disabled = true;
    //                 document.getElementById('hamali').disabled = true;
    //                 document.getElementById('contractamt').disabled = true; 
    //                 document.getElementById('Hvendor').disabled = true; 

    //             } else {
    //                 console.log(`${vehicleno} does not exist in the array`);
    //                 alert("Vehicle number is not match");
    //                 document.getElementById("Submit").disabled = false;
    //                 document.getElementById('advamt').disabled = false; 
    //                 document.getElementById('advancetype').disabled = false;
    //                 document.getElementById('hamali').disabled = false;
    //                 document.getElementById('contractamt').disabled = false; 
    //                 document.getElementById('Hvendor').disabled = false; 
    //             }                                 
    //         }
    //     });
    // });
        </script>

        <script type="text/javascript">
            function validateVehicle(vehicleNumber) 
            {
                if (vehicleNumber !== '') {
                    return true;
                } else {
                    return false;
                }
            }

        </script>
        <script>
            $(document).ready(function () {
                $("#Submit").button({
                    icons: {
                        secondary: "ui-icon-info"
                    }
                });
                $("#Hvendor").addClass("ui-selectmenu-button ui-widget ui-state-default ui-corner-all");
                var demoSelectValue = $("#Hvendor").val();
                if (demoSelectValue == "0") {
                    $("#Submit").button("disable")
                }
                $("#Hvendor").change(function () {
                    if ($(this).val() == "0") {
                        $("#Submit").button("disable")
                    } else {
                        $("#Submit").button("enable")
                    }
                });
            });

        </script>
        <script>
            function lettersValidate(key) {
                var keycode = (key.which) ? key.which : key.keyCode;

                if ((keycode > 64 && keycode < 91) || (keycode > 96 && keycode < 123))  
                {    
                    return true;    
                }
                else
                {
                    return false;
                }

            }
        </script>
        <script type="text/javascript">
            $("#txtlrno").keyup(function (event) {
                if (event.keyCode === 13) {
                    add_row();
                }
            });
        </script>
        <script>
            function add_row() {
                var lrnolist = document.getElementsByName('str_lr_no[]');
                var iLen = lrnolist.length;
                var val = document.getElementById('txtlrno').value.trim();
                for (var i = 0; i < iLen; i++) {
                    if (lrnolist[i].value == val.toUpperCase()) {
                        document.getElementById('warntext').innerText = "LR No. already Present.";
                        document.getElementById('txtlrno').value = "";
                        // document.getElementById('btnaddrow').enable = false;
                        return;
                    }
                }

                var xhr = new XMLHttpRequest();
                var url = '<?php echo site_url("getlrdataJUNE"); ?>';
                var params = 'LRNO=' + encodeURIComponent(document.getElementById('txtlrno').value);
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;

                            if (response == "No Data.") {
                                document.getElementById('warntext').innerText = "LR No. Not Found";
                                document.getElementById('txtlrno').value = "";
                                document.getElementById('btnaddrow').disabled = false;
                            } else {
                                var data = JSON.parse(response).data;
                                var newRow = createTableRow(data);
                                document.getElementById('lrdetails').appendChild(newRow);

                                recalculateTotals();

                                document.getElementById('txtlrno').value = "";
                                document.getElementById('warntext').innerText = "";
                                document.getElementById('btnaddrow').disabled = false;
                            }
                        } else {
                            console.log(xhr.status);
                            alert("An error occurred while retrieving data. Please try again.");
                            document.getElementById('btnaddrow').disabled = false;
                        }
                    }
                };

                xhr.send(params);
            }


            function createTableRow(data) {
                var row = document.createElement('tbody');
                row.innerHTML = `
                <td><input class="str_lr_no" name="str_lr_no[]" value="${data.LRNO}"></td>
                <td><input class="lrdate"  name="lrdate[]" value="${data.LRDate}"></td>
                <td><input class="paytype" name="paytype[]" value="${data.PayBasis}"></td>
                <td><input class="from_location" name="from_location[]" value="${data.FromPlace}"></td>
                <td><input class="to_location" name="to_location[]" value="${data.ToPlace}"></td>
                <td><input class="arrive_date" name="arrive_date[]" value="${data.LRDate}"></td>
                <td><input class="PkgsNo" name="PkgsNo[]" value="${data.PkgsNo}"></td>
                <td><input class="actual_weight" name="actual_weight[]" value="${data.ActualWeight}"></td>
                <td><input class="grandtotal" name="grandtotal[]" value="${data.DocketTotal}"></td>
                <td style="display:none!important;"><input class="InvoiceNo" name="InvoiceNo[]" value="${data.InvoiceNo}"></td>
                <td style="display:none!important;"><input class="Consignor" name="Consignor[]" value="${data.Consignor}"></td>
                <td style="display:none!important;"><input class="Consignee" name="Consignee[]" value="${data.Consignee}"></td>
                <td><input type='button' value='DELETE' onclick="delete_row(this)"></td>
                `;

                var paytype = data.PayBasis.trim();
                var totaltopayInput = document.getElementById('totaltopay');

                if (paytype === 'TO PAY') {
                    var grandtotal = data.DocketTotal.trim();
                    totaltopayInput.value = grandtotal;
                } else {
                    totaltopayInput.value = '0';
                }

                totaltopayInput.readOnly = true;


                var actualWeight = parseInt(data.ActualWeight, 10);
                if (actualWeight > 2200) {
                    var containerDrsInputs = row.querySelectorAll('.container-drs-input input, .container-drs-input select');
                    containerDrsInputs.forEach(input => {
                        input.disabled = true;
                    });

        // var container= document.getElementById('')

        // var createDRSButton = document.getElementById('CreateDRS');
        // createDRSButton.disabled = true;
                }



                recalculateTotals();
                return row;
            }
            function addTableRow(data) {
                var tableBody = document.querySelector('#lrdetails tbody');
                var newRow = createTableRow(data);
                tableBody.appendChild(newRow);

                var pkgsNoInput = newRow.querySelector('.PkgsNo');
                var actualWeightInput = newRow.querySelector('.actual_weight');

                pkgsNoInput.addEventListener('input', recalculateTotals);
                actualWeightInput.addEventListener('input', recalculateTotals);

                recalculateTotals(); 
            }


            function getAllTableData() {
                var tableRows = document.querySelectorAll('#lrdetails tbody tr');
                var tableData = [];
                tableRows.forEach(function (row) {
                    var rowData = {
                        str_lr_no: row.querySelector('.str_lr_no').value,
                        lrdate: row.querySelector('.lrdate').value,
                        paytype: row.querySelector('.paytype').value,
                        from_location: row.querySelector('.from_location').value,
                        to_location: row.querySelector('.tocity').value,
                        arrive_date: row.querySelector('.arrive_date').value,
                        PkgsNo: row.querySelector('.PkgsNo').value,
                        actual_weight: row.querySelector('.actual_weight').value,
                        grandtotal: row.querySelector('.grandtotal').value
                    };
                    tableData.push(rowData);
                });
                return tableData;
            }

            function delete_row(button) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
                recalculateTotals();
            }

            function recalculateTotals() {
                const rows = document.querySelectorAll('#lrdetails tbody tr');
                let totalQty = 0;
                let totalWeight = 0;

                rows.forEach(row => {
                    const pkgsNoInput = row.querySelector('.PkgsNo');
                    const actualWeightInput = row.querySelector('.actual_weight');
                    const pkgsNo = parseFloat(pkgsNoInput.value) || 0;
                    const actualWeight = parseFloat(actualWeightInput.value) || 0;
                    totalQty += pkgsNo;
                    totalWeight += actualWeight;
                });

                const totalQtyElement = document.getElementById('totalqty');
                const totalWeightElement = document.getElementById('totalwt');

                if (totalQtyElement) {
                    totalQtyElement.textContent = totalQty.toFixed(2);
                }

                if (totalWeightElement) {
                    totalWeightElement.textContent = totalWeight.toFixed(2);
                }
            }

            document.getElementById('lrdetails').addEventListener('input', () => {
                recalculateTotals();
            });

            window.addEventListener('load', () => {
                recalculateTotals();
            });

        </script>

        <script>
            function onlyAlphabets(e, t) {
                var regexp = new RegExp(/^[A-Z0-9 ]*$/);
                if (window.event) {
                    keynum = e.keyCode;
                } else if (e.which) {
                    keynum = e.which;
                }
                var test = regexp.test(String.fromCharCode(keynum));
                return test;
            }
        </script>
        <script>
            function sum() {
                var n1 = parseFloat(document.getElementById('liter').value);
                var n2 = parseFloat(document.getElementById('Rate').value);
                var n5 = n1 * n2 ;
                document.getElementById('dieselamt').value = n5; 
            }
        </script>
        <script type="text/javascript">
            function fetch_ownername(element){
   //alert('ownername')
                var ownername;
                var AccountNO;
                var IFSC;
                var BankName;
                var branch;
                var Ownername_valid_check=true;
                var accountNO_valid_check=true;
                var iFSC_valid_check=true;
                var bankName_valid_check=true;
                var Branch_valid_check=true;

                ownername = document.getElementsByName('ownername');
                AccountNO= document.getElementsByName('AccountNO');
                IFSC= document.getElementsByName('IFSC');
                BankName= document.getElementsByName('BankName');
                branch= document.getElementsByName('branch');


                for (i = 0; i < ownername.length; i++) {
                    if (ownername[i] == element) {
                        index = i;
                        break;
                    }
                }


                for (i = 0; i < AccountNO.length; i++) {
                    if (AccountNO[i] == element) {
                        index = i;
                        break;
                    }
                }


                for (i = 0; i < IFSC.length; i++) {
                    if (IFSC[i] == element) {
                        index = i;
                        break;
                    }
                }


                for (i = 0; i < BankName.length; i++) {
                    if (BankName[i] == element) {
                        index = i;
                        break;
                    }
                }


                for (i = 0; i < branch.length; i++) {
                    if (branch[i] == element) {
                        index = i;
                        break;
                    }
                }

                if(Ownername_valid_check ==true){

                    $.ajax({
                        type: 'post',
                        url: 'createdrsdemo1accountno',
                        data: {
                            ownername:ownername[index].value,
                            AccountNO:AccountNO[index].value,

                        },
                        success: function (response) {
                            if(response==''){ 
                                accountNO_valid_check=false;
                            }
                            AccountNO[index].value=response;

                        },
                        error: function(response) {
                        }
                    });
                }
                if(Ownername_valid_check ==true){

                    $.ajax({
                        type: 'post',
                        url: 'createdrsdemo1ifsc',
                        data: {
                            ownername:ownername[index].value,
                            IFSC:IFSC[index].value,

                        },
                        success: function (response) {
                            if(response==''){ 
                                iFSC_valid_check=false;
                            }
//alert(response);
                            IFSC[index].value=response;

                        },
                        error: function(response) {
                        }
                    });
                }
                if(Ownername_valid_check ==true){

                    $.ajax({
                        type: 'post',
                        url: 'createdrsdemo1bank',
                        data: {
                            ownername:ownername[index].value,
                            BankName:BankName[index].value,

                        },
                        success: function (response) {
                            if(response==''){ 
                                bankName_valid_check=false;
                            }
                            BankName[index].value=response;

                        },
                        error: function(response) {
                        }
                    });
                }
                if(Ownername_valid_check ==true){

                    $.ajax({
                        type: 'post',
                        url: 'createdrsdemo1branch',
                        data: {
                            ownername:ownername[index].value,
                            branch:branch[index].value,

                        },
                        success: function (response) {
                            if(response==''){ 
                                Branch_valid_check=false;
                            }
                            branch[index].value=response;

                        },
                        error: function(response) {
                        }
                    });
                }
            }
        </script>
        <script>
            function fetch_hamali(e){
                var Hvendor;
                var HAccountNO;
                var HIFSC;
                var Hbank;
                var Hbranch;
                var HVendorCode;
                var HvendoR_valid_check=true;
                var HAccountNo_valid_check=true;
                var HIFSc_valid_check=true;
                var HbanK_valid_check=true;
                var Branch_valid_check=true;
                var HVendorCodE_valid_check=true;
                Hvendor = document.getElementsByName('Hvendor');
                HAccountNO= document.getElementsByName('HAccountNO');
                HIFSC= document.getElementsByName('HIFSC');
                Hbank= document.getElementsByName('Hbank');
                Hbranch= document.getElementsByName('Hbranch');
                HVendorCode= document.getElementsByName('HVendorCode');
                for (i = 0; i < Hvendor.length; i++) {
                    if (Hvendor[i] == e) {
                        index = i;
                        break;
                    }
                }
                for (i = 0; i < HAccountNO.length; i++) {
                    if (HAccountNO[i] == e) {
                        index = i;
                        break;
                    }
                }
                for (i = 0; i < HIFSC.length; i++) {
                    if (HIFSC[i] == e) {
                        index = i;
                        break;
                    }
                }
                for (i = 0; i < Hbank.length; i++) {
                    if (Hbank[i] == e) {
                        index = i;
                        break;
                    }
                }
                for (i = 0; i < Hbranch.length; i++) {
                    if (Hbranch[i] == e) {
                        index = i;
                        break;
                    }
                }
                for (i = 0; i < HVendorCode.length; i++) {
                    if (HVendorCode[i] == e) {
                        index = i;
                        break;
                    }
                }
                if(HvendoR_valid_check ==true){

                    $.ajax({
                        type: 'post',
                        url: 'hamaliaccount',
                        data: {
                            Hvendor:Hvendor[index].value,
                            HAccountNO:HAccountNO[index].value,
                        },
                        success: function (response) {
                            if(response==''){ 
                                HAccountNo_valid_check=false;
                            }
                            HAccountNO[index].value=response;
                        },
                        error: function(response) {
                        }
                    });
                }
                if(HvendoR_valid_check ==true){
                    $.ajax({
                        type: 'post',
                        url: 'hamaliifsc',
                        data: {
                            Hvendor:Hvendor[index].value,
                            HIFSC:HIFSC[index].value,
                        },
                        success: function (response) {
                            if(response==''){ 
                                HIFSc_valid_check=false;
                            }
                            HIFSC[index].value=response;
                        },
                        error: function(response) {
                        }
                    });
                }
                if(HvendoR_valid_check ==true){
                    $.ajax({
                        type: 'post',
                        url: 'hamalibank',
                        data: {
                            Hvendor:Hvendor[index].value,
                            Hbank:Hbank[index].value,
                        },
                        success: function (response) {
                            if(response==''){ 
                                HbanK_valid_check=false;
                            }
                            Hbank[index].value=response;
                        },
                        error: function(response) {
                        }
                    });
                }
                if(HvendoR_valid_check ==true){
                    $.ajax({
                        type: 'post',
                        url: 'hamalibranch',
                        data: {
                            Hvendor:Hvendor[index].value,
                            Hbranch:Hbranch[index].value,

                        },
                        success: function (response) {
                            if(response==''){ 
                                Branch_valid_check=false;
                            }
                            Hbranch[index].value=response;
                        },
                        error: function(response) {
                        }
                    });
                }
                if(HVendorCodE_valid_check ==true){
                    $.ajax({
                        type: 'post',
                        url: 'hamaliVendorCode',
                        data: {
                            Hvendor:Hvendor[index].value,
                            HVendorCode:HVendorCode[index].value,
                        },
                        success: function (response) {
                            if(response==''){ 
                                HVendorCodE_valid_check=false;
                            }
                            HVendorCode[index].value=response;
                        },
                        error: function(response) {
                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">
            var dialog = $("#dialog1").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog('close');
                    }
                }
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#form1').submit(function(e) {
                    e.preventDefault();

                    var rows = parseInt($('#lrdetails').val());
                    if (rows < 3) {
                        var message = "Please add LR NO.";
                        $('#abc').html(message);
                        $('#dialog1').dialog();
                        return false;
                    }
                    var formData = new FormData(this);
                    formData.delete('Submit');

                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (IsJsonString(response)) {
                                var drsobj = JSON.parse(response);
                                if (drsobj.success == 1) {
                                    $('#diagmsg').html(drsobj.msg);
                                    $('#diagimg').attr('src', 'images1/success.png');
                                    dialog.dialog('open');
                                } else {
                                    $('#diagmsg').html(drsobj.msg);
                                    $('#diagimg').attr('src', 'images1/error.png');
                                    dialog.dialog('open');
                                    $('#Submit').prop('disabled', false);
                                }
                            } else {
                                $('#diagmsg').html(response);
                                $('#diagimg').attr('src', 'images1/error.png');
                                dialog.dialog('open');
                                $('#Submit').prop('disabled', false);
                            }
                        },
                        error: function(response) {
                            $('#diagmsg').html(response);
                            $('#diagimg').attr('src', 'images1/error.png');
                            dialog.dialog('open');
                            $('#Submit').prop('disabled', false);
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            const btnstep1 = document.getElementById('btnstep1');
            const step1 = document.getElementById('step1');

            btnstep1.addEventListener('click', function() {
                const input1Value = document.getElementById('drivername').value;
                const input2Value = document.getElementById('mreading').value;
                const select1Value = document.getElementById('vendortype').value;

                if (input1Value !== '' && input2Value !== '' && select1Value !== '') {
                    step1.style.display = 'block';
                    document.getElementById('step0').style.pointerEvents = 'none';
                    document.getElementById('step0').style.opacity = '0.5';
                } else {
                    step1.style.display = 'none';
                }
            });
        </script>

        <script type="text/javascript">
            var lastrowid = 0;
            var verified = false;
            var dialog;
            var drsobj;
            $(function () {
                dialog = $("#dialog-message").dialog({
                    autoOpen: false,
                    width: 500,
                    position: {my: "center", at: "top+100", of: "#step1"},
                    modal: true,
                    buttons: {
                        OK: function () {
                            $(this).dialog("close");
                            if (drsobj != undefined)
                                if (drsobj.success == 1)
                                    window.location.href = "printdrsdemo.php?DRSNO=" + drsobj.DRSNO;
                            }
                        },
                        close: function () {
                            if (drsobj != undefined)
                                if (drsobj.success == 1)
                                    window.location.href = "printdrsdemo.php?DRSNO=" + drsobj.DRSNO;
                            }
                        });
                $("#datepicker").datepicker({
                    dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate:0,
                    maxDate: 0
                });
                $("#licexpdate").datepicker({
                    dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0
                });
    // $("#txtlrno").autocomplete({
    //  minLength: 3,
    //  source: 'lrac.php'
    // });
            });
            $(document).on("keypress", 'form', function (e) {
                if (e.target.className.indexOf("allowEnter") == -1) {
                    var code = e.keyCode || e.which;
                    if (code == 13) {
                        e.preventDefault();
                        return false;
                    }
                }
            });
            $( function() {
                $( "#dialog1" ).hide();
            } );
            $(document).ready(function() {
                $('#vendortype').change(function() {
                    fetch_vendor();
                });
            });
            function fetch_vendor() {
                document.getElementById('btnstep1').disabled = false;
                $.ajax({
                    type: 'post',
                    url: "fetch_vendor",
                    data: {
                        vendorname: $('#vendorname').val(),
                        vendortype: $('#vendortype').val(),
                    },
                    success: function(response) {
                        if (response.length < 3) {
                            document.getElementById('ftype').style.display = 'inline';
                            document.getElementById('ftperkm').checked = true;
                        } else if (response == "no data set.") {
                            document.getElementById('ftype').style.display = 'none';
                            document.getElementById('ftfix').checked = true;
                        } else {
                            document.getElementById('vehicleno').innerHTML = response;
                            document.getElementById('ftfix').checked = true;
                            document.getElementById('ftype').style.display = 'none';
                        }
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            }
            function fetch_vehicleno() {

                document.getElementById('btnstep1').disabled = false;
                $.ajax({
                    type: 'post',
                    url: "fetch_vendor",
                    data: {
                        vendorname: document.getElementById('vendorname').value,
                    },
                    success: function (response) {
                        if (response.length < 3) {
                            document.getElementById('ftype').style.display = 'inline';
                            document.getElementById('ftperkm').checked = true;

                        } else if (response == "no data set.") {
                            document.getElementById('ftype').style.display = 'none';
                            document.getElementById('ftfix').checked = true;
                        }
                        else {
                            document.getElementById('vehicleno').innerHTML = response;
                            document.getElementById('ftfix').checked = true;
                            document.getElementById('ftype').style.display = 'none';
                        }
                    },
                    error: function (response) {
                        alert(response);
                    }
                });



                $.ajax({
                    type: 'post',
                    url: 'fetch_vendor2',
                    data: {
                        vendorname: document.getElementById('vendorname').value,
                        vendortype: document.getElementById('vendortype').value,
                    },
                    success: function (response) {
                        if(document.getElementById('vendortype').value=="Attached"){
                            if (response != 1) {
                                console.log('3rd'+response);
                                <?php if(array('blockvendor')){
                                    echo"$('#btnstep1').attr('disabled',false)";
                                }else{
                                    echo"$('#btnstep1').attr('disabled',true)";
                                } ?>

//alert("Please upload vendor contract");

                                var message="Please upload vendor contract";
                                document.getElementById("abc").innerHTML = message;

                                $( function() {
                                    $( "#dialog1" ).dialog();

                                } );

                            }
                            console.log('3th'+response);

                        }
                        else {
                            console.log('4th'+response);
                            document.getElementById('btnstep1').disabled = false;

                        }
                    },
//alert(response + response.length);
// },
                    error: function (response) {
                        alert(response);
                    }
                });
            }
            function fetch_driver() {
                if (document.getElementById('vendortype').value == "Attached")
                    return;
                if (document.getElementById('driver').value == "")
                    return;
                $.ajax({
                    type: 'post',
                    url: 'fetch_vendor',
                    data: {
                        DName: document.getElementById('driver').value
                    },
                    success: function (response) {
                        var str = response.split("\n");
                        document.getElementById('drivername').value = document.getElementById('driver').value;
                        document.getElementById('mobileno').value = str[0];
                        document.getElementById('licenseno').value = str[1];
                        document.getElementById('licexpdate').value = str[2];
                    },
                    error: function (response) {
                        alert(response);
                    }
                });
            }

            function checklist() {
                var vehicleno = $('#vehicleno').val();

                $.ajax({
                    type: 'post',
                    url: "validateVehicle",
                    data: { vehicleno: vehicleno },
                    success: function (response) {
                        if (response == 'valid') {
                            $('#btnstep1').attr('disabled', false);
                        } else {
                            $('#btnstep1').attr('disabled', true);
                        }
                    },
                    error: function (response) {
                        alert('Error occurred while validating vehicle number');
                    }
                });
            }
// $('#loading-image').show();
// $.ajax({
//  type: 'post',
//  url: 'gettripavailibitytu',
//  data: {

//      vehicleno: document.getElementById('vehicleno').value
//  },
//  success: function (response) {
//      console.log(response);
//      if (response!=0) {

//          $('#btnstep1').attr('disabled',true);
//          document.getElementById('btnstep1').disabled = true;
//          document.getElementById('btnstep1').disabled = true;
//          document.getElementById('Submit').disabled = true;
//          var message=" This Vehicle Not Available For Tripsheet."+response;
//          document.getElementById("abc").innerHTML = message;

//          $( function() {
//              $( "#dialog1" ).dialog();

//          } );
//      }

//      else{
//      }
//  },
//  error: function (response) {
//      alert(response);
//  }
// });
            function validateVehicle() {
                if ($('#vendortype').val() == "Own") {
                    return true;
                }
                var pattern1 = /^[A-Z]{2}[0-9]{2}[A-Z]{0,2}[0-9]{4}$/;
                var pattern2 = /^[A-Z]{3}[0-9]{4}$/;
                var pattern3 = /^[A-Z]{2}[0-9]{3}[A-Z]{1}[0-9]{4}$/;
                var pattern4 = /^[A-Z]{2}[0-9]{2}[A-Z]{3}[0-9]{4}$/;

                if (args.val().length >= 6 && !args.prop('disabled')) {
                    if (pattern1.test(args.val()) || pattern2.test(args.val()) || pattern3.test(args.val()) || pattern4.test(args.val())) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            function validateVeh() {
                $('#podpending').prop('disabled', true);
                if (validateVehicle($('#avehicleno').val())) {
                    $('#vehtxt').html('');
                } else {
                    $('#vehtxt').html('Invalid Vehicle No.');
                }
                $('.loader').show();

                var drs = 'DRS';

                if (drs === 'DRS') {
                    var a = $('#avehicleno').val();
                    var message = 'vehicle no-' + a + ' Not Financially Close Please Clear All POD First';
                    $('#abc').html(message);
                    $('#dialog1').dialog();
                } else {
                    $('#dialog1').hide();
                }

                $('.loader').hide();

                $.post('driverpodstatus.php', { avehicleno: $('#avehicleno').val() }, function (response) {
                    document.getElementById("podpending").style.display = "none";
                    if ($('#vendortype').val() == "Attached") {
                        var temp = JSON.parse(response);
                        if (temp != "OK") {
                            $("#podpending").show();
                            $("#target").show();
                        } else {
                            document.getElementById("podpending").style.display = "none";
                        }
                    } else {
                        document.getElementById("podpending").style.display = "none";
                    }
                }).fail(function (response) {
                    alert(response);
                });

                $.post('pendingpodcount.php', { avehicleno: $('#avehicleno').val() }, function (response) {
                    var temp1 = JSON.parse(response);
                    $("#target").text(temp1);
                }).fail(function (response) {
                    alert(response);
                });

                $.post('checkvoucherdrs.php', { avehicleno: $('#avehicleno').val() }, function (response) {
                    if (response != "No data Found") {
                        var message = response;
                        $("#abc2").html(message);
                        $("#dialog3").dialog();
                    } else {
                        $("#dialog3").hide();
                    }
                }).fail(function (response) {
                    alert(response);
                });
            }
            function toggleVehicleInput() {
                var selectedVehicle = document.getElementById('vehicleno').value;
                var avehiclenoInput = document.getElementById('avehicleno');

                if (selectedVehicle === '') {
                    avehiclenoInput.style.display = 'none';
                    avehiclenoInput.disabled = true;
                } else {
                    avehiclenoInput.style.display = 'block';
                    avehiclenoInput.disabled = false;
                }
            }
            function fixclick() {
                $('#drskm').prop('disabled', true);
            }
            function fixclick1() {
                $('#drskm').prop('disabled', true);
            }
            function kmclick() {
                $('#drskm').prop('disabled', false);
            }
            function rateclick() {
                var vehicle_no = $('#avehicleno').val();
                var kmdrs = $('#drskm').val();

                $.post('getdiliverykm', { vehicleno: $('#avehicleno').val() }, function (response) {
                    $('#responsekm').val(response);

                    if (response != 0) {
                        if (kmdrs > response) {
                            var message = "<b style='color:red; font-family:Times New Roman, Times, serif'>" + vehicle_no + " DRS KM LIMIT IS " + response + " km";
                            $('#abc').html(message);
                            $('#dialog1').dialog();
                        }
                    }
                }).fail(function (response) {
                    alert(response);
                });
            }
            function checkDuplicates() {
                var $elems = $("input[name='str_lr_no[]']");
                var values = [];
                var isDuplicated = false;
                $elems.each(function () {
                    if (!this.value) return true;
                    if (values.indexOf(this.value) !== -1) {
                        var message="Duplicate LR NO. " + this.value + " Found in LR List.";
                        document.getElementById("abc").innerHTML = message;

                        $( function() {
                            $( "#dialog1" ).dialog();

                        } );

                        isDuplicated = true;
                        return false;
                    }
// store the value
                    values.push(this.value);
                });
                return isDuplicated;
            }
            function IsJsonString(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }
            function contrcheck()
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdrsthcfright',
                    data: {
                        avehicleno: document.getElementById('avehicleno').value,
                        vendorname: document.getElementById('vendorname').value,
                    },
                    success: function (response) {
                    },
                    error: function (response) {
                    }

                });

                $.ajax({
                    type: 'post',
                    url: 'checkdrsthcallowcreatedemo',
                    data: {
                        avehicleno: document.getElementById('avehicleno').value,
                        vendorname: document.getElementById('vendorname').value,
                    },
                    success: function (response) {
                        alert(response);

                        if(response==0)
                        {
                            if(document.getElementById('vendortype').value == "Attached")
                            {
                                var n11 = parseInt(document.getElementById('totaldockettotal').value);
                                var n12 = parseFloat(document.getElementById('contractamt').value);
                                var n13 = n11-n12;
                                var n14 = n13*100/n11;
                                const result2 = n14.toFixed(2);
// alert(result2);
                                var n15=document.getElementById('percentage').value=result2;
                                if(result2>=40)
                                {
                                    document.getElementById('percentage').value='';
                                }
                                if (result2<40) {
                                    alert("Contract Amount cannot be greater than Docket Amount. Contact to Control Tower Team.");
                                    document.getElementById('Submit').disabled = true; 
                                    document.getElementById('Hvendor').disabled = true; 


                                    document.getElementById('advamt').disabled = true; 
                                    document.getElementById('advancetype').disabled = true;
                                    document.getElementById('hamali').disabled = true;


                                    return false;
                                }
                                else
                                {
                                    document.getElementById('Submit').disabled = false; 
                                    document.getElementById('Hvendor').disabled = false; 

                                    document.getElementById('advamt').disabled = false; 
                                    document.getElementById('advancetype').disabled = false;
                                    document.getElementById('hamali').disabled = false;

                                }

                            }
                        }

                        if(response==0)
                        {
                            if(document.getElementById('vendortype').value == "Own")
                            {
                                var n11 = parseInt(document.getElementById('totaldockettotal').value);
                                var n12 = parseFloat(document.getElementById('contractamt').value);
                                var n13 = n11-n12;
                                var n14 = n13*100/n11;
                                const result2 = n14.toFixed(2);
// alert(result2);
                                var n15=document.getElementById('percentage').value=result2;
                                if(result2>=40)
                                {
                                    document.getElementById('percentage').value='';
                                }
                                if (result2<40) {
                                    alert("Contract Amount cannot be greater than Docket Amount. Contact to Control Tower Team.");
                                    document.getElementById('Submit').disabled = true; 
                                    document.getElementById('Hvendor').disabled = true; 

                                    document.getElementById('advamt').disabled = true; 
                                    document.getElementById('advancetype').disabled = true;
                                    document.getElementById('hamali').disabled = true;
                                    return false;
                                }
                                else
                                {
                                    document.getElementById('advamt').disabled = false; 
                                    document.getElementById('advancetype').disabled = false;
                                    document.getElementById('hamali').disabled = false;
                                    document.getElementById('Submit').disabled = false; 
                                    document.getElementById('Hvendor').disabled = false;  
                                }

                            }
                        }
                    },
                    error: function (response) {
//alert(response);
                    }

                });
}
function contrcheck1()
{
    $.ajax({
        type: 'post',
        url: 'checkdrsthcfright',
        data: {
            avehicleno: document.getElementById('avehicleno').value,
            vendorname: document.getElementById('vendorname').value,
        },
        success: function (response) {

            if(document.getElementById('vendortype').value == "Attached" || document.getElementById('totaltopay').value == "TO PAY" )
            {
                var totalpay=document.getElementById('totaltopay').value;
                var contractamt=document.getElementById('contractamt').value;
                var advanceamt=document.getElementById('advamt').value;
                var rk=contractamt*10/100;
                var remain=contractamt-rk;
                var advance=remain-totalpay;
                if(advance<=0)
                {
                    var advanceamt=document.getElementById('advamt').value;  
                }
                if(advanceamt>advance)
                {
                    var advanceamt=document.getElementById('advamt').value=0; 
                }
                if(advance>0)
                {
                    alert(" Maximum Advance Allowed Rs " + advance);
                }
                else
                {
                    alert("  No Advance Allowed Rs " + advance);
                }

            }

        },
        error: function (response) {
            alert(response);
        }

    });

    $.ajax({
        type: 'post',
        url: 'checkdrsthcallowcreate',
        data: {
            avehicleno: document.getElementById('avehicleno').value,
            vendorname: document.getElementById('vendorname').value,
        },
        success: function (response) {
            if(response==0)
            {
                if(document.getElementById('vendortype').value == "Own")
                {
                    var cal=parseInt(document.getElementById('advamt').value)<='contractamt';
                    var Result24 = document.getElementById('advamt').value;
                    var Quantity112 = document.getElementById('contractamt').value;
                    if(parseInt(Result24) >=parseInt(Quantity112)){
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            if(response==0)
            {
                if(document.getElementById('vendortype').value == "Attached")
                {
                    var cal=parseInt(document.getElementById('advamt').value)<='contractamt';
                    var Result244 = document.getElementById('advamt').value;
                    var Quantity1122 = document.getElementById('contractamt').value;
                    if(parseInt(Result244) >=parseInt(Quantity1122)){
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
        },
        error: function (response) {
            alert(response);
        }

    });

}
</script>
<script>
    $(document).ready(function() {
        var searchInput = $('#drivername');
        var searchResultsList = $('#drivername-list');

        searchInput.on('keyup', function() {
            var keyword = searchInput.val().trim();

            if (keyword !== '') {
                $.ajax({
                    url: '<?php echo site_url('driver_data'); ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    success: function(response) {
                        searchResultsList.html(response);
                    }
                });
            } else {
                searchResultsList.html('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var searchInput = $('#txtlrno');
        var searchResultsList = $('#search-txtlrno-list');

        searchInput.on('keyup', function() {
            var keyword = searchInput.val().trim();

            if (keyword !== '') {
                $.ajax({
                    url: '<?php echo site_url('str_lr_no'); ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    success: function(response) {
                        searchResultsList.html(response);
                    }
                });
            } else {
                searchResultsList.html('');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function sendotp() {
        if ($('#mobileno').val().length != 10) {
            alert("Please enter a valid 10-digit number.");
            return;
        }

        $('#mobileno').prop('readonly', true);

        $.ajax({
            type: 'post',
            url: '<?php echo base_url('sendotp'); ?>',
            data: {
                mobileno: $('#mobileno').val()
            },
            success: function (response) {
                if (response == "Success.") {
                    $('#mobtxt').text("OTP is sent to mobile no.");
                    $('#mobtxt').css('backgroundColor', 'Aquamarine');
                    $('#btnsendotp').prop('disabled', true);
                    $('#btnverifyotp').prop('disabled', false);
                    $('#timer').html('02:00');
                    startTimer();
                } else {
                    // $('#mobtxt').text(response);
                    // $('#mobtxt').css('backgroundColor', 'LightSalmon');
                    $('#mobileno').prop('readonly', false);
                }
            },
            error: function (response) {
                alert(response);
            }
        });
    }


    function verifyotp() {
        if ($('#otp').val().length != 6) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('verify_otp'); ?>',
            data: {
                otp: $('#otp').val()
            },
            success: function (response) {
                if (response.trim() === "Success") {
                    $('#mobtxt').text("OTP verification successful.");
                    $('#mobtxt').css('backgroundColor', 'PaleGreen');
                    verified = true;
                } else {
                    $('#mobtxt').text("OTP verification successful");
                    $('#mobtxt').css('backgroundColor', 'PaleGreen');
                    verified = false;
                }
            },
            error: function (response) {
            }
        });
    }

</script>


<!-- THC DIV BELOW -->

<div class="d-flex justify-content-center my-2">
    <button class="justify-content-center" id="plusButton"><i class="fa fa-plus" style="font-size:15px;"></i></button>
</div>
<div id="container"></div>

<script>
    var count = 0;

    document.getElementById("plusButton").addEventListener("click", function() {
        var div = document.createElement("div");
        div.innerHTML = document.getElementById("step2").innerHTML;
        div.id = "step2-" + count;
        document.getElementById("container").appendChild(div);

        var cancelButton = document.createElement("button");
        cancelButton.textContent = "Cancel";
        cancelButton.addEventListener("click", function() {
            div.remove();
        });
        div.appendChild(cancelButton);

        count++;
    });
</script>
<div id="step2" style="display: none;">
    <br>
<!--  <div class="container">
    <div class="row">
        <div class="col" >Driver Mobile No.:</div>
        <div class="col">
            <input class="form-control" type="number" id="mobileno" name="mobileno" pattern="[0-9]+" required="">
        </div>
        <div class="col">
            <input  type="button" id="btnsendotp" value="Send OTP" onclick="sendotp()">
        </div>
        <div  class="col" id="mobtxt" align="center" style="border-radius: 10px;">
        </div>
        <div class="col" style="text-align:;color:red"><input class="form-control" type="number" id="otp" name="otp" pattern="[0-9]+"></div>
        <div class="col"><input  type="button" id="btnverifyotp" value="Verify" maxlength="6" onclick="verifyotp()">
        </div>
    </div>
</div> -->
<!-- <br>
<center>
    <br>
    <p><b>Enter LR Number</b></p>
    <input class="form-control" type="text" id="txtLRNO" maxlength=15 placeholder="Search LR Number" list="search-txtLRNO-list" style="width:23%;" required>
    <datalist id="search-txtLRNO-list" style="width: 200px;">
    </datalist>
    <br>
    <br> -->
   <!--  <center>
        <input  type="button" id="btnaddrow1" value="Add Row" onclick="add_row1()" required>
        <span id="warntext" style="margin-left: 5px; color: red;"></span>
    </center> -->
    <!-- <br>
    <div class="table" style="overflow:auto">
     <table id="lrdetails1" align='center' class="table-responsive col-12">
        <thead>
            <th>LR NO</th>
            <th>LR Date</th>
            <th>Pay Basis</th>
            <th>From</th>
            <th>To</th>
            <th>Arrive Date</th>
            <th>PkgsNo</th>
            <th>Actual Weight</th>
            <th>Docket Total</th>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th>DELETE</th>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <td colspan=5></td>
            <td align='right'><b>Total</b></td>
            <td id="totalqty">0</td>
            <td id="totalwt">0</td>
            <td colspan=4></td>
        </tfoot>
    </table>
</div> -->
<div class="container">
    <div class="row">
        <div>
            <input class="form-control" type="hidden" id="totaldockettotal" onchange="contrcheck()" name="totaldockettotal"
            value="0" readonly>
            <span id="totaldockettotal">
            </span>
        </div>
        <div>
            <input class="form-control" type="hidden" id="totaldockettotalthc" name="totaldockettotalthc"
            value="0" readonly>
        </div>
        <div class="col-md-2">
            GP For This DRS : 
            <input class="form-control" type="text" id="percentage"  name="percentage"  readonly>
            <span id="gppercentage"> &nbsp %</span>
        </div>
    </div> 
    <span>पोच भाडे 10% राहणार</span>
    <br>
    <div class="row"  style="border-bottom:hidden!important;border-top:hidden!important;">
        <input class="form-control" type='hidden'  name='wtones1' id='wtones1'>
        <input class="form-control" type='hidden' name='capicitynew' id="capicitynew">
        <div class="col-md-2">Total ToPay :</div>
        <div class="col-md-2">
            <input class="form-control" type="number" id="totaltopay" name="totaltopay"
            value="0" readonly>
        </div>
        <div class="col-md-2">Contract Amount :<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="number" id="contractamt1" name="contractamt"
            pattern="[0-9]+"
            oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
            oninput="this.setCustomValidity('')" onchange="contrcheck()" required
            >
        </div>
        <div class="col-md-2"> Hamali Received From Driver:<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="text" id="advancetype" name="advancetype">
        </div>
    </div>
    <br>
    <div class="row" style="border-bottom:hidden!important;border-top:hidden!important;">
        <div class="col-md-2">Advance Amount :<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="number" id="advamt" name="advamt"
            pattern="[0-9]+"
            oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
            oninput="this.setCustomValidity('')" 
            onchange="contrcheck1()" required
            >
            <span id="advamt">
            </span>
        </div>
        <div class="col-md-2">Fuel Quantity (ltr/kg) :<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="number" id="liter1" name="liter1"
            oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
            oninput="this.setCustomValidity('')" 
            onchange="sum1()" 
            >
            <span id="liter1">
            </span>
        </div>
        <div class="col-md-2"> Fuel Rate (ltr/kg) :<span style='color:red'>*</span></div>
        <div class="col-md-2"><input class="form-control" type="number" id="Rate1" name="Rate1"  
            oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
            oninput="this.setCustomValidity('')"  onchange="sum1()"
            ><span id="Rate1">
            </span>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">Fuel Amount:</div>
        <div class="col-md-2">
            <input class="form-control" type="number" id="dieselamt1" name="dieselamt1"
            pattern="[0-9]+" 
            oninvalid="this.setCustomValidity('Please enter Diesel Amount.')"
            oninput="this.setCustomValidity('')"  readonly  >
            <span id="dieselamt1">
            </span>
        </div>
        <div class="col-md-2">
            <label>Upload Image Fuel Bill:<span style='color:red'>*</span>
            </label>
        </div>
        <div class="col-md-2">
            <input type="file" class="form-control" id="defaultFile" name="thumbnail1" onchange="readURL(this,'ImagePreview');" >
            <br><br>
        </div>
        <div class="col-md-2">Fuel Vendor Name :<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <select id="dieselvendorname1" style="height:50px;" name="dieselvendorname1" onchange="fuel_vendor()" class="form-control">
                <option value="1" required>SELECT VENDOR NAME</option>
                <option value="" required>No Fuel Vendor</option>
                <?php
                $user_id = $this->session->userdata('user_id');
                $user_query = $this->db->get_where('employee', array('EmpID' => $user_id));
                $user_data = $user_query->row();

                if ($user_data) {
                    $Depot = $user_data->Depot;
                    $fuel_query = $this->db->get('petrolpump');
                    $fuel_data1 = $fuel_query->result();

                    $found = false;
                    $matchingPetrolPumps = array();

                    foreach ($fuel_data1 as $row) {
                        $locations = explode(',', $row->Location);

                        if (in_array($Depot, $locations)) {
                            $matchingPetrolPumps1[] = $row->PetrolPumpName;
                            $found = true;
                        }
                    }

                    if ($found) {
                        foreach ($matchingPetrolPumps1 as $petrolPumpName) {
                            echo '<option value="' . $petrolPumpName . '">' . $petrolPumpName . '</option>';
                        }
                    } else {
                        echo '<option value="" required>Depot not found in any location</option>';
                    }
                } else {
                    echo '<option value="" required>User not found</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">Fuel Bill No<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="text" id="Dieselbillno" name="Dieselbillno"
            pattern="[0-9]+"
            oninvalid="this.setCustomValidity('Please enter Hamali.')"
            oninput="this.setCustomValidity('')">
        </div>
        <div class="col-md-2"> Loading Hamali Vendor Name :<span style='color:red'>*</span>
        </div>
        <div class="col-md-2">
            <select id="Hvendor1" style="height:50px;font-size: smaller;" class="form-control" name="Hvendor1" onchange="fetch_hamali(this)">
                <option value="0" required>Select Hamali Vendor</option>
                <option value="1" required>No Hamali Vendor</option>
                <?php
                $user_id = $this->session->userdata('user_id');
                $user_query = $this->db->get_where('employee', array('EmpID' => $user_id));
                $user_data = $user_query->row();

                if ($user_data) {
                    $Depot = $user_data->Depot;
                    $hamali_query = $this->db->get('hamalivendor');
                    $hamali_data = $hamali_query->result();

                    $found = false;
                    $matchinghamali = array();

                    foreach ($hamali_data as $row) {
                        $DEPOT = $row->DEPOT;
                        if ($Depot == $DEPOT) {
                            $matchinghamali[] = $row->Hvendor;
                            $found = true;
                        }
                    }

                    if ($found) {
                        foreach ($matchinghamali as $Hvendor) {
                            echo '<option value="' . $Hvendor . '">' . $Hvendor . '</option>';
                        }
                    } else {
                        echo '<option value="" required>Depot not found in any location</option>';
                    }
                } else {
                    echo '<option value="" required>User not found</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">Loading Hamali Amount :<span style='color:red'>*</span>
        </div>
        <div  class="col-md-2">
            <input class="form-control" type="number" id="hamali1" name="hamali1"
            pattern="[0-9]+"
            oninvalid="this.setCustomValidity('Please enter Loading Hamali Amount.')"
            oninput="this.setCustomValidity('')" required>
        </div>
    </div>
</center>
<div class="d-flex justify-content-center">
    <input type="submit" id="CreateTHC" name="CreateTHC" value="Create THC" class="btn btn-outline-dark btn-fw">
    <input type="hidden" name="CreateTHC" value="Create THC">
    <div id="loader" class="text-center" style="display: none;">
        <div class="loader"></div>
    </div> 
</div>
</div>

<script type="text/javascript">
    const btnstep2 = document.getElementById('btnstep2');
    const step2 = document.getElementById('step2');
    const A1 = document.getElementById('GPDRS');
    const createDRSButton = document.getElementById('CreateDRS'); 

    btnstep2.addEventListener('click', function() {
        const input1Value = document.getElementById('drivername').value;
        const input2Value = document.getElementById('mreading').value;
        const select1Value = document.getElementById('vendortype').value;

        if (input1Value !== '' && input2Value !== '' && select1Value !== '') {
            step2.style.display = 'block';
            A1.style.display = 'none';
            document.getElementById('step0').style.pointerEvents = 'none';
            document.getElementById('step0').style.opacity = '0.5';
            createDRSButton.style.display = 'block';
        } else {
            step2.style.display = 'block';
            A1.style.display = 'block';
        }
    });
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    const currentDate = new Date();
    const currentFormattedDate = formatDate(currentDate);
    const twoDaysAgo = new Date();
    twoDaysAgo.setDate(currentDate.getDate() - 2);
    const twoDaysAgoFormattedDate = formatDate(twoDaysAgo);
    document.getElementById('drsdate').value = currentFormattedDate;
    document.getElementById('drsdate').setAttribute('max', currentFormattedDate);
    document.getElementById('licexpdate').value = currentFormattedDate;

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>
<script type="text/javascript">
    document.getElementById("CreateDRS").addEventListener("click", function() {
        var submitBtn = document.getElementById("CreateDRS");
        var loader = document.getElementById("loader");
        submitBtn.style.display = "block";
        loader.style.display = "block";
    });
</script>
<script type="text/javascript">
    document.getElementById("CreateTHC").addEventListener("click", function() {
        var submitBtn1 = document.getElementById("CreateTHC");
        var loader = document.getElementById("loader");
        submitBtn1.style.display = "block";
        loader.style.display = "block";
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
<script>
    $(document).ready(function () {
        $("#Submit").button({
            icons: {
                secondary: "ui-icon-info"
            }
        });
        $("#Hvendor").addClass("ui-selectmenu-button ui-widget ui-state-default ui-corner-all");
        var demoSelectValue = $("#Hvendor").val();
        if (demoSelectValue == "0") {
            $("#Submit").button("disable")
        }
        $("#Hvendor").change(function () {
            if ($(this).val() == "0") {
                $("#Submit").button("disable")
            } else {
                $("#Submit").button("enable")
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#checkbox1').change(function(){    
            if(this.checked){
                $('#Hvendor').prop("disabled",false);   
            } else {
                $('#Hvendor').prop("disabled",true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#checkbox2').change(function(){    
            if(this.checked){
                $('#Hvendor').prop("disabled",false);   
            } else {
                $('#Hvendor').prop("disabled",true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#checkbox3').change(function(){    
            if(this.checked){
                $('#Hvendor').prop("disabled",false);   
            } else {
                $('#Hvendor').prop("disabled",true);
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function vendortypechange() {
        var vendortype = document.getElementById('vendortype').value;
        var attachedVendorSelect = document.getElementById('attachedvendor');
        var ownVendorSelect = document.getElementById('vendor-options');
        var inputElement = document.getElementById('avehicleno');
        var inputElement1 = document.getElementById('AccountNO');
        var inputElement2 = document.getElementById('IFSC');
        var inputElement3 = document.getElementById('BankName');
        var inputElement4 = document.getElementById('branch');
        var inputElement5 = document.getElementById('ownername');
        if (vendortype === "Attached") {
            inputElement.style.display="block"
            inputElement1.style.display="block"
            inputElement2.style.display="block"
            inputElement3.style.display="block"
            inputElement4.style.display="block"
            inputElement5.style.display="block"
            attachedVendorSelect.style.display = 'block';
            ownVendorSelect.style.display = 'none';
        } else if (vendortype === "Own") {
            inputElement.style.display="none"
            inputElement1.style.display="none"
            inputElement2.style.display="none"
            inputElement3.style.display="none"
            inputElement4.style.display="none"
            inputElement5.style.display="none"
            attachedVendorSelect.style.display = 'none';
            ownVendorSelect.style.display = 'block';
        } else {
            attachedVendorSelect.style.display = 'none';
            ownVendorSelect.style.display = 'none';
        }
    }
    $(document).ready(function() {
        $("#vendor-options").on('change', function() {
            var selectedOption = $(this).val();
            var vehicleOptionsSelects = $("[id^='vehicle-options-']");
            vehicleOptionsSelects.hide();
            if (selectedOption === "VTC 3 PL SERVICES LTD (KALBHOR)") {
                $("#vehicle-options-KALBHOR").show();
            } else if (selectedOption === "VTC 3 PL SERVICES LTD AKOLA") {
                $("#vehicle-options-AKOLA").show();
            } else if (selectedOption === "VTC 3 PL SERVICES LTD PUNE") {
                $("#vehicle-options-PUNE").show();
            }else{
                $("#avehicleno").show();
            }
        });
    });
    function sum1() {
        var LITER = parseFloat(document.getElementById('liter1').value);
        console.log(LITER);
        var RATE = parseFloat(document.getElementById('Rate1').value);
        console.log(RATE);
        var DISELAMT1 = LITER * RATE ;
        console.log(DISELAMT1);
        document.getElementById('dieselamt1').value = DISELAMT1; 
    }
    function attachedvendorname(){
        var  attached = document.getElementById('attachedvendor').value;
        var  own = document.getElementById('vendor-options').value;
        console.log(own);
    }
    function ownvehicle(){
        attachedvehicle = document.getElementById('avehicleno').value;
        ownvehicle = document.getElementById('vehicle-options-KALBHOR').value;
        ownvehicle1 = document.getElementById('vehicle-options-AKOLA').value;
        ownvehicle2 = document.getElementById('vehicle-options-PUNE').value;
        console.log(ownvehicle1);
    }
    function fuel_vendor(){
        fuelvendor =document.getElementById('dieselvendorname1').value;
        console.log(fuelvendor);
    }
    function fetch_hamali(){
        hamaliname=document.getElementById('Hvendor1').value;
        console.log(hamaliname);
    }
</script>
<script>
    $(document).ready(function() {
        $("#btnstep1").click(function() {
            var formData = new FormData($('#form1')[0]);
            var error = false;

            if (formData.get('drsdate') == "") {
                errorToster('Please Select drsdate');
                $('#drsdate').focus();
                error = true;
            }
            else if (formData.get('vendortype') == "") {
                errorToster('Please Select vendortype');
                $('#vendortype').focus();
                error = true;
            }
            else if (formData.get('ownername') == "") {
                errorToster('Please Enter ownername');
                $('#ownername').focus();
                error = true;
            }
            else if (formData.get('mreading') == "") {
                errorToster('Please Enter mreading');
                $('#mreading').focus();
                error = true;
            }
            else if (formData.get('drskm') == "") {
                errorToster('Please Enter drskm');
                $('#drskm').focus();
                error = true;
            }
            else if (formData.get('drivername') == "") {
                errorToster('Please Enter drivername');
                $('#drivername').focus();
                error = true;
            }
            else if (formData.get('FTLType') == "") {
                errorToster('Please Select FTLType');
                $('#FTLType').focus();
                error = true;
            }
            else if (formData.get('licenseno') == "") {
                errorToster('Please Enter licenseno');
                $('#licenseno').focus();
                error = true;
            }
            else if (formData.get('AccountNO') == "") {
                errorToster('Please Enter AccountNO');
                $('#AccountNO').focus();
                error = true;
            }
            else if (formData.get('IFSC') == "") {
                errorToster('Please Enter IFSC');
                $('#IFSC').focus();
                error = true;
            }
            else if (formData.get('BankName') == "") {
                errorToster('Please Enter BankName');
                $('#BankName').focus();
                error = true;
            }
            else if (formData.get('branch') == "") {
                errorToster('Please Enter branch');
                $('#branch').focus();
                error = true;
            }
            else {
                $('#err_msg').html('');
            }
        });
    });


    $(document).ready(function() {
        $("#btnaddrow").click(function() {
            var formData = new FormData($('#form1')[0]);
            var error = false;
            if (formData.get('txtlrno') == "") {
                errorToster('Please Search LRNO');
                $('#txtlrno').focus();
                error = true;
            }

            else  {
                $('#err_msg').html('');
            }
        });
    });

    function successToster(msg) {

        var x = document.getElementById("snackbar");
        x.innerHTML = msg;

        x.classList.remove("error");
        x.classList.add("success");

        x.classList.add("show");
        setTimeout(function(){ 
            x.classList.remove("show"); 
        }, 3000);
    }

    function errorToster(msg) {
        var x = document.getElementById("snackbar");
        x.innerHTML = msg;

        x.classList.remove("success");
        x.classList.add("error");

        x.classList.add("show");
        setTimeout(function(){ 
            x.classList.remove("show"); 
        }, 3000);
    }
</script>































