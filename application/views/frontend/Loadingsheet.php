  <?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

.ui-dialog {
    position: absolute;
    height: auto;
    margin: 10% 40%;
    width: max-content;
}
</style>
     <script type="text/javascript">
        var dialog;
        var thcobj;
        var drsobj;

        $(function () {
            dialog = $("#dialog-message").dialog({
                autoOpen: false,
                position: { my: "center", at: "top+100", of: "#step1" },
                modal: true,
                buttons: {
                    OK: function () {
                        $(this).dialog("close");
                        if (thcobj != undefined) {
                            window.location.href = "Viewloadingsheet?Lsno=" + thcobj;
                        } else if (drsobj != undefined ) {
                            window.location.href = "Viewloadingsheet?Lsno=" + drsobj;
                        }
                    }
                },
                close: function () {
                    if (thcobj != undefined) {
                        window.location.href = "Loadingsheet";
                    } else if (drsobj != undefined ) {
                        window.location.href = "Loadingsheet";
                    }
                }
            });
        });  
        
    </script>
<script type="text/javascript">
         var lastrowid = 0;
        function add_row() {
                var lrnolist = document.getElementsByName('LRNO[]');
                var iLen = lrnolist.length;
                var val = document.getElementById('txtlrno').value.trim();
                   if ($("#invtab tr").length > 101) {
                      alert("Cannot add more than 100 rows.");
                        return;
                    }
                for (var i = 0; i < iLen; i++) {
                    if (lrnolist[i].value == val.toUpperCase()) {
                        document.getElementById('warntext').innerText = "LR No. already Present.";
                        document.getElementById('txtlrno').value = "";
                        //alert("LR No. already Present.");
                        document.getElementById('btnaddrow').disabled = false;
                        return;
                    }
                }
       

        $.ajax({
            type: 'post',
            url: 'Lredit/getlrdataJUNE',
            data: {
                LRNO: document.getElementById('txtlrno').value
            },
            success: function (response) {
                alert(response); // Log the response data to the browser's console
                    var lines = response.split('\n');
                        if (lines.length >= 2 && lines[1].trim() === "No Data."){
                        document.getElementById('warntext').innerText = "LR No. Not Found";
                        document.getElementById('txtlrno').value = "";
                        document.getElementById('btnaddrow').disabled = false;
                        }
                 else {
                    // alert(response);
                    lastrowid = lastrowid + 1;
                    $("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + response + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "')></td></tr>");
                    var tabrow = document.getElementById('row' + lastrowid);
                    // alert(tabrow);
                    var tabcells = tabrow.getElementsByTagName("td");
                              // alert(tabcells[8].innerText);
                    document.getElementById('totalqty').innerText = parseInt(document.getElementById('totalqty').innerText) + parseInt(tabcells[6].innerText);
                    document.getElementById('totalwt').innerText = parseInt(document.getElementById('totalwt').innerText) + parseInt(tabcells[7].innerText);
                      if (tabcells[2].innerText == "TO PAY")

                        document.getElementById('totaltopay').value = parseInt(document.getElementById('totaltopay').value) + parseInt(tabcells[8].innerText);                

                    document.getElementById('txtlrno').value = "";
                    document.getElementById('warntext').innerText = "";
                }
            },
            error: function (xhr, status, error) {
                console.log('XHR Status: ' + status);
                console.log('XHR Error: ' + error);
                console.log('XHR Response Text: ' + xhr.responseText);
                alert('An error occurred. Check the browser console for details.');
                document.getElementById('btnaddrow').disabled = false;
            }
        });
    }
    function delete_row(rowno) {
                var tabrow = document.getElementById(rowno);
                var tabcells = tabrow.getElementsByTagName("td");
                document.getElementById('totalqty').innerText = parseInt(document.getElementById('totalqty').innerText) - parseInt(tabcells[6].innerText);
                document.getElementById('totalwt').innerText = parseInt(document.getElementById('totalwt').innerText) - parseInt(tabcells[7].innerText);            
                if (tabcells[2].innerText == "TO PAY")
                    document.getElementById('totaltopay').value = parseInt(document.getElementById('totaltopay').value) - parseInt(tabcells[8].innerText);

                $('#' + rowno).remove();
            }
</script>
<script>
    $(document).ready(function () {
        fetchDepotOptions();
    });

    function fetchDepotOptions() {
        $.ajax({
            type: 'get',
            url: 'Lredit/depotse',
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    var depotSelect = $('#depot');

                    $.each(response, function (index, item) {
                        depotSelect.append('<option value="' + item.CPCODE + '">' + item.CPCODE + '-' + item.DEPO_NAME + '</option>');
                    });
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var dataList = document.getElementById('json-datalist');
        var input = document.getElementById('txtlrno');

        input.addEventListener('input', function () {
            var query = input.value;

            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    var jsonOptions = JSON.parse(request.responseText);

                    // Clear previous options
                    dataList.innerHTML = '';

                    jsonOptions.forEach(function (item) {
                        var option = document.createElement('option');
                        option.value = item.LRNO; // Assuming 'LRNO' is the field from your database
                        dataList.appendChild(option);
                    });
                }
            };

            // Replace 'SearchlrnoReturn' with the actual controller/method URL
            request.open('GET', '<?php echo base_url(); ?>Lredit/SearchlrnoReturn?query=' + encodeURIComponent(query), true);
            request.send();
        });
    });
</script>
<script type="text/javascript">
         function Validate() {
            var selectedOption = document.getElementById('depot').value;
            if (selectedOption === '') {
              alert('Please select a depot name');
              return false;
            }  
          var formData = new FormData(document.getElementsByName('form1')[0]);// yourForm: form selector
           $.ajax({
              type: "POST",
              url: 'Lredit/InsertLsThc',
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {
                    thcobj = response;
                    if (thcobj != undefined) {
                        document.getElementById("diagmsg").innerHTML = thcobj;
                        document.getElementById("diagimg").src = "assets/images/success.png";
                        dialog.dialog("open");
                    } else {
                        document.getElementById("diagmsg").innerHTML = thcobj.msg;
                        document.getElementById("diagimg").src = "assets/images/error.png";
                        dialog.dialog("open");
                        document.getElementById('Submit1').disabled = false;
                    }
                    },
                    error: function (response) {
                        document.getElementById("diagmsg").innerHTML = response;
                        document.getElementById("diagimg").src = "assets/images/error.png";
                        dialog.dialog("open");
                        document.getElementById('Submit1').disabled = false;
                    }
         });
    }
     function Validate1() {

      var formData = new FormData(document.getElementsByName('form1')[0]);// yourForm: form selector
       $.ajax({
          type: "POST",
          url: 'Lredit/InsertLsDrs',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
                drsobj = response;
                if (drsobj != undefined) {
                    document.getElementById("diagmsg").innerHTML = drsobj;
                    document.getElementById("diagimg").src = "assets/images/success.png";
                    dialog.dialog("open");
                } else {
                    document.getElementById("diagmsg").innerHTML = drsobj;
                    document.getElementById("diagimg").src = "assets/images/error.png";
                    dialog.dialog("open");
                    document.getElementById('Submit1').disabled = false;
                }
                },
                error: function (response) {
                    document.getElementById("diagmsg").innerHTML = response;
                    document.getElementById("diagimg").src = "assets/images/error.png";
                    dialog.dialog("open");
                    document.getElementById('Submit1').disabled = false;
                }
     });

}
</script>
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">LOADINGSHEET</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">LOADINGSHEET</li>
        </ol>
    </nav>
</div>

<br>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <form method='post' id="form1" name='form1'  enctype='multipart/form-data' action=" ">
                <center>
                    <p>
                        <b>Enter LR Number</b>
                    </p>
                    <input class="form-control " type="text" id="txtlrno" maxlength=15 placeholder="Search LR Number" list="json-datalist" name="txtlrno"  style="width: 120px"; required>
                    <datalist id="json-datalist" name="json-datalist" style="width: 200px;">
                    </datalist>
                    <br>
                    <center>
                        <input  type="button" id="btnaddrow" class="btn btn-outline-dark btn-fw" value="Add Row" onclick="add_row()" required>
                        <span id="warntext" style="margin-left: 5px; color: red;"></span>
                    </center>
                    <br>
                    <div class="table-container">
                    <table id="invtab" align='center' >
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
                </div>
                    <br>
                    <div class="container" id="GPDRS" style="text-align:start;">
                        <div class="row">
                            <div class="col-sm">
                                <label>GP For This DRS:</label>
                                <input class="form-control" type="text" id="percentage" name="percentage" readonly="">
                                
                            </div>
                            <div class="col-sm">
                                <label>Total ToPay :</label>
                                <input class="form-control" type="number" id="totaltopay" name="totaltopay" value="0" readonly="">
                                </div>
                            <div class="col-sm">
                                <label>Contract Amount :</label><span style="color:red">*</span>
                                <input class="form-control" type="number" id="contractamt" name="contractamt" pattern="[0-9]+" oninvalid="this.setCustomValidity('Please enter Contract Amount.')" oninput="this.setCustomValidity('')" onchange="contrcheck()" required="">
                            </div>
                            <div class="col-sm">
                            <label for="SelectDestination">Select Destination</label>
                            <select id="depot" name="depot" class="form-control" style="display: none;">
                            </select>

                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                    <center>
                        <br>
                       <input type='submit'  id='Submit' name='Submit' class="btn btn-outline-dark btn-fw" value='Loading Sheet Thc'
                        >
                        <input type='hidden' name='Submit' value='Create DRS'>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <input type='submit'  id='Submit1' name='Submit1' class="btn btn-outline-dark btn-fw" value='Loading Sheet Drs'
                        onclick="Validate1()">
                        <input type='hidden' name='Submit1' value='Create DRS'>
                    </div>
                </center>
                    <div class="col-sm">
                        <input class="form-control" type="hidden" id="totaldockettotal" onchange="contrcheck()" name="totaldockettotal" value="0" readonly="">
                    <span id="totaldockettotal">
                        </span>
                    </div>
                    <div>
                    <input class="form-control" type="hidden" id="totaldockettotalthc" name="totaldockettotalthc" value="0" readonly="">
                            </div>
            </div>
        </div>
   <div id="dialog-message" title="Create DRS Status">
    <img id="diagimg" style="vertical-align: middle;" src="assets/images/success.png"
         height="30">
    <span id="diagmsg">success msg.</span>
</div>
    </form>
</div>
</div>
</div>
</div>



