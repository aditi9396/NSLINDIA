<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php
$THCNO = $_GET['THCNO'];

$query = $this->db->query("SELECT `id`, `LRNO`, `THCNO`, `Qty`, `UpdatedQty`, `Reason`, `LSNO`, `TEST`, `Weight`, `InvoiceNo`, `Consignee`, `Consignor`
    FROM `lrthcdetails` WHERE `THCNO` = ?", array($THCNO));

$data['thcdata1'] = $query->result();

foreach ($data['thcdata1'] as $thcdatanew) {
    $LRNO = $thcdatanew->LRNO; 
    $Qty = $thcdatanew->Qty; 
}

?>
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
.grid-cell {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#arrivaldate").datepicker({
            dateFormat: "dd/mm/yy"
        });
    });
</script>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">THC UPDATE</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">THC Update</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="thcupdate">
          <div class="container">
            <div class="row">
                <div class="col-md-3 grid-cell">
                    <strong>THC No.</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails['THCNO']; ?></div>
                <div class="col-md-3 grid-cell">
                    <strong>THC Date</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails["drsdate"]; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3 grid-cell">
                    <strong>Vehicle No.</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails["vehicleno"]; ?></div>
                <div class="col-md-3 grid-cell">
                    <strong>Vendor Name</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails["vendorname"]; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3 grid-cell">
                    <strong>Driver Name</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails["driver"]; ?></div>
                <div class="col-md-3 grid-cell">
                    <strong>Driver Mobile No.</strong>
                </div>
                <div class="col-md-3 grid-cell"><?php echo $thcDetails["mobileno"]; ?></div>
            </div>
        </div>
    </div>
    <br><br>
    <form method="post"  id="formTHCUPDATE" action="">
        <input type="hidden" name="THCNO" value="<?php echo $thcDetails['THCNO']; ?>">
        <input type="hidden" name="prevdepot" value="<?php echo $thcDetails["Place"]; ?>">
        <input type="hidden" name="destdepot" value="<?php echo $thcDetails["Place"]; ?>">
        <div class="row">
            <div class="col-md-3">
                <label>Closing KM:</label>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="closingkm" id="closingkm" value="0" required="">
            </div>

            <div class="col-md-3">
                <label>Arrival Date:</label>&nbsp;
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="arrivaldate" id="arrivaldate" value="" required=""
                class="datepicker" disabled>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Hamali vendor Name:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="THCArrivalHvendor" id="THCArrivalHvendor" list="hamalivendor-list"required>
                <datalist id="hamalivendor-list"></datalist>

            </div>

            <div class="col-md-3">
                <label>Hamali Amount Paid To HVendor:</label>&nbsp;
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="HHamali" id="HHamali" required="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Unloading Hamali Received From Driver:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="UnloadingHamali" id="UnloadingHamali" required="">
            </div>

            <div class="col-md-3">
                <label>Payment Mode:</label>&nbsp;
            </div>
            <div class="col-md-3">
                <select id="Paymenttype" class="form-control" name="Paymenttype"  autofocus="" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Nohamali">No Hamali</option>
                    <option value="Bank">Bank</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label>Transaction Id:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="Referenceid" id="Referenceid" required="">
            </div>

            <div class="col-md-3">
                <label>Are you Unloading Vehicle or Not:</label>&nbsp;
            </div>
            <div class="col-md-3">
                <input type="radio"  name="laodingtype" id="laodingtype" value="UnLoading" checked=""> UnLoading
                &nbsp;&nbsp;
                <input type="radio" name="laodingtype" id="laodingtype" value="WithoutUnLoading">&nbsp;&nbsp;Crossing
            </div>
        </div>
        <br>
        <br>
        <div class="table-container">
          <table id="invtab">
            <thead class="table-primary">
              <tr align="center">
                <th>LR No.</th>
                <th>LR Date</th>
                <th>Place</th>
                <th>Qty</th>
                <th>Received Qty</th>
                <th>Reason</th>
                <th>SELECT</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                <input class="form-control" name="LRNO" value="<?php echo $thcdatanew->LRNO;?>" disabled>
            </td>
            <td>
              <input type="date" class="form-control" name="drsdate" value="<?php echo $thcDetails['drsdate']; ?>"disabled>
          </td>
          <td>
              <input class="form-control" name="place" value="<?php echo $thcDetails['Place']; ?>" disabled>
          </td>
          <td>
              <input class="form-control" type="number" name="Qty" value="<?php echo $thcdatanew->Qty;?>" disabled>
          </td>
          <td>
              <input class="form-control" type="number" name="received_qty" value="1">
          </td>
          <td>
              <input  type="text" name="Reason" class="Reason">
          </td>
          <td>
            <input type="hidden" class="form-control" name="str_lr_no1" value="<?php echo $thcdatanew->LRNO;?>">
        </td>
    </tr>
</tbody>
</table>
</div>

<br>
</form>
<div class="text-center">
    <input type="button" id="UPADTETHC"   value="Submit" class="btn btn-outline-dark btn-fw">
</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var searchInput = $('#THCArrivalHvendor');
        var searchResultsList = $('#hamalivendor-list');

        searchInput.on('keyup', function() {
            var keyword = searchInput.val().trim();

            if (keyword !== '') {
                $.ajax({
                    url: '<?php echo site_url('hamali_data'); ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    dataType: 'json', 
                    success: function(response) {
                        searchResultsList.html('');

                        $.each(response, function(index, result) {
                            searchResultsList.append('<option>' + result.Hvendor + '</option>');
                        });
                    }
                });
            } else {
                searchResultsList.html(''); 
            }
        });
    });
    var currentDate = new Date();
    var arrivaldateInput = document.getElementById('arrivaldate');

    var formattedDate = currentDate.toISOString().substr(0, 10);

    arrivaldateInput.value = formattedDate;
</script>

<script type="text/javascript">
  $( "#UPADTETHC" ).click(function() {
    let form = document.getElementById("formTHCUPDATE");
    let fd = new FormData(form);

    $.ajax({
        url: base_url + "UPADTETHC",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            var myObj = JSON.parse(data);
            if (myObj.status) {
                successToster('THCArrival Generated Successfully');
                setTimeout(function(){
                    console.log(data);
                    window.location.href = base_url + "printarrival/" + myObj.DRS_THCNO;  
                }, 2000);
            } else {
                errorToster('THCArrival Not Generated Successfully');
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
