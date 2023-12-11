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
        <h3 class="page-title">LRCPVOLUMETRIC LIST</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Forms</a></li>
              <li class="breadcrumb-item active" aria-current="page">LRCPVOLUMETRIC LIST</li>
          </ol>
      </nav>
  </div>
  <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
    <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('lr-generataion'); ?>">CREATE CPVOLUMETRICLR</a>
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
                <th> LRNO </th>
                <th> LRDate </th>
                <th> PayBasis </th>
                <th> PkgsNo </th>
                <th> ToPlace </th>
                <th> FromPlace </th>
                <th> DocketTotal </th>
                <th> Consignee </th>
                <th> Consignor </th>
                <th> Status </th>
                <th> DRS_THCNO </th>
                <th> Action </th>
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
                    <span class="tb-amount"><?php echo $requestdata[$i]->LRNO; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->LRDate; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->PayBasis; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->PkgsNo; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->ToPlace; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->FromPlace; ?></span>
                </td> 
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->DocketTotal; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Consignee; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Consignor; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Status; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->DRS_THCNO; ?></span>
                </td>
                <td>
                    <span class="tb-amount">
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
                            <button type="button" id="deleteLR" class="btn btn-outline-dark btn-fw ">Yes, Delete it</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script type="text/javascript">
    function prepareDelete(id) {
        $('#delet_id').val(id); 
        $('#deleteEventPopup').modal('show');

    }

    $(document).ready(function() {
        $( "#deleteLR" ).click(function() {
            var delet_id = $('#delet_id').val();
            $.ajax({
                url: base_url + "delete_LR",
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