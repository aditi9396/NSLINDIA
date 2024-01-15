<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DRS Profit Approval Report</title>
    <!-- Add Bootstrap CSS, JS, and Popper.js (optional) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</head>
<body>
    <div class="container mt-5">
        <div class="card" >
            <div class="card-header">
               <center><h5 class="card-title">DRS Profit Approval Form</h5></center> 
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('user/UpdateDRSProfitApproval') ?>">
                    <div class="row">
                        <div class="col-md-3"> <label for="vendorName">Vendor Name:</label></div>
                      <div class="col-md-6">
    <select name="vendorName" class="form-control" id="vendorName">
    <option value="">Select</option>
    <?php foreach ($vendorNames as $vendor): ?>
        <option value="<?php echo $vendor['Vendorname']; ?>" <?php echo isset($EditDRS_Approval_details['vendorName']) && $EditDRS_Approval_details['vendorName'] === $vendor['Vendorname'] ? 'selected' : ''; ?>>
            <?php echo $vendor['Vendorname']; ?>
        </option>
    <?php endforeach; ?>
    <!-- Add more options as needed -->
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
                        <div class="col-md-6"> <input type="text" class="form-control" id="approvalUser" value="<?php echo isset($EditDRS_Approval_details['approvalUser']) ? $EditDRS_Approval_details['approvalUser'] : ''; ?>" name="approvalUser" required></div>

                    </div>

                        <div class="row mt-4">
                        <div class="col-md-5"> </div>
                        <div class="col-md-6">  <button type="submit" name="submit" class="btn btn-primary">Submit</button></div>

                    </div>
                 
                  
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // Get the current date in the format YYYY-MM-DD
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the minimum date for the input field to the current date
    document.getElementById('date').min = currentDate;
</script>
</html>
