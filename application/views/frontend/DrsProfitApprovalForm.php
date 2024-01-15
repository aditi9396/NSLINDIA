    <style>
        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0.1, 0.1);
            border-radius: 10px;
        }


    .card-header {
        
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <form method="post" action="" id="formdrsapproval">
                    <div class="form-group row">
                        <label for="vendorName" class="col-md-3 col-form-label">Vendor Name:</label>
                   

<div class="col-md-6">
    <select name="vendorName" class="form-control" id="vendorName">
        <option>select</option>
        <?php        
             
            $sql1 = "SELECT `Hvendor` FROM `HamaliVendor` WHERE `Active` = '1' ORDER BY `Hvendor`;";
            $result1 = $this->db->query($sql1); 

            $rowsCount = $result1->num_rows();

            if ($rowsCount > 0) {
                foreach ($result1->result_array() as $row) {
                    echo "<option value='" . $row['Hvendor'] . "'>" . $row['Hvendor'] . "</option>";
                }
            }
        
        ?>
    </select>
</div>


                    </div>
                    <div class="form-group row">
                        <label for="vehicleNo" class="col-md-3 col-form-label">Vehicle Number:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="vehicleNo" name="vehicleNo" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-md-3 col-form-label">Date:</label>
                        <div class="col-md-6">
                            <?php
                            $currentDate = date('Y-m-d');
                            ?>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $currentDate; ?>" min="<?php echo $currentDate; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-md-3 col-form-label">Reason:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="approvalUser" class="col-md-3 col-form-label">Approval User:</label>
                        <div class="col-md-6">
    <?php
        $UserName = isset($user->UserName) ? $user->UserName : null;
    ?>
    <input type="text" readonly class="form-control" id="approvalUser" name="approvalUser" value="<?php echo $UserName; ?>" required>
</div>

                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-md-5"></div>
                        <div class="col-md-6">
                            <button type="submit" name="submit" id="Submitdrsapproval" class="btn btn-outline-dark btn-fw">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
    
    </div>

    <script>
    $("#Submitdrsapproval").click(function() {
    let form = document.getElementById("formdrsapproval");
    let fd = new FormData(form);

    $.ajax({
        url: base_url + "insertDRSProfitApproval",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(response) {
            if (response.success) {
                successToster(response.message);
                // Redirect to a different page
                window.location.href = base_url + "DRSProfitApprovalReport";
            } else {
                errorToster(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Request Error:", status, error);
            errorToster("An error occurred while processing your request.");
        }
    });
});


</script>

