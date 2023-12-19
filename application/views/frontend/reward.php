<div id="content" class="app-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col">
                    <h1 class="page-header">
                        REWARD LIST
                        <a class="btn btn-outline-theme1 shadow-focus "  href="<?php echo base_url('add-reword')?>" style="float: right;" id="add-news">Add Reward</a>
                    </h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">REWARD DISTRIBUTED</a></li>
                        <li class="breadcrumb-item active">REWARD LIST</li>
                    </ul>
                    <hr class="mb-4" />
                    <div id="datatable" class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <table id="rewardTable" class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Title</th>
                                            <th>Amount Reward</th>
                                            <th>Next Payout</th>
                                            <th>Action</th>
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
                                                    <span class="tb-amount"><?php echo $requestdata[$i]->title; ?></span>
                                                </td>
                                                <td >
                                                    <span class="tb-amount"><?php echo $requestdata[$i]->reward_amount; ?></span>
                                                </td>
                                                <td>
                                                    <span class="tb-amount"><?php echo $requestdata[$i]->til_datetime; ?></span>
                                                </td>
                                                <td>
                                                    <div  class="d-flex gap-2">
                                                        <a href="<?php echo base_url('edit-reward/'.$requestdata[$i]->id); ?>"   data-toggle="tooltip" data-placement="top" title="edit" id="delete-data" class="btn btn-sm btn-outline-theme1 shadow-focus"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <button class="btn btn-sm btn-outline-theme1 delete shadow-focus "  data-toggle="tooltip" data-placement="top" title="delete" id="delete-reward"  onclick="$('#deleteEventPopup').modal('show');$('#delet_id').val(<?php echo $requestdata[$i]->id; ?>) "><i class="fa-solid fa-trash-can"></i></button>
                                                    </div>
                                                </td>
                                                <tr>
                                                    <?php }?>
                                                    
                                    </tbody>
                                </table>
                                    </div>
                                    <div class="card-arrow">
                                        <div class="card-arrow-top-left"></div>
                                        <div class="card-arrow-top-right"></div>
                                        <div class="card-arrow-bottom-left"></div>
                                        <div class="card-arrow-bottom-right"></div>
                                    </div>
                                </div>
                            </div>
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
                                    <button type="button" id="deletereward" class="btn btn-success ">Yes, Delete it</button>
                                </div>
                                <div>
                                    <button data-bs-dismiss="modal" data-toggle="modal" data-target="#editEventPopup" class="btn btn-danger btn-dim">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>