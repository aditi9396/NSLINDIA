  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
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
  </style>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">LRGENERATION</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">LR Generation</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
        <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('CPVOLUMETRICdata'); ?>">CPvolumetricLR List</a>
      </div>
      <form id="change-lr-form">
        <input type="radio" name="option" value="option1">LR ENTRY
        <input type="radio" name="option" value="option2" checked />CPVOLUMETRIC
      </form>
      <br>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="form-sample" method="post_data" id="form1" name="form1" enctype="multipart/form-data" action="<?php echo base_url('lr-generation'); ?>">
               <div class="col-md-12 col-12 pb-2">
                <label style="color:red;" id="err_msg"></label> 
              </div>
              <div class="">
                <div class="row">
                  <div class="col-sm">
                    <label for="LRDate">LR Date:</label>
                    <input type="date" class="form-control" name="LRDate" id="date_field" size="10">
                  </div>
                  <div class="col-sm">
                    <label for="paytype" >Payment Type:</label>
                    <select id="paytype" class="form-control"  name="paytype" onchange="paytypechange()" autofocus required>
                        <option value="" selected="" >SELECT PAYMENT TYPE</option>
                        <option value="TO PAY" <?php if (isset($requestdata) && $requestdata->PayBasis === 'TO PAY') echo 'selected'; ?>>TO PAY</option>
                        <option value="TBB">TBB</option> 
                        <option value="PAID">PAID</option>
                      </select>
                    </div>

                    <div class="col-sm">
                      <label for="district">City:</label>
                      <input type="text" class="form-control" id="district" style="text-transform:uppercase ;" name="district" list="District-list" placeholder="Enter City" value="<?php if(isset($requestdata)) echo $requestdata->ToPlace; ?>" required>
                      <datalist id="District-list"></datalist>
                    </div>

                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-sm">
                    <div>
                      <div></div>
                      <div colspan="2">Consignor</div>
                    </div>
                    <div>
                      <div>Mobile No <span style="color:red;font-weight:bold">*</span></div>
                      <div><input type="text" class="form-control" id="WIConsignormob" name="WIConsignormob" pattern="[0-9]+" maxlength="10" value="<?php if(isset($requestdata)) echo $requestdata->ConsignorMob; ?>" ></div>
                    </div>
                    <br>
                    <div>
                      <div>Consignor Name</div>
                      <div style="display:none">
                        <input type="text" class="form-control" id="FMConsignor" name="FMConsignor" size="10" value="<?php if(isset($requestdata)) echo $requestdata->Consignor; ?>" class="ui-autocomplete-input" autocomplete="off" disabled="">
                        -<input type="text" class="form-control" id="FMConsignorName" name="FMConsignorName" value="<?php if(isset($requestdata)) echo $requestdata->Consignor; ?>" disabled="">
                      </div>
                      <div><input type="text" class="form-control" id="WIConsignor" name="WIConsignor" value="<?php if(isset($requestdata)) echo $requestdata->Consignor; ?>" required></div>
                    </div>
                    <br>
                    <br>
                    <div>
                      <div>Address</div>
                      <div><input type="text" id="WIConsignoradd" class="form-control" name="WIConsignoradd" value="<?php if(isset($requestdata)) echo $requestdata->ConsignorAdd; ?>" style="text-transform:uppercase" required></div>
                    </div>
                  </div>

                  <div class="col-sm">
                    <div>
                      <div></div>
                      <div>Consignee</div>
                    </div>
                    <div>
                      <div></div>
                    </div>
                    <div>
                      <div>Mobile No <span style="color:red;font-weight:bold">*</span></div>
                      <div><input type="text" class="form-control" id="WIConsigneemob" name="WIConsigneemob" value="<?php if(isset($requestdata)) echo $requestdata->ConsigneeMob; ?>" pattern="[0-9]+" maxlength="10" required>
                      </div>
                    </div>
                    <div>
                      <div>Consignee Name</div>
                      <div style="display:none">
                        <input type="text" class="form-control" id="FMConsignee" name="FMConsignee"></div>
                      <div><input type="text" id="WIConsignee" class="form-control" name="WIConsignee" value="<?php if(isset($requestdata)) echo $requestdata->ConsigneeMar; ?>" required="">
                        <input type="text" id="WIConsigneeMar" class="form-control" name="WIConsigneeMar" value="<?php if(isset($requestdata)) echo $requestdata->ConsigneeMar; ?>" required></div>
                      </div>
                      <div>
                        <div>Address</div>
                        <div>
                          <input type="text" id="WIConsigneeadd" class="form-control" name="WIConsigneeadd" value="<?php if(isset($requestdata)) echo $requestdata->ConsigneeAdd; ?>" style="text-transform:uppercase" required>

                          <input type="text" id="WIConsigneeaddMar" class="form-control" name="WIConsigneeaddMar" value="<?php if(isset($requestdata)) echo $requestdata->ConsigneeAdd; ?>" style="text-transform:uppercase" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
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
                          <th>Length (inch)</th>
                          <th>Width (inch)</th>
                          <th>Height (inch)</th>
                          <th>Actual Weight/Pkg (inch)</th>
                          <th>Actual Weight (inch)</th>
                          <th>Actual Weight(pkg)</th>
                          <th>Actual Weight</th>
                          <th style="display:none">Excess Rate (In Rs.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="row1">
                          <td>
                            <input type="text" class="form-control" name="invoiceno[]" size="10">
                          </td>
                          <td>
                            <input type="date" id="invdate" style="padding:3%;" class="form-control" name="invoicedate" size="10">
                          </td>
                          <td>
                            <select class="form-control" name="pkgtype[]">
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
                          <select class="form-control" name="prodtype[]">
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
                          <input type="text" class="form-control" name="declval[]" size="10" onchange="calinvamt()" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="pkgno[]" class="form-control" size="10" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="length[]" class="form-control" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="width[]"class="form-control" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="height[]" size="5" onchange="calamt(this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="actwtperpkg[]" size="4" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required="" readonly="">
                        </td>
                        <td>
                          <input type="text" class="form-control" name="actwt[]" size="4" readonly="">
                        </td>
                        <td>
                          <input type="text" class="form-control" name="actwtperpkg_w[]" size="4" onchange="calamt(this)" pattern="[0-9]+" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')" required>
                        </td>
                        <td>
                          <input type="text" class="form-control" name="actwt_w[]" size="5" readonly="">
                        </td>
                        <td style="display:none">
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <input type="text" class="form-control" id="tactwt" name="tactwt" size="10" readonly="">
                        </td>
                        <td></td>
                        <td>
                          <input type="text" class="form-control" id="actwttotal" name="actwttotal" size="10" readonly="">
                        </td>
                        <td>
                          <input type="button" id="addrow" onclick="add_row()" value="Add Row" class="btn btn-outline-dark btn-fw">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <br>

                <div class="container-fluid1">
                  <div class="table">
                    <div class="row">
                      <div class="col-sm" valign="top">Eway Bill No. : <br>(Separated by Comma)</div>
                      <div class="col-sm">
                        <textarea type="text" class="form-control" id="EWBNOS" name="EWBNOS" rows="1
                        "></textarea>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div>
                    <div class="row" style="display: -webkit-inline-box;">
                      <div class="col-sm">EDD</div>
                      <div class="col-sm">
                        <input type="date" class="form-control" name="eddate" id="eddate">
                      </div>
                      <div class="col-sm">Freight Rate:</div>
                      <div class="col-sm">
                        <input type="text" class="form-control " id="freightrate" name="freightrate"  onchange="lrtotal()" required>

                        <div class="col-sm">
                          <select id="freighttype" class="form-control" name="freighttype" onchange="lrtotal()" required>
                           <option value="flat">FLAT (IN Rs)</option>
                           <option value="perkg">Per KG</option>
                           <option value="perpkg">Per PKG</option>
                           <option value="perton">Per TON</option>
                           <option value="quintal">Quintal</option>
                           <option value="kmwise">KM WISE</option>
                           <option value="vehiclewise">Vehicle WISE</option>
                           <option value="metricton">METRIC TON</option>
                         </select>
                       </div>
                     </div>
                     <div class="col-sm">Freight Charge :</div>
                     <div class="col-sm">
                      <input type="text" class="form-control" id="freightotal" name="freightotal" size="10" readonly="" >
                    </div>
                    <div class="col-sm">Document Charges :</div>
                    <div class="col-sm">
                      <input type="number" class="form-control" id="doccharge" name="doccharge" size="10" min="10" onchange="lrtotal()">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm">Pickup/Other Charges :</div>
                    <div class="col-sm">
                      <input type="text" class="form-control" id="othercharge" name="othercharge" size="10" value="0" onchange="lrtotal()">
                    </div>
                    <div class="col-sm">Hamali Charges :</div>
                    <div class="col-sm">
                      <input type="number" class="form-control" id="hamalicharge" name="hamalicharge" min="0" value="" onchange="lrtotal()" >
                    </div>
                    <div class="col-sm">Excess Weight Charges :</div>
                    <div class="col-sm">
                      <input type="text" class="form-control" id="excesscharge" name="excesscharge" size="10" value="0" onchange="lrtotal()">
                    </div>
                    <div class="col-sm">Value Search Charge :</div>
                    <div class="col-sm">
                      <input type="checkbox"  id="valuesearch" name="valuesearch" value="0.005" onclick="lrtotal();" class="form-check-input">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm">Door Del. Charges :</div>
                    <div class="col-sm">
                      <input type="text" class="form-control" id="doordelcharge" name="doordelcharge" size="10" value="0" onchange="lrtotal()" readonly="">
                    </div>
                    <div class="col-sm">CGST + SGST Rate(%)</div>
                    <div class="col-sm">
                      <select id="csgstrate" class="form-control" style="padding: 15%;" name="csgstrate"  disabled="" class="form-select">
                        <option value="0">0</option>
                        <option value="2.5+2.5">2.5+2.5</option>
                        <!-- Remaining options... -->
                      </select>
                    </div>
                    <div class="col-sm">CGST + SGST Amount :</div>
                    <div class="col-sm">
                      <input type="text" class="form-control" id="csgst" name="csgst" size="10" onchange="lrtotal()">
                    </div>
                    <div class="col-sm">Grand Total :</div>
                    <div class="col-sm">
                      <input type="text" class="form-control" id="grandtotal" name="grandtotal" size="10">
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="container">
                  <div class="d-flex justify-content-center">
                    <input type="submit" id="Submit" name="Submit" value="Create LR" class="btn btn-outline-dark btn-fw">
                    <input type="hidden" name="Submit" value="Create LR">
                    <!-- <div id="loader" class="text-center" style="display: none;">
                      <div class="loader"></div> -->
                    </div>                    
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function paytypechange() {
      switch (document.getElementById("paytype").value) {
      case 'PAID':
        document.getElementById("FMConsignor").value = '';
        document.getElementById("FMConsignorName").value = '';
        document.getElementById("FMConsignor").disabled = true;
        document.getElementById("csgstrate").value = "2.5+2.5";
        break;
      case 'TO PAY':
        document.getElementById("csgstrate").value = "2.5+2.5";
        document.getElementById("FMConsignor").value = '';
        document.getElementById("FMConsignorName").value = '';
        document.getElementById("FMConsignor").disabled = true;
        break;
      case 'TBB': 
        break;
      }
    }

    function getcharges(a) {
      $.ajax({
        type: 'post',
        url: '<?php echo base_url("Lrgeneration/getCharges"); ?>',
        data: {
          village: a,
        },
        success: function (response) {
          const obj = JSON.parse(response);

          if (obj.status == true) {
            $('#doordelcharge').val(obj.Rate);
          } else {
            alert('Door Delivery Charges Not Found');
            $('#doordelcharge').val(0);
          }
        },
        error: function (response) {
        }
      });
    }

    function delete_row(rowno) {
      $('#' + rowno).remove();
      calinvamt();

      var twt = 0;
      var tqty = 0;
      var tewtchrg = 0;
      var act_ww=0;

      var qty = document.getElementsByName('pkgno[]');
      var wt = document.getElementsByName('actwt[]');
      var ewtchrg = document.getElementsByName('Exwtchrgs[]');
      var actwt_w = document.getElementsByName('actwt_w[]');

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
      document.getElementById("excesscharge").value = tewtchrg;
      document.getElementById("actwttotal").value = act_ww;
    }

    function validate() {
      if ($("#form1")[0].checkValidity()) {
        var intpkgno = document.getElementById('tpkgno').value;
        if (intpkgno * 20 > total) {

          alert("Please enter Correct freight rate");
        }
        $("#form1").find("input,select,textarea").prop('disabled', false);

        radclick('cewi');
        document.getElementById("Submit").disabled = true;
        $("#form1").submit();
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

      qty = document.getElementsByName('pkgno[]');
      wtperpkg = document.getElementsByName('actwtperpkg[]');
      wt = document.getElementsByName('actwt[]');
      var ewtchrg = document.getElementsByName('Exwtchrgs[]');

      var length1 = document.getElementsByName('length[]');
      var width1 = document.getElementsByName('width[]');
      var height1 = document.getElementsByName('height[]');
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

        for (i = 0; i < length1.length; i++) {
          if (length1[i] == e) {
            index = i;
            break;
          }
        }
        for (i = 0; i < width1.length; i++) {
          if (width1[i] == e) {
            index = i;
            break;
          }
        }
        for (i = 0; i < height1.length; i++) {
          if (height1[i] == e) {
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

          var amm = (parseFloat(height1[index].value) * parseFloat(width1[index].value) * parseFloat(length1[index].value))/366;

          (wtperpkg[index].value)=amm.toFixed(2);

          wt[index].value = parseFloat(qty[index].value) * parseFloat(wtperpkg[index].value);

          actwt_w[index].value = parseFloat(qty[index].value) * parseFloat(actwtperpkg_w[index].value);

          if (typeof ewobj !== 'undefined') {
            for (var j = 0, jLen = ewobj.Rates.length; j < jLen; j++) {
              if (wtperpkg[index].value >= ewobj.Rates[j].FromWeight && wtperpkg[index].value <= ewobj.Rates[j].ToWeight) {
                ewtchrg[index].value = ewobj.Rates[j].Rate;
                break;
              } else {
                ewtchrg[index].value = 0;
              }
            }
          } else {
            ewtchrg[index].value = 0;
          }

          var twt = 0;
          var tqty = 0;
          var tewtchrg = 0;
          var act_ww = 0;

          for (var i = 0, iLen = wt.length; i < iLen; i++) {
            if (wt[i].value != "") {
              twt += parseFloat(wt[i].value);
            }
            if (qty[i].value != "") {
              tqty += parseFloat(qty[i].value);
            }
            if (qty[i].value != "" && ewtchrg[i].value != "") {
              tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);
            }
            if (actwt_w[i].value != "") {
              act_ww += parseFloat(actwt_w[i].value);
            }
          }

          document.getElementById("tactwt").value = twt;
          document.getElementById("tpkgno").value = tqty;
          document.getElementById("actwttotal").value = act_ww;

          var hamalical = tqty*doccharge;
          document.getElementById("hamalicharge").value = hamalical;
          document.getElementById("excesscharge").value = tewtchrg;

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
            htmltxt = htmltxt.replace("invdate1", "invdate" + lastrowid);
            $("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' class='btn btn-outline-dark btn-fw' onclick=delete_row('row" + lastrowid + "','enrexp')></td></tr>");

            $(function () {
              $("#invdate" + lastrowid).datepicker({dateFormat: "dd/mm/yy"});
            });

               // rateCP();
          }


          function lrtotal() {
            var intpkgno = document.getElementById('tpkgno').value;
            var intactwt = document.getElementById('tactwt').value;
            var infreightrate = document.getElementById('freightrate').value;
            var infreighttype = document.getElementById('freighttype').value;
            var total;

            switch (infreighttype) {
            case 'flat':
              document.getElementById("freightotal").value = infreightrate;
              break;
            case 'perkg':
              document.getElementById("freightotal").value = infreightrate * intactwt;
              break;
            case 'perpkg':
              document.getElementById("freightotal").value = infreightrate * intpkgno;
              break;
            case 'gram':
              document.getElementById("freightotal").value = infreightrate * intactwt * 1000;
              break;
            case 'perton':
              document.getElementById("freightotal").value = infreightrate * intactwt / 1000;
              break;
            case 'quintal':
              document.getElementById("freightotal").value = infreightrate * intactwt / 100;
              break;
            }

            total = parseInt(document.getElementById("freightotal").value) + parseInt(document.getElementById("hamalicharge").value) + parseInt(document.getElementById("doccharge").value) +
            parseInt(document.getElementById("doordelcharge").value) + parseInt(document.getElementById("othercharge").value) + parseInt(document.getElementById("excesscharge").value);

            document.getElementById("grandtotal").value = total;

            if (document.getElementById("paytype").value != "FOC" && freightobj == undefined && intpkgno * 20 > total && infreightrate <= 0) {
              alert("Please enter Correct freight rate");
              document.getElementById("Submit").disabled = true;
            } else {
              document.getElementById("Submit").disabled = false;
            }
            if( total >= 750 && (document.getElementById("paytype").value == "PAID" || document.getElementById("paytype").value == "TO PAY"))
            {
              document.getElementById("csgstrate").value = "2.5+2.5";
            }
            else{
              document.getElementById("csgstrate").value = "0";
            }

            if (document.getElementById("csgstrate").value == "2.5+2.5" ) {
              document.getElementById("grandtotal").value = total + parseInt(total * 0.05);
              document.getElementById("csgst").value = parseInt(total * 0.05);
            }

            else {
              document.getElementById("grandtotal").value = total;
              document.getElementById("csgst").value = 0;
            }
          }


          function delete_row(rowno) {
            $('#' + rowno).remove();
            calinvamt();

            var twt = 0;
            var tqty = 0;
            var tewtchrg = 0;
            var act_ww=0;

            var qty = document.getElementsByName('pkgno[]');
            var wt = document.getElementsByName('actwt[]');
            var ewtchrg = document.getElementsByName('Exwtchrgs[]');
            var actwt_w = document.getElementsByName('actwt_w[]');

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
            document.getElementById("excesscharge").value = tewtchrg;
            document.getElementById("actwttotal").value = act_ww;
            rateCP();
          }


          $(document).on('input', '#WIConsigneemob', function () {
            if ($('#WIConsigneemob').val().length !== 0 && $('#WIConsigneemob').val().length !== 10) {
              this.setCustomValidity('Please enter a valid 10-digit mobile number.');
            } else {
              this.setCustomValidity('');
            }
          });

          function chkvalidity(id) {
            if (id.value == '')
              id.setCustomValidity('Please enter value.');
            else
              id.setCustomValidity('Please enter Number Only');
          }


        </script>


        <script>

          var total = total; 
          var intpkgno =intpkgno;

          document.getElementById("grandtotal").value = total;
          if ((intpkgno * 750 > total) || (doccharge< 10)) {
            alert("Please Give Correct Inputs");
            document.getElementById("Submit").disabled = true;
          } else {
            document.getElementById("Submit").disabled = false;
          }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

        <script type="text/javascript">
         $("#FMConsignor").autocomplete({
          minLength: 3,
          source: 'getCustomers',
          select: function (event, ui) {
            $("#FMConsignor").val(ui.item.CustCode);
            $("#FMConsignorName").val(ui.item.CustName);
            return false;
          },
          change: function (event, ui) {
            if (ui.item == null) {
              event.currentTarget.value = '';
              event.currentTarget.focus();
            }
          }
        })
         .autocomplete("instance")._renderItem = function (ul, item) {
          return $("<li>")
          .append("<div>" + item.CustCode + " : " + item.CustName + "</div>")
          .appendTo(ul);
        };

        $("#WIConsignee").on('keyup', function (event) {
          $('#WIConsigneeMar').val(this.value);
        });
        $("#WIConsigneeadd").on('keyup', function (event) {
          $('#WIConsigneeaddMar').val(this.value);
        });

      </script>

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <script>
        const currentDate = new Date();
        const twoDaysAgo = new Date();
        twoDaysAgo.setDate(currentDate.getDate() - 2);
        const currentFormattedDate = formatDate(currentDate);
        const twoDaysAgoFormattedDate = formatDate(twoDaysAgo);
        document.getElementById('date_field').value = currentFormattedDate;
        document.getElementById('date_field').setAttribute('min', twoDaysAgoFormattedDate);
        document.getElementById('date_field').setAttribute('max', currentFormattedDate);

        function formatDate(date) {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${year}-${month}-${day}`;
        }
        const currentDate1 = new Date();
        const year = currentDate1.getFullYear();
        const month = String(currentDate1.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate1.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;

        document.getElementById('invdate').value = formattedDate;
        document.getElementById('eddate').value = formattedDate;

        document.addEventListener('DOMContentLoaded', function() {
          const currentDate2 = new Date();
          const formattedDate2 = formatDate(currentDate2);

          const invdateInput = document.querySelector("#invtab #row2 input#invdate");
          if (invdateInput) {
            invdateInput.value = formattedDate2;
          }
        });

        function formatDate(date) {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${year}-${month}-${day}`;
        }



      </script>

      <script type="text/javascript">
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

        $('#WIConsigneemob').bind('input', function () {
          if ($('#WIConsigneemob').val().length != 0 || $('#WIConsigneemob').val().length != 10)
            this.setCustomValidity('Please Enter valid Mobile No.');
          else
            this.setCustomValidity('');
        });
        // document.getElementById("Submit").addEventListener("click", function() {
        //   var submitBtn = document.getElementById("Submit");
        //   var loader = document.getElementById("loader");
        //   submitBtn.style.display = "none";
        //   loader.style.display = "block";
        // });

        var pdarr = {
          gptogd: "Godown Pickup-Godown Delivery",
          gptodd: "Godown Pickup-Door Delivery",
          dptogd: "Door Pickup-Godown Delivery",
          dptodd: "Door Pickup-Door Delivery"
        };
        var ewobj;
        var freightobj;
        var ml = "";
        $body = $("body");
        $(document).on({
          ajaxStart: function () {
            $body.addClass("loading");
          },
          ajaxStop: function () {
            $body.removeClass("loading");
          }
        });

        var lastrowid = 1;
        $(window).bind('pageshow', function () {
            // update hidden input field
          var form = $('form');
            // let the browser natively reset defaults
          form[0].reset();
        });

        $(document).on("keypress", 'form', function (e) {
          if (e.target.className.indexOf("allowEnter") == -1) {
            var code = e.keyCode || e.which;
            var btnid = e.target.id;
            if (code == 13 && !(btnid == "btnstep1" || btnid == "btnstep2" || btnid == "btnstep3" || btnid == "addrow" || btnid == "Submit")) {
              e.preventDefault();
              return false;
            }
          }
        });
        $(document).ready(function() {
          var searchInput = $('#district');
          var searchResultsList = $('#District-list');

          searchInput.on('input', function() {
            var keyword = searchInput.val().trim();

            if (keyword !== '') {
              $.ajax({
                url: '<?php echo site_url('getDistricts'); ?>',
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

        document.addEventListener("DOMContentLoaded", function () {
          const radioButtons = document.querySelectorAll('#change-lr-form input[name="option"]');

          radioButtons.forEach(function (radio) {
            radio.addEventListener("click", function () {
              if (this.value === "option1") {
                window.location.href = "createlr";
              }
              else if (this.value === "option2") {
                window.location.href = "lr-generataion";
              }
            });
          });
        });

      </script>



