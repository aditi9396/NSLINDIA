<style type="text/css">
 table table-striped {
    width: 100%;
    overflow-x: auto;
}

.btn i {
    font-size: 2rem;
}
.card .card-body{
    overflow-x: scroll;
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
    box-sizing: border-box;
}
@media (max-width: 576px) {
    .table-responsive {
      overflow-x: auto;
  }
}
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">VEHICLE MASTER LIST</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Forms</a></li>
              <li class="breadcrumb-item active" aria-current="page">VEHICLE LIST</li>
          </ol>
      </nav>
  </div>
  <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
    <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('vehiclemaster'); ?>">ADD NEWLY</a>
</div>
<br>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table id="invtab" class="table table-striped">
          <thead>
            <tr>
                <th>id</th>
                <th> VehicleType </th>
                <th> Vehicle_No </th>
                <th> VendorName </th>
                <th> VendorType </th>
                <th> RegDate </th>
                <th> Chassis_No </th>
                <th> Engine_No </th>
                <th> Depot </th>
                <th> Length </th>
                <th> Width </th>
                <th> Height </th>
                <th> Capacity </th>
                <th> GVW </th>
                <th> UnloadedWeight </th>
                <th> AttachedDate </th>
                <th> Insurance_Validity </th>
                <th> Fitness_Validity </th>
                <th> Permit_validity </th>
                <th> CertNo </th>
                <th> InsuranceNo </th>
                <th> RTONo </th>
                <th> Permit_No </th>
                <th> Fitness_No </th>
                <th> CloseTrip </th>
                <th> ControllingBranch </th>
                <th> AssetType </th>
                <th> NoOfDrivers </th>
                <th> GPSDeviceEnabled </th>
                <th> PermitStates </th>
                <th> FTLType </th>
                <th> VehicleBroker </th>
                <th> NoOfTyres </th>
                <th> RCBookNo </th>
                <th> RegistrationNo </th>
                <th> InsuranceCompany </th>
                <th> FitnessCertificateDate </th>
                <th> RateKm </th>
                <th> ActiveFlag </th>
                <th> CFT </th>
                <th> ServiceKM </th>
                <th> Tax_validdate </th>
                <th> PUCC_Valid </th>
                <th> Fittness_Validdate </th>
                <th> MilageKM </th>
                <th> PerKmRate1 </th>
                <th> Milage </th>
                <th> FuelTankCapacity </th>
                <th> STATUS </th>
            </tr>
        </thead>
        <tbody>
         <?php  
            $count = 0;
            for ($i=0; $i < count($requestdata); $i++) {
                $count++;?> 
                <tr id="media_row_ <?php echo $requestdata[$i]->id; ?>)">
                    <td >
                        <?php echo $count; ?>

                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->VehicleType; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Vehicle_No; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->VendorName; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->VendorType; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->RegDate; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Chassis_No; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Engine_No; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Depot; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Length; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Width; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Height; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Capacity; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->GVW; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->UnloadedWeight; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->AttachedDate; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Insurance_Validity; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Fitness_Validity; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Permit_validity; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->CertNo; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->InsuranceNo; ?></span>
                    </td> 
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->RTONo; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Permit_No; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Fitness_No; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->CloseTrip; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->ControllingBranch; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->AssetType; ?></span>
                    </td>

                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->NoOfDrivers; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->GPSDeviceEnabled; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->PermitStates; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->FTLType; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->VehicleBroker; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->NoOfTyres; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->RCBookNo; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->RegistrationNo; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->InsuranceCompany; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->FitnessCertificateDate; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->RateKm; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->ActiveFlag; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->CFT; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->ServiceKM; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Tax_validdate; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->PUCC_Valid; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Fittness_Validdate; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->MilageKM; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->PerKmRate1; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->Milage; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount"><?php echo $requestdata[$i]->FuelTankCapacity; ?></span>
                    </td>
                    <td>
                        <span class="tb-amount">
                            <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('edit-vehicle/'.$requestdata[$i]->id); ?>">Edit</a>
                            <button class="btn btn-outline-dark btn-fw delete shadow-focus" data-toggle="tooltip" data-placement="top" title="Delete"
                            onclick="prepareDelete('<?php echo $requestdata[$i]->id; ?>')">Delete</button>
                        </span>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="deleteEventPopup">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal py-4">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Are You Sure ?</h4>
                    <div class="nk-modal-text mt-n2">
                        <p class="text-soft">Are you sure you want delete.</p>
                    </div>
                    <div class="d-flex justify-content-center gx-4 mt-4">
                        <div>
                            <input type="hidden" id="delet_id">
                            <button type="button" id="deletevehicle" class="btn btn-outline-dark btn-fw ">Yes, Delete it</button>
                        </div>
                        <div>
                            <button data-bs-dismiss="modal" data-toggle="modal" data-target="#editEventPopup" class="btn btn-outline-dark btn-fw">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function prepareDelete(id) {
        $('#delet_id').val(id); 
        $('#deleteEventPopup').modal('show');
    }

    $(document).ready(function() {
        $( "#deletevehicle" ).click(function() {
            var delet_id = $('#delet_id').val();
            $.ajax({
                url: base_url + "deletevehicle",
                data: {"id": delet_id},
                type: 'POST',
                success: function (data) {
                    var myObj = JSON.parse(data);

                    if(myObj.status){
                        $('#deleteEventPopup').modal('hide');
                        location.reload();
                    } else {
                        $('#deleteEventPopup').modal('hide');
                    }
                },
            });
        });
    });
</script>

