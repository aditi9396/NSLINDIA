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
        <h3 class="page-title">LOCATION MASTER LIST</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Forms</a></li>
              <li class="breadcrumb-item active" aria-current="page">LOCATION LIST</li>
          </ol>
      </nav>
  </div>
  <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
    <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('locationmaster'); ?>">ADD NEWLY</a>
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
                <th> Hierarchy </th>
                <th> ReportingTo </th>
                <th> ReportingLocation </th>
                <th> LocationCode </th>
                <th> LocationName </th>
                <th> Branch </th>
                <th> PinCode </th>
                <th> State </th>
                <th> City </th>
                <th> Address </th>
                <th> FaxNo</th>
                <th> MobileNo</th>
                <th> EmailId</th>
                <th> AccountLocation</th>
                <th> DataEntryLocation</th>
                <th> StartDate</th>
                <th> EndDate</th>
                <th> Comp</th>
                <th> NextLocation</th>
                <th> PreviousLocation</th>
                <th> LocationOwnership</th>
                <th> ControlLocation</th>
                <th> AdvanceLimit</th>
                <th> Octroi</th>
                <th> BilledAt</th>
                <th> Status</th>
            </tr>
        </thead>
        <tbody>
         <?php  
         $count = 0;
         for ($i=0; $i < count($requestdata); $i++) {
            $count++;?> 
            <tr id="media_row_ <?php echo $requestdata[$i]->id;?>)">
                <td >
                    <?php echo $count; ?>

                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Hierarchy; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->ReportingTo; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->ReportingLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->LocationCode; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->LocationName; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Branch; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->PinCode; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->State; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->City; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Address; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->FaxNo; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->MobileNo; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->EmailId; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->AccountLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->DataEntryLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->StartDate; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->EndDate; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Comp; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->NextLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->PreviousLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->LocationOwnership; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->ControlLocation; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->AdvanceLimit; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Octroi; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->BilledAt; ?></span>
                </td>
                <td>
                    <span class="tb-amount">
                        <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('edit-location/'.$requestdata[$i]->id); ?>">Edit</a>
                        <button class="btn btn-outline-dark btn-fw delete shadow-focus" data-toggle="tooltip" data-placement="top" title="Delete"
                        onclick="prepareDelete('<?php echo $requestdata[$i]->id;?>')">Delete</button>
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
                            <button type="button" id="deletelocation" class="btn btn-outline-dark btn-fw ">Yes, Delete it</button>
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
        $( "#deletelocation" ).click(function() {
            var delet_id = $('#delet_id').val();
            $.ajax({
                url: base_url + "deletelocation",
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




