<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">

  <style type="text/css">
    .table-container {
        width: 100%;
        overflow-x: scroll;
    }
    #lrdetails,#lrdetails1 {
        border-collapse: collapse;
        width: 100%;
    }
    #lrdetails th, #lrdetails td ,#lrdetails1 th,#lrdetails1 td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    #lrdetails th,#lrdetails1 th {
        background-color: #2c2d58a3;
    }
    #lrdetails input[type="text"], #lrdetails1 input[type="text"], #lrdetails select, #lrdetails1 select {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    @media (max-width: 768px) {
        #lrdetails ,#lrdetails1 {
          font-size: 12px;
      }
  }
</style>
     


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Spare Details</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!-- ==================== -->
                   <div class="center-container">

         <table id="lrdetails">      
           <thead>
            <tr>
                <th>Part Name</th>
                <th>Bill No.</th>
                <th>Bill date.</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Vendor Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($SpareDetails)): ?>
                <?php foreach ($SpareDetails as $user): ?>
                    <tr>
                        <td><?= $user->pname; ?></td>
                        <td><?= $user->BillNo; ?></td>
                        <td><?= $user->BillDate; ?></td>
                        <td><?= $user->Rate; ?></td>
                        <td><?= $user->Amount; ?></td>
                        <td><?= $user->VendorName; ?></td>
                        <td><?= $user->Qty; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
  </div>
</div>
  </div>
</div>
  </div>





