<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>"><!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>
<body>
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Spare Part</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Spare Part Update</li>
              </ol>
          </nav>
      </div> 
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
    <div class="container mt-5">
    <form method="post" id="update_user" name="update_user" action="<?= site_url('UserCrud/update1') ?>">
    <input type="hidden" name="id" id="id" value="<?= $user_obj->id ?? ''; ?>">
         <div class="form-group">
        <label>IncidentType</label>
        <input type="text" name="IncidentType" class="form-control" value="<?= $user_obj->IncidentType ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>IncidentLocation</label>
        <input IncidentLocation="text" name="IncidentLocation" class="form-control" value="<?= $user_obj->IncidentLocation ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>AffectedPart</label>
        <input IncidentLocation="text" name="AffectedPart" class="form-control" value="<?= $user_obj->AffectedPart ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>Vehicleno</label>
        <input type="text" name="Vehicleno" class="form-control" value="<?= $user_obj->Vehicleno ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>DriverName</label>
        <input IncidentLocation="text" name="DriverName" class="form-control" value="<?= $user_obj->DriverName ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>Assignedperson</label>
        <input type="text" name="Assignedperson" class="form-control" value="<?= $user_obj->Assignedperson ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>CosttoIncident</label>
        <input IncidentLocation="text" name="CosttoIncident" class="form-control" value="<?= $user_obj->CosttoIncident ?? ''; ?>">
      </div>
      <div class="form-group">
        <label>Correctiveaction</label>
        <input type="text" name="Correctiveaction" class="form-control" value="<?= $user_obj->Correctiveaction ?? ''; ?>">
      </div>
    
      <div class="form-group">
        <label>Remarkindetails</label>
        <input type="text" name="Remarkindetails" class="form-control" value="<?= $user_obj->Remarkindetails ?? ''; ?>">
      </div>
      <div class="form-group">
                <button type="submit" class="btn btn-danger btn-block">Update</button>
      </div>
    </form>
    </div>
 </div>
  </div>
   </div>
    </div>
     </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
 
        
