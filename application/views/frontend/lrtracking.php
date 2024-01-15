    <?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
      .table-scroll {
        overflow-x: auto;
    }
    }
  </style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">LR TRACKING</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">LR Tracking</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="row grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                   <form action="<?= base_url('Lrtracking_Controller/searchlrdata') ?>" method="POST">
								<div class="row d-flex">
								<div class="col-md-2">
								<label>Search By LR NO:</label>
								</div>
								<div class="col-md-3">
								<input type='text' class="form-control" id="LRNO" name='LRNO'>
								</div>
								</div>
<br>
							<div class="row d-flex">
							    <div class="col-md-2">
							        <label for="CustName">Search By Company Name.</label>
							    </div>
							    <div class="col-md-3">
							        <input type="text" class="form-control" id="CustName" name="CustName">
							    </div>
							</div>
<br>
                    	<div class ="row d-flex">
                    			<div class= "col-md-2">
                    			<label>Search By Party Name.</label>
                    		</div>
                    		<div class= "col-md-3">
                           <input type='text' class="form-control" id='Consignee' name='Consignee'>  </div>
                    	</div>
<br>
                    	<div class ="row d-flex">
                    			<div class= "col-md-2">
                    			<label>Search By Invoice NO.</label>
                    		</div>
                    		<div class= "col-md-3">
                            <input type='text' class="form-control" id='InvoiceNo' name='InvoiceNo'> </div>
                    	</div>
<br>
                    	<div class ="row d-flex">
                    			<div class= "col-md-2">
                    			<label>Search By Village Name..</label>
                    		</div>
                    		<div class= "col-md-3">
                             <input type='text' class="form-control" id='ToPlace' name='ToPlace'>                             </div>
                    	</div>
<center>
  <input type='submit' class="btn btn-outline-dark btn-fw"  name='Search' value='Search'></center>
                        </form>
                        <br>
<!-- ============================ -->

<?php if (isset($result)): ?>

        <div  class="table-container">
    <table id="invtab">
        <thead class="table-primary">
            <tr align="center">

                    <th>LR NO</th>
                    <th>LR DATE</th>
                    <th>COMPANY NAME</th>
                    <th>PARTY NAME</th>
                    <th>FROM PLACE</th>
                    <th>TO PALCE</th>
                    <th>MATERIAL QUANTITY</th>
                    <th>EXP.DEL.DATE</th>
                    <th>CANCEL REASON</th>
                    <th>CANCEL DATE</th>
                    <th>CANCEL USER</th>
                    <th>DRSTHC NO</th>
                    <th>CURRENT LOCATION</th>
                    <th>NEXT LOCATION</th>
                    <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr><td>
                   <a href=<?= base_url('Lrtracking_Controller/trackLR/' . $row->LRNO) ?>><?= $row->LRNO ?></a>
                    </td>
                    <td><?= $row->LRDate ?></td>
                     <td><?= $row->Consignor ?></td>
                    <td><?= $row->Consignee ?></td>
                     <td><?= $row->FromPlace ?></td>
                    <td><?= $row->ToPlace ?></td>
                     <td><?= $row->PkgsNo ?></td>
                    <td><?= $row->EDD ?></td>
                     <td><?= $row->CancelReason ?></td>
                    <td><?= $row->CancelDate ?></td>
                     <td><?= $row->CancelUser ?></td>
                    <td><?= $row->DRS_THCNO ?></td>
                     <td><?= $row->CurrentLocation ?></td>
                    <td><?= $row->NextLocation ?></td>
                    <td><?= $row->Status ?></td>

                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<br><br>
<!-- ==============? -->
<form action="<?= base_url('Lrtracking_Controller/insert') ?>" method="POST">
               <div  class="table-container">
    <table id="invtab">
        <thead class="table-primary">
            <tr align="center">

                                <th>LR NO</th>
                                <th>CONTACT PERSON</th>
                                <th>PERSON MOBILE NO</th>
                                <th>CATEGORY</th>
                                <th>PROBLEM</th>
                                <th>RESPONCE</th>
                                <th>FEEDBACK</th>

                            </tr>
                        </thead>
                        <tbodY>
                            <tr>
                                <td><input type='text' class="form-control" id="LRNO" name='LRNO'></td>
                                <td><input type="text" class="form-control" name="PersonName"></td>
                                <td><input type="text" name="PersonMobile" id="PersonMobile"
                                        onkeypress="return ValidateMobile(event)" class="form-control"></td>
                                <td><select id="CATEGORY"  class="form-control"name="CATEGORY">
                                        <option value="">SELECT</option>
                                        <option value="MATERIAL DELIVERY STATUS">MATERIAL DELIVERY STATUS</option>
                                        <option value="DRIVER DELIVERY ISSUE">DRIVER DELIVERY ISSUE</option>
                                        <option value="LESS, INCORRECT, DAMAGE MATERIAL RECEIVED">LESS, INCORRECT,
                                            DAMAGE MATERIAL RECEIVED</option>
                                        <option value="LR ENTRY RELATED">LR ENTRY RELATED</option>
                                        <option value="DENY FOR MATERIAL ACCEPTANCE">DENY FOR MATERIAL ACCEPTANCE
                                        </option>
                                        <option value="SALES ENQUIRY">SALES ENQUIRY</option>
                                        <option value="FREIGHT RELATED">FREIGHT RELATED</option>
                                        <option value="EMERGENCY SERVICE">EMERGENCY SERVICE</option>
                                        <option value="URGENT LR DELIVERY">URGENT LR DELIVERY</option>
                                        <option value="OTHER">OTHER</option>
                                        <option value="VEHICLE RELATED">VEHICLE RELATED</option>
                                        <option value="DETENTAION">DETENTAION</option>
                                        <option value="DRIVERCALL">DRIVER CALL</option>
                                        <option value="TOPAY FRIGHT">TOPAY FRIGHT</option>
                                        <option value="RETURN MATERIAL">RETURN MATERIAL</option>

                                        <option value="LR REMARK">LR REMARK</option>
                                    </select></td>
                                <td><input type="text" name="Problem" id="Problem" class="form-control"></td>
                                <td><input type="text" name="Responce" id="Responce" class="form-control"></td>
                                <td><input type="text" name="Feedback" id="Feedback" class="form-control"></td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="button">
                    <center>
                    <br><br><input type="submit" name="save" value="Submit" class="btn btn-outline-dark btn-fw">
                
                    <input type="button" value="View Feedback" class="btn btn-outline-dark btn-fw"
                       onclick="redirectToFeedbackForm()">
                </div>
                </center>
            </form>
              <a href="<?= base_url('send-daily-report') ?>" class="btn btn-outline-dark btn-fw">Send Todays Report</a>


                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function redirectToFeedbackForm() {
        var feedbackUrl = <?= json_encode(base_url('Lrtracking_Controller/ViewFeedback')) ?>;

        window.location.href = feedbackUrl;
    }
</script>
  <script>
        $(function () {
            $("#LRNO").autocomplete({
                minLength: 1,
                source: '<?= base_url('Lrtracking_Controller/Search') ?>',
                select: function (event, ui) {
                    $("#LRNO").val(ui.item.LRNO);
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

            // If you want to customize the display of suggestions
            $("#LRNO").data("ui-autocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<div>" + item.LRNO + "</div>")
                    .appendTo(ul);
            };
        });
        // ==============================================================
         $(function () {
        $("#CustName").autocomplete({
            minLength: 1,
            source: '<?= base_url('Lrtracking_Controller/search5') ?>',
            select: function (event, ui) {
                $("#CustName").val(ui.item.CustName);
                $("#CustCode").val(ui.item.CustCode);
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

        $("#CustName").autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<div>" + item.CustCode + " : " + item.CustName + "</div>")
                .appendTo(ul);
        };
    });
// ========================
    $(function () {
    $("#Consignee").autocomplete({
        minLength: 1,
        source: '<?= base_url('Lrtracking_Controller/search2') ?>',
        select: function (event, ui) {
            $("#Consignee").val(ui.item.Consignee);
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

    // If you want to customize the display of suggestions
    $("#Consignee").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.Consignee + "</div>")
            .appendTo(ul);
    };
});
    // ======================
     $(function () {
    $("#InvoiceNo").autocomplete({
        minLength: 1,
        source: '<?= base_url('Lrtracking_Controller/search3') ?>',
        select: function (event, ui) {
            $("#InvoiceNo").val(ui.item.InvoiceNo);
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

    $("#InvoiceNo").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.InvoiceNo + "</div>")
            .appendTo(ul);
    };
});
     // ======================
     $(function () {
    $("#ToPlace").autocomplete({
        minLength: 1,
        source: '<?= base_url('Lrtracking_Controller/search4') ?>',
        select: function (event, ui) {
            $("#ToPlace").val(ui.item.ToPlace);
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

    $("#ToPlace").data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.ToPlace + "</div>")
            .appendTo(ul);
    };
});   
    </script>