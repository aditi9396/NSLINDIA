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
            <h3 class="page-title">Spare Part</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Spare Part Save</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
  <div class="container mt-5">
    <form method="post" id="add_create" name="add_create" action="<?= base_url('Store') ?>">
      <div class="form-group">
        <label>pName</label>
        <input type="text" name="pname" class="form-control">
      </div>
      <div class="form-group">
        <label>pDesc</label>
        <input type="text" name="pdesc" class="form-control">
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
</body>
</html>
