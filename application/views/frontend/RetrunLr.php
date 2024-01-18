<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') 
?>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

<script>
    function removeSpaces(string) {
        return string.split(' ').join('');
    }
            $(document).ready(function () {
            $("#row1").hide();
        });
       $(function () {
            $("#tocity").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/CityName',
                select: function (event, ui) {
                    $("#tocity").val(ui.item.CityNameEng);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#tocity").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.District + ": " + item.CityNameEng + "</a>")
                    .appendTo(ul);
            };  
        });
        $(function () {
            $("#fromcity").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/CityName',
                select: function (event, ui) {
                    $("#fromcity").val(ui.item.CityNameEng);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#fromcity").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.District + ": " + item.CityNameEng + "</a>")
                    .appendTo(ul);
            };  
        });
       $(function () {
            $("#partyid").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/SearchcustCode',
                select: function (event, ui) {
                    $("#partyid").val(ui.item.CustCode);
                    $("#FMConsignor").val(ui.item.CustCode);
                    $("#partyname").val(ui.item.CustName);
                    $("#FMConsignorName").val(ui.item.CustName); 
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#partyid").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };  
        });
        $(function () {
            $("#FMConsignee").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/FMConsignees1',
                        dataType: 'json',
                        data: {
                            term: request.term,
                            partyid: $("#partyid").val(),
                            city: $("#tocity").val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $("#FMConsignee").val(ui.item.CustCode);
                    $("#FMConsigneeName").val(ui.item.CustName);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#FMConsignee").autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };
        });
        $(function () {
            $("#FMConsignor").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/SearchcustCode',
                        dataType: 'json',
                        data: {
                            term: request.term,
                            partyid: $("#partyid").val(),
                            city: $("#tocity").val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
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
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#FMConsignor").autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };
        });
</script>

    <script>
        $('#WIConsigneemob').bind('input', function () {
            alert('executed');
            if ($('#WIConsigneemob').val().length != 0 || $('#WIConsigneemob').val().length != 10)
                this.setCustomValidity('Please Enter valid Mobile No.');
            else
                this.setCustomValidity('');
        });
             function chkvalidity(id) {
            if (id.value == '')
                id.setCustomValidity('Please enter value.');
            else
                id.setCustomValidity('Please enter Number Only');
        }

        function paytypechange() {
            switch (document.getElementById("paytype").value) {
                case 'TBB':
                    document.getElementById("partyid").disabled = false;
                    document.getElementById("partyid").required = true;
                    document.getElementById("csgstrate").value = "0";
                    break;
                case 'PAID':
                    document.getElementById("partyid").disabled = true;
                    document.getElementById("partyid").required = false;
                    document.getElementById("partyid").value = '';
                    document.getElementById("partyname").value = '';
                    document.getElementById("csgstrate").value = "2.5+2.5";
                    break;
                case 'TO PAY':
                    document.getElementById("partyid").disabled = false;
                    document.getElementById("partyid").required = false;
                    document.getElementById("partyid").value = '';
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
            }
        }

        function IsJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#row1").hide();
        });
       $(function () {
            $("#tocity").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/CityName',
                select: function (event, ui) {
                    $("#tocity").val(ui.item.CityNameEng);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#tocity").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.District + ": " + item.CityNameEng + "</a>")
                    .appendTo(ul);
            };  
        });
        $(function () {
            $("#fromcity").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/CityName',
                select: function (event, ui) {
                    $("#fromcity").val(ui.item.CityNameEng);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#fromcity").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.District + ": " + item.CityNameEng + "</a>")
                    .appendTo(ul);
            };  
        });
       $(function () {
            $("#partyid").autocomplete({
                minLength: 1,
                source: '<?php echo base_url(); ?>/SearchcustCode',
                select: function (event, ui) {
                    $("#partyid").val(ui.item.CustCode);
                    $("#FMConsignor").val(ui.item.CustCode);
                    $("#partyname").val(ui.item.CustName);
                    $("#FMConsignorName").val(ui.item.CustName); 
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#partyid").autocomplete().data("uiAutocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };  
        });
        $(function () {
            $("#FMConsignee").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/FMConsignees1',
                        dataType: 'json',
                        data: {
                            term: request.term,
                            partyid: $("#partyid").val(),
                            city: $("#tocity").val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $("#FMConsignee").val(ui.item.CustCode);
                    $("#FMConsigneeName").val(ui.item.CustName);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item == null) {
                        event.currentTarget.value = '';
                        event.currentTarget.focus();
                    }
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#FMConsignee").autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };
        });
        $(function () {
            $("#FMConsignor").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/SearchcustCode',
                        dataType: 'json',
                        data: {
                            term: request.term,
                            partyid: $("#partyid").val(),
                            city: $("#tocity").val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
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
                },
                open: function () {
                    $('.ui-autocomplete').css('width', '400px');
                }
            });

            $("#FMConsignor").autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<a>" + item.CustCode + ": " + item.CustName + "</a>")
                    .appendTo(ul);
            };
        });

    </script>
    <script type="text/javascript">
        $(function () {
            $("#lrdate").datepicker({dateFormat: "dd/mm/yy"});
            $("#eddate").datepicker({dateFormat: "dd/mm/yy"});
            $("#invdate2").datepicker({dateFormat: "dd/mm/yy"});
             });
        var lastrowid = 1;
        function add_row() {
            if ($("#invtab tr").length > 8) {
                alert("Cannot add more than 7 rows.");
                return;
            }
            lastrowid = lastrowid + 1;
            var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
            htmltxt = htmltxt.replace("invdate1", "invdate" + lastrowid);
            $("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "')></td></tr>");

            $(function () {
                $("#invdate" + lastrowid).datepicker({dateFormat: "dd/mm/yy"});
            });
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

        function validate() {
            if ($("#form1")[0].checkValidity()) {
                $("#form1").find("input,select,textarea").prop('disabled', false);
                if (document.form1.Consignorfrom.value == "From Master")
                    radclick('crfm');
                else
                    radclick('crwi');
                if (document.form1.Consigneefrom.value == "From Master")
                    radclick('cefm');
                else
                    radclick('cewi');
                $("#row1").find("input,select").attr("disabled", "disabled");
            } else
                $("#form1")[0].reportValidity();
        }

    </script>
    <script type="text/javascript">
            function step1click() {
        if ($("#form1")[0].checkValidity()) {
            $.ajax({
                type: 'post',
                url: 'Lredit/fetch_data1',
                data: {
                        ConID: document.getElementById('partyid').value,
                        LRDate: document.getElementById('lrdate').value,
                        PayType: document.getElementById('paytype').value
                },
                success: function (response) {
                    if (response && IsJsonString(response)) {
                        ewobj = JSON.parse(response);
                        document.getElementById('doccharge').value = ewobj.DocumentCharges || 0;

                        // Check if ewobj.ServiceType is not null or undefined and has a length property
                        if (ewobj.ServiceType && ewobj.ServiceType.length) {
                            $("#servicetype").empty();
                            var st = ewobj.ServiceType.split(",");
                            for (var i = 0; i < st.length; i++)
                                $("#servicetype").append("<option value='" + st[i] + "'>" + st[i].toUpperCase() + "</option>");
                        }

                        // Check if ewobj.PickupDelivery is not null or undefined and has a length property
                        if (ewobj.ServiceType && ewobj.ServiceType.length) {
                            $("#servicetype").empty();
                            var st = ewobj.ServiceType.split(",");
                            for (var i = 0; i < st.length; i++) {
                                $("#servicetype").append("<option value='" + st[i] + "'>" + st[i].toUpperCase() + "</option>");
                            }
                        } else {
                            // If ewobj.ServiceType is null, set default options
                            $("#servicetype").empty();
                            $("#servicetype").append("<option value='LTL'>LTL</option>");
                            $("#servicetype").append("<option value='FTL'>FTL</option>");
                        }

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
            $("#form1")[0].reportValidity();
        }
    }

        function step2click() {
                if ($("#form1")[0].checkValidity()) {
                    var cityexist = false;
                    $.ajax({
                        async: false,
                        type: "GET",
                        url: '<?php echo base_url(); ?>Lredit/checkcityEdit',
                        data: {term: document.getElementById("fromcity").value},
                        success: function (response) {
                        var lines = response.split('\n');
                         if (lines.length >= 2 && lines[1].trim() === "Success")
                                cityexist = true;
                        }
                    });
                    if (cityexist == false) {
                        alert("From City is not in City Master.");
                        document.getElementById("fromcity").value = "";
                        document.getElementById("fromcity").focus();
                        return;
                    }
                    calamt(document.getElementsByName('pkgno[]')[1]);
                    calinvamt();
                    cityexist = false;
                    $.ajax({
                        async: false,
                        type: "GET",
                         url: '<?php echo base_url(); ?>Lredit/checkcityEdit',
                        data: {term: document.getElementById("tocity").value},
                        success: function (response) {
                        var lines = response.split('\n');
                         if (lines.length >= 2 && lines[1].trim() === "Success")
                                cityexist = true;
                        }
                    });
                    if (cityexist == false) {
                        alert("To City is not in City Master.");
                        document.getElementById("tocity").value = "";
                        document.getElementById("tocity").focus();
                        return;
                    }

                    document.getElementById('btnstep2').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';
                    $("#step1").find("input,select").attr("disabled", "disabled");
                    document.getElementById("FMConsignor").required = true;
                    document.getElementById("FMConsignee").required = true;
                    document.getElementsByName('invoiceno[]')[0].value = "0";
                    document.getElementsByName('declval[]')[0].value = "0";
                    document.getElementsByName('pkgno[]')[0].value = "0";
                    document.getElementsByName('actwtperpkg[]')[0].value = "0";
                    document.getElementsByName('actwt[]')[0].value = "0";
                    document.getElementsByName('Exwtchrgs[]')[0].value = "0";
                    document.getElementsByName('invoiceno[]')[0].required = true;
                    document.getElementsByName('declval[]')[0].required = true;
                    document.getElementsByName('pkgno[]')[0].required = true;
                    document.getElementsByName('actwtperpkg[]')[0].required = true;
                    $("#FMConsignee").focus();
                } else  //Validate Form
                    $("#form1")[0].reportValidity();
        }
        function step3click() {
                    if ($("#form1")[0].checkValidity()) {
                        var str = document.getElementById('EWBNOS').value;
                        if (str != "") {
                            var EWBNos = str.split(",");
                            for (var i = 0; i < EWBNos.length; i++) {
                                if (/^\d+$/.test(EWBNos[i]) == false || EWBNos[i].trim().length != 12) {
                                    alert("Invalid Eway Bill No.");
                                    return;
                                }
                            }
                        }
                        if (ewobj != undefined) {
                            $.ajax({
                                type: 'post',
                                url: 'Lredit/fetch_dataEdit',
                                data: {
                                    ContractID: ewobj.ContractID,
                                    Qty: document.getElementById('tpkgno').value,
                                    ToPlace: document.getElementById('tocity').value,
                                    MA: ewobj.MatricesAllowed
                                },
                                success: function (response) {
                                    //alert(response);
                                    if (IsJsonString(response)) {
                                        freightobj = JSON.parse(response);
                                        document.getElementById('freightrate').value = freightobj.Rate;
                                        document.getElementById('freighttype').value = freightobj.RateType;
                                        document.getElementById('doordelcharge').value = freightobj.DDCharge;
                                        /*var edd = $("#eddate").datepicker('getDate');
                                         edd.setDate(edd.getDate() + parseInt(freightobj.TransitDay));
                                        $('#eddate').datepicker('setDate', edd);*/
                                        lrtotal();
                                    }
                                },
                                error: function (response) {
                                    alert(response);
                                }
                            });
                        }

                        switch (document.getElementById("paytype").value) {
                            case 'TBB':
                                document.getElementById("csgstrate").value = "0";
                                break;
                            case 'PAID':
                                document.getElementById("csgstrate").value = "6+6";
                                break;
                            case 'TO PAY':
                                document.getElementById("csgstrate").value = "6+6";
                                break;
                            case 'FOC':
                                document.getElementById("csgstrate").value = "0";
                                break;
                        }

                        var edd = $("#eddate").datepicker('getDate');
                        edd.setDate(edd.getDate() + 4);
                        $('#eddate').datepicker('setDate', edd);

                        document.getElementById('btnstep3').style.display = 'none';
                        document.getElementById('step3').style.display = 'block';
                        $("#step2").find("input,select,textarea").attr("disabled", "disabled");
                        document.getElementById("freightrate").required = true;
                        //document.getElementById("csgstrate").required = true;
                    } else  //Validate Form
                        $("#form1")[0].reportValidity();
                }
    </script>
    <script type="text/javascript">
      function calamt(e) {
            var qty;
            //var wtcharg;
            var wtperpkg;
            var wt;
            var twt = 0;
            var tqty = 0;
            var tewtchrg = 0;
            var index = 99;
            var i = 0;

            qty = document.getElementsByName('pkgno[]');
            wtperpkg = document.getElementsByName('actwtperpkg[]');
            wt = document.getElementsByName('actwt[]');
            var ewtchrg = document.getElementsByName('Exwtchrgs[]');

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

            wt[index].value = parseFloat(qty[index].value) * parseFloat(wtperpkg[index].value);

            if (ewobj !== undefined && Array.isArray(ewobj.Rates)) {
                for (var j = 0, jLen = ewobj.Rates.length; j < jLen; j++) {
                    if (wtperpkg[index].value >= ewobj.Rates[j].FromWeight && wtperpkg[index].value <= ewobj.Rates[j].ToWeight) {
                        ewtchrg[index].value = ewobj.Rates[j].Rate;
                        break;
                    }
                }
            } else {
                // Handle the case where ewobj.Rates is undefined or not an array
                ewtchrg[index].value = 0;
            }

            for (var i = 0, iLen = wt.length; i < iLen; i++) {
                if (wt[i].value != "")
                    twt += parseFloat(wt[i].value);
                if (qty[i].value != "")
                    tqty += parseFloat(qty[i].value);
                // if (qty[i].value != "" && ewtchrg[i].value != "")
                //     tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);
            }
            document.getElementById("tactwt").value = twt;
            document.getElementById("tpkgno").value = tqty;
            // document.getElementById("excesscharge").value = tewtchrg;
        }

        function calinvamt() {
            var tinvamt = 0;
            var tinvamt1 = 0;
            var tinvoiceamt = 0;
            var invamt = document.getElementsByName('declval[]');
            var invamt1 = document.getElementsByName('declval1[]');

            for (var i = 0, iLen = invamt.length; i < iLen; i++)
                if (invamt[i].value != "")
                    tinvamt += parseFloat(invamt[i].value);

            for (var i = 0, iLen1 = invamt1.length; i < iLen1; i++)
                if (invamt1[i].value != "")
                    tinvamt1 += parseFloat(invamt1[i].value);

            tinvoiceamt = tinvamt + tinvamt1;

            document.getElementById("tdeclval").value = tinvoiceamt;
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
                alert(total);
            document.getElementById("grandtotal").value = total;
            if( total >= 0 && (document.getElementById("paytype").value == "PAID" || document.getElementById("paytype").value == "TO PAY"))
                document.getElementById("csgstrate").value = "6+6";
            else
                document.getElementById("csgstrate").value = "0";

            if (document.getElementById("csgstrate").value == "6+6" ) {
                document.getElementById("grandtotal").value = total + parseInt(total * 0.12);
                document.getElementById("csgst").value = parseInt(total * 0.12);
            } else if (document.getElementById("csgstrate").value == "6+6") {
                document.getElementById("grandtotal").value = total + parseInt(total * 0.12);
                document.getElementById("csgst").value = parseInt(total * 0.12);
            } else {
                document.getElementById("grandtotal").value = total;
                document.getElementById("csgst").value = 0;
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
    </script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">LR ENTRY</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">LR Entry</li>
                </ol>
            </nav>
        </div>
 <?php if (isset($lrdata) && !empty($lrdata)): ?>
    <?php foreach ($lrdata as $lr): ?>
        <form  class="form-sample" method="post" id="form1" name='form1' enctype='multipart/form-data' action="<?php echo base_url();?>RetrunLrInsert">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card" >
                        <div class="card-body">
                            <div  id="step0">
                            <div class="row">
                                <div class="col-sm">
                                    <label>LR DATE:</label>
                                    <input type="hidden" id="LRNO" name="LRNO" class="form-control" value="<?= $lr['LRNO']; ?>" readonly>
                                    <input type="text" id="lrdate" name="lrdate" class="form-control" value="<?= $lr['LRDate']; ?>" readonly>
                                </div>
                                <div class="col-sm">
                                    <label for="paytype">PAYMENT TYPE:</label>
                                    <select id="paytype" style="padding: 3%;" class="form-control" name="paytype" onchange="paytypechange()" required>
                                        <option value="TBB" <?= ($lr['PayBasis'] == 'TBB') ? 'selected' : ''; ?>>TBB</option>
                                        <option value="PAID" <?= ($lr['PayBasis'] == 'PAID') ? 'selected' : ''; ?>>PAID</option>
                                        <option value="TO PAY" <?= ($lr['PayBasis'] == 'TO PAY') ? 'selected' : ''; ?>>TO PAY</option>
                                        <option value="FOC" <?= ($lr['PayBasis'] == 'FOC') ? 'selected' : ''; ?>>FOC</option>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="paytype">CoastCenter:</label>
                                    <input type="text" id="CoastCenter" class="form-control" name="CoastCenter" style='text-transform:uppercase'
                                        value='<?= $lr['CoastCenter']; ?>' disabled>
                                </div>
                            </div>

                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <label>CONTRACT PARTY:</label>
                                        <input type="text" id="partyid" name="partyid" class="form-control" style="text-transform: uppercase" value="<?= $lr['BillingParty']; ?>" required>
                                        <datalist id="partyid-list">
                                        </datalist>
                                        -
                                        <input type="text" id="partyname" name="partyname" class="form-control" value="<?= ($lr['BillingParty'] == $lr['ConsignorId']) ? $lr['Consignor'] : (($lr['BillingParty'] == $lr['ConsigneeId']) ? $lr['Consignee'] : ''); ?>" disabled>
                                    </div>
                                    <div class="col-sm">
                                        <label>ORIGIN:</label>
                                        <input type="text" id="Origin" name="Origin" class="form-control" value="<?= $lr['Origin']; ?>" disabled>
                                    </div>
                                    <div class="col-sm">
                                        <label>DISTINATION:</label>
                                        <input type="text" id="Destination" name="Destination" class="form-control" value="<?= $lr['Destination']; ?>" style='text-transform: uppercase'>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                          <input type="button" class="btn btn-outline-dark btn-fw" onclick="step1click()" id="btnstep1"  value="Step 1">
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
                                     <select id='servicetype' class="form-control" name='servicetype' style='width:200px'>
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
                                    value='<?= $lr['FromPlace']; ?>'>
                                </div>
                                <div class="col">
                                    <label >TO CITY:</label><br>
                                    <input type="text" class="form-control"  id="tocity" list="District-list" name="tocity" style='text-transform:uppercase' value="<?= $lr['ToPlace']; ?>">
                                    <datalist id="District-list"></datalist>
                                </div>
                            </div>
                            <br>
                            <br>
                            <input type="button" class="btn btn-outline-dark btn-fw"  id="btnstep2" onclick="step2click()" value="Step 2">
                        </div>
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
                                 <?php if ($lr['ConsignorId'] == '8888'): ?>
                                <label><input type='radio' name='Consignorfrom' value='From Master' onclick="radclick('crfm')"
                                  checked>From Master</label>
                                  </div>
                                  <div class="col">
                                  <label><input type='radio' name='Consignorfrom' value='Walk-In'
                                      onclick="radclick('crwi')">Walk-In</label>
                                      </div>
                                      <div class="col">
                                <?php else: ?>
                                <label><input type='radio' name='Consignorfrom' value='From Master' onclick="radclick('crfm')"
                                  checked>From Master</label>
                                  </div>
                                  <div class="col">
                                  <label><input type='radio' name='Consignorfrom' value='Walk-In'
                                      onclick="radclick('crwi')">Walk-In</label>
                                      <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <label>From Master</label>
                                        <?php if ($lr['ConsignorId'] == '8888'): ?>
                                            <input type="text" id='FMConsignor' class="form-control" name='FMConsignor' size="10" disabled>
                                            -<input type="text" id='FMConsignorName' class="form-control" name='FMConsignorName' disabled>
                                            <input type="text" id='WIConsignor' name='WIConsignor' value="<?php echo $lr['Consignor']; ?>" required>
                                        <?php else: ?>
                                            <input type="text" id='FMConsignor' class="form-control" name='FMConsignor' size="10" value="<?php echo $lr['ConsignorId']; ?>">
                                            -<input type="text" id='FMConsignorName' class="form-control" name='FMConsignorName' value="<?php echo $lr['Consignor']; ?>" disabled>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <!-- This input will always be displayed -->
                                        <input type="text" id='WIConsignor' class="form-control" name='FMConsignor' required disabled>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                   <div class="col-md-6">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id='WIConsignoradd' class="form-control" name='WIConsignoradd' value="<?php echo $lr['ConsignorAdd']; ?>"
                                                   style='text-transform:uppercase'
                                                   required disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">Mobile No</div>
                                <div class="col-md-6">
                                    <input type="text" id='WIConsignormob' class="form-control" name='WIConsignormob'
                                                   value="<?php echo $lr['ConsignorMob']; ?>" pattern="[0-9]+" maxlength=10 required
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
                                   <?php if ($lr['ConsigneeId'] == '8888'): ?>
                                        <label><input type='radio' name='Consigneefrom' value='From Master' onclick="radclick('cefm')">From Master</label>
                                        </div>
                                        <div class="col">
                                            <label><input type='radio' name='Consigneefrom' value='Walk-In' onclick="radclick('cewi')" checked>Walk-In</label>
                                            </div>
                                    <?php else: ?>
                                        <div class="col">
                                        <label><input type='radio' name='Consigneefrom' class="form-control" value='From Master' onclick="radclick('cefm')">From Master</label>
                                        </div>
                                        <div class="col">
                                            <label><input type='radio' name='Consigneefrom' class="form-control" value='Walk-In' onclick="radclick('cewi')" checked>Walk-In</label>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6 d-flex">
                                            <label>From Master</label>
                                           <?php if ($lr['ConsigneeId'] == '8888'): ?>
                                            <input type="text" id='FMConsignee' class="form-control" name='FMConsignee' size="10" disabled>-<input
                                                        type="text" id='FMConsigneeName' name='FMConsigneeName' disabled>
                                                         </div>
                                                       <div class="col-md-6 d-flex">
                                              <input type="text" id='WIConsignee' class="form-control" name='WIConsignee' value="<?php echo $lr['Consignee']; ?>"
                                                       disabled required>

                                                <input type="text" id='WIConsigneeMar' class="form-control" name='WIConsigneeMar'
                                                       value="<?php echo $lr['ConsigneeMar']; ?>" disabled required>
                                                </div>
                                        <?php else: ?>
                                            <input type="text" id='FMConsignee' class="form-control" name='FMConsignee' value="<?php echo $lr['ConsigneeId']; ?>"
                                                       size="10">-<input type="text" class="form-control" id='FMConsigneeName' name='FMConsigneeName'
                                                                         value="<?php echo $lr['Consignee']; ?>" disabled>
                                        </div>
                                        <?php endif; ?>
                                   </div><br>
                                   <div class="row">
                                       <div class="col-md-6 pt-4">
                                    <label>Address</label>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                         <input type="text" id='WIConsigneeadd' class="form-control" name='WIConsigneeadd'
                                                   value="<?php echo $lr['ConsigneeAdd']; ?>" style='text-transform:uppercase'
                                                   required disabled><br>
                                            <input type="text" id='WIConsigneeaddMar' class="form-control" name='WIConsigneeaddMar'
                                                   value="<?php echo $lr['ConsigneeAddMar']; ?>" style='text-transform:uppercase'
                                                   required disabled>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">Mobile No</div>
                                    <div class="col-md-6">
                                        <input type="text" id='WIConsigneemob' class="form-control" name='WIConsigneemob'
                                                   value="<?php echo $lr['ConsigneeMob']; ?>" pattern="[0-9]+" maxlength=10 required
                                                   disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="table-container">
                          <table id="invtab">
                            <thead class="table-primary">
                                 <tr>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>
                                        <th>Packaging Type</th>
                                        <th>Product Type</th>
                                        <th>Invoice Gross Value</th>
                                        <th>No of Pkgs.</th>
                                        <th>Actual Weight/Pkg</th>
                                        <th>Actual Weight</th>
                                        <th>Excess Rate(In Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='row1' style="border-bottom:hidden!important;border-top:hidden!important;">
                                        <td><input type='text' name='invoiceno[]' size=10></td>
                                        <td><input type='text' id="invdate1" name='invoicedate[]'size=10
                                                   readonly></td>
                                        <td><select name='pkgtype[]'>
                                                <option value="BAGS">BAGS</option>
                                                <option value="BOX">BOX</option>
                                                <option value="BUCKETS">BUCKETS</option>
                                                <option value="BUNDAL">BUNDAL</option>
                                                <option value="CAN">CAN</option>
                                                <option value="DRUM">DRUM</option>
                                                <option value="PACKET">PACKET</option>
                                                <option value="PIPE">PIPE</option>
                                                <option value="TYRES">TYRES</option>
                                                <option value="WOODEN FRAME">WOODEN FRAME</option>
                                            </select></td>
                                        <td><select name='prodtype[]'>
                                                <option value="ADVERTISE MATERIAL">ADVERTISE MATERIAL</option>
                                                <option value="Auto parts">Auto parts</option>
                                            <option value="FERTILIZERS">FERTILIZERS</option>
                                            <option value="MEDICINE">MEDICINE</option>
                                            <option value="PALLETS">PALLETS</option>
                                            <option value="PESTICIDES">PESTICIDES</option>
                                            <option value="SEEDS">SEEDS</option>
                                            <option value="SPRAY PUMP">SPRAY PUMP</option>
                                            <option value="STATIONERY">STATIONERY</option>
                                            </select></td>
                                        <td><input type='text' name='declval[]' size=10 onchange="calinvamt()" pattern="[0-9]+"
                                                   oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                        <td><input type='text' name='pkgno[]' size=10 onchange="calamt(this)" pattern="[0-9]+"
                                                   oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                        <td><input type='text' name='actwtperpkg[]' size=10 onchange="calamt(this)" pattern="^\d+(\.\d+)?$"
                                                   oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                        <td><input type='text' name='actwt[]' size=10 readonly></td>
                                        <td><input type='text' name='Exwtchrgs[]' size=10 readonly></td>
                            </tr>
                        <?php
                        $i = 2;
                        if (isset($lrdata1) && !empty($lrdata1)):
                            foreach ($lrdata1 as $lr1):
                                ?>
                                    
                            <tr id="row<?= $i;?>" style="border-bottom:hidden!important;border-top:hidden!important;">
                                             <td><input type='text' name='invoiceno[]' value="<?php echo $lr1['InvoiceNo']; ?>" size=10></td>
                                            <td><input type='text' id="invdate" name='invoicedate[]'
                                                               value="<?php echo $lr1['InvDate']; ?>"
                                                               size=10
                                                   readonly></td>
                                                  <td>
                                        <select name='pkgtype[]'>
                                            <option value="BAGS" <?php if ($lr1['PkgType'] == 'BAGS') echo "selected='selected'"; ?>>BAGS</option>
                                            <option value="BOX" <?php if ($lr1['PkgType'] == 'BOX') echo "selected='selected'"; ?>>BOX</option>
                                            <option value="BUCKETS" <?php if ($lr1['PkgType'] == 'BUCKETS') echo "selected='selected'"; ?>>BUCKETS</option>
                                            <option value="BUNDAL" <?php if ($lr1['PkgType'] == 'BUNDAL') echo "selected='selected'"; ?>>BUNDAL</option>
                                            <option value="CAN" <?php if ($lr1['PkgType'] == 'CAN') echo "selected='selected'"; ?>>CAN</option>
                                            <option value="DRUM" <?php if ($lr1['PkgType'] == 'DRUM') echo "selected='selected'"; ?>>DRUM</option>
                                            <option value="PACKET" <?php if ($lr1['PkgType'] == 'PACKET') echo "selected='selected'"; ?>>PACKET</option>
                                            <option value="PIPE" <?php if ($lr1['PkgType'] == 'PIPE') echo "selected='selected'"; ?>>PIPE</option>
                                            <option value="TYRES" <?php if ($lr1['PkgType'] == 'TYRES') echo "selected='selected'"; ?>>TYRES</option>
                                            <option value="WOODEN FRAME" <?php if ($lr1['PkgType'] == 'WOODEN FRAME') echo "selected='selected'"; ?>>WOODEN FRAME</option>
                                            </select>
                                        </td>
                                        <td><select name='prodtype[]'>
                                                    <option value="ADVERTISE MATERIAL"<?php if ($lr1['ProductType'] == 'ADVERTISE MATERIAL') echo "selected='selected'"; ?>>
                                                    ADVERTISE MATERIAL
                                                </option>
                                                <option value="Auto parts"<?php if ($lr1['ProductType'] == 'Auto parts') echo "selected='selected'"; ?>>
                                                    Auto parts
                                                </option>
                                                <option value="FERTILIZERS"<?php if ($lr1['ProductType'] == 'FERTILIZERS') echo "selected='selected'"; ?>>
                                                    FERTILIZERS
                                                </option>
                                                <option value="MEDICINE"<?php if ($lr1['ProductType'] == 'MEDICINE') echo "selected='selected'"; ?>>
                                                    MEDICINE
                                                </option>
                                                <option value="PALLETS"<?php if ($lr1['ProductType'] == 'PALLETS') echo "selected='selected'"; ?>>
                                                    PALLETS
                                                </option>
                                                <option value="PESTICIDES"<?php if ($lr1['ProductType'] == 'PESTICIDES') echo "selected='selected'"; ?>>
                                                    PESTICIDES
                                                </option>
                                                <option value="SEEDS"<?php if ($lr1['ProductType'] == 'SEEDS') echo "selected='selected'"; ?>>
                                                    SEEDS
                                                </option>
                                                <option value="SPRAY PUMP"<?php if ($lr1['ProductType'] == 'SPRAY PUMP') echo "selected='selected'"; ?>>
                                                    SPRAY PUMP
                                                </option>
                                                <option value="STATIONERY"<?php if ($lr1['ProductType'] == 'STATIONERY') echo "selected='selected'"; ?>>
                                                    STATIONERY
                                                </option>
                                                </select></td>
                                        <td><input type='text' name='declval[]' value="<?php echo $lr1['Invoicevalue']; ?>" size=10 onchange="calinvamt()" pattern="^\d+(\.\d+)?$" oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                        <td><input type='text' name='pkgno[]' value="<?php echo $lr1['PkgsNo']; ?>" size=10 onchange="calamt(this)" pattern="[0-9]+"
                                         oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                            <td><input type='text' name='actwtperpkg[]' value="<?php echo $lr1['ActwtperPkg']; ?>" size=10
                                                       onchange="calamt(this)" pattern="^\d+(\.\d+)?$"
                                                       oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                                            <td><input type='text' name='actwt[]' value="<?php echo $lr1['ActualWeight']; ?>" size=10 readonly>
                                            </td>
                                            <td><input type='text' name='Exwtchrgs[]' value="<?php echo $lr1['ExcessRate']; ?>" size=10 readonly>
                                            </td>
                                        <?php if ($i > 2): ?>
                                        <td><input type='button' value='DELETE' onclick="delete_row('row<?php echo $i; ?>')"></td>
                                    <?php endif; ?>
                            </tr>
                                 <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php
                        $strscript = "lastrowid = " . ($i - 1) . ";\n";
                        $strscript .= "paytypechange();\n";
                        if ($lr['ConsignorId'] == "8888")
                            $strscript .= "radclick('crwi');\n";
                        if ($lr['ConsignorId'] == "8888")
                            $strscript .= "radclick('cewi');\n";
                        ?>
                                <tr>
                                        <td colspan=4 align='right'>Total</td>
                                        <td><input type='text' id='tdeclval' name='tdeclval' size=10 readonly></td>
                                        <td><input type='text' id='tpkgno' name='tpkgno' size=10 readonly></td>
                                        <td></td>
                                        <td><input type='text' id='tactwt' name='tactwt' size=10 readonly></td>
                                        <td></td>
                                        <td><input type='button' id="addrow" name="addrow" onclick="add_row()" value='Add Row' class="btn btn-outline-dark btn-fw"></td>
                                </tr> 
        </tbody>
    </table>
</div>
<table cellpadding='4'>
    <tr>
        <td valign="Top">Eway Bill No. : <br>(Separated by Comma)</td>
        <td>
                <?php if (is_array($lrdata2) || is_object($lrdata2)): ?>
                    <textarea id="EWBNOS" name="EWBNOS" cols="80" rows="5"><?= implode(',', $lrdata2); ?></textarea>
                    <?php else: ?>
                        <textarea id="EWBNOS" name="EWBNOS" cols="80" rows="5"><?= $lrdata2; ?></textarea>
                    <?php endif; ?>
        </td>
    </tr>
</table>
<input type="button" id="btnstep3" class="btn btn-outline-dark btn-fw" onclick="step3click()" value="Step 3"><br><br>
</div>
                            <?php endforeach; date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $datestr = $date->format('d/m/Y');?>
                                    <?php endif; ?>
<div id="step3" style="display:none;" >
    <table>
        <div class="row">
            <div class="col-sm">Estimated Delivery Date :
            </div>
            <div class="col-sm">
           <input type="text" id="eddate" class="form-control" name='eddate' size="10" value="<?= $datestr ?>" readonly>         </div>
        </div>
        <br>
        <div class="row">
            <div class="col">Freight Rate :</div>
            <div class="col">
                <input type="text" class="form-control" id="freightrate" name="freightrate" size="10" oninput="paytypechange()" onchange="lrtotal()">
                    <select id='freighttype' class="form-control" name='freighttype' onchange="lrtotal()">
                            <option value="flat">FLAT (IN Rs)</option>
                            <option value="perkg">Per KG</option>
                            <option value="perpkg">Per PKG</option>
                            <option value="gram">GRAM</option>
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
                    <input type="text" class="form-control" id="freightotal" name="freightotal" size=10 readonly>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">Document Charges :</div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="doccharge" name="doccharge" size=10 value="0" onchange="lrtotal()">
            </div>
            <div class="col-md-3">Other Charges :
            </div>
            <div class="col-md-3">
               <input type="text" class="form-control" id="othercharge" name="othercharge" size=10 value="0" onchange="lrtotal()">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">Hamali Charges :</div>
            <div class="col-md-3">
                 <input type="text" class="form-control" id="hamalicharge" name="hamalicharge" size=10 value="0" onchange="lrtotal()">
            </div>
            <div class="col-md-3">Excess Weight Charges :</div>
            <div class="col-md-3">
                 <input type="text" class="form-control"  id="excesscharge" name="excesscharge" size=10 value="0" readonly>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3
            ">Door Del. Charges :</div>
            <div class="col-md-3">
               <input type="text" class="form-control" id="doordelcharge" name="doordelcharge" size=10 value="0" onchange="lrtotal()">
            </div>
            <div class="col-md-3">CGST + SGST Rate(%) :</div>
            <div class="col-md-3">
                <select id='csgstrate' class="form-control" name='csgstrate' style='width:100px' disabled>
                            <option value="0">0</option>
                            <option value="6+6">6+6</option>
                        </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-3">CGST + SGST Amount :
            </div >
            <div class="col-md-3"><input type="text" class="form-control" id="csgst" name="csgst" size=10 value="0">

            </div>
            <div class="col-md-3">Grand Total :
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="grandtotal" name="grandtotal" size=10 readonly>
            </div>
        </div>
    </table>

    <br><br>              
    <input type='submit' class="btn btn-outline-dark btn-fw" class="touch" id='SubmitLR' name='Submit' value='Return Lr' onclick="return validate()">
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













