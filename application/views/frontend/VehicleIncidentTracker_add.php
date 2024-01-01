<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>"><!DOCTYPE html>

<html>
<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
  <style>
    .container {
      max-width: 500px;
    }
    .error {
      display: block;
      padding-top: 5px;
      font-size: 14px;
      color: red;
    }
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
</head>
<body>


  <div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Vehicle Incident Tracker</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Vehicle Incident Tracker Save</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
  <div class="container mt-5">
    <form method="post" id="add_create" name="add_create" action="<?= base_url('Store1') ?>">
      <div class="form-group">
        <label>IncidentType</label>
        <input type="text" name="IncidentType" class="form-control">
      </div>
      <div class="form-group">
        <label>IncidentLocation</label>
        <input IncidentLocation="text" name="IncidentLocation" class="form-control">
      </div>
     <div class="form-group">
    <label>incidenttime</label>
    <input type="text" name="incidenttime" id="incidenttime" class="form-control">
     </div>
      <div class="form-group">
        <label>AffectedPart</label>
        <input IncidentLocation="text" name="AffectedPart" class="form-control">
      </div>
      <div class="form-group">
        <label>Vehicleno</label>
        <input type="text" name="Vehicleno" class="form-control">
      </div>
      <div class="form-group">
        <label>DriverName</label>
        <input IncidentLocation="text" name="DriverName" class="form-control">
      </div>
      <div class="form-group">
        <label>Assignedperson</label>
        <input type="text" name="Assignedperson" class="form-control">
      </div>
      <div class="form-group">
        <label>CosttoIncident</label>
        <input IncidentLocation="text" name="CosttoIncident" class="form-control">
      </div>
      <div class="form-group">
        <label>Correctiveaction</label>
        <input type="text" name="Correctiveaction" class="form-control">
      </div>
      <div class="form-group">
        <label>WorkCompletedateandtime</label>
        <input IncidentLocation="text" name="WorkCompletedateandtime" id="WorkCompletedateandtime" class="form-control">
      </div>
      <div class="form-group">
        <label>Remarkindetails</label>
        <input type="text" name="Remarkindetails" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Save</button>
      </div>
    </form>
  </div>
   </div>
     </div>
       </div>
         </div>
           </div>

           <script>
    // Set current date and time to the incidenttime input field
    document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2) + ' ' + ('0' + currentDate.getHours()).slice(-2) + ':' + ('0' + currentDate.getMinutes()).slice(-2) + ':' + ('0' + currentDate.getSeconds()).slice(-2);
        
        document.getElementById('incidenttime').value = formattedDate;
                document.getElementById('WorkCompletedateandtime').value = formattedDate;

    });
</script>
</body>
</html>
