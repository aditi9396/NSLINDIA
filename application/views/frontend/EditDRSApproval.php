<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<style>
        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0.1, 0.1);
            border-radius: 10px;
        }


    .card-header {
        background-color: #f39c12; /* Orange color */
        color: white;
        text-align: center;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

        .card-body {
            padding: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }


    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: transform 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.1);
    }


    </style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">DRS APPROVAL FORM</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">DRS APPROVAL FORM</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
       
              <div class="card-body">
        <div class="card">
            
            <div class="card-body">
                <form method="post" action="<?php echo base_url('UpdateDRSProfitApproval') ?>">
                    <div class="row">
                        <div class="col-md-3"> <label for="vendorName">Vendor Name:</label></div>
                      <div class="col-md-6">
    <select name="vendorName" class="form-control" id="vendorName">
   
      <?php        
    $sql1 = "SELECT DISTINCT `vendorName` FROM `drsprofitapproval`";
    $result1 = $this->db->query($sql1); 

    $rowsCount = $result1->num_rows();

    if ($rowsCount > 0) {
        foreach ($result1->result_array() as $row) {
            echo "EditDRS_Approval_details: " . $EditDRS_Approval_details['vendorName'] . "<br>";   
            echo "Row Hvendor: " . $row['vendorName'] . "<br>";

            // Add debugging information for $selected
            $selected = (isset($EditDRS_Approval_details['vendorName']) && $row['vendorName'] === $EditDRS_Approval_details['vendorName']) ? 'selected' : '';
            echo "Selected: " . $selected . "<br>";
           
            echo "<option value='{$row['vendorName']}' {$selected}>{$row['vendorName']}</option>";
        }
    }
    ?>
</select>

     <input type="hidden" class="form-control" id="editdrsid" name="editdrsid" value="<?php echo isset($EditDRS_Approval_details['id']) ? $EditDRS_Approval_details['id'] : ''; ?>" required>
</div>


                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3"> <label for="vendorName">Vehicle Number:</label></div>
                        <div class="col-md-6">  <input type="text" class="form-control" id="vehicleNo" name="vehicleNo" value="<?php echo isset($EditDRS_Approval_details['vehicleNo']) ? $EditDRS_Approval_details['vehicleNo'] : ''; ?>" required></div>

                    </div>
                   <div class="row mt-3">
    <div class="col-md-3">
        <label for="vendorName">Date:</label>
    </div>
    <div class="col-md-6">
        <input type="date" class="form-control" id="date" name="date" value="<?php echo isset($EditDRS_Approval_details['date']) ? $EditDRS_Approval_details['date'] : ''; ?>" required>
    </div>
</div>
                <div class="row mt-3">
    <div class="col-md-3">
        <label for="reason">Reason:</label>
    </div>
    <div class="col-md-6">
        <textarea class="form-control" id="reason" name="reason" rows="3" required><?php echo isset($EditDRS_Approval_details['reason']) ? $EditDRS_Approval_details['reason'] : ''; ?></textarea>
    </div>
</div>


                    <div class="row mt-3">
                        <div class="col-md-3"> <label for="vendorName">Approval User:</label></div>
                        <div class="col-md-6"> <input type="text" readonly class="form-control" id="approvalUser" value="<?php echo isset($EditDRS_Approval_details['approvalUser']) ? $EditDRS_Approval_details['approvalUser'] : ''; ?>" name="approvalUser" required></div>

                    </div>

                        <div class="row mt-4">
                        <div class="col-md-5"> </div>
                        <div class="col-md-6">  <button type="submit" name="submit" class="btn btn-outline-dark btn-fw">Submit</button></div>

                    </div>
                 
                  
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    // Get the current date in the format YYYY-MM-DD
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the minimum date for the input field to the current date
    document.getElementById('date').min = currentDate;
</script>
