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
    function submitForm() {
        console.log('welcome');
        document.getElementById('searchForm').submit();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {    
        var today = new Date();
       
        var yesterday = new Date(today);
        yesterday.setDate(today.getDate() - 1);
     
        var formattedToday = today.toISOString().split('T')[0];
        var formattedYesterday = yesterday.toISOString().split('T')[0];
      
        document.getElementById('d1').value = formattedYesterday;
        document.getElementById('d2').value = formattedToday;
    });
</script>
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
        <form class="form-inline" id="searchForm" action="<?php echo base_url('fetchprnwise') ?>" method="POST">
                   <div class="radio">
            <input type='radio' id='r1' name='searchby' value='Bydate' checked>
        </div>
        <div class="form-group">
    <label for="email">Select Date: From:</label>
    <input type='Date'  id='d1' name='d1' >
     <label for="email">To:</label>
    <input type='Date'  id='d2' name='d2' >
    </div>   
       
        <div class="radio">
            <input type='radio' id='r2' name='searchby' value='THCNO'>
        </div>
        <div class="form-group">
            <label for="email">PRN No:</label>
            <input type='text' class='form-control' id='THCNO' name='THCNO'>
        </div>
        <br><br>
        <div class="form-group">
            <input type='hidden' id='page' name='page' value='1'>
                        <div>  <button type="submit" onclick="searchbutton()" id="fetchdata" class="btn btn-outline-dark btn-fw" name="searchButton">Search</button>

                    </div>
                    </div>
                </form>
            
                <?php if (isset($results)): ?>
        <div class="table-container">
           <table class="table table-hover custom-table" id="showtable">
    <thead>
        <tr class="table-heading">
            <th>SR No</th>
            <th>PRN No</th>
            <th>PRN Date</th>
            <th>Vehicle No</th>
            <th>Update Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 1; // Initialize the counter variable
        foreach ($results as $record):
        ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $record->PRNId; ?></td>
                <td><?php echo $record->PRNDate; ?></td>
                <td><?php echo $record->VehicleNo; ?></td>
                   <td>
                                    <form action="<?php echo base_url('UpdatePrnStock'); ?>" method="POST"
                                        style="display:inline;">
                                        <input type="hidden" name="Edit_PrnStock" value="<?php echo $record->PRNId; ?>">
                                        <button type="submit" class="btn btn-outline-dark btn-fw" name="edit">Update</button>
                                    </form>
                                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        </div>
    <?php endif; ?>
</div>
</div>
</div>
</div>
</div>

  