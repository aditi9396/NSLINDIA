<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') 
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
   <style type="text/css">
    .table-container {
      width: 100%;
      overflow-x: auto;
  }
  #invtab {
      border-collapse: collapse;
      width: 100%;
  }
  #invtab th, #invtab td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
  }
  #invtab th {
      background-color: #2c2d58a3;
  }
#invtab tbody tr td input[type="text"], #invtab select {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
}

  @media (max-width: 768px) {
      #invtab {
        font-size: 12px;
    }
}

.ui-dialog {
    position: absolute;
    height: auto;
    margin: 10% 40%;
    width: max-content;
}
.thcno-input {
    width: 177px !important;
}


</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Multiple Lr Print</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Multiple Lr Print</li>
                </ol>
            </nav>
        </div>
        <br>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form  class="form-sample" method="post" id="form1" name='form1' enctype='multipart/form-data' action="<?php echo base_url();?>SelectConsidata">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="startdate">From Date</label>
                                    <input class="form-control" type="date" name="startdate" id="startdate" size="10" onchange="fetchConsignerOptions();">
                                </div>
                                <div class="col-sm">
                                    <label for="enddate">To Date</label>
                                    <input class="form-control" type="date" onchange="fetchConsignerOptions();" name="enddate" id="enddate" size="10">
                                </div>
                                <div class="col-sm">
                                    <label for="Consigner">Consigner</label>
                                    <select id="Consigner" name="Consigner" class="form-control">
                                        <option value='All'>All</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <input type="submit" class="btn btn-outline-dark btn-fw" id="Submit" value="Submit" name="Submit">
                        </form>
                            <br>
                            <br>
                            <?php if (isset($_POST["Submit"])): ?>
                        <form class="form-sample" method="post" id="myForm" name='myForm' enctype='multipart/form-data' action="<?php echo base_url();?>Multiplelr">
                                <label><input type='checkbox' name='Copies[]' value='Consignee Copy'>Consignee Copy</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type='checkbox' name='Copies[]' value='Acknowledgement Copy'>Acknowledgement Copy</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type='checkbox' name='Copies[]' value='Consigner Copy'>Consigner Copy</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type='checkbox' name='Copies[]' value='Account Copy'>Account Copy</label>
                            <div class="table-container">
                                <table id="invtab" text-align='center'>
                                    <thead> 
                                        <th>Id</th>
                                        <th>LRNO</th>
                                        <th>LRDate</th>
                                        <th>Consignor</th>
                                        <th>Consignee</th>
                                        <th>Pkgs No</th>
                                        <th>Actual Weight</th>    
                                        <th>InvoiceNo</th>

                                        <th><input type="checkbox" id="selectall">Select all for Print</th>
                                    </thead>
                                     <?php if (isset($Considata) && !empty($Considata)): ?>
                                        <?php $i = 1; ?>
                                            <?php foreach ($Considata as $Con): ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?= $Con->LRNO ?></td>
                                                    <td><?= $Con->LRDate ?></td>
                                                    <td><?= $Con->Consignor ?></td>
                                                    <td><?= $Con->Consignee ?></td> 
                                                    <td><?= $Con->PkgsNo ?></td>
                                                    <td><?= $Con->ActualWeight ?></td>
                                                    <td style="width: 13px !important;"><?= $Con->InvoiceNo ?></td>
                                                    <td>
                                                    <input type="checkbox" name="LRNO[]" value="<?= $Con->LRNO ?>">
                                                    <input type='button' value='LR Lazer Print' onclick='window.open("lrlazer?LRNO=<?= $Con->LRNO ?>","_blank","width=1200,height=600");'>
                                                </td>
                                                 </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                </table>
                 <input type="hidden" id="selectedRow" name="selectedRow" value="">
                        <!-- Add a single submit button outside the table -->
                        <input type="submit" class="submit-row" value="Submit">
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <script>
    $('#selectall').click(function() {
        $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
    });
  </script>

<script type="text/javascript">
    const currentDate = new Date();
    const currentFormattedDate = formatDate(currentDate);
    
    document.getElementById('startdate').value = currentFormattedDate;
    document.getElementById('enddate').value = currentFormattedDate;
    
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>

<script>


    function fetchConsignerOptions() {
        $.ajax({
            type: 'get',
            url: 'Lredit/fetchconsignor',
            dataType: 'json',
            data: {
                startdate: document.getElementById('startdate').value,
                enddate: document.getElementById('enddate').value
                },
                success: function (response) {
                    var depotSelect = $('#Consigner').empty();

                    if (response && response.length > 0) {
                        $.each(response, function (index, item) {
                            depotSelect.append('<option value="' + item.Consignor + '">' + item.Consignor + '</option>');
                        });
                    } else {
                        depotSelect.append('<option value="">Consigner is null</option>');
                    }
                },
            error: function (response) {
                console.log(response);
            }
        });
    }
</script>