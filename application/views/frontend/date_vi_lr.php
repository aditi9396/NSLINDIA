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
                  <li class="breadcrumb-item active" aria-current="page">Sticker </li>
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
            <form name='myForm' method='post' onsubmit="window.open('allstickerprint.php','result', 'width=1000,height=600,scrollbars=yes')" action="<?= base_url('allstickerprint') ?>" enctype='multipart/form-data'  target='result'>

         <table id="lrdetails">      
           <thead>
            <tr>
                <th> <input type="checkbox" name="check" id="selectall"><b>Select All</b> </th>
                <th>LR No.</th>
                <th>LR Date </th>
                <th>PLACE</th>
                <th>CONSIGNEE</th>
                <th>Qty</th>
                <th>Invoice No.</th>
                <th>Delivery Depot</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lr)): ?>
                <?php foreach ($lr as $user): ?>
                    <tr>
                     <td> <input type='checkbox' name='LRNO[]' value='<?= $user->LRNO; ?>'></td></td>
                        <td><?= $user->LRNO; ?></td>
                        <td><?= $user->LRDate; ?></td>
                        <td><?= $user->ToPlace; ?></td>
                        <td><?= $user->Consignee; ?></td>
                        <td><?= $user->PkgsNo; ?></td>
                        <td><?= $user->InvoiceNo; ?></td>
                        <td><?= $user->NextLocation; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br><input type='submit' name='submit' value='Print Selected Sticker'></form>
  </div>
</div>
  </div>
</div>
  </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#selectall').click(function () {
            $(':checkbox[name="LRNO[]"]').prop('checked', this.checked);
        });

        // Update "Select All" checkbox state based on individual checkboxes
        $(':checkbox[name="LRNO[]"]').click(function () {
            $('#selectall').prop('checked', $(':checkbox[name="LRNO[]"]:checked').length === $(':checkbox[name="LRNO[]"]').length);
        });
    });
</script>




