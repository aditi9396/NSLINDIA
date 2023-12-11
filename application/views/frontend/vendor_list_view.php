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
.pagination  li{
    poi
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
        <h3 class="page-title">VENDOR MASTER LIST</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Forms</a></li>
              <li class="breadcrumb-item active" aria-current="page">VENDOR LIST</li>
          </ol>
      </nav>
  </div>
  <div class="d-flex" style="display: flex!important; align-items: flex-end;flex-direction: row; justify-content: space-between;">
    <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('vendormaster'); ?>">ADD NEWLY</a>
</div>
<br>
<div class="row">
   <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
            <select  name="state" id="maxRows">
               <option value="5000">Show ALL Rows</option>
               <option value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="50">50</option>
               <option value="70">70</option>
               <option value="100">100</option>
           </select>
       </div>
       <table id="invtab" class="table table-striped">
          <thead>
            <tr>
                <th>id</th>
                <th> VendorCode </th>
                <th> VendorName </th>
                <th> Type </th>
                <th> Address </th>
                <th> City </th>
                <th> Pincode </th>
                <th> Mobile_No </th>
                <th> PAN_No </th>
                <th> GSTNO </th>
                <th> U_Location </th>
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
                    <span class="tb-amount"><?php echo $requestdata[$i]->VendorCode; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->VendorName; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Type; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Address; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->City; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Pincode; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->Mobile_No; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->PAN_No; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->GSTNO; ?></span>
                </td>
                <td>
                    <span class="tb-amount"><?php echo $requestdata[$i]->U_Location; ?></span>
                </td>
                <td>
                    <span class="tb-amount">
                        <a class="btn btn-outline-dark btn-fw" href="<?php echo base_url('edit-vendor/'.$requestdata[$i]->id); ?>">Edit</a>
                        <button class="btn btn-outline-dark btn-fw delete shadow-focus" data-toggle="tooltip" data-placement="top" title="Delete"
                        onclick="prepareDelete('<?php echo $requestdata[$i]->id;?>')">Delete</button>
                    </span>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<nav>
    <ul class="pagination" id="pagination">
    <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
</ul>
</nav>
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
                            <button type="button" id="deletevendor" class="btn btn-outline-dark btn-fw ">Yes, Delete it</button>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function prepareDelete(id) {
        $('#delet_id').val(id); 
        $('#deleteEventPopup').modal('show');
    }

    $(document).ready(function() {
        $( "#deletevendor" ).click(function() {
            var delet_id = $('#delet_id').val();
            $.ajax({
                url: base_url + "deletevendor",
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
<script type="text/javascript">
(function($) {
  'use strict';

  if ($('#pagination-demo').length) {
    $('#pagination-demo').twbsPagination({
      totalPages: 35,
      visiblePages: 7,
      onPageClick: function(event, page) {
        $('#page-content').text('Page ' + page);
      }
    });
  }

  if ($('.sync-pagination').length) {
    $('.sync-pagination').twbsPagination({
      totalPages: 20,
      onPageClick: function(evt, page) {
        $('#content').text('Page ' + page);
      }
    });
  }

})(jQuery);
</script>




