<style type="text/css">
    table.blueTable {
      margin: 20px; 
      border: 1px solid #1C6EA4;
      background-color: #EEEEEE;
      width: 90%;
      text-align: left;
      border-collapse: collapse;
  }
  table.blueTable td, table.blueTable th {
      border: 1px solid #AAAAAA;
      padding: 3px 2px;}
      table.blueTable tbody td {
          font-size: 14px;
      }
      table.blueTable tr:nth-child(even) {
          background: #D0E4F5;
      }
      table.blueTable thead {
        background: #1C6EA4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 2px solid #444444;
    }
    table.blueTable thead th {
      font-size: 16px;
      height: 50px;
      text-align: center;
      font-weight: bold;
      color: #FFFFFF;
      border-left: 2px solid #D0E4F5;
  }
  table.blueTable thead th:first-child {
      border-left: none;
  }

  table.blueTable tfoot {
      font-size: 14px;
      font-weight: bold;
      color: #FFFFFF;
      background: #D0E4F5;
      background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
      background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
      background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
      border-top: 2px solid #444444;
  }
  table.blueTable tfoot td {
      font-size: 14px;
  }
  table.blueTable tfoot .links {
      text-align: right;
  }
  table.blueTable tfoot .links a{
      display: inline-block;
      background: #1C6EA4;
      color: #FFFFFF;
      padding: 2px 8px;
      border-radius: 5px;
  }
  table.blueTable tfoot .links .active{
      background: #EE0000;
  }
  #radio1 {
    visibility: hidden;
}
</style>
<form method="post" id="form1" name="form1" enctype="multipart/form-data" action="printlrcpvolumetric.php">
    <input type="hidden" name="ContractID" id="ContractID" value="CPN0000000038" readonly="">
    <center> <p style="font-size: 20px"> Credit Limit :<span style="font-weight:bold"> 1000</span> &nbsp;&nbsp;&nbsp;&nbsp;  Total Remaining Amount : <span style="font-weight:bold">150200</span></p></center>
    <input type="hidden" name="condstatus" id="condstatus" value="1">
    <div id="step0">
        <table width="80%" cellpadding="4" class="table table-borderless">
            <tbody><tr>
                <td>LR Date :</td>
                <td><input type="text" id="lrdate" name="lrdate" size="10" value="27/02/2023" readonly="" class="hasDatepicker">
                </td>
                <td>Payment Type :</td>
                <td><select id="paytype" name="paytype" style="width:200px" autofocus="" required="">

                    <option value="PAID">PAID</option>
                    <option value="TO PAY">TO PAY</option>
                </select></td>

                <td>To City :<input type="text" id="tocity" name="tocity" style="text-transform:uppercase"  required="" class="ui-autocomplete-input" autocomplete="off"></td>
            </tr>
            <tr style="display: none">
                <td>Manual LR NO:</td>
                <td><input type="hidden" id="manuallrno" name="manuallrno" size="20" value="" required="">
                </td>
            </tr> 
        </tbody></table><table width="800px" cellpadding="4" style="display: none" class="table table-borderless">
            <tbody><tr>
                <td>Mode Of Transport :- <select id="mot" name="mot" style="width:200px"> <option value="REGULAR">REGULAR</option>
                    <option value="URGENT">URGENT</option>
                </select></td>
                <td>Service Type :- <select id="servicetype" name="servicetype" style="width:200px">
                    <option value="LTL">LTL</option>
                    <option value="FTL">FTL</option>
                    <option value="FCL">FCL</option>
                </select></td>
                <td>Type of Movement :- <input type="text" id="tomove" name="tomove" size="10" value="Road" readonly=""></td>
            </tr>
            <tr>
                <td>Pickup/Delivery :<select id="pickdeli" name="pickdeli">
                    <option value="DoorPickupDoorDelivery">Door Pickup - Door Delivery</option>
                    <option value="DoorPickupGodownDelivery">Door Pickup - Godown Delivery</option>
                    <option value="GodownPickupDoorDelivery">Godown Pickup - Door Delivery</option>
                    <option value="GodownPickupGodownDelivery">Godown Pickup - Godown Delivery</option>
                </select></td>
                <td>From City :<input type="text" id="fromcity" name="fromcity" style="text-transform:uppercase" value="PUNE" class="ui-autocomplete-input" autocomplete="off">
                </td>
            </tr>
        </tbody></table>   <br>
        <table style="width:45%;float: left;" cellpadding="4" class="table table-borderless"> <tbody><tr>
            <td></td>
            <td colspan="2">Consignor</td>
        </tr>
        <tr>
            <td></td>
            <td><label><input type="radio" name="Consignorfrom" value="Walk-In" checked="checked">Walk-In</label></td>
        </tr>
        <tr>
            <td>Mobile No <span style="color:red;font-weight:bold"> *</span></td>

            <td><input type="text" id="WIConsignormob" name="WIConsignormob" pattern="[0-9]+" maxlength="10" required=""></td>
        </tr>
        <tr>
            <td>Consignor Name</td>
            <td style="display:none"><input type="text" id="FMConsignor" name="FMConsignor" size="10" value="" class="ui-autocomplete-input" autocomplete="off">-<input type="text" id="FMConsignorName" name="FMConsignorName" value="" disabled=""></td>
            <td><input type="text" id="WIConsignor" name="WIConsignor" required=""></td>
        </tr>
        <tr>
            <td>Address</td>

            <td><input type="text" id="WIConsignoradd" name="WIConsignoradd" style="text-transform:uppercase" required=""></td>
        </tr>
    </tbody></table>
    <table style="margin-left: 100px;width:45%;float: left;" cellpadding="4" class="table table-borderless"> 
        <tbody><tr>
            <td></td>
            <td>Consignee</td>
        </tr>
        <tr>
            <td></td>
            <td><label><input type="radio" name="Consigneefrom" value="Walk-In" checked="checked">Walk-In</label></td>
        </tr>
        <tr>
            <td>Mobile No <span style="color:red;font-weight:bold"> *</span></td>
            <td><input type="text" id="WIConsigneemob" name="WIConsigneemob" pattern="[0-9]+" maxlength="10" required=""></td>
        </tr>

        <tr>
            <td>Consignee Name</td>
            <td style="display:none"><input type="text" id="FMConsignee" name="FMConsignee" size="10" class="ui-autocomplete-input" autocomplete="off">-<input type="text" id="FMConsigneeName" name="FMConsigneeName" disabed=""></td>
            <td><input type="text" id="WIConsignee" name="WIConsignee" required=""><br>
                <input type="text" id="WIConsigneeMar" name="WIConsigneeMar" required=""></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" id="WIConsigneeadd" name="WIConsigneeadd" style="text-transform:uppercase" required=""><br>
                    <input type="text" id="WIConsigneeaddMar" name="WIConsigneeaddMar" style="text-transform:uppercase" required=""></td>
                </tr>
            </tbody></table>
            <table id="invtab" class="blueTable">
                <tbody><tr align="center">
                    <th>Invoice No</th>
                    <th>Invoice Date</th>
                    <th>Packaging Type</th>
                    <th>Product Type</th>
                    <th>Invoice Gross Value  <span style="color:red;font-weight:bold"> *</span></th>
                    <th>No of Pkgs.</th>
                    <th>Length(inch)</th>
                    <th>Width(inch)</th>
                    <th>Height(inch)</th>
                    <th>Actual Weight/Pkg(inch)</th>
                    <th>Actual Weight (inch)</th>
                    <th>Actual Weight/Pkg</th>
                    <th>Actual Weight </th>
                    <th style="display:none">Excess Rate(In Rs.)</th>
                </tr>
                <tr id="row1">
                    <td><input type="text" name="invoiceno[]" size="10"></td>
                    <td><input type="text" id="invdate1" name="invoicedate[]" value="27/02/2023" size="10" readonly="" class="hasDatepicker"></td>
                    <td><select name="pkgtype[]">
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
                    </select></td>
                    <td><select name="prodtype[]">
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
                    </select></td>
                    <td><input type="text" name="declval[]" size="10" pattern="[0-9]+"  required=""></td>
                    <td><input type="text" name="pkgno[]" size="10"  pattern="[0-9]+"  required=""></td>

                    <td><input type="text" name="length[]" size="5"  pattern="[0-9]+([\.,][0-9]+)?" step="0.01" required=""></td>

                    <td><input type="text" name="width[]" size="5"  pattern="[0-9]+([\.,][0-9]+)?" step="0.01"  required=""></td>
                    <td><input type="text" name="height[]" size="5"  pattern="[0-9]+([\.,][0-9]+)?" step="0.01"  required=""></td>

                    <td><input type="text" name="actwtperpkg[]" size="4"  pattern="[0-9]+" required="" readonly=""></td>

                    <td><input type="text" name="actwt[]" size="4" readonly=""></td>

                    <td><input type="text" name="actwtperpkg_w[]" size="4"  pattern="[0-9]+" required=""></td>
                    <td><input type="text" name="actwt_w[]" size="5" readonly=""></td>

                    <td style="display:none"><input type="text" name="Exwtchrgs[]" size="10" readonly=""></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">Total</td>
                    <td><input type="text" id="tdeclval" name="tdeclval" size="10" readonly=""></td>
                    <td><input type="text" id="tpkgno" name="tpkgno" size="10" readonly=""></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="text" id="tactwt" name="tactwt" size="10" readonly=""></td>
                    <td></td>
                    <td><input type="text" id="actwttotal" name="actwttotal" size="10" readonly=""> </td>
                    <td><input type="button" id="addrow"  value="Add Row"></td>
                </tr>
            </tbody></table>

            <table cellpadding="4" class="table table-borderless">
                <tbody><tr>
                    <td valign="Top">Eway Bill No. : <br>(Separated by Comma)</td>
                    <td><textarea id="EWBNOS" name="EWBNOS" cols="142" rows="2" ></textarea></td>
                </tr>
            </tbody></table>
            <table width="80%" cellpadding="4" class="table table-borderless">
               <tbody><tr style="display:none">
                <td></td>
                <td></td>
                <td>Estimated Delivery Date :</td>
                <td><input type="text" id="eddate" name="eddate" size="10" value="03/03/2023" readonly="" class="hasDatepicker">
                </td>
            </tr> 
            <tr>
                <td>Freight Rate :  <span style="color:red;font-weight:bold"> *</span></td>
                <td><input type="text" id="freightrate" name="freightrate" size="10"  required="">
                    <select id="freighttype" name="freighttype"  required="">
                        <option value="flat">FLAT (IN Rs)</option>
                        <option value="perkg">Per KG</option>
                        <option value="perpkg">Per PKG</option>
                        <option value="perton">Per TON</option>
                        <option value="quintal">Quintal</option>
                        <option value="kmwise">KM WISE</option>
                        <option value="vehiclewise">Vehicle WISE</option>
                        <option value="metricton">METRIC TON</option>
                    </select></td>
                    <td>Freight Charge :</td>
                    <td><input type="text" id="freightotal" name="freightotal" size="10" readonly="" required=""></td>
                    <td>Document Charges :</td>
                    <td><input type="number" id="doccharge" name="doccharge" size="10" value="10" min="10" ></td>
                </tr>
                <tr>
                    <td>Pickup/Other Charges :</td>
                    <td><input type="text" id="othercharge" name="othercharge" size="10" value="0" ></td>
                    <td>Hamali Charges :</td>
                    <td><input type="number" id="hamalicharge" name="hamalicharge" min="0" value="" ></td>
                    <td>Excess Weight Charges :</td>
                    <td><input type="text" id="excesscharge" name="excesscharge" size="10" value="0" ></td>
                    <td>Value Search Charge :</td>            
                    <td><input type="checkbox" id="valuesearch" name="valuesearch" value="0.005" onclick="lrtotal();">
                    </td>
                </tr>
                <tr>
                    <td>Door Del. Charges :</td>
                    <td><input type="text" id="doordelcharge" name="doordelcharge" size="10" value="0"  readonly=""></td>
                    <td>CGST + SGST Rate(%) :</td>
                    <td><select id="csgstrate" name="csgstrate" style="width:100px" disabled="">
                        <option value="0">0</option>
                        <option value="2.5+2.5">2.5+2.5</option>
                        <!--<option value="6+6">6+6</option>-->
                    </select></td>
                    <td>CGST + SGST Amount :</td>
                    <td><input type="text" id="csgst" name="csgst" size="10" value="0" ></td>
                    <td>Grand Total :</td>
                    <td><input type="text" id="grandtotal" name="grandtotal" size="10" readonly=""></td>
                </tr>
            </tbody></table>
            <br>
            <input type="submit" id="Submit" name="Submit" value="Create LR" onclick="return validate()">
            <input type="hidden" name="Submit" value="Create LR">
        </div>
    </form>