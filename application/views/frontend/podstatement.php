<style type="text/css">
    .table{
        width: 100%;
        overflow-x: auto;
    }
    #pod {
        border-collapse: collapse;
        width: 100%;
    }
    #pod th, #pod td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    #pod th {
        background-color: #2c2d58a3;
    }
    #pod input[type="text"], #pod select {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    @media (max-width: 768px) {
        #pod {
            font-size: 12px;
        }
    }
    #zoomWindow:hover{
        margin-left: 15px;
    }
    

    .grid-cell {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">POD STATEMENT</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">POD STATEMENT</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card" >
                    <div class="card-body">
                        <form name="myForm" method="get" id="myform" action="">
                           Select Date: <br><br>
                           &nbsp;&nbsp; From:
                           <input type="date"  id="d1" name="d1" min="" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           To: 
                           <input type="date" id="d2"  name="d2" max="" value="">
                           <br><br>
                           <input type="hidden" id="page" name="page" value="1">
                           <input type="hidden" id="depo" name="depo" value="PNA">
                           &nbsp;&nbsp; Depot : 
                           <select id="poddepo" class="form-control w-25" name="poddepo" onchange="fetch_select();">
                            <?php foreach ($country as $country) { ?>
                                <option value="<?php echo $country['CPCODE']; ?>">
                                    <?php echo $country['CPCODE'] . "-" . $country['DEPO_NAME']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; Consigner: 
                        <select id="Consigner" name="Consigner">
                            <option value="">Select Consignor Name</option>
                            <?php foreach ($country1 as $country) { ?>
                                <option value="<?php echo $country['Consignor']; ?>">
                                    <?php echo $country['Consignor']; ?>
                                </option>
                            <?php } ?>
                        </select><br><br>

                        <input type="submit" id="submitqry" class="btn btn-outline-dark btn-fw" name="submitqry" value="Search"><br><br>
                    </form>
                    <div class="table-container">
                        <table class="invtab" border="1" id='pod'style="display: none; width:100%;">
                            <thead>
                                <tr >
                                    <th>Consignor</th>
                                    <th>LRNO</th>
                                    <th>DRSNO</th>
                                    <th>Image</th>
                                    <th>Select all</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    function getCurrentDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    document.getElementById('d2').value = getCurrentDate();
    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    const yYear = yesterday.getFullYear();
    const yMonth = String(yesterday.getMonth() + 1).padStart(2, '0');
    const yDay = String(yesterday.getDate()).padStart(2, '0');
    const yesterdayFormatted = `${yYear}-${yMonth}-${yDay}`;
    document.getElementById('d1').value = yesterdayFormatted;
    document.getElementById('d1').setAttribute('max', getCurrentDate());

    function fetch_select() {
        var selectedValue = $("#poddepo").val();
        console.log(selectedValue);
    }
    $(document).ready(function () {
        $("#submitqry").click(function () {
            let form = document.getElementById("myform");
            let fd = new FormData(form);

            $.ajax({
                url: base_url + "podsearch",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                   $("#pod").show();
                   $('#pod tbody').empty();
                   $.each(response.data, function (index, row) {
                    var newRow = "<tr>" +
                    "<td>" + row.Consignor + "</td>" +
                    "<td>" + row.LRNO + "</td>" +
                    "<td>" + row.DRSNO + "</td>" +
                    "<td>" + row.Image + "</td>" +
                    "<td><input type='checkbox' class='select-all'></td>" +
                    "</tr>";
                    $('#pod tbody').append(newRow);
                });
               },
               error: function (jqXHR, textStatus, errorThrown) {
                console.error("Ajax request failed:", textStatus, errorThrown);
                errorToster('Ajax request failed');
            }
        });
        });
    });
</script>









