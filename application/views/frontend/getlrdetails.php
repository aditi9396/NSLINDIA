<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
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
      <h3 class="page-title">LR CANCEL</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">LR Cancel</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="LR">
            <form name="myForm" id="LRform" method="get" action="<?php echo base_url('THCarrival/search4'); ?>">
                LRNO
                <input type="text" id="LRNO" class="form-control"  name="searchbyLR">
                <br><br>
                <input type="submit" id="submitqry" class="btn btn-outline-dark btn-fw" name="submitqry" value="Search"><br><br>
                <?php if (!empty($results)): ?>
                    <table id="invtab" class="blueTable" cellpadding="4" border="1">
                        <thead>
                            <tr>
                                <th >Sr No.</th>
                                <th>LRNO</th>
                                <th>LRDate</th>
                                <th>Cancel Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><input class="LRNO form-control" name="LRNO" value="<?php echo $row["LRNO"]; ?>"></td>
                                    <td><input class="LRDate form-control" name="LRDate" value="<?php echo $row["LRDate"]; ?>"></td>
                                    <td><input type="text form-control" class="LRreason form-control" name="LRreason" ></td>

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

<br><br>
<div class="col-lg-12 text-center">
    <input type="button" id="LRcancel"   value="submit" class="btn btn-outline-dark btn-fw">
</div>
</div>

<br>
<?php else: ?>
<?php endif; ?>
<script type="text/javascript">
   $("#LRcancel").click(function () {
    let form = document.getElementById("LRform");
    let fd = new FormData(form);

    $.ajax({
        url: base_url + "lrcancel",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json', 
        success: function (data) {
            if (data.status) {
                successToster('UPDATED LR');
                setTimeout(function(){
                   window.location.href = base_url + "LR_cancel";
               },2000);
            } else {
                errorToster('NOT UPDATED THC ARRIVAL');
            }
        },
        error: function (xhr, status, error) {
            window.location.href = base_url + "LR_cancel"; 
            successToster('CANCEL LR');
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
