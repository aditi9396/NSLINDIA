<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php if (!empty($meta)) {
      echo $meta['title'];
    } else {
      echo "NSLINDIA";
    } ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets_old/src/master.css">
  <!-- <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css"> -->
  <link rel="manifest" href="assets_old/manifest.json">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>
<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url('assets_old/jquery.min.js'); ?>"></script>
<script src="assets_old/src/sw.js"></script>
<style type="text/css">
  #snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #091631;
    color: #fff!important;
    border-radius: 2px;
    padding: 10px;
    position: fixed;
    z-index: 100000000;
    right: 20px;
    top: 100px;
    font-size: 15px;
  }

  #snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  #snackbar.success {
    border-left: 4px solid green;
  }

  #snackbar.error {
    border-left: 4px solid red;
  }
</style>
<body id="homepage" class="homepage">

  <div id="snackbar">Some text some message..</div>
  <div class="container-scroller">
    <?php 
    if(!empty($header)){ $this->load->view($header); }

    if(!empty($sidebar)){ $this->load->view($sidebar); }

    if(!empty($body)){ $this->load->view($body); }

    if(!empty($footer)){ $this->load->view($footer); }
    ?>
    
  </div>

  <script src="<?php echo base_url('assets_old/custom.js'); ?>"></script>
  <!-- <script src="assets/vendors/js/vendor.bundle.base.js"></script> -->
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <!-- <script src="assets/js/misc.js"></script> -->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/todolist.js"></script>

</body>
</html>