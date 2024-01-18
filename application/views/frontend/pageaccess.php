<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">PAGE ACCESS</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page Access </li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form name='pageaccess' method="post" action=''>
                            <div class='row d-flex'>
                                <div class="col-md-3">
                                    <label class='form-label'> User Name: </label>
                                </div>
                                <div class="col-md-3">
                                    <input type='text' class="form-control" id='username' list='username-list' name='username'>
                                    <datalist id="username-list"></datalist>
                                </div>
                            </div>
                            <input type="button" id='submitqry' name='submitqry' class="btn btn-gradient-dark btn-fw" value="Search">
                        </form>
                        <br>
                        <div class="container" id="userdetails">
                        </div>
                        <div id="DETAILS" style="display:none;">
                            <form method="post" name="userform" id="userform" enctype="multipart/form-data" action="" >
                                <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <ul class="list-group">
                                        <b>
                                            <li class="list-group-item" data-bs-toggle="collapse" data-bs-target="#collapseExample" id="TPTSection" aria-expanded="false" aria-controls="collapseExample">
                                                TPT
                                            </li>
                                        </b>
                                        <div id="collapseExample" class="collapse">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="select-all">Select All
                                                        </th>
                                                        <th>Pages</th>
                                                        <th>Module</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" name="Page[]" value="lr-generataion"></td>
                                                        <td>lr-generataion</td>
                                                        <td>TPT</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="Page[]" value="LR_cancel"></td>
                                                        <td>LR_cancel</td>
                                                        <td>TPT</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="Page[]" value="Createprn"></td>
                                                        <td>Createprn</td>
                                                        <td>TPT</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="Page[]" value="fetchprnwise"></td>
                                                        <td>fetchprnwise</td>
                                                        <td>TPT</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <input type="btn" name="Submit" id="Access" style="cursor:pointer; font-weight:bold;" class="btn btn-gradient-dark btn-fw" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        var searchInput = $('#username');
        var searchResultsList = $('#username-list');

        searchInput.on('keyup', function() {
            var keyword = searchInput.val().trim();

            if (keyword !== '') {
                $.ajax({
                    url: '<?php echo site_url("userautosearch"); ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    success: function(response) {
                        searchResultsList.html(response);
                    }
                });
            } else {
                searchResultsList.html('');
            }
        });

        $('#submitqry').on('click', function() {
            fetchEmployeeData();
        });
    });

    function fetchEmployeeData() {
        var username = $('#username').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url("fetchEmployeeData")?>',
            data: { username: username },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    var userDetails = '<h4 style="text-align:center; background-color:#d3ede2; height:28px; padding:5px;">' +
                    '<strong>' + data.UserName + ':' + data.EmpName + '</strong>' +
                    '</h4>';
                    $('#userdetails').html(userDetails);
                    displayUserForm();
                }
            },
            error: function() {
                alert('Error fetching employee data');
            }
        });
    }

    function displayUserForm() {
        $('#DETAILS').show();
    }

    $(document).ready(function () {
        $('.select-all').on('change', function () {
            var checkboxes = $(this).closest('table').find(':checkbox');
            checkboxes.prop('checked', $(this).prop('checked'));
        });

        $(':checkbox[name="Page[]"]').on('change', function () {
            var allCheckboxes = $(':checkbox[name="Page[]"]');
            $('.select-all').prop('checked', allCheckboxes.length === allCheckboxes.filter(':checked').length);
        });
    });

    $("#Access").click(function() {
        let form = document.getElementById("userform");
        let fd = new FormData(form);

        var username = document.getElementById('username').value;
        at = username;
        alert(at);

        fd.append('at', at);

        $.ajax({
            url: base_url + "Access",
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                var myObj = JSON.parse(data);
                if (myObj.status) {
                    setTimeout(function() {
                    }, 2000);
                } else {
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("Error: " + textStatus, errorThrown);
            }
        });
    });

</script>
