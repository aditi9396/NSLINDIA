<?php include('backend_template.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
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
#invtab input[type="text"], #invtab select {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
}
@media (max-width: 768px) {
    #invtab {
      font-size: 12px;
  }
}

</style>

     <script>
        window.onload = function () {
            // Set the default value to today's date
            var arrivadate = document.getElementById('arrivadate');
            if (arrivadate) {
                arrivadate.valueAsDate = new Date();
                console.log(arrivadate.value);
            }
        }
    </script>

    <script>
    function togglehideshowunloading() {
        var withoutUnloadingRadio = document.getElementById('loadingTypeWithoutUnloading');
        var loadingHamaliAmountLabel = document.getElementById('loadingHamaliAmountLabel');
        var loadingHamaliAmountInput = document.getElementById('loadingHamaliAmountInput');
        
        var loadingHamalivendornamelabel = document.getElementById('loadingHamalivendornamelabel');
        var loadingHamalivendornamedropdown = document.getElementById('loadingHamalivendornamedropdown');

        if (withoutUnloadingRadio.checked) {
            loadingHamaliAmountLabel.style.display = 'none';
            loadingHamaliAmountInput.style.display = 'none';
            loadingHamalivendornamelabel.style.display ='none';
            loadingHamalivendornamedropdown.style.display ='none';
        } else {
            loadingHamaliAmountLabel.style.display = 'block';
            loadingHamaliAmountInput.style.display = 'block';
            loadingHamalivendornamelabel.style.display ='block';
            loadingHamalivendornamedropdown.style.display='block';
        }
    }

    // Call the function on page load to set initial state
    togglehideshow();
</script>
<script>
    function togglehideshow() {
        var withoutUnloadingRadio = document.getElementById('loadingTypeUnloading');
        var loadingHamaliAmountLabel = document.getElementById('loadingHamaliAmountLabel');
        var loadingHamaliAmountInput = document.getElementById('loadingHamaliAmountInput');
        
        var loadingHamalivendornamelabel = document.getElementById('loadingHamalivendornamelabel');
        var loadingHamalivendornamedropdown = document.getElementById('loadingHamalivendornamedropdown');

        if (withoutUnloadingRadio.checked) {
            loadingHamaliAmountLabel.style.display = 'block';
            loadingHamaliAmountInput.style.display = 'block';
            loadingHamalivendornamelabel.style.display ='block';
            loadingHamalivendornamedropdown.style.display='block';
            
            
           
        } else {
             loadingHamaliAmountLabel.style.display = 'none';
            loadingHamaliAmountInput.style.display = 'none';
            loadingHamalivendornamelabel.style.display ='none';
            loadingHamalivendornamedropdown.style.display ='none';
            
        }
    }

    // Call the function on page load to set initial state
    togglehideshow();
</script>
 <script>
document.getElementById('form1').addEventListener('submit', function (event) {
    const selectElement = document.getElementById('Hvendor');
    if (selectElement.value === 'Select') {
        alert('Please select a vendor.'); 
        event.preventDefault();
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var selectElements = document.querySelectorAll('.select-validation');
  var submitButton = document.querySelector('input[name="Submit"]');


  submitButton.disabled = true;

  selectElements.forEach(function (select) {
    select.addEventListener('change', function () {
      validateDropdowns();
    });
  });

  function validateDropdowns() {
    var allDropdownsSelected = true;

    selectElements.forEach(function (select) {
      if (select.value === 'SELECT') {
        allDropdownsSelected = false;
        return;
      }
    });


    submitButton.disabled = !allDropdownsSelected;
  }
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>  
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">THC UPDATE</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">THC Update</li>
      </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="thcupdate">
          <div class="container">
            <div class="row">
    <div class='table-responsive'>
        <table class='table'>
            <table style='width:100%' class='blueTable' cellpadding='4' border='1'>
                <?php foreach ($Edit_PrnStock_details as $row): ?>
                    <tr>
    <td style="border: 1px solid black;"><strong>PRN No.</strong></td>
    <td style="border: 1px solid black;"><?php echo $row->PRNId; ?></td>
    <td style="border: 1px solid black;"><strong>PRN Date</strong></td>
    <td style="border: 1px solid black;"><?php echo $row->PRNDate; ?></td>
    <td style="border: 1px solid black;"><strong>Vehicle No.</strong></td>
    <td style="border: 1px solid black;"><?php echo $row->VehicleNo; ?></td>
</tr>


                <?php endforeach; ?>
            </table>

        </table>
    </div>
</div>
</div>

           <form method='post' id='form1' name='form1' enctype='multipart/form-data' action='<?php echo base_url('prnarrivaldetails') ?>'>

            <table class='table'>
        <table cellpadding='10'>


            <div class="row mt-4" >      
        <div class="col-md-2">
        <strong><label>Arrival Date :</label></strong>
            </div>
            <div class="md-3" style="margin-top: -20px; margin-left:130px;">
             <input type="date"  id="arrivadate" style="margin-left:-20PX;" name="arrivadate">
             </div>
       
        <td> <input type='hidden' name='thcno' value="<?php echo $row->PRNId; ?>">
         <input type='hidden' name='Vehicleno' value="<?php echo $row->VehicleNo; ?>"></td>

        </div>

        <div class="row mt-3">

    <div class="row">
       

        <div class="col-md-4">    
        <label>Are you UnLoading Vehicle or Not :</label>
   
    </div>
   <div class="col-md-2">
        <label for='q1-y'>
            <input type='radio' name='loadingtype' id='loadingTypeUnloading' value='UnLoading' onclick='togglehideshowunloading()' checked required>UnLoading
        </label>

        </div>


    
    <div class="col-md-4">
        <label for='q1-n'>
            <input type='radio' name='loadingtype' id='loadingTypeWithoutUnloading' value='WithoutUnLoading'  onclick='togglehideshow()' required>&nbsp;Without UnLoading
        </label>
    </div>

      </div>
      <div class="row mt-3">

    <div class="col-md-3" id='loadingHamalivendornamelabel'>


    <label> Loading Hamali Vendor Name :<span style='color:red'>*</span></label>
</div>

<div class="col-md-3" id='loadingHamalivendornamedropdown'>

         <select required id='Hvendor' class="form-control" name='Hvendor' >
        <option value='0' required>SELECT Hamali Vendor</option>
        
        <?php        
        $depot = isset($user->Depot) ? $user->Depot : null;

        print_r($depot);

        echo " testing";

        if ($depot) {
            $sql1 = "SELECT `Hvendor` FROM `HamaliVendor` WHERE `DEPOT`= '$depot' ";
            $result1 = $this->db->query($sql1); // Use CodeIgniter's query method

            $rowsCount = $result1->num_rows();

            if ($rowsCount > 0) {
                foreach ($result1->result_array() as $row) {
                    echo "<option value='" . $row['Hvendor'] . "'>" . $row['Hvendor'] . "</option>";
                }
            }
        }
        ?>
    </select>

    </div>

<div class="col-md-3" id='loadingHamaliAmountLabel'>
    <label>
  Loading Hamali Amount :<span style='color:red'>*</span></label>
  </div>

  <div class="col-md-3" id='loadingHamaliAmountInput' >
        <input type='text'  id='hamali' name='hamali' pattern='[0-9]+' required>

    </div>
</div>

</div>

 <div class='table-responsive' style='margin-left:35px'>          
    <form method='post' action='your_action_page.php'>
        <div class="table-container">
          <table id="invtab">
            <thead class="table-primary">
                <tr>
                    <th>LR No.</th>
                    <th>LR Date</th>
                    <th>Place</th>
                    <th>Qty</th>
                    <th>Received Qty</th>
                    <th>Reason</th>
                    <th>SELECT</th>
                </tr>
            </thead>

            <?php foreach ($Edit_PrnStock_alldetails as $record): ?>
                <tr>
                    <!-- Use the correct column name -->
                    <td><input type='text' readonly name='LRNO[]' value="<?php echo $record->LRNO; ?>"></td>
                    <td><input type='text' readonly name='lr_dates[]' value="<?php echo $record->LRDate; ?>"></td>
                    <td><?php echo $record->ToPlace; ?></td>
                    <td><input type='text' name='qty_<?php echo $record->LRNO; ?>' readonly value="<?php echo $record->PkgsNo; ?>"></td>
                   <td><input type='number' name='received_qty_<?php echo $record->LRNO; ?>' value="<?php echo $record->PkgsNo; ?>"></td>

                    <td>
                       <select name='reason_<?php echo $record->LRNO; ?>' class='select-validation'>
                            <option value='SELECT' selected>SELECT</option>
                            <option value='OK'>OK</option>
                            <option value='MissmatchQty'>Missmatch Qty</option>
                            <option value='Licakage'>Licakage</option>
                            <option value='Damage'>Damage</option>
                            <option value='Extra'>Extra</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table><br>

        <div class='form-group' style='margin-left:60px'>
            <input type='submit' class='btn btn-primary' name='Submit' onclick='return validateForm()' value='Submit'>
        </div>
    </form>
</div>      

    </div>
</div>

</body>

</html>
