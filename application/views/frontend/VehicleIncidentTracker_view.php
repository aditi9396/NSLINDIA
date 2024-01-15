<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>"><!DOCTYPE html>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style type="text/css">
        
        .table-container {
    width: 100%;
    overflow-x: auto;
}

.table-container::-webkit-scrollbar {
    height: 12px;
}

.table-container::-webkit-scrollbar-thumb {
    background-color: #888;
}
    
    </style>
          <div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Vehicle Incident Tracker</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">VehicleIncidentTracker</li>
              </ol>
          </nav>
      </div>
       <div class="d-flex justify-content-end">
            <a href="<?= base_url('create1') ?>" style="background-color: darkgreen;" class="btn btn-success mb-2">Add Vehicle Tracker</a>

             <a href="<?= base_url('UserCrud/xlsxdata1') ?>" style="background-color: darkgreen;" class="btn btn-success mb-2">Download XLS</a>

                  


        </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
    <div class="container mt-4">
       

        <div class="mt-3">
            <div class="table-responsive">
            <table class="table table-bordered" id="users-list">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>IncidentType</th>
                        <th>IncidentLocation</th> 
                          <th>incidenttime</th>
                        <th>AffectedPart</th>
                        <th>Vehicleno</th>
                             <th>DriverName</th>
                        <th>Assignedperson</th>
                          <th>CosttoIncident</th>
                        <th>Correctiveaction</th>
                        <th>WorkCompletedateandtime</th>

                         <th>Remarkindetails</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sparepart)): ?>   
                        <?php foreach ($sparepart as $user): ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['IncidentType']; ?></td>
                                <td><?= $user['IncidentLocation']; ?></td>
                                   <td><?= $user['incidenttime']; ?></td>
                                <td><?= $user['AffectedPart']; ?></td>
                                <td><?= $user['Vehicleno']; ?></td>

                                <td><?= $user['DriverName']; ?></td>
                                <td><?= $user['Assignedperson']; ?></td>
                                   <td><?= $user['CosttoIncident']; ?></td>
                                <td><?= $user['Correctiveaction']; ?></td>
                                <td><?= $user['WorkCompletedateandtime']; ?></td>

                                   <td><?= $user['Remarkindetails']; ?></td>
                                <td><?= $user['Status']; ?></td>

                                <td>
                                    <a href="<?= base_url('singleUser1/' . $user['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?= base_url('delete2/' . $user['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
     </div>
      </div>
       </div>
        </div>
         </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script>
    $(document).ready(function () {
        $('#users-list').DataTable(); 
    });
</script>
