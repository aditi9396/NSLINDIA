<!doctype html>
<html lang="en">
<head>
  <!-- <meta charset="utf-8"> -->
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <title>
    <?php if (!empty($meta)) {
      echo $meta['title'];
    } else {
      echo "NSLINDIA";
    } ?>
  </title>
  <!-- This site is optimized -->
  <link rel="icon" type="image/png" href="assets_old/frontend/images/SWAT12.png">
  <link rel="manifest" href="assets_old/manifest.json">
  <link rel="stylesheet" href="assets_old/style.css">

  <link rel="canonical" href="#" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
  <link rel="apple-touch-icon" href="favicon.icon">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets_old/src/master.css">
  <meta property="og:image" content="assets_old/frontend/image/SWAT12.png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="assets_old/frontend/image/SWAT12.png" />
  <script src="assets_old/src/index.js"></script>
  <script src="assets_old/src/sw.js"></script>
  <!-- SEO End -->

  <script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
  </script>
  <!-- <script src="<?php echo base_url('assets_old/jquery.min.js'); ?>"></script> -->
  <style type="text/css">
    body{
      overflow-x: hidden;
/*      background-color: #000;*/
}

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

  <?php
  if (!empty($header)) {
    $this->load->view($header);
  }?>
  <?php
  if (!empty($body)) {
    $this->load->view($body);
  }
  if (!empty($footer)) {
    $this->load->view($footer);
  }
  ?>

</body>
<script src="<?php echo base_url('assets_old/custom.js'); ?>"></script>
</html>