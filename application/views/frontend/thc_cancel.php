<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<style>
    .table-container {
        width: 100%;
        overflow-x: scroll;
    }
    #lrdetails {
        border-collapse: collapse;
        width: 100%;
    }
    #lrdetails th, #lrdetails td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    #lrdetails th {
        background-color: #2c2d58a3;
    }
    #lrdetails input[type="text"], #lrdetails select{
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    @media (max-width: 768px) {
        #lrdetails  {
          font-size: 12px;
      }
  }  
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">THC CANCEL</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">THC Cancel</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="THC">
            <form name="myForm" id="THCsearch" method="get" action="<?php echo base_url('THCarrival/search'); ?>">
                THC NO
                <input type="text" class="form-control"  id="THCNO" name="searchby">
                <br><br>
                <input type="submit" class="btn btn-outline-dark btn-fw" id="submitqry" name="submitqry" value="Search" ><br><br>
                <?php if (!empty($results)): ?>
                    <table class="table" id="lrdetails" cellpadding="4" border="1"  style="overflow:auto;">
                        <thead>
                            <tr>
                                <th style="width: 1%; white-space: nowrap;">Sr No.</th>
                                <th>THC NO</th>
                                <th>THC Date</th>
                                <th>VehicleNo</th>
                                <th>THC Location</th>
                                <th>THC Cancel Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><input class="THCNO form-control" id="THCNO1" name="THCNO1" value="<?php echo $row["THCNO"]; ?>"disabled>
                                        <input type="hidden" id="THCNO" name="THCNO" value="<?php echo $row["THCNO"]; ?>">
                                    </td>
                                    <td><input class="form-control" name="drsdate" value="<?php echo $row["drsdate"]; ?>"disabled></td>
                                    <td><input class="form-control" name="vehicleno" value="<?php echo $row["vehicleno"]; ?>"disabled></td>
                                    <td><input class="form-control" name="Place" value="<?php echo $row["Place"]; ?>"disabled></td>
                                    <td><input type="text" name="thccancel" class="form-control"></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<br>
<br>
<div class="col-lg-12 text-center">
    <input type="button" id="thccancel"   value="Submit" class="btn btn-outline-dark btn-fw">
</div>
<br>
<?php else: ?>
<?php endif; ?>
</div>



<script type="text/javascript">
  $("#thccancel").click(function () {
    let form = document.getElementById("THCsearch");
    let fd = new FormData(form);

    $.ajax({
        url: base_url + "thccancel",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.status) {
                successToster('UPDATED THC ARRIVAL');
                
                
            } else {
                errorToster('NOT UPDATED THC ARRIVAL');
            }
        },
        error: function (xhr, status, error) {
            window.location.href = base_url + "thc_cancel"; 
            console.error("AJAX Error:", error);
            successToster('CANCEL THC');
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
