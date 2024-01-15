<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>"><!DOCTYPE html>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
          <div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">SPARE PART</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Spare Part View</li>
              </ol>
          </nav>
      </div>
      <br>
      <a href="<?= base_url('create') ?>" class="btn btn-success mb-2">Add PART</a>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
    <div class="container mt-4">
        <div class="d-flex justify-content-end">
        </div>

        <div class="mt-3">
            <div class="table-responsive">
            <table class="table table-bordered" id="users-list">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>pName</th>
                        <th>pDesc</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sparepart)): ?>   
                        <?php foreach ($sparepart as $user): ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['pname']; ?></td>
                                <td><?= $user['pdesc']; ?></td>
                                <td>
                                    <a href="<?= base_url('singleUser/' . $user['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?= base_url('delete1/' . $user['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
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
