<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">
    
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <form name="myForm"  method="get" action="<?php echo base_url(); ?>Editlr">
                <div class="form-group">
                    <b>Enter LR Number</b>
                    <br><br>
                    <input type="text" class="form-control mx-auto" id="Lrno" name="Lrno" onblur="this.value=removeSpaces(this.value);" required style="max-width: 200px;">
                </div>
                <button type="submit" class="btn btn-outline-dark btn-fw">Search</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
       function removeSpaces(string) {
            return string.split(' ').join('');
        }
        </script>

