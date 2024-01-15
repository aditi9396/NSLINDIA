<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<style>
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
  

</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">LR ENTRY</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">EXCEL LR</li>
                </ol>
            </nav>
        </div>
        <a  href="Exceldownload">
          <input type="button" class="btn btn-gradient-dark btn-fw" value="EXCEL DOWNLOAD"></a>
          <br>
      </br>
          <form  class="form-sample" method="post" id="formLR" name='formLR' enctype='multipart/form-data' action="">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card" >
                        <div class="card-body">
                            <div  id="step0">
                                <div class="row">
                                    <div class="col-sm">
                                        <label>LR DATE:</label>
                                        <input class="form-control" type="date" name="lrdate" id="lrdate" size="10">
                                    </div>
                                    <div class="col-sm">
                                        <label for="paytype">PAYMENT TYPE:</label>
                                        <select id="paytype" style="padding: 3%;" class="form-control" name="paytype" onchange="paytypechange()" required>
                                            <option value="" selected>SELECT OPTION</option>
                                            <option value="TBB">TBB</option>
                                            <option value="PAID">PAID</option>
                                            <option value="TO PAY">TO PAY</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <label>CONTRACT PARTY:</label>
                                        <input type="text" class="form-control" id="partyid" name="partyid" style="text-transform: uppercase" value="" list="partyid-list" onchange="updateContract()" required>
                                        <datalist id="partyid-list">
                                        </datalist>
                                        -
                                        <input type="text" class="form-control" id="partyname" style="text-transform: uppercase;" name="partyname" value="" />
                                    </div>
                                    <div class="col-sm">
                                        <label>ORIGIN:</label>
                                        <?php echo $user->Depot; ?>
                                    </div>
                                    <div class="col-sm">
                                        <label>DISTINATION:</label>
                                        <?php echo $user->Depot; ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <input type="button" class="btn btn-gradient-dark btn-fw" onclick="step1click()" id="btnstep1"  value="Step 1">
                            <div id="step1" style="display: none;" >
                                <div class="row" >
                                    <div class="col-sm">
                                        <label>MODE OF TRANSPORT:</label>
                                        <select class="form-control" id='mot' name='mot' style="padding:4%;">
                                            <option value='REGULAR'>REGULAR</option>
                                            <option value="URGENT">URGENT</option>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                        <label>SERVICE TYPE:</label>
                                        <select  class="form-control" id='servicetype' name='servicetype' style="padding:4%;">
                                            <option value='LTL'>LTL</option>
                                            <option value="FTL">FTL</option>
                                            <option value="FCL">FCL</option>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                      <label>TYPE OF MOVEMENT
                                      </label> 
                                      <input  class="form-control" type="text" class="w-50" id="tomove" name="tomove"  value="Road" readonly>
                                  </div>
                              </div>
                              <br>
                              <br>
                              <div class="row justify-content-center">
                                <div class="col">
                                    <label >Pickup/Delivery:</label>
                                    <select id='pickdeli' class="form-control" name='pickdeli' style="padding:4%;">
                                        <option value='DoorPickupDoorDelivery'>Door Pickup - Door Delivery</option>
                                        <option value="DoorPickupGodownDelivery">Door Pickup - Godown Delivery</option>
                                        <option value="GodownPickupDoorDelivery">Godown Pickup - Door Delivery</option>
                                        <option value="GodownPickupGodownDelivery">Godown Pickup - Godown Delivery</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label >FROM CITY:</label><br>
                                    <input class="form-control" type="text" id="fromcity" name="fromcity" style='text-transform:uppercase'
                                    value='<?php echo $user->Depot; ?>'>
                                </div>
                                <div class="col">
                                    <label >File Upload:</label><br>
                                   <!--  <input type="hidden" class="form-control"  id="district" list="District-list" name="district" style='text-transform:uppercase'>
                                    <datalist id="District-list"></datalist> -->
                                    <input type="file" class ="form-control" id="excel_file" name="excel_file">
                                </div>
                            </div>
                            <br>
                            <br>
                            <input type="button" class="btn btn-gradient-dark btn-fw" id="btnstep2" onclick="step2click()" value="Step 2">
                        </div>

                        <div id="step2" style="display: none;">
                            <div class="row">
                                <div class="col">
                                    <div></div>
                                    <label>Consignor</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div></div>
                                <div class="col">
                                    <label>
                                        <input type='radio' value='From Master' onclick="radclick('crfm')"
                                        checked>From Master</label>
                                    </div>
                                    <div class="col">
                                        <label>
                                            <input type='radio' name='Consignorfrom' id="walkInRadio" value='Walk-In'
                                            onclick="radclick('crwi')">Walk-In
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <label>From Master</label>
                                        <input type="text" id='FMConsignor' class="form-control" name='FMConsignor' size="10"
                                        value="<?php if (isset($ConID)) echo $ConID; ?>">-<input type="text" class="form-control"
                                        id='FMConsignorName'
                                        name='FMConsignorName'
                                        value="<?php if (isset($CustName)) echo $CustName; ?>"
                                        disabled>
                                    </div>
                                    <div class="col">
                                        <input type="text" id='WIConsignor' class="form-control" name='FMConsignor' required disabled>
                                    </div><br>
                                </div><br>
                                <div class="row">
                                   <div class="col-md-6">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id='WIConsignoradd' class="form-control" name='WIConsignoradd' style='text-transform:uppercase'
                                    required disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">Mobile No</div>
                                <div class="col-md-6">
                                    <input type="text" id='WIConsignormob' class="form-control" name='WIConsignormob' onkeypress="return validateNumber(event)" maxlength="10" required
                                    disabled>
                                </div>
                            </div>
                            <div>
                                <div class="">
                                  <div class="row">
                                    <div class="col">
                                        <div></div>
                                        <label>Consignee</label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div></div>
                                    <div class="col">
                                        <label>
                                            <input type='radio' name='Consigneefrom' value='From Master' onclick="radclick('cefm')"
                                            checked>From Master</label>
                                        </div>
                                        <div class="col">
                                            <label>
                                                <input type='radio' name='Consigneefrom' value='Walk-In'
                                                onclick="radclick('cewi')">Walk-In
                                            </label>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6 d-flex">
                                            <label>From Master</label>
                                            <input type="text" id='FMConsignee' class="form-control" name='FMConsignee' size="10"
                                            value="<?php if (isset($ConID)) echo $ConID; ?>">-<input type="text"
                                            id='FMConsigneeName' name='WIConsignee' class="form-control" value="<?php if (isset($CustName)) echo $CustName; ?>"
                                            disabled>
                                        </div>
                                        <div class="col-md-6 d-flex">
                                           <input type="text" class="form-control" id='WIConsignee' name='WIConsignee' required disabled>-
                                           <input type="text" class="form-control" id='WIConsigneeMar' name='WIConsigneeMar' required disabled>
                                       </div><br>
                                   </div><br>
                                   <div class="row">
                                       <div class="col-md-6 pt-4">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <input type="text" id='WIConsigneeadd' class="form-control" name='WIConsigneeadd' style='text-transform:uppercase'
                                        required disabled>-
                                        <input type="text" id='WIConsigneeaddMar' class="form-control" name='WIConsigneeaddMar' style='text-transform:uppercase'
                                        required disabled>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">Mobile No</div>
                                    <div class="col-md-6">
                                        <input type="text" id='WIConsigneemob' class="form-control" name='WIConsigneemob' onkeypress="return validateNumber(event)" maxlength=10 
                                        disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="table-container">
                          <table id="invtab">
                            <thead class="table-primary">
                              <tr align="center">
                                <th>Invoice No</th>
                                <th>Invoice Date</th>
                                <th>Packaging Type</th>
                                <th>Product Type</th>
                                <th>Invoice Gross Value</th>
                                <th>No of Pkgs.</th>
                                <th style="display:none;">Length (inch)</th>
                                <th style="display:none">Width (inch)</th>
                                <th style="display:none">Height (inch)</th>
                                <th style="display:none">Actual Weight/Pkg (inch)</th>
                                <th style="display:none">Actual Weight (inch)</th>
                                <th>Actual Weight(pkg)</th>
                                <th>Actual Weight</th>
                                <th>Excess Rate (In Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr id="row1">
                            <td>
                              <input type="text" class="form-control" name="invoiceno[]" size="10">
                          </td>
                          <td>
                              <input type="date"  id="invdate" style="padding:3%;" class="form-control" name="invdate" size="10" value="">
                          </td>
                          <td>
                              <select class="form-control" id="pkgtype" onchange="pkgtypechange(this)" name="pkgtype[]">
                               <option value="BAGS">BAGS</option>
                               <option value="BOX">BOX</option>
                               <option value="BUCKETS">BUCKETS</option>
                               <option value="BUNDAL">BUNDAL</option>
                               <option value="CAN">CAN</option>
                               <option value="DRUM">DRUM</option>
                               <option value="PACKET">PACKET</option>
                               <option value="PIPE">PIPE</option>
                               <option value="TYRES">TYRES</option>
                               <option value="WOODEN">WOODEN</option>
                           </select>
                       </td>
                       <td>
                        <select class="form-control" id="prodtype" onchange="producttypechange(this)" name="prodtype[]">
                          <option value="ADVERTISE MATERIAL">ADVERTISE MATERIAL</option>
                          <option value="Auto parts">Auto parts</option>
                          <option value="FERTILIZERS">FERTILIZERS</option>
                          <option value="MEDICINE">MEDICINE</option>
                          <option value="PALLETS">PALLETS</option>
                          <option value="PESTICIDES">PESTICIDES</option>
                          <option value="SEEDS">SEEDS</option>
                          <option value="SPRAY PUMP">SPRAY PUMP</option>
                          <option value="STATIONERY">STATIONERY</option>
                          <option value="E-Goods">E-Goods</option>
                          <option value="CHEMICAL">CHEMICAL</option>
                          <option value="PAINT">PAINT</option>
                          <option value="MOTOR">MOTOR</option>
                          <option value="ELECTRICS">ELECTRICS</option>
                          <option value="TYRE">TYRE</option>
                          <option value="COSMETIC">COSMETIC</option>
                          <option value="PVC">PVC</option>
                          <option value="Packaging Material">Packaging Material</option>
                          <option value="WOODEN FRAME">WOODEN FRAME</option>
                          <option value="ITEM">ITEM</option>
                          <option value="TARPAULIN">TARPAULIN</option>
                          <option value="ROLL">ROLL</option>
                          <option value="CLOTHES">CLOTHES</option>
                          <option value="WOODENSTICKS">WOODENSTICKS</option>
                          <option value="INCENSESTICKS">INCENSESTICKS</option>
                          <option value="RACK">RACK</option>
                          <option value="POT">POT</option>
                          <option value="SUNMICA">SUNMICA</option>
                          <option value="PLYWOOD">PLYWOOD</option>
                          <option value="WIRE">WIRE</option>
                          <option value="GLASS">GLASS</option>
                          <option value="PLASTICS">PLASTICS</option>
                          <option value="HARDWARE">HARDWARE</option>
                          <option value="GLOSORY">GLOSORY</option>
                          <option value="FOODS">FOODS</option>
                          <option value="CERAMIC">CERAMIC</option>
                          <option value="POP">POP</option>
                          <option value="ELECTONICS">ELECTONICS</option>
                          <option value="BOOK">BOOK</option>
                          <option value="OTHER">OTHER</option>
                      </select>
                  </td>
                  <td>
                    <input type="text" class="form-control" name="declval[]" size="10" onchange="calinvamt()" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td>
                    <input type="text" class="form-control" id="pkgno" name="pkgno[]" class="form-control" size="10" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td style="display: none;">
                    <input type="text" class="form-control" name="length[]" class="form-control" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td style="display:none;">
                    <input type="text" class="form-control" name="width[]"class="form-control" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td style="display:none;">
                    <input type="text" class="form-control" name="height[]" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td style="display:none;">
                    <input type="text" class="form-control" name="actwtperpkg[]" size="4" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"  readonly="">
                </td>
                <td style="display:none">
                    <input type="text" class="form-control" name="actwt[]" size="4" readonly="">
                </td>
                <td>
                    <input type="text" class="form-control" id="tactwt1" name="actwtperpkg_w[]" size="4" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" >
                </td>
                <td>
                    <input type="text" class="form-control" name="actwt_w[]" size="5" readonly="">
                </td>
                <td>
                    <input type="text" class="form-control" name="Exwtchrgs[]" size="10" readonly="">
                </td>
            </tr>
            <tr>
                <td colspan="4" align="right">Total</td>
                <td>
                    <input type="text" class="form-control" id="tdeclval" name="tdeclval" size="10" readonly="">
                </td>
                <td>
                    <input type="text" class="form-control" id="tpkgno" name="tpkgno" size="10" readonly="">
                </td>
                <td style="display: none;">
                    <input type="text" class="form-control" id="tactwt" name="tactwt" size="10" readonly="">
                </td>
                <td></td>
                <td>
                    <input type="text" class="form-control" id="actwttotal" name="actwttotal" size="10" readonly="">
                </td>
                <td></td>
                <td>
                    <input type="button" id="addrow" onclick="add_row()" value="Add Row" class="btn btn-outline-dark btn-fw">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<table cellpadding='4'>
    <tr>
        <td valign="Top">Eway Bill No. : <br>(Separated by Comma)</td>
        <td>
            <textarea id="EWBNOS" class="form-control" name="EWBNOS" cols="80" rows="5"></textarea>
        </td>
    </tr>
</table>
<input type="button" id="btnstep3" class="btn btn-gradient-dark btn-fw" onclick="step3click()" value="Step 3"><br><br>
</div>


<div id="step3" style="display:none;" >
    <table>
        <div class="row">
            <div class="col-sm">Estimated Delivery Date :
            </div>
            <div class="col-sm">
                <input  type="date" class="form-control" name="lrdatedd" id="lrdatedd"  min="" max="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">Freight Rate :</div>
            <div class="col">
                <input type="text" id="freightrate" class="form-control" name="freightrate"  size=10
                onchange="lrtotal()">
                <select id='freighttype' class="form-control" style="padding: 3%;" name='freighttype' onchange="lrtotal()">
                    <option value="flat">FLAT (IN Rs)</option>
                    <option value="perkg">Per KG</option>
                    <option value="perpkg">Per PKG</option>
                    <option value="perton">Per TON</option>
                    <option value="quintal">Quintal</option>
                    <option value="kmwise">KM WISE</option>
                    <option value="vehiclewise">Vehicle WISE</option>
                    <option value="metricton">METRIC TON</option>
                </select>
                <select class="form-control" style="padding:3%;" id='paidtype' name='paidtype'>
                    <option value='CASH'>CASH</option>
                    <option value='BANK'>BANK</option>
                    <option value='BALENCE'>BALENCE</option>
                </select>
            </div>
            <div class="col">Freight Charge :
            </div>
            <div class="col">
                <input type="text" id="freightotal" class="form-control" name="freightotal" size=10 readonly>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">Document Charges :</div>
            <div class="col-md-3">
                <input type="text" id="doccharge" class="form-control" name="doccharge" size=10 value="0" onchange="lrtotal()">
            </div>
            <div class="col-md-3">Other Charges :
            </div>
            <div class="col-md-3">
                <input type="text" id="othercharge" class="form-control" name="othercharge" size=10 value="0"
                onchange="lrtotal()">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">Hamali Charges :</div>
            <div class="col-md-3">
                <input type="text" id="hamalicharge" class="form-control" name="hamalicharge" size=10 value="0"
                onchange="lrtotal()">
            </div>
            <div class="col-md-3">Excess Weight Charges :</div>
            <div class="col-md-3">
                <input type="text" id="excesscharge" class="form-control" name="excesscharge" size=10 value="0" readonly>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3
            ">Door Del. Charges :</div>
            <div class="col-md-3">
                <input type="text" id="doordelcharge" class="form-control" name="doordelcharge" size=10 value="0"
                onchange="lrtotal()">
            </div>
            <div class="col-md-3">CGST + SGST Rate(%) :</div>
            <div class="col-md-3">
                <select id='csgstrate' name='csgstrate' class="form-control" disabled>
                    <option value="0">0</option>
                    <option value="2.5+2.5">2.5+2.5</option>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">CGST + SGST Amount :
            </div >
            <div class="col-md-3"><input type="text" class="form-control" id="csgst" name="csgst" size=10 value="0" disabled>
            </div>
            <div class="col-md-3">Grand Total :
            </div>
            <div class="col-md-3">
                <input type="text" id="grandtotal" class="form-control" name="grandtotal" size=10 readonly>
            </div>
        </div>
    </table>

    <br><br>              
    <input type='submit' class="btn btn-gradient-dark btn-fw" class="touch" id='SubmitLR' name='Submit' value='Create LR'>
    <div class="loder">
        <input type='hidden' name='Submit' value='Create LR'>
    </div>  
</div>      
<br>
<br><br>
</div>
</div>
</div>
</div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function paytypechange() {
        var paytype = document.getElementById("paytype").value;
        var walkInRadio = document.getElementById('walkInRadio');

        if (paytype === 'TBB') {
            walkInRadio.style.display = 'none';
            walkInRadio.disabled = true;
        } else {
            walkInRadio.style.display = 'block';
            walkInRadio.disabled = false;
        }

        switch (paytype) {
        case 'TBB':
            document.getElementById("partyid").disabled = false;
            document.getElementById("partyid").required = true;
            document.getElementById("csgstrate").value = "0";
            break;
        case 'PAID':
            document.getElementById("partyid").disabled = true;
            break;
        case 'TO PAY':
            document.getElementById("partyid").disabled = false;
            document.getElementById("partyid").required = false;
            // document.getElementById("partyid").value = '';
            document.getElementById("partyname").value = '';
            document.getElementById("csgstrate").value = "2.5+2.5";
            break;
        case 'FOC':
            document.getElementById("partyid").disabled = true;
            document.getElementById("partyid").required = false;
            document.getElementById("partyid").value = '';
            document.getElementById("partyname").value = '';
            document.getElementById("csgstrate").value = "0";
            break;
        default:
            break;
        }
    }
    const partyIdInput = $('#partyid');
    const partyNameInput = $('#partyname');
    const partyIdList = $('#partyid-list');

    partyIdInput.on('input', function () {
        const keyword = $(this).val().trim();
        paytypechange();
        const paymenttype = $('#paytype').val();

        if (keyword !== '') {
            $.ajax({
                url: '<?php echo base_url('Autocomplete/searchcustomers'); ?>',
                type: 'GET',
                data: {
                    keyword: keyword,
                    paymenttype: paymenttype,
                },
                success: function (response) {
                    partyIdList.empty();
                    $.each(response, function (index, item) {
                        if (item.value2 === paymenttype) {
                            console.log(item.value2 === paymenttype); 
                            const option = $('<option>')
                            .attr('label', item.label)
                            .attr('value', item.value)
                            .data('value2', item.value2);
                            partyIdList.append(option);
                        }
                    });
                }
            });
        } else {
            partyIdList.empty();
        }
    });

    partyIdInput.on('change', function () {
        const selectedOption = partyIdList.find('option[value="' + $(this).val() + '"]');
        if (selectedOption.length > 0) {
            const label = selectedOption.attr('label');
            const value = selectedOption.attr('value');
            partyIdInput.val(label);
            partyNameInput.val(value);
        }
    });

</script>

<script type="text/javascript">
    const currentDate = new Date();
    const currentFormattedDate = formatDate(currentDate);
    const twoDaysAgo = new Date();
    twoDaysAgo.setDate(currentDate.getDate() - 2);
    const twoDaysAgoFormattedDate = formatDate(twoDaysAgo);
    document.getElementById('lrdate').value = currentFormattedDate;
    document.getElementById('lrdate').setAttribute('min', twoDaysAgoFormattedDate);
    document.getElementById('lrdate').setAttribute('max', currentFormattedDate);
    document.getElementById('lrdatedd').value = currentFormattedDate;
    document.getElementById('invdate').value = currentFormattedDate;
    
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>
<script type="text/javascript">
    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    var pt; 

    function updateContract() {
        $(document).ready(function() {
            var form1 = $("#formLR")[0];
            if (form1 && form1.checkValidity()) {
                var paymenttype = document.getElementById('paytype');
                pt = paymenttype.value;
                if (pt == "TBB") {
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url('Autocomplete/fetch_contract') ?>',
                        data: {
                            ConID: $("#partyid").val(),
                            PayType: pt
                        },
                        success: function(response) {
                            if (IsJsonString(response)) {
                                var ewobj = JSON.parse(response);
                                if (ewobj.message == 'Contract Update Required') {
                                    alert('Update contract required');
                                    $("#btnstep1").css("display", "none");
                                } else if (ewobj.message == 'Success') {
                                } else if (ewobj.message == 'Contract Not Exist') {
                                    alert('Contract does not exist');
                                    $("#btnstep1").css("display", "none");
                                }
                            } else {
                                alert('Invalid response');
                            }
                        },
                        error: function(response) {
                            alert('Error occurred');
                            $("#btnstep1").css("display", "none");
                        }
                    });
                }
            } else {
                if (form1) {
                    form1.reportValidity();
                } else {
                }
            }
        });
    }



    function step1click() {
        if ($("#formLR")[0].checkValidity()) {
            $.ajax({
                type: 'post',
                url: 'fetch_data',
                data: {
                    ConID: document.getElementById('partyid').value,
                    PayType: pt 
                },
                success: function(response) {
                    if (IsJsonString(response)) {
                        ewobj = JSON.parse(response);
                        document.getElementById('doccharge').value = ewobj.DocumentCharges;
                        $("#servicetype").empty();
                        var st = ewobj.ServiceType.split(",");
                        for (var i = 0; i < st.length; i++)
                            $("#servicetype").append("<option value='" + st[i] + "'>" + st[i]
                                .toUpperCase() + "</option>");
                        $("#pickdeli").empty();
                        var pd = ewobj.PickupDelivery.split(",");
                        for (var i = 0; i < pd.length; i++)
                            $("#pickdeli").append("<option value='" + pd[i] + "'>" + pdarr[pd[i]] +
                                "</option>");
                        ml = ewobj.MatricesAllowed;
                    }
                },
                error: function(response) {
                    alert(response);
                }
            });
            document.getElementById('btnstep1').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
            document.getElementById("fromcity").required = true;
            $("#step0").find("input,select").attr("disabled", "disabled");
            $("#district").focus();
        } else {
            $("#formLR")[0].reportValidity();
        }
    }
    function checkCity() {
        var searchTerm = $("#searchTerm").val();

        $.ajax({
            type: "GET",
            url: "<?php echo base_url('Autocomplete/checkCitymaster'); ?>",
            data: {
                term: searchTerm
            },
            success: function(response) {
                $("#result").text(response);
            }
        });
    }

    $(document).ready(function() {
      var searchInput = $('#district');
      var searchResultsList = $('#District-list');

      searchInput.on('input', function() {
        var keyword = searchInput.val().trim();

        if (keyword !== '') {
          $.ajax({
            url: '<?php echo site_url('getcity'); ?>',
            type: 'GET',
            data: { keyword: keyword },
            dataType: 'json', 
            success: function(response) {
              searchResultsList.empty();
              $.each(response, function(index, option) {
                searchResultsList.append(option);
            });
          }
      });
      } else {
          searchResultsList.empty();
      }
  });
  });
    function step2click() {
     let form = document.getElementById("formLR");
     let fd = new FormData(form);

     var lrdate = document.getElementById('lrdate');
     var partyname = document.getElementById('partyname');
     var partyid = document.getElementById('partyid');
     var paymenttype = document.getElementById('paytype');
     pt = paymenttype.value; 
     pt2 = lrdate.value; 
     pt5 = partyname.value; 
     pt4 = partyid.value; 
     fd.append('pt', pt);
     fd.append('pt2', pt2);
     fd.append('pt4', pt4);
     fd.append('pt5', pt5);
     {
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "Excelforminsert",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('SimpleLR Generated Successfully');
                    setTimeout(function() {
                        // window.location.href = base_url + "printsimplelr/" + myObj.lr_no;
                    }, 2000);
                } else {
                    errorToster('SimpleLR Generation Failed');
                }
            }
        });
    }

}


function validate() {
    if ($("#formLR")[0].checkValidity()) {
        $("#formLR").find("input,select,textarea").prop('disabled', false);
        if (document.formLR.Consignorfrom.value == "From Master")
            radclick('crfm');
        else
            radclick('crwi');
        if (document.formLR.Consigneefrom.value == "From Master")
            radclick('cefm');
        else
            radclick('cewi');
        document.getElementById("Submit").disabled = true;
        $("#formLR").submit();
    } else
    $("#formLR")[0].reportValidity();
    ValidationGreaterThanZero();
}

function ValidationGreaterThanZero() {
    var FreightRate = parseInt(document.getElementById("freightrate").value);
    if (FreightRate > 0) {
        return true;
    } else {
        return false;

    }
}

function radclick(str) {
    switch (str) {
    case 'crfm':
        document.getElementById("FMConsignor").disabled = false;
        document.getElementById("WIConsignor").disabled = true;
        document.getElementById("WIConsignoradd").disabled = true;
        document.getElementById("WIConsignormob").disabled = true;
        document.getElementById("WIConsignor").value = '';
        document.getElementById("WIConsignoradd").value = '';
        document.getElementById("WIConsignormob").value = '';
        document.getElementById("FMConsignor").focus();
        break;
    case 'crwi':
        document.getElementById("FMConsignor").disabled = true;
        document.getElementById("FMConsignor").value = '';
        document.getElementById("WIConsignor").disabled = false;
        document.getElementById("WIConsignoradd").disabled = false;
        document.getElementById("WIConsignormob").disabled = false;
        document.getElementById("WIConsignor").focus();
        break;
    case 'cefm':
        document.getElementById("FMConsignee").disabled = false;
        document.getElementById("WIConsignee").disabled = true;
        document.getElementById("WIConsigneeadd").disabled = true;
        document.getElementById("WIConsigneemob").disabled = true;
        document.getElementById("WIConsigneeMar").disabled = true;
        document.getElementById("WIConsigneeaddMar").disabled = true;
        document.getElementById("WIConsignee").value = '';
        document.getElementById("WIConsigneeadd").value = '';
        document.getElementById("WIConsigneeMar").value = '';
        document.getElementById("WIConsigneeaddMar").value = '';
        document.getElementById("WIConsigneemob").value = '';
        document.getElementById("FMConsignee").focus();
        break;
    case 'cewi':
        document.getElementById("WIConsignee").disabled = false;
        document.getElementById("WIConsigneeadd").disabled = false;
        document.getElementById("WIConsigneeMar").disabled = false;
        document.getElementById("WIConsigneeaddMar").disabled = false;
        document.getElementById("WIConsigneemob").disabled = false;
        document.getElementById("FMConsignee").disabled = true;
        document.getElementById("FMConsignee").value = '';
        document.getElementById("WIConsignee").focus();
        break;
    }
}

$('#WIConsigneemob').bind('input', function() {
    if ($('#WIConsigneemob').val().length != 0 || $('#WIConsigneemob').val().length != 10)
        this.setCustomValidity('Please Enter valid Mobile No.');
    else
        this.setCustomValidity('');
});

function validateNumber(e) {
    const pattern3 = /^[0-9]$/;

    return pattern3.test(e.key)
}

function isNumberKey(evt, element) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
    else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        if (index > 0 && charCode == 46) {
            return false;
        }
        if (index > 0) {
            var CharAfterdot = (len + 1) - index;
            if (CharAfterdot > 3) {
                return false;
            }
        }

    }
    return true;
}

$("#WIConsignee").on('keyup', function(event) {
    $('#WIConsigneeMar').val(this.value);
});
$("#WIConsigneeadd").on('keyup', function(event) {
    $('#WIConsigneeaddMar').val(this.value);
});

function fetch_Batch(e) {
    var tinvamt = 0;
    var declval;
    var invamt = document.getElementsByName('declval[]');
    declval = document.getElementsByName('declval[]');

    for (i = 0; i < declval.length; i++) {
        if (declval[i] == e) {
            index = i;
            break;
        }
    }

    if (invamt !== undefined) {
        for (var i = 0; i < invamt.length; i++) {
            if (invamt[i].value != "") {
                tinvamt += parseFloat(invamt[i].value);
            }
        }
        document.getElementById("tdeclval").value = tinvamt;
    }
}

function calamt(e) {
    var qty;
    var wtcharg;
    var wtperpkg;
    var wt;
    var twt = 0;
    var tqty = 0;
    var tewtchrg = 0;
    var index = 99;
    var i = 0;
    var act_ww=0;

    var  qty = document.getElementsByName('pkgno[]');
    var wtperpkg = document.getElementsByName('actwtperpkg[]');
    var wt = document.getElementsByName('actwt[]');
    var ewtchrg = document.getElementsByName('Exwtchrgs[]');
    var  actwt_w = document.getElementsByName('actwt_w[]');
    var actwtperpkg_w = document.getElementsByName('actwtperpkg_w[]');
    var actwt_w = document.getElementsByName('actwt_w[]');
    for (i = 0; i < qty.length; i++) {
      if (qty[i] == e) {
        index = i;
        break;
    }
}
if (index == 99)
  for (i = 0; i < wtperpkg.length; i++) {
    if (wtperpkg[i] == e) {
      index = i;
      break;
  }
}
if (index == 99)
    for (i = 0; i < actwtperpkg_w.length; i++) {
      if (actwtperpkg_w[i] == e) {
        index = i;
        break;
    }
}
wt[index].value = parseFloat(qty[index].value) * parseFloat(wtperpkg[index].value);

actwt_w[index].value = parseFloat(qty[index].value) * parseFloat(actwtperpkg_w[index].value);
var twt = 0;
var tqty = 0;
var tewtchrg = 0;
var act_ww = 0;

for (var i = 0, iLen = wt.length; i < iLen; i++) {
 if (wt[i].value != "")
    twt += parseFloat(wt[i].value);

if (qty[i].value != "")
    tqty += parseFloat(qty[i].value);

if (qty[i].value != "" && ewtchrg[i].value != "")
    tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);

if (actwt_w[i].value != "")
    act_ww += parseFloat(actwt_w[i].value);
}

document.getElementById("tactwt").value = twt;
document.getElementById("tpkgno").value = tqty;
document.getElementById("actwttotal").value = act_ww;

var hamalical = tqty * doccharge;
var hamalicalInput = document.getElementById("hamalicharge");

if (!isNaN(hamalical)) {
  hamalicalInput.value = parseFloat(hamalical);
} else {
  hamalicalInput.value = "0";
}

var tewtchrgInput = document.getElementById("excesscharge");

if (!isNaN(tewtchrg)) {
  tewtchrgInput.value = parseFloat(tewtchrg);
} else {
  tewtchrgInput.value = "";
}

lrtotal();

}

function calinvamt() {
    var tinvamt = 0;
    var invamt = document.getElementsByName('declval[]');

    for (var i = 0, iLen = invamt.length; i < iLen; i++)
      if (invamt[i].value != "")
        tinvamt += parseFloat(invamt[i].value);
    document.getElementById("tdeclval").value = tinvamt;
}



var lastrowid = 1; 
function add_row() {
  if ($("#invtab tr").length > 8) {
    alert("Cannot add more than 7 rows.");
    return;
}

lastrowid = lastrowid + 1;
var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
htmltxt = htmltxt.replace("invdate", "invdate" + lastrowid);
$("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' class='btn btn-gradient-dark btn-fw' onclick=delete_row('row" + lastrowid + "','enrexp')></td></tr>");

$(document).ready(function() {
  $("#invdate" + lastrowid).datepicker({
    currentFormattedDate: "dd/mm/yy"
});
});

}
function step3click() {
    var pkgtype = document.getElementById('pkgtype').value;
    var paymenttype = document.getElementById('paytype').value;
    var selectedDistrict = document.getElementById('district').value;
    var intpkgno = parseFloat(document.getElementById('pkgno').value);
    var intactwt = parseFloat(document.getElementById('tactwt1').value);
    var infreightrate = parseFloat(document.getElementById('freightrate').value);
    var infreighttype = document.getElementById('freighttype').value;
    var csgstrate = document.getElementById('csgstrate').value;
    var csgst = document.getElementById('csgst').value;
    var grandtotal=parseFloat(document.getElementById('grandtotal').value);
    var freightotal=parseFloat(document.getElementById('freightotal').value);
    var parts = selectedDistrict.split(':');
    if (parts.length > 1) {
        var district1 = parts[0].trim();
        console.log(district1);
    } else {
        console.log("District format is not recognized.");
    }

    var Qty = document.getElementById('pkgno').value;
    console.log(Qty);
    var step2Fields = $("#step2 select");
    var allFieldsFilled = true;

    step2Fields.each(function() {
        if ($(this).val() === "") {
            allFieldsFilled = false;
            return false;
        }
    });

    if (allFieldsFilled) {
     $.ajax({
        type: "POST",
        url: "Autocomplete/fetch_data",
        data: {
            ConID: $("#partyid").val(),
            paytype: paymenttype
        },
        success: function (data) {
            if (data.hasOwnProperty('data') && data.data !== null && data.data.length > 0) {
                if (data.hasOwnProperty('data1') && data.data1 !== null && data.data1.length > 0) {
                    var firstItem1 = data.data1[0];
                    var documentCharges = firstItem1.DocumentCharges;
                    var firstItem = data.data[0];
                    console.log(firstItem); 
                    var toPlaceValue = firstItem.ToPlace;
                    if (district1 === toPlaceValue)
                    {
                       if (Qty>1 && Qty<=100) {
                         document.getElementById("freightrate").value=firstItem.Slab1;
                         document.getElementById("freighttype").value="perkg";
                         freightotal = firstItem.Slab1 * intactwt;
                         document.getElementById("freightotal").value=freightotal;
                         lrtotal();
                     } else if (Qty>100 && Qty<=250) {
                        var frttype= document.getElementById("freighttype").value="perpkg";
                        if(frttype==="perpkg"){
                         document.getElementById("doccharge").value = documentCharges;
                         document.getElementById("freightrate").value=firstItem.Slab2;
                         freightotal = firstItem.Slab2 * intpkgno;
                         console.log(freightotal);
                         document.getElementById("freightotal").value=freightotal;
                         console.log(document.getElementById("freightotal").value);

                         lrtotal();
                     }
                 } else {
                    console.log('No data1 found.');
                }
            } else if(Qty>250 && Qty<=350){
             document.getElementById("freightrate").value=firstItem.Slab3;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

             console.log(frt);
         }else if(Qty>350 && Qty<=625){
             document.getElementById("freightrate").value=firstItem.Slab4;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

         }else if(Qty>625 && Qty<=750){
             document.getElementById("freightrate").value=firstItem.Slab5;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

         }else if(Qty>750 && Qty<=850){
             document.getElementById("freightrate").value=firstItem.Slab6;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

         }else if(Qty>850 && Qty<=1000){
             document.getElementById("freightrate").value=firstItem.Slab7;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

         }else if(Qty>1000 && Qty<=2000) {
             document.getElementById("freightrate").value=firstItem.Slab8;
             var frt= document.getElementById("freightrate").value
             document.getElementById("freighttype").value="flat";
             document.getElementById("freightotal").value=frt;
             lrtotal();

         } else {
         }
     } else {
     }
 }else {
 }

},
error: function (xhr, status, error) {
    console.error("Error: " + error);
}
});
document.getElementById('btnstep3').style.display = 'none';
document.getElementById('step3').style.display = 'block';

step2Fields.prop("disabled", true);
document.getElementById("freightrate").required = true;
} else {
}
}





function add_row() {
    if ($("#invtab tr").length > 8) {
        alert("Cannot add more than 7 rows.");
        return;
    }
    lastrowid = lastrowid + 1;
    var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
    htmltxt = htmltxt.replace("invdate1", "invdate" + lastrowid);
    $("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt +
        "<td><input type='button' value='DELETE' class='btn btn-outline-dark btn-fw' onclick=delete_row('row" + lastrowid +
        "','enrexp')></td></tr>");

    
} 

function delete_row(rowno) {
    $('#' + rowno).remove();
    calinvamt();

    var twt = 0;
    var tqty = 0;
    var tewtchrg = 0;

    var qty = document.getElementsByName('pkgno[]');
    var wt = document.getElementsByName('actwt[]');
    var ewtchrg = document.getElementsByName('Exwtchrgs[]');

    for (var i = 0, iLen = wt.length; i < iLen; i++) {
        if (wt[i].value != "")
            twt += parseFloat(wt[i].value);
        if (qty[i].value != "")
            tqty += parseFloat(qty[i].value);
        if (qty[i].value != "" && ewtchrg[i].value != "")
            tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);
    }
    document.getElementById("tactwt").value = twt;
    document.getElementById("tpkgno").value = tqty;
    document.getElementById("excesscharge").value = tewtchrg;
}
function lrtotal() {
    var intpkgno = parseFloat(document.getElementById('pkgno').value);
    var intactwt = parseFloat(document.getElementById('tactwt1').value);
    var infreightrate = parseFloat(document.getElementById('freightrate').value);
    var infreighttype = document.getElementById('freighttype').value;
    var csgstrate = document.getElementById('csgstrate').value;
    var csgst = document.getElementById('csgst').value;
    var grandtotal=parseFloat(document.getElementById('grandtotal').value);

    var freightotal = 0;
    var grandtotal = 0;
    var total = 0;

    switch (infreighttype) {
    case 'flat':
        freightotal = infreightrate;
        grandtotal  = infreightrate;
        break;
    case 'perkg':
        freightotal = infreightrate * intactwt;
        break;
    case 'perpkg':
        freightotal = infreightrate * intpkgno;
        break;
    case 'gram':
        freightotal = infreightrate * intactwt * 1000;
        break;
    case 'perton':
        freightotal = infreightrate * intactwt / 1000;
        break;
    case 'quintal':
        freightotal = infreightrate * intactwt / 100;
        break;
    }

    var doccharge = parseFloat(document.getElementById("doccharge").value);
    var hamalicharge = parseFloat(document.getElementById("hamalicharge").value);
    var othercharge = parseFloat(document.getElementById("othercharge").value);
    var doordelcharge = parseFloat(document.getElementById("doordelcharge").value);
    var excesscharge = parseFloat(document.getElementById("excesscharge").value);
    var csgstrate = document.getElementById("csgstrate").value;
    var csgst = document.getElementById("csgst").value;
    var total = document.getElementById("grandtotal").value;

    total = freightotal + hamalicharge + doccharge + doordelcharge + othercharge + excesscharge;
    document.getElementById("freightotal").value = freightotal;

    if (freightotal >= 750 && (document.getElementById("paytype").value === "PAID" || document.getElementById("paytype").value === "TO PAY") && document.getElementById("prodtype").value !== "SEEDS") {
        document.getElementById("csgstrate").value = "2.5+2.5";
        document.getElementById("csgst").value=parseFloat(freightotal*0.05);

        document.getElementById("grandtotal").value = parseFloat(total+csgst);
    } 

    else {
        document.getElementById("csgstrate").value = "0";
        document.getElementById("csgst").value = csgst;
        document.getElementById("grandtotal").value = total;
    }
    document.getElementById("grandtotal").value = total;

}




const partyidInput = document.getElementById('partyid');
const partynameInput = document.getElementById('partyname');
const FMConsignorInput = document.getElementById('FMConsignor');
const FMConsignorNameInput = document.getElementById('FMConsignorName');
const FMConsigneeInput = document.getElementById('FMConsignee');
const FMConsigneeNameInput = document.getElementById('FMConsigneeName');

partyidInput.addEventListener('input', function() {
    const selectedOption = document.querySelector(`option[value="${this.value}"]`);
    if (selectedOption) {
        const optionLabel = selectedOption.label;
        const optionValue = selectedOption.value;
        FMConsignorInput.value = optionLabel;
        FMConsignorNameInput.value = optionValue;
    }
});

function getCurrentDate() {
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");
    return `${day}-${month}-${year}`;
}

function pkgtypechange(){
    var pkgtype= document.getElementById('pkgtype').value;
    console.log(pkgtype);
}

function producttypechange(){
    var prodtype= document.getElementById('prodtype').value;
    console.log(prodtype);
}


// SIMPLELR
$("#SubmitLR").click(function() {
    let form = document.getElementById("formLR");
    let fd = new FormData(form);
    var pkgtype= document.getElementById('pkgtype');
    pkg =pkgtype.value;
    var prodtype= document.getElementById('prodtype');
    product =prodtype.value;
    console.log(product);
    var paymenttype = document.getElementById('paytype');
    var pt = paymenttype.value;
    var selectedDistrict = document.getElementById('district');
    dt =selectedDistrict.value;
    console.log(pkg);
    fd.append('pt', pt);
    fd.append('dt', dt);
    fd.append('pkg', pkg);
    fd.append('product', product);
    
    {
        $.ajax({
            enctype: 'multipart/form-data',
            url: base_url + "SimpleLR",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    successToster('SimpleLR Generated Successfully');
                    setTimeout(function() {
                        window.location.href = base_url + "printsimplelr/" + myObj.lr_no;
                    }, 2000);
                } else {
                    errorToster('SimpleLR Generation Failed');
                }
            }
        });
    }
});

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
<script type="text/javascript">
    <?php
    if (isset($_GET["ConID"])) {
        echo '<script type="text/javascript">step1click();</script>';
    }
?>
</script>











