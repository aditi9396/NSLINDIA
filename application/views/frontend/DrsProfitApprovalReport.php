<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
   <style>   
        
          .table-container {
    width: 100%;
    overflow-x: auto;
}
#showtable {
    border-collapse: collapse;
    width: 100%;
}
#showtable th, #showtable td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
#showtable th {
    background-color: #2c2d58a3;
}
#showtable input[type="text"], #showtable select {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
}
@media (max-width: 768px) {
    #showtable {
      font-size: 12px;
  }
}
    </style>
   <script type="text/javascript">
    $(function() {
        $("#fromdate").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#Todate").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
<script>
    function confirmDelete(){

        var isConfirmed = confirm('Are you sure you want to delete?');
 
        if (isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
 
<script>
    function submitForm() {
        console.log('welcome');
        document.getElementById('searchForm').submit();
    }
</script>



<script>
    function searchbutton() {
        var showtable = document.getElementById('showtable');

        // Assuming your search logic sets a flag or something to indicate success
        var searchSuccessful = true;

        if (searchSuccessful) {
            showtable.style.display = 'block';
        } else {
            // Display a message when there are no results
            console.log('No Result');
            // Alternatively, you can show a message in your HTML, e.g., create a <div> with an id for displaying messages
            // document.getElementById('errorMessage').innerText = 'No Result';
        }
    }
</script>


<script>
    function exportToExcel() {
        
        var table = document.querySelector('.custom-table');
     
        var ws = XLSX.utils.table_to_sheet(table, { raw: true, header: ['Vendor Name', 'Vehicle No', 'Date', 'Reason', 'Approval User'] });

        // Create workbook
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Save workbook to file
        var fileName = 'DRS_Profit_Approval_Report.xlsx';
        XLSX.writeFile(wb, fileName);
    }
</script>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">DRS APPROVAL</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">DRS APPROVAL</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">  

            <form id="searchForm" action="<?php echo base_url('DRSProfitApprovalReport') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <label>From Date:</label>
                        </div>
                        <div class="col-md-4">
                            <?php $currentDate = date('Y-m-d'); ?>
                            <input type="Date" id="fromdate" name="fromdate" class="form-control"
                                value="<?php echo $currentDate; ?>">
                        </div>
                        <div class="col-md-2">
                            <label>To Date:</label>
                        </div>
                        <div class="col-md-4">
                            <?php $currentDate = date('Y-m-d'); ?>
                            <input type="Date" id="Todate" name="Todate" class="form-control"
                                value="<?php echo $currentDate; ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"></div>
                        <div>  <button type="submit" onclick="searchbutton()" id="fetchdata" class="btn btn-outline-dark btn-fw" name="searchButton">Search</button>

</div>
                    </div>
                </form>


        <?php if (isset($records) && !empty($records)): ?>
    <div class="mt-3">
        <table class="table table-hover custom-table" id="showtable">
            <thead>
                <tr class="table-heading">
                    <th>Vendor Name</th>
                    <th>Vehicle No</th>
                    <th>Date</th>
                    <th>Reason</th>
                    <th>Approval User</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record->vendorName; ?></td>
                        <td><?php echo $record->vehicleNo; ?></td>
                        <td><?php echo $record->date; ?></td>
                        <td><?php echo $record->reason; ?></td>
                        <td><?php echo $record->approvalUser; ?></td>
                        <td>
                            <form action="<?php echo base_url('edit_drsapproval'); ?>" method="POST"
                                style="display:inline;">
                                <input type="hidden" name="Edit_Approval" value="<?php echo $record->id; ?>">
                                <button type="submit" class="btn btn-success" name="edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form id="deleteForm" action="<?php echo base_url('delete_drsapproval'); ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="Delete_Approval" value="<?php echo $record->id; ?>">
                                <button type="button" class="btn btn-delete" onclick="confirmDelete()">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No records found</p>
<?php endif; ?>

    </div>
</div>
</div>
</div>
</div>
   