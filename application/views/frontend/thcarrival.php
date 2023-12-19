<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php
if (isset($_GET["d1"])) {
    $d1 = $_GET["d1"];
} else {
    $d1 = date('Y-m-d'); 
}

if (isset($_GET["d2"])) {
    $d2 = $_GET["d2"];
} else {
    $d2 = date('Y-m-d'); 
}
?>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
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
<script>
    $(function() {
        $("#d1").datepicker({
            dateFormat: "dd/mm/yy"
        });
        $("#d2").datepicker({
            dateFormat: "dd/mm/yy"
        });
    });
</script>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">THC ARRIVAL</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">THCArrival</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p>&nbsp;</p>
        <div class="thcarrive">
            <form name="myForm" method="get" action="">
                &nbsp;&nbsp;
                <input type="radio" id="r1" name="searchby" value="Bydate" checked> Select Date:
                <br>
                <br>
                <div class="d-flex">
                    From:
                    <input type="date" class="form-control w-auto "  id="d1" name="d1" value="<?php echo $d1; ?>" readonly>
                    To:
                    <input type="date"  class="form-control w-auto "  id="d2" name="d2" value="<?php echo $d2; ?>" readonly>
                </div>
                <br>
                <br>
                &nbsp;&nbsp;
                <input type="radio" id="r2" name="searchby" value="THCNO"> THC NO
                <input type="text" class="form-control" id="THCNO" name="THCNO"><br>
                <input type="hidden" id="page" name="page" value="1"><br>
                <input type="submit" id="submitqry" class="btn btn-outline-dark btn-fw" name="submitqry" value="Search"><br><br>
            </form>
        </div>
        <?php if (isset($_GET["submitqry"])): ?>
            <?php if ($total_records > 0): ?>
                <table class="blueTable" id="invtab" cellpadding="4" border="1">
                    <thead>
                        <tr>
                            <th style="width: 1%; white-space: nowrap;">Sr No.</th>
                            <th>THC NO</th>
                            <th>THC Date</th>
                            <th>VehicleNo</th>
                            <th>THC Location</th>
                            <th>Route</th>
                            <th>Update stock</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row["THCNO"]; ?></td>
                                <td><?php echo $row["drsdate"]; ?></td>
                                <td align="middle"><?php echo $row["vehicleno"]; ?></td>
                                <td><?php echo $row["Place"]; ?></td>
                                <td><?php echo $row["Place"]; ?></td>
                                <td>
                                    <a href="thcarrivalupdate?THCNO=<?php echo $row["THCNO"]; ?>" class="btn btn-outline-dark btn-fw">Update</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
            <?php else: ?>
                <p>0 result</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
</div>
</div>


