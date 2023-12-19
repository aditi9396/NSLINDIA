 <?php
 date_default_timezone_set('Asia/Kolkata');
 $date = new DateTime();
 $date->sub(new DateInterval('P1D'));
 $datestr = $date->format('d-m-Y');
 ?>
 <script src="assets/vendors/js/vendor.bundle.base.js"></script>
 <script src="assets/js/misc.js"></script>
 <style type="text/css">
    .invtab {
        width: 100%;
        border: none;
    }
    .invtab th, .invtab td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .invtab th {
        background-color: #2c2d58a3;
    }
    .invtab input[type="text"], .invtab select {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    @media (max-width: 768px) {
        .invtab {
          font-size: 12px;
      }
  }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">TRIPSHEET EXPENSES</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">TRIPSHEET EXPENSES</li>
                </ol>
            </nav>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="main">
                        <form method="post" name="fm">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input type="radio" name="no" class="num" value="drsnoo" onclick="showDiv('first')">&nbsp;&nbsp;&nbsp;<b>Select DRS NO.</b>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="radio" name="no" class="num" value="thcnoo" onclick="showDiv('second')">&nbsp;&nbsp;&nbsp;<b>Select THC
                                        NO.</b>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="radio" name="no" class="num" value="both" onclick="showDiv('third')">&nbsp;&nbsp;&nbsp;<b>BOTH</b>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="contentDiv" id="first" style="display:none;">
                            <form method="post" id="drsnext">
                                <div class="form-group">
                                    <div class="row"> 
                                        <div class="col-sm-2">
                                            <label>Select DRS NO</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" id="drs" name="drs" class="form-control"  style="text-transform:uppercase ;"  list="drs-list" required="">
                                            <datalist id="drs-list"></datalist>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" name="DRSNext"  id="DRSNext" value="Next"  onclick="showDRSTables()" class="btn btn-outline-dark btn-fw ">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="contentDiv" id="second" style="display:none;">
                            <form method="post" id="thcnext">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Select THC NO</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="thc" id="thc" list="thc-list" class="form-control" required>
                                            <datalist id="thc-list"></datalist>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" name="THCNext" onclick="showTHCTables()" id="THCNext" value="Next" class="btn btn-outline-dark btn-fw ">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="contentDiv" id="third" style="display:none;">
                            <form method="post" id="DRSTHCdata">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label>Select DRS NO</label>
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" name="bothdrs" id="bothdrs" list="drs-list1" class="form-control" required>
                                            <datalist id="drs-list1"></datalist>
                                        </div>
                                        <div class="col-sm">
                                            <label>Select THC NO</label>
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" name="boththc" id="boththc"  list="thc-list1" class="form-control" required>
                                            <datalist id="thc-list1"></datalist>
                                        </div>
                                        <div class="col-sm">
                                            <label>Select Date</label>
                                        </div>
                                        <div class="col-sm">
                                            <input type='date' name='dbilldate' id="dbilldate1"class="form-control" required>
                                        </div>
                                        <div class="col-sm">
                                            <input type="submit" name="bothno" id="bothno" onclick="showDRSTHCTables()" value="Next" class="btn btn-outline-dark btn-fw ">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="table-container" id="DRStable">
                           <table class="invtab" id='table1' style="display:none;" cellpadding='4' border='1'>
                            <tr>
                                <td style="width: 100%;" >
                                    <strong>Total ToPay :</strong>
                                </td>
                                <td id="resultCell"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;" >
                                    <strong>Total LR Hamali :</strong>
                                </td>
                                <td id="resultCell1"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;" >
                                    <strong>Total Qty :</strong>
                                </td>
                                <td id="resultCell2"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;" >
                                    <strong>Freight :</strong>
                                </td>
                                <td id="resultCell3"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Advance :</strong>
                                </td>
                                <td  id="resultCell4"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;" >
                                    <strong>Remaining Freight:</strong>
                                </td>
                                <td id="resultCell5"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="table-container" id="THCtable">
                        <table  class="invtab" id='table2' style="display:none;" cellpadding='4' border='1'>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Advance</strong>
                                </td>
                                <td  id="resultCellthc"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Extra Charges</strong>
                                </td>
                                <td  id="resultCellthc1"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Other Charges</strong>
                                </td>
                                <td  id="resultCellthc2"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Updated Hamali</strong>
                                </td>
                                <td id="resultCellthc3"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Remaining</strong>
                                </td>
                                <td id="resultCellthc4"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="table-container">
                        <table class="invtab"  id='table3' style="display:none;" cellpadding='4' border='1'>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Total ToPay</strong>
                                </td>
                                <td id="bothdr"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Total LR Hamali(DRS)</strong>
                                </td>
                                <td id="bothdr1"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Updated Hamali(THC)</strong>
                                </td>
                                <td id="bothdr2"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Total Qty</strong>
                                </td>
                                <td id="bothdr3"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Freight</strong>
                                </td>
                                <td id="bothdr4"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Advance(DRS)</strong>
                                </td>
                                <td id="bothdr5"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Advance(THC)</strong>
                                </td>
                                <td id="bothdr6"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Extra Charges</strong>
                                </td>
                                <td id="bothdr7"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Other Charges</strong>
                                </td>
                                <td id="bothdr8"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Remaining Freight</strong>
                                </td>
                                <td id="bothdr9"></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;">
                                    <strong>Remaining Amount(THC)</strong>
                                </td>
                                <td id="bothdr10"></td>
                            </tr>
                        </table>
                    </div>
                    <form method="post" id="Depodata">
                        <div class="table-container">
                            <input type="hidden" id="drsNo" name="drsNo" class="form-control" >
                            <input type="hidden" id="thcNo" name="thcNo" class="form-control" >
                            <input type="hidden" id="thcdepo" name="thcdepo" class="form-control" >
                            <input type="hidden" id="drsdepo" name="drsdepo" class="form-control" >
                            <table class="invtab" border="1" id='dexp'style=" overflow:auto;display: none;">
                                <tr >
                                    <th>Depo</th>
                                    <th>Petrol Pump Name</th>
                                    <th>Bill No.</th>
                                    <th>Bill Date</th>
                                    <th>Diesel(Qty in Ltr)</th>
                                    <th>Diesel Rate(Rate/Ltr)</th>
                                    <th>Amount</th>
                                    <th>By Card/Cash</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr >
                                    <td>
                                        <select name='dplace[]' class="form-control" required>
                                            <option value='PNA'>PNA-PUNE</option>
                                            <option value='NSK'>NSK-NASHIK</option>
                                            <option value='AKL'>AKL-AKOLA</option>
                                            <option value='AUR'>AUR-AURANGABAD</option>
                                            <option value='SHV'>SHV-SHIVARI</option>
                                            <option value='ISL'>ISL-ISLAMPUR</option>
                                            <option value='SOL'>SOL-SOLAPUR</option>
                                            <option value='SGL'>SGL-SANGLI</option>
                                            <option value='ANK'>ANK-ANKLESHWAR</option>
                                            <option value='ASL'>ASL-ASLALI</option>
                                            <option value='BEL'>BEL-BELLARY</option>
                                            <option value='BNH'>BNH-BANGLORE</option>
                                            <option value='BRD'>BRD-BARODA</option>
                                            <option value='HYD'>HYD-HYDERABAD</option>
                                            <option value='IND'>IND-INDORE</option>
                                            <option value='NAG'>NAG-NAGPUR</option>
                                            <option value='JNPT'>JNPT-NAVA-SHIVA</option>
                                            <option value='TRI'>TRI-TRICHY</option>
                                            <option value='OZAR'>OZAR-OZAR</option>
                                            <option value='DHI'>DHI-DHULE</option>
                                            <option value='NAN'>NAN-NANDED</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="dppname" style="height:50px;" name="dppname[]" class="form-control">
                                            <option value="1" required>SELECT PETROLPUMP</option>
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
                                    </td>
                                    <td>
                                        <input type='text' name='dbillno[]' class="form-control" >
                                    </td>
                                    <td>
                                        <input type='date' name='dbilldate[]' id="dbilldate1"class="form-control">
                                    </td>
                                    <td>
                                        <input type='number' step='0.01' name='dqty[]' onchange="calamt('dexp')" class="form-control"
                                        required>
                                    </td>
                                    <td>
                                        <input type='number' step='0.01' name='drate[]' onchange="calamt('dexp')" class="form-control"
                                        required>
                                    </td>
                                    <td>
                                        <input type='number' step='0.01' name='damount[]' class="form-control" readonly>
                                    </td>
                                    <td>
                                        <select name='dpaytype[]' class="form-control" required>
                                            <option value='Cash'>Cash</option>
                                            <option value='Diesel Card'>Diesel Card</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type='text' name='dremark[]' class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=4 align='right'>Total</td>
                                    <td>
                                        <input type='text' id='dtltr' name='dtltr' class="form-control" readonly>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input type='text' id='dtamount' name='dtamount' class="form-control" readonly>
                                    </td>
                                    <td colspan=2>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <input type="submit" name="submit" id="Submittripsheet" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                            <input type="submit" name="submit" id="Submittripsheet1" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                            <input type="submit" name="submit" id="Submittripsheet2" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                        </div>
                    </form>
                    <form action="post" id="nature">
                        <div class="table-container1" style="overflow-x: auto;">
                            <input type="hidden" id="drsdepo1" name="drsdepo1" class="form-control" readonly >
                            <input type="hidden" id="thcdepo1" name="thcdepo1" class="form-control" readonly >
                            <input type="hidden" id="thcdeponew" name="thcdeponew" class="form-control" readonly >
                            <input type="hidden" id="drsdeponew" name="drsdeponew" class="form-control" readonly >
                            <table id="enrexp" border="1" class="invtab" style="display:none;">
                                <tbody>
                                    <tr>
                                        <th>Nature of Expenses</th>
                                        <th>Amount Spent</th>
                                        <th>Bill No.</th>
                                        <th>Bill Date</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr id="row1">
                                        <td>
                                            <select name="expnature[]" class="form-control">
                                              <option value=''>Select Expenses</option>
                                              <option value='Permit'>Permit</option>
                                              <option value='Border/Check Post'>Border/Check Post</option>
                                              <option value='Toll'>Toll</option>
                                              <option value='Sales Tax seal'>Sales Tax seal</option>
                                              <option value='Escorts'> Escorts</option>
                                              <option value='Octroi(if Paid)'>Octroi(if Paid)</option>
                                              <option value='Loading'>Loading</option>
                                              <option value='Unloading'>Unloading</option>
                                              <option value='Enroute Repairs'>Enroute Repairs</option>
                                              <option value='Penalty(if any)'>Penalty(if any)</option>
                                              <option value='Tyre Puncture(if any)'>Tyre Puncture(if any)</option>
                                              <option value='Weigh Bridge Expenses'>Weigh Bridge Expenses</option>
                                              <option value='Parking(if any)'>Parking(if any)</option>
                                              <option value='Telephone'>Telephone</option>
                                              <option value='Temporary Permit(if any)'>Temporary Permit(if any)</option>
                                              <option value='Driver Daily Allowance'>Driver Daily Allowance</option>
                                              <option value='Incentive Payable'>Incentive Payable</option>
                                              <option value='Other Expense'>Other Expense</option>
                                              <option value='Holding'>Holding</option>
                                              <option value='Broker Commission'>Broker Commission</option>
                                              <option value='Drivers Salary Owned Vehicle'>Drivers Salary Owned Vehicle
                                              </option>
                                              <option value='Contract Amount'>Contract Amount</option>
                                              <option value='POD Upload'>POD Upload</option>
                                          </select>
                                      </td>
                                      <td>
                                        <input type="number" step="0.01" name="expamount[]" class="form-control"  onchange="calinvamt()" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                                    </td>
                                    <td>
                                        <input type="text" name="billno[]" class="form-control" value="">
                                    </td>
                                    <td>
                                        <input type="date" id="invdate" name="billdate[]" value="" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="expremark[]" class="form-control" value="">
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-outline-dark btn-fw" onclick="add_row()" value='Add Row'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Total</td>
                                    <td>
                                        <input type="text" id="examount" name="examount" class="form-control" readonly="">
                                    </td>                                
                                    <td colspan="4"></td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" name="submit" id="Submitnaturexp" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                        <input type="submit" name="submit" id="Submitnaturexp1" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                        <input type="submit" name="submit" id="Submitnaturexp2" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                    </div>
                </form>
                <br>
                <form action="post" id="place">
                    <div class="table-responsive text-nowrap">
                        <input type="hidden" id="drsdept" name="drsdept" class="form-control" readonly >
                        <input type="hidden" id="thcdept" name="thcdept" class="form-control" readonly >
                        <input type="hidden" id="thcdepo2" name="thcdepo2" class="form-control" readonly >
                        <input type="hidden" id="drsdepo2" name="drsdepo2" class="form-control" readonly >
                        <table id="endexp" border="1" class="invtab" style="display:none;">
                            <tbody>
                                <tr style="background-color: #2c2d5854;">
                                    <th>Place</th>
                                    <th>Petrol Pump Name</th>
                                    <th>Bill No.</th>
                                    <th>Bill Date</th>
                                    <th>Diesel(Qty in Ltr)</th>
                                    <th>Diesel Rate(Rate/Ltr)</th>
                                    <th>Amount</th>
                                    <th>By Card/Cash</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
                                  <tr >
                                    <td>
                                        <select name='dplace[]' class="form-control" required>
                                            <option value='PNA'>PNA-PUNE</option>
                                            <option value='NSK'>NSK-NASHIK</option>
                                            <option value='AKL'>AKL-AKOLA</option>
                                            <option value='AUR'>AUR-AURANGABAD</option>
                                            <option value='SHV'>SHV-SHIVARI</option>
                                            <option value='ISL'>ISL-ISLAMPUR</option>
                                            <option value='SOL'>SOL-SOLAPUR</option>
                                            <option value='SGL'>SGL-SANGLI</option>
                                            <option value='ANK'>ANK-ANKLESHWAR</option>
                                            <option value='ASL'>ASL-ASLALI</option>
                                            <option value='BEL'>BEL-BELLARY</option>
                                            <option value='BNH'>BNH-BANGLORE</option>
                                            <option value='BRD'>BRD-BARODA</option>
                                            <option value='HYD'>HYD-HYDERABAD</option>
                                            <option value='IND'>IND-INDORE</option>
                                            <option value='NAG'>NAG-NAGPUR</option>
                                            <option value='JNPT'>JNPT-NAVA-SHIVA</option>
                                            <option value='TRI'>TRI-TRICHY</option>
                                            <option value='OZAR'>OZAR-OZAR</option>
                                            <option value='DHI'>DHI-DHULE</option>
                                            <option value='NAN'>NAN-NANDED</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="dppname" style="height:50px;" name="dppname[]" class="form-control">
                                            <option value="1" required>SELECT PETROLPUMP</option>
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
                                    </td>
                                    <td>
                                        <input type='text' name='dbillno[]' class="form-control" >
                                    </td>
                                    <td>
                                        <input type='date' name='dbilldate[]' id="dbilldate1"class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="dqty2[]" id="dqty2" class="form-control"  onchange="calinvamt1()" required>
                                    </td>
                                    <td>
                                        <input type='number' step='0.01' name='drate[]' onchange="calamt('dexp')" class="form-control"
                                        required>
                                    </td>
                                    <td>
                                        <input type='text' step='0.01' name='damount1[]' id="damount1" class="form-control"  onchange="calinvamt2()" required>
                                    </td>
                                    <td>
                                        <select name='dpaytype[]' class="form-control" required>
                                            <option value='Cash'>Cash</option>
                                            <option value='Diesel Card'>Diesel Card</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type='text' name='dremark[]' class="form-control" required>
                                    </td>
                                </tr>

                                <td colspan="4" align="right">Total</td>
                                <td>
                                    <input type="text" id="dtltr2" name="endtltr"  class="form-control" readonly>
                                </td>
                                <td></td>
                                <td>
                                    <input type="text" id="dtamount1" name="endtamount" class="form-control" readonly>
                                </td>
                                <td colspan="2">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" name="submit" id="Submitplace" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                    <input type="submit" name="submit" id="Submitplace1" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                    <input type="submit" name="submit" id="Submitplace2" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
                </div>
            </form>
            <br>
            <form method="post" id="Reading">
                <input type="hidden" id="thcdepot" name="thcdepot" class="form-control" readonly >
                <input type="hidden" id="drsdepot" name="drsdepot" class="form-control" readonly >
                <input type="hidden" id="thcdepo3" name="thcdepo3" class="form-control" readonly >
                <input type="hidden" id="drsdepo3" name="drsdepo3" class="form-control" readonly >
                <div class="form-group" id="Meter" style="display:none;" >
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Meter Reading</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="mreading"  class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group" id="Rating" style="display:none;">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Driver Rating</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="driver" class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <table id="driver" border="1" class="invtab" style="display:none;">
                    <tbody>
                        <tr style="background-color: #b0d3e8;">
                            <th>Driver ID</th>
                            <th>Driver Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>
                              <input type='text' name='driverid' class="form-control" required>  
                          </td>
                          <td>
                              <input type='text' name='drivername' class="form-control" required>  
                          </td>
                          <td>
                            <input type='date' name='dbilldate' id="dbilldate1"class="form-control">
                        </td>
                        <td>
                            <input type='text' name='status' class="form-control" required>  
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="form-group" id="Penaltydata" style="display:none;">
                <div class="row">
                    <div class="col-sm-2">
                        <label>Penalty</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="Penalty" id="Penalty" class="form-control" value="0" >
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group" id="Remarkdata" style="display:none;">
                <div class="row">
                    <div class="col-sm-2">
                        <label>Remark</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="Remark" id="Remark" class="form-control" value="" >

                    </div>
                </div>
            </div>
            <br>
            <input type="submit" name="submit" id="Submitdriverdata" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
            <input type="submit" name="submit" id="Submitdriverdata1" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
            <input type="submit" name="submit" id="Submitdriverdata2" value="Submit" class="btn btn-outline-dark btn-fw" style="display: none;">
        </form>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   function getcurrentdate(){
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth()+1).padStart(2,'0');
    const day = String (now.getDate()).padStart(2,'0');
    return `${year}-${month}-${day}`;
}
document.getElementById('dbilldate1').value=getcurrentdate();
function showDiv(divId) {
    var divToShow = document.getElementById(divId);
    var allDivs = document.querySelectorAll('.contentDiv');
    for (var i = 0; i < allDivs.length; i++) {
        allDivs[i].style.display = 'none';
    }
    divToShow.style.display = 'block';
}
</script>
<script>
  function showDRSTables() {
    var tables = document.querySelectorAll('.table-container table');
    var btn = document.getElementById('Submittripsheet');
    var drsno = document.getElementById('drs').value;


    tables.forEach(function (table) {
        table.style.display = 'none';
    });

    var table1 = document.getElementById('table1');
    var table2 = document.getElementById('table2');
    var table4 = document.getElementById('dexp');
    table1.style.display = 'block';
    table4.style.display = 'block';
    table2.style.display = 'none';
    btn.style.display = 'block';
    document.getElementById('drsdepo').value=drsno;

}
$("#DRSNext").click(function () {
    let form = document.getElementById("drsnext");
    let fd = new FormData(form);
    var table1 = document.getElementById('table1');
    var table4 = document.getElementById('dexp');

    $.ajax({
        url: base_url + "DRSNext",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (response) {
            try {
                if (response.error) {
                    errorToster(response.error);
                } else {
                    var myObj = response.data;
                    console.log(myObj);

                    if (myObj) {
                        successToster('DRSNext data retrieved successfully');
                        var resultCell = document.getElementById('resultCell');
                        resultCell.innerHTML = myObj.ToPay;
                        var resultCell1 = document.getElementById('resultCell1');
                        resultCell1.innerHTML = myObj.LRHamali;
                        var resultCell2 = document.getElementById('resultCell2');
                        resultCell2.innerHTML = myObj.Qty;
                        var resultCell3 = document.getElementById('resultCell3');
                        resultCell3.innerHTML = myObj.FreightCharge;
                        var resultCell4 = document.getElementById('resultCell4');
                        resultCell4.innerHTML = myObj.Advance;
                        var resultCell5 = document.getElementById('resultCell5');
                        resultCell5.innerHTML = myObj.BalanceFreight;
                    } else {
                        errorToster('DRSNO not found');
                    }
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                errorToster('Error parsing server response');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Ajax request failed:", textStatus, errorThrown);
            errorToster('Ajax request failed');
        }
    });
});

</script>
<script>
    function showTHCTables() {
        var tables = document.querySelectorAll('.table-container table');
        var btn = document.getElementById('Submittripsheet1');
        var thcno = document.getElementById('thc').value;


        tables.forEach(function(table) {
            table.style.display = 'none';
        });

        var table1 = document.getElementById('table1');
        var table2 = document.getElementById('table2');
        var table4 = document.getElementById('dexp');
        table1.style.display = 'none';
        table2.style.display = 'block';
        table4.style.display = 'block';
        btn.style.display = 'block';
        document.getElementById('thcdepo').value=thcno;

    }

    $("#THCNext").click(function () {
        let form = document.getElementById("thcnext");
        let fd = new FormData(form);
        var table2 = document.getElementById('table2');
        var table4 = document.getElementById('dexp');

        $.ajax({
            url: base_url + "THCNext",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (response) {
                try {
                    if (response.error) {
                        errorToster(response.error);
                    } else {
                        var myObj = response.data;
                        console.log(myObj);

                        if (myObj) {
                            successToster('THC data retrieved successfully');
                            var resultCellthc = document.getElementById('resultCellthc');
                            resultCellthc.innerHTML = myObj.ClosingKM;
                            var resultCellthc1 = document.getElementById('resultCellthc1');
                            resultCellthc1.innerHTML = myObj.Rate;
                            var resultCellthc2 = document.getElementById('resultCellthc2');
                            resultCellthc2.innerHTML = myObj.dieselamt;
                            var resultCellthc3 = document.getElementById('resultCellthc3');
                            resultCellthc3.innerHTML = myObj.liter;
                            var resultCellthc4 = document.getElementById('resultCellthc4');
                            resultCellthc4.innerHTML = myObj.mreading;
                        } else {
                            errorToster('THC not found');
                        }
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    errorToster('Error parsing server response');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Ajax request failed:", textStatus, errorThrown);
                errorToster('Ajax request failed');
            }
        });
    });
</script>
<script>
    function showDRSTHCTables() {
        var tables = document.querySelectorAll('.table-container table');
        tables.forEach(function(table) {
            table.style.display = 'none';
        });

        var table1 = document.getElementById('table1');
        var table2 = document.getElementById('table2');
        var table3 = document.getElementById('table3');
        var table4 = document.getElementById('dexp');
        table1.style.display = 'none';
        table2.style.display = 'none';
        table4.style.display = 'block';
        table3.style.display = 'block';
    }

    $("#bothno").click(function () {
        let form = document.getElementById("DRSTHCdata");
        let fd = new FormData(form);
        var drsno = document.getElementById('bothdrs').value;
        alert(drsno);
        var thcno = document.getElementById('boththc').value;
        alert(thcno);

        $.ajax({
            url: base_url + "showDRSTHCTables",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json', 
            success: function (response) {
                console.log(response);
                try {
                    if (response) {
                        console.log(response);
                        document.getElementById('bothdr').innerHTML = response.ToPay;
                        document.getElementById('bothdr1').innerHTML = response.LRHamali;
                        document.getElementById('bothdr2').innerHTML = response.LRHamali;
                        document.getElementById('bothdr3').innerHTML = response.THCArrivalHvendor;
                        document.getElementById('bothdr4').innerHTML = response.ExtraDeliveryCharge;
                        document.getElementById('bothdr5').innerHTML = response.Advance;
                        document.getElementById('bothdr6').innerHTML = response.Advance;
                        document.getElementById('bothdr7').innerHTML = response.FreightCharge;
                        document.getElementById('bothdr8').innerHTML = response.OtherCharges;
                        document.getElementById('bothdr9').innerHTML = response.ToPay;
                        document.getElementById('bothdr10').innerHTML = response.ToPay;
                        $("#Submittripsheet2").show();
                        document.getElementById('drsNo').value=drsno;
                        document.getElementById('thcNo').value=thcno;
                        successToster('THC data retrieved successfully');
                    } else {
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    errorToster('Error parsing server response');
                }
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Ajax request failed:", textStatus, errorThrown);
                errorToster('Ajax request failed');
            }
        });
    });

</script>
<script type="text/javascript">
 var lastrowid = 1;
 function calamt(tableid) {
    var qty;
    var rate;
    var amount;
    if (tableid == 'dexp') {
        qty = document.getElementsByName('dqty[]');
        rate = document.getElementsByName('drate[]');
        amount = document.getElementsByName('damount[]');
    }
    if (tableid == 'endexp') {
        qty = document.getElementsByName('endqty[]');
        rate = document.getElementsByName('endrate[]');
        amount = document.getElementsByName('endamount[]');
    }
    for (var i = 0, iLen = amount.length; i < iLen; i++)
        amount[i].value = qty[i].value * rate[i].value;
    caltotal(tableid);
}



</script>
<script type="text/javascript">
   var lastrowid = 1; 
   function add_row() {
    if ($("#enrexp tr").length > 8) {
      alert("Cannot add more than 7 rows.");
      return;
  }

  lastrowid = lastrowid + 1;
  var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
  htmltxt = htmltxt.replace("invdate1", "invdate" + lastrowid);
  $("#enrexp tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' class='btn btn-outline-dark btn-fw' onclick=delete_row('row" + lastrowid + "','enrexp')></td></tr>");

  $(function () {
      $("#invdate" + lastrowid).datepicker({dateFormat: "dd/mm/yy"});
  });

}
function delete_row(rowno) {
  $('#' + rowno).remove();
  calinvamt();
}

var lastrowid = 1;
function calamt(tableid) {
    var qty;
    var rate;
    var amount;
    if (tableid == 'dexp') {
        qty = document.getElementsByName('dqty[]');
        rate = document.getElementsByName('drate[]');
        amount = document.getElementsByName('damount[]');
    }
    if (tableid == 'endexp') {
        qty = document.getElementsByName('endqty[]');
        rate = document.getElementsByName('endrate[]');
        amount = document.getElementsByName('endamount[]');
    }
    for (var i = 0, iLen = amount.length; i < iLen; i++)
        amount[i].value = qty[i].value * rate[i].value;
    caltotal(tableid);
}

function caltotal(tableid) {
    var t = 0;
    var t1 = 0;

    switch (tableid) {
    case 'enrexp':
        var amount = document.getElementsByName('expamount[]');
        for (var i = 0, iLen = amount.length; i < iLen; i++) {
            if (amount[i].value != "")
                t += parseFloat(amount[i].value);
        }
        document.getElementById("examount").value = t;
        break;

    case 'dexp':
        var dqty = document.getElementsByName('dqty[]');
        var damount = document.getElementsByName('damount[]');
        for (var i = 0, iLen = dqty.length; i < iLen; i++) {
            if (dqty[i].value != "")
                t += parseFloat(dqty[i].value);
            if (damount[i].value != "")
                t1 += parseFloat(damount[i].value);
        }
        document.getElementById("dtltr").value = t;
        document.getElementById("dtamount").value = t1;
        break;

    case 'endexp':
        var endqty = document.getElementsByName('endqty[]');
        var endamount = document.getElementsByName('endamount[]');
        for (var i = 0, iLen = endqty.length; i < iLen; i++) {
            if (endqty[i].value != "")
                t += parseFloat(endqty[i].value);
            if (endamount[i].value != "")
                t1 += parseFloat(endamount[i].value);
        }
        document.getElementById("endtltr").value = t;
        document.getElementById("endtamount").value = t1;
        break;
    }
}

function calinvamt() {
  var tinvamt = 0;
  var invamt = document.getElementsByName('expamount[]');
  
  for (var i = 0, iLen = invamt.length; i < iLen; i++)
    if (invamt[i].value != "")
      tinvamt += parseFloat(invamt[i].value);
  document.getElementById("examount").value = tinvamt;
}

function calinvamt1() {
  var invamt1 = document.getElementsByName('dqty2[]');
  var tinvamt = 0;

  for (var i = 0, iLen = invamt1.length; i < iLen; i++) {
    if (invamt1[i].value !== "") {
      tinvamt += parseFloat(invamt1[i].value);
  }
}

document.getElementById("dtltr2").value = tinvamt;
}

var inputs = document.getElementsByName('dqty2[]');
for (var i = 0; i < inputs.length; i++) {
  inputs[i].addEventListener('change', calinvamt1);
}

function calinvamt2() {
  var invamt2 = document.getElementsByName('damount1[]');
  var tinvamt = 0;

  for (var i = 0, iLen = invamt2.length; i < iLen; i++) {
    if (invamt2[i].value !== "") {
      tinvamt += parseFloat(invamt2[i].value);
  }
}

document.getElementById("dtamount1").value = tinvamt;
}

var inputs = document.getElementsByName('dqty2[]');
for (var i = 0; i < inputs.length; i++) {
  inputs[i].addEventListener('change', calinvamt1);
}


</script>

<script type="text/javascript">
   $(document).ready(function() {
    var searchInput = $('#drs');
    var searchResultsList = $('#drs-list');

    searchInput.on('keyup', function() {
      var keyword = searchInput.val().trim();

      if (keyword !== '') {
        $.ajax({
          url: '<?php echo site_url('DRSsearch'); ?>',
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

   $(document).ready(function() {
    var searchInput = $('#bothdrs');
    var searchResultsList = $('#drs-list1');

    searchInput.on('keyup', function() {
      var keyword = searchInput.val().trim();

      if (keyword !== '') {
        $.ajax({
          url: '<?php echo site_url('DRSsearch1'); ?>',
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

   $(document).ready(function() {
    var searchInput = $('#thc');
    var searchResultsList = $('#thc-list');

    searchInput.on('keyup', function() {
      var keyword = searchInput.val().trim();

      if (keyword !== '') {
        $.ajax({
            url: '<?php echo site_url('THCsearch'); ?>',
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
   $(document).ready(function() {
    var searchInput = $('#boththc');
    var searchResultsList = $('#thc-list1');

    searchInput.on('keyup', function() {
      var keyword = searchInput.val().trim();

      if (keyword !== '') {
        $.ajax({
            url: '<?php echo site_url('THCsearch1'); ?>',
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
<script type="text/javascript">
    $( "#Submittripsheet" ).click(function() {
        let form = document.getElementById("Depodata");
        let fd = new FormData(form);
        var drsno1 = document.getElementById('drsdepo').value;
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submittripsheet",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Depo data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#Submittripsheet").hide();
                    $("#Submitnaturexp").show();
                    document.getElementById('drsdepo1').value=drsno1;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                   errorToster('Depo data inserted');
               }
           }
       });
    });

    $( "#Submittripsheet1" ).click(function() {
        let form = document.getElementById("Depodata");
        let fd = new FormData(form);
        var thcno1 = document.getElementById('thcdepo').value;
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submittripsheet1",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Depothc data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#Submittripsheet1").hide();
                    $("#Submitnaturexp1").show();
                    document.getElementById('thcdepo1').value=thcno1;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                   errorToster('Depothc data inserted');
               }
           }
       });
    });

    $( "#Submittripsheet2" ).click(function() {
        let form = document.getElementById("Depodata");
        let fd = new FormData(form);
        var drsno = document.getElementById('drsNo').value;
        var thcno = document.getElementById('thcNo').value;

        

        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submittripsheet2",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Depothc data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#Submittripsheet2").hide();
                    $("#Submitnaturexp2").show();
                    document.getElementById('thcdeponew').value=thcno;
                    document.getElementById('drsdeponew').value=drsno;
                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                   errorToster('Depothc data inserted');
               }
           }
       });
    });


    $( "#Submitnaturexp" ).click(function() {
        let form = document.getElementById("nature");
        let fd = new FormData(form);
        var drsno2 = document.getElementById('drsdepo1').value;
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitnaturexp",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Nature of expenses data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#Submittripsheet").hide();
                    $("#Submitnaturexp").hide();
                    $("#Submitplace").show();
                    document.getElementById('drsdepo2').value=drsno2;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Nature of expenses data not inserted');
                }
            }
        });
    });

    $( "#Submitnaturexp1" ).click(function() {
        let form = document.getElementById("nature");
        let fd = new FormData(form);
        var thcno2 = document.getElementById('thcdepo1').value;
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitnaturexp1",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Nature of expenses data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#Submittripsheet1").hide();
                    $("#Submitnaturexp1").hide();
                    $("#Submitplace1").show();
                    document.getElementById('thcdepo2').value=thcno2;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Nature of expenses data not inserted');
                }
            }
        });
    });


    $( "#Submitnaturexp2" ).click(function() {
        let form = document.getElementById("nature");
        let fd = new FormData(form);
        var THC = document.getElementById('thcdeponew').value;
        var DRS = document.getElementById('drsdeponew').value;

        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitnaturexp2",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Nature of expenses data inserted sucessfully');
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#Submittripsheet2").hide();
                    $("#Submitnaturexp2").hide();
                    $("#Submitplace2").show();
                    document.getElementById('drsdept').value=DRS;
                    document.getElementById('thcdept').value=THC;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Nature of expenses data not inserted');
                }
            }
        });
    });



    $( "#Submitplace" ).click(function() {
        let form = document.getElementById("place");
        let fd = new FormData(form);
        var drsno3 = document.getElementById('drsdepo2').value;

        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitplace",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Place data inserted sucessfully');
                    $("#Submittripsheet").hide();
                    $("#Submitnaturexp").hide();
                    $("#Submitplace").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata").show();
                    document.getElementById('drsdepo3').value=drsno3;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Place data not inserted');
                }
            }
        });
    });

    $( "#Submitplace1" ).click(function() {
        let form = document.getElementById("place");
        let fd = new FormData(form);
        var thcno3 = document.getElementById('thcdepo2').value;

        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitplace1",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Place data inserted sucessfully');
                    $("#Submittripsheet1").hide();
                    $("#Submitnaturexp1").hide();
                    $("#Submitplace1").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata1").show();
                    document.getElementById('thcdepo3').value=thcno3;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Place data not inserted');
                }
            }
        });
    });

    $( "#Submitplace2" ).click(function() {
        let form = document.getElementById("place");
        let fd = new FormData(form);
        var thcno3 = document.getElementById('thcdeponew').value;
        var drsno3 = document.getElementById('drsdeponew').value;


        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitplace2",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Place data inserted sucessfully');
                    $("#Submittripsheet2").hide();
                    $("#Submitnaturexp2").hide();
                    $("#Submitplace2").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata2").show();
                    document.getElementById('drsdept').value=drsno3;
                    document.getElementById('thcdept').value=thcno3;

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Place data not inserted');
                }
            }
        });
    });


    $( "#Submitdriverdata" ).click(function() {
        let form = document.getElementById("Reading");
        let fd = new FormData(form);


        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitdriverdata",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Driver data inserted sucessfully');
                    $("#Submittripsheet").hide();
                    $("#Submitnaturexp").hide();
                    $("#Submitplace").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata").show();

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Driver data not inserted');
                }
            }
        });
    });


    $( "#Submitdriverdata1" ).click(function() {
        let form = document.getElementById("Reading");
        let fd = new FormData(form);


        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitdriverdata1",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Driver data inserted sucessfully');
                    $("#Submittripsheet1").hide();
                    $("#Submitnaturexp1").hide();
                    $("#Submitplace1").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata1").show();

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Driver data not inserted');
                }
            }
        });
    });

    $( "#Submitdriverdata2" ).click(function() {
        let form = document.getElementById("Reading");
        let fd = new FormData(form);


        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Submitdriverdata2",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('Driver data inserted sucessfully');
                    $("#Submittripsheet2").hide();
                    $("#Submitnaturexp2").hide();
                    $("#Submitplace2").hide();
                    $("#Meter").show();
                    $("#Rating").show();
                    $("#Penaltydata").show();
                    $("#Remarkdata").show();
                    $("#Depodata").show();
                    $("#enrexp").show();
                    $("#endexp").show();
                    $("#driver").show();
                    $("#Submitdriverdata1").show();

                    setTimeout(function(){
                        console.log(data);
                    }, 2000);
                } else {
                    errorToster('Driver data not inserted');
                }
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


