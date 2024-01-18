<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function removeSpaces(string) {
        return string.split(' ').join('');
    }
</script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <form name="myForm" method="get" action="<?php echo base_url(); ?>RetrunLr">
                <div class="form-group">
                    <b>Enter LR Number</b>
                    <br><br>
                    <input type="text" class="form-control mx-auto" id="Lrno" list="json-datalist" name="Lrno" onblur="this.value=removeSpaces(this.value);" required style="max-width: 200px;">
                    <datalist id="json-datalist"></datalist>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-dark btn-fw">Search</button>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        var dataList = document.getElementById('json-datalist');
        var input = document.getElementById('Lrno');

        input.addEventListener('input', function () {
            var query = input.value;

            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    var jsonOptions = JSON.parse(request.responseText);

                    // Clear previous options
                    dataList.innerHTML = '';

                    jsonOptions.forEach(function (item) {
                        var option = document.createElement('option');
                        option.value = item.LRNO; // Assuming 'LRNO' is the field from your database
                        dataList.appendChild(option);
                    });
                }
            };

            // Replace 'SearchlrnoReturn' with the actual controller/method URL
            request.open('GET', '<?php echo base_url(); ?>Lredit/SearchlrnoReturn?query=' + encodeURIComponent(query), true);
            request.send();
        });
    });
</script>


