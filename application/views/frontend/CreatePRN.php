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

      #myDiv {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

<script>
    function searchbutton() {
        var fetchdata = document.getElementById('fetchdata');        
        var showtable = document.getElementById('showtable');

        if (fetchdata) {
            showtable.style.display = 'block';  
        } else {
            echo('No Result');  
        }
    }
</script>

<script>
   jQuery(document).ready(function ($) {
    $("#partyid").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + "get_customer_data",                
                type: 'POST',
                dataType: 'json',
                data: { search: request.term },
                success: function (data) {
                    console.log('Ajax success:', data);
                    if (Array.isArray(data)) {
                        response(data);
                    } else {
                        console.error('Invalid data received from the server:', data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Ajax error:', status, error);
                }
            });
        },
        select: function (event, ui) {
            $("#partyid").val(ui.item.label);
            $("#partyname").val(ui.item.value);
            return false;
        },
        change: function (event, ui) {
            if (!ui.item) {
                $("#partyid").val('');
                $("#partyname").val('');
            }
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
        .append("<div>" + item.label + " : " + item.value + "</div>")
        .appendTo(ul);
    };
});

</script>

<script>
    jQuery(document).ready(function ($) {
        $("#num").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '<?php echo base_url(); ?>CreateAndArrivalPRN/get_vehicle_data',
                    type: 'POST',
                    data: { search: request.term },
                    dataType: 'json',
                    success: function (data) {
                        var formattedData = $.map(data, function (item) {
                            return {
                                label: item.label,
                                value: item.value
                            };
                        });
                        response(formattedData);
                    },
                });
            },
            select: function (event, ui) {
                $("#num").val(ui.item.value);
                return false;
            }
        });
    });
</script> 


<script>
    function fetchLRNumbers() {
        var div = document.getElementById("myDiv");
        div.style.display = "block";

        var partyID = $("#partyname").val();
        var fromDate = $("#fromdate").val();
        var selectedDate = $("#Todate").val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('CreateAndArrivalPRN/getLRNumbersdata') ?>",
            data: {
                party_id: partyID,
                selected_date: selectedDate,
                from_Date: fromDate
            },
            success: function (response) {
                console.log("Success:");
                console.log(response);

                $("#lrTableBody").empty();

                try {
                    var lrNumbers = JSON.parse(response);

                    console.log(lrNumbers);
                    if (lrNumbers.length === 0) {
                        var messageRow = $("<tr>");
                        var messageCell = $("<td>").attr("colspan", 3).text("No LR numbers found for this party.");
                        messageRow.append(messageCell);
                        $("#lrTableBody").append(messageRow);
                        $("#Submit").css("display", "none");
                    } else {
                        for (var i = 0; i < lrNumbers.length; i++) {
                            var row = $("<tr>");
                            var srCell = $("<td>").text(i + 1);
                            var lrCell = $("<td>").text(lrNumbers[i]);
                            var saveLRCell = $("<td>").html("<input type='checkbox' name='lr_to_save[]' value='" + lrNumbers[i] + "'>");
                            row.append(srCell);
                            row.append(lrCell);
                            row.append(saveLRCell);

                            $("#lrTableBody").append(row);
                        }
                        $("#Submit").css("display", "block");
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    alert("An error occurred while processing the response.");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:");
                console.log(xhr);
                console.log(status);
                console.log(error);

                alert("An error occurred while fetching LR numbers.");
            }
        });
    }
</script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">CREATE PRN</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">CREATEPRN Form</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">


                <form id="formprn" action="" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <label>From Date:</label>
                        </div>
                        <div class="col-md-4">
                            <?php $currentDate = date('Y-m-d'); ?>
                            <input type="Date" id="fromdate" name="fromdate" class="form-control" value="<?php echo $currentDate; ?>">
                        </div>
                        <div class="col-md-2">
                            <label>To Date:</label>
                        </div>
                        <div class="col-md-4">
                            <?php $currentDate = date('Y-m-d'); ?>
                            <input type="Date" id="Todate" name="Todate" class="form-control" value="<?php echo $currentDate; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label>Contract Party:</label>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 d-flex">
                            <input type="text" class="form-control" id="partyid" name="partyid" size="10" style="text-transform: uppercase" required > -
                            <input type="text" class="form-control" required name="partyname" id="partyname" readonly />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label>Vehicle No:</label>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <input type="text"  class="form-control" name="num" id="num" onchange="fetchLRNumbers()" required>
                        </div>
                    </div>
                    <br>
                    <p><span style="color: red;">Note: Please select the checkbox and then generate PRN.</span></p>

                    <!-- Add hidden input fields for LR numbers -->
                    <div id="lrNumbersContainer" style="display: none;"></div>

                    <div class="table-container" >
                        <table id="invtab">
                            <tr>
                                <th>Sr No</th>
                                <th>Lr No</th>
                                <th>Select</th>
                            </tr>
                            <tbody id="lrTableBody">

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="hamali" id="myDiv">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <label><b>Hamali Vendor Name</b></label>
                                </div>
                                <div class="col-sm">
                                    <select id='Hvendor' name='Hvendor' style='width:300px; margin-left: -180px;' class="form-control">
                                        <option value='0' required>SELECT Hamali Vendor</option>

                                        <?php        
                                        $depot = isset($user->Depot) ? $user->Depot : null;

                                        print_r($depot);

                                        echo " testing";

                                        if ($depot) {
                                            $sql1 = "SELECT `Hvendor` FROM `HamaliVendor` WHERE `DEPOT`= '$depot' ";
                                            $result1 = $this->db->query($sql1); 

                                            $rowsCount = $result1->num_rows();

                                            if ($rowsCount > 0) {
                                                foreach ($result1->result_array() as $row) {
                                                    echo "<option value='" . $row['Hvendor'] . "'>" . $row['Hvendor'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>



                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <label><b>Hamali Amount</b></label>
                                </div>
                                <div class="col-sm">
                                    <input type="text" style="width: 300px; margin-left: -180px;" class="form-control" name="hamaliamount" id="hamaliamount" required>
                                    <input type="hidden" name="depot" value="<?php echo $depot;  ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-center" style="top: 4px;">
                                <input type="submit" class="btn btn-outline-dark btn-fw" id="SubmitPRN" name="submit_action" value="Create_PRN">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $("#SubmitPRN").click(function() {
        let form = document.getElementById("formprn");
        let fd = new FormData(form);

        $.ajax({
            url: base_url + "savePrn",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (response) {
                if (response.success) {
                    successToster(response.message);

                // Redirect to createprnview page with the PRNNO
                    window.location.href = base_url + "createprnview?prnno=" + response.PRNNO;
                } else {
                    console.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });
    });



    function updateLRNumbers() {
        var lrNumbers = document.querySelectorAll('input[name="lr_to_save[]"]:checked');
        var lrNumbersContainer = document.getElementById('lrNumbersContainer');
        lrNumbersContainer.innerHTML = '';

        lrNumbers.forEach(function (lrNumber) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'lr_to_save[]';
            hiddenInput.value = lrNumber.value;

            lrNumbersContainer.appendChild(hiddenInput);
        });
    }



</script>


</div>        




