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
            for (var i = 0; i < iLen; i++) {
                if (lrnolist[i].value == val.toUpperCase()) {
                    document.getElementById('warntext').innerText = "LR No. already Present.";
                    document.getElementById('txtlrno').value = "";
                
                    document.getElementById('btnaddrow').disabled = false;
                    return;
                }
            }

            $.ajax({
                type: 'post',
                url: '',
                data: {
                    LRNO: document.getElementById('txtlrno').value,
                    poddepo: document.getElementById('poddepo').value,
                    d1: $("#d1").datepicker("getDate").toISOString().split("T")[0],
                    d2: $("#d2").datepicker("getDate").toISOString().split("T")[0],
                    Consigner: document.getElementById('Consigner').value
                },
                success: function(response) {
                 
                    if (response == "No Data.") {
                        document.getElementById('warntext').innerText =
                        "LR No. Not Found"; //alert("LR No. Not Found");
                        document.getElementById('txtlrno').value = "";
                        document.getElementById('btnaddrow').disabled = false;
                    } else {
                        lastrowid = lastrowid + 1;
                        $("#lrdetails tr:last").after("<tr id='row" + lastrowid + "'>" + response +
                            "<td><input type='button' value='DELETE' onclick=delete_row('row" +
                            lastrowid + "')></td></tr>");
                        var tabrow = document.getElementById('row' + lastrowid);
                        var tabcells = tabrow.getElementsByTagName("td");
                        
                        document.getElementById('txtlrno').value = "";
                        document.getElementById('warntext').innerText = "";
                        document.getElementById('btnaddrow').disabled = false;
                    }
                },
                error: function(response) {
                    alert(response);
                    document.getElementById('btnaddrow').disabled = false;
                }
            });

        }

        function delete_row(rowno) {
            var tabrow = document.getElementById(rowno);
            $('#' + rowno).remove();
        }
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
                            <th>DELETE</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                    <br>
                    <center>
                        <br>
                       <input type='submit'  id='Submit' name='Submit' class="btn btn-outline-dark btn-fw" value='Loading Sheet Thc'
                        >
                        <input type='hidden' name='Submit' value='Create DRS'>
                    </div>
                </center>

            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>



