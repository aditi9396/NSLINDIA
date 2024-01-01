<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

  <style type="text/css">
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

  #scroll {
            max-height: 300px; 
            overflow-y: auto; 
        }

        .table-fixed {
            width: 100%;
            border-collapse: collapse;
        }

        .table-fixed th, .table-fixed td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
</style>
     


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">CREATE DRS</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Spare Details</li>
              </ol>
          </nav>
      </div>
      <br>
      <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!-- ==================== -->
                   <div class="center-container">

        <form class="responsive-form">
            <div class="horizontal-radio-group">
                <label>
                    <input type="radio" name="formSelector" value="1st"> Insert
                </label>
                <label>
                    <input type="radio" name="formSelector" value="2nd"> Show All
                </label>
                <label>
                    <input type="radio" name="formSelector" value="3rd"> Show Total Qty
                </label>
            </div>
        </form>
        <br><br>
<!-- ==================================================== -->
<div id='1st'>
      <form method='post' id='form' name='form' action="<?= site_url('InsertController/part'); ?>">
        <div class="table-container">
         <table id="lrdetails">
        <thead>
            <tr>
                <th>Part Name</th>
                <th>Vendor Name</th>
                <th>Bill No.</th>
                <th>Bill Date</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
       <tbody id='dataTable'>
               <tr>
                <td>
                    <select id="pname" name="pname[]">
    <?php foreach ($sparepart as $sparepartItem) { ?>
        <option value="<?php echo $sparepartItem['pname']; ?>">
            <?php echo $sparepartItem['pname']; ?>
        </option>
    <?php } ?>
</select>
                </td>
                <td><input type="text" name="vname[]" required></td>
                <td><input type="text" name="billno[]" required></td>
                <td><input type="date" name="bdt[]" required></td>
                <td><input type="text" name="Qty[]" oninput="calculateAmount(this)" required></td>
                <td><input type="text" name="rate[]" oninput="calculateAmount(this)" required></td>
                <td><input type="text"  name="amount[]" readonly required></td>
                <td>             
                </td>
            </tr>
            </tbody>
          <tfoot>
               <tr>
                  <td colspan=4 align='right'>Total</td>
                  <td><input type='text' id='dtltr' name='dtltr' readonly></td>
                  <td></td>
                  <td><input type='text' id='dtamount' name='dtamount' readonly> </td>
                  <td>
                     <div id="addBtnContainer">
                        <input type="button"  class="btn btn-outline-dark btn-fw"  id="addBtn" onclick="addRow()" value="Add Row">
                     </div>
                  </td>
               </tr>
            </tfoot>
         </table>
     </div>
         <br>
         <center>
            <input type="button"  class="btn btn-outline-dark btn-fw"  id="Submit" value="Submit" >
         </center>
      </form>
   </div>
<!-- ===================== -->
 <div id='2nd'>
    <form method="post" action="<?= site_url('filterByDate'); ?>" id="dateFilterForm">
          <center>
        <label for="startdt">Select Start Date</label>
        <input type="date" name="startdt" id="startdt" required>

        <label for="enddt">Select End Date</label>
        <input type="date" name="enddt" id="enddt" required>

        <input type="submit" value="Show"  class="btn btn-outline-dark btn-fw"  id="Submit" name="date" class="btn btn-primary">
          </center>
    </form>
</div>
<!-- =================================== -->
<div id='3rd'>
    <div class="table-responsive text-nowrap" id="scroll">
    <table   id="lrdetails" class="table table-fixed text-center">
    <thead class="thead-fixed">
        <tr>
            <th>Part Name</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sparepart as $row) : ?>
            <tr>
                <td><?= isset($row['pname']) ? $row['pname'] : '' ?></td>
                <td><?= isset($row['UpdatedQty']) ? $row['UpdatedQty'] : '' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
</div>
  </div>
</div>
  </div>
</div>
  </div>




<!-- ============================================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
        $(document).ready(function () {
            function hideAllForms() {
                $("#1st, #2nd, #3rd").hide();
            }
            function showForm(formId) {
                hideAllForms();
                $("#" + formId).show();
            }
            hideAllForms();
            $("input[name='formSelector']").on("change", function () {
                showForm($(this).val());
            });
        });
    </script>
    <script>
        // ============================
         function setCurrentDate() {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); 
        var day = currentDate.getDate().toString().padStart(2, '0'); 

        var currentDateStr = `${year}-${month}-${day}`;
        document.querySelector("[name='bdt[]']").value = currentDateStr;
    }

    window.onload = function() {
        setCurrentDate();
    };

    // ===============================================
      function addRow() {
    var tbody = document.getElementById("dataTable");
    var row = tbody.insertRow(tbody.rows.length);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);

    // Assuming 'sparepart' is a JavaScript array containing the options
    var sparepartOptions = <?php echo json_encode($sparepart); ?>;

    cell1.innerHTML = '<select id="pname" name="pname[]">' +
        sparepartOptions.map(function (item) {
            return '<option value="' + item.pname + '">' + item.pname + '</option>';
        }).join('') +
        '</select>';

    cell2.innerHTML = '<input type="text" name="vname[]">';
    cell3.innerHTML = '<input type="text" name="billno[]">';
    cell4.innerHTML = '<input type="date" name="bdt[]">';
    cell5.innerHTML = '<input type="text" oninput="calculateAmount(this)" name="Qty[]">';
    cell6.innerHTML = '<input type="text" oninput="calculateAmount(this)" name="rate[]">';
    cell7.innerHTML = '<input type="text" name="amount[]">';
    cell8.innerHTML = '<button type="button" class="btn btn-outline-dark btn-fw" onclick="deleteRow(this)">Delete</button>';
}

// =====================
        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

   // ========================     
     function calculateAmount(input) {
        var row = input.closest("tr");
        var qty = parseFloat(row.querySelector("[name='Qty[]']").value) || 0;
        var rate = parseFloat(row.querySelector("[name='rate[]']").value) || 0;
        var amount = qty * rate;
        row.querySelector("[name='amount[]']").value = amount.toFixed(2);

        updateTotalQty();
    }

// ====================================//////
    function updateTotalQty() {
        var table = document.getElementById("dataTable");
        var rows = table.getElementsByTagName("tr");
        var totalQty = 0;
        var totalAmount = 0;

        for (var i = 0; i < rows.length; i++) { 
            var qty = parseFloat(rows[i].querySelector("[name='Qty[]']").value) || 0;
            totalQty += qty;
        }

         for (var i = 0; i < rows.length; i++) { 
            var amount = parseFloat(rows[i].querySelector("[name='amount[]']").value) || 0;
            totalAmount += amount;
        }

        document.getElementById("dtltr").value = totalQty.toFixed(2);
                document.getElementById("dtamount").value = totalAmount.toFixed(2);

    }
        // ======================
   $(document).ready(function () {
    $("#Submit").click(function () {
        let form = document.getElementById("form");
        var fd = new FormData(form);

        $.ajax({
            url: "<?= base_url('submitpart'); ?>",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            datatype: 'json', 
            type: 'POST',
            success: function (response) {
                var myObj = JSON.parse(response); 

                if (myObj.response) {
                    // Success: Data inserted successfully
                    alert('Data inserted successfully');
                } else {
                    // Failure: Data not inserted
                    alert('Data not inserted. ' + myObj.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});
    </script>
</body>

</html>
