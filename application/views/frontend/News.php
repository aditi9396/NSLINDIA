<div id="content" class="app-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col">
                    <h1 class="page-header">
                        <a class="btn btn-outline-theme1 shadow-focus "  href="<?php echo base_url('add')?>" style="float: right;" id="add-news">ADD STUDENT</a>
                    </h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">NEWS</a></li>
                        <li class="breadcrumb-item active">NEWS LIST</li>
                    </ul>
                    <hr class="mb-4" />
                    <div id="datatable" class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatableDefault" class="table w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:42px;">Sr No</th>
                                            <th >News Title</th>
                                            <th >Thumbnail</th>
                                            <th >Description</th>
                                            <th >Status</th>
                                            <th >Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php  
                                       $count = 0;
                                       for ($i=0; $i < count($requestdata); $i++) {

                                        $count++;
                                        ?> 
                                        <tr id="media_row_<?php// echo $requestdata[$i]->id; ?>">
                                            <td >
                                                <?php //echo $count; ?>

                                            </td>
                                            <td style=" width: 20%; word-break: break-word!important; " ><?php echo $requestdata[$i]->student_name; ?></td>
                                            <td >
                                                <img src="<?php echo $requestdata[$i]->thumbnail; ?>" height="100px" style="object-fit: cover;">
                                            </td>
                                            <td class="our-team" style=" width: 50%; word-break: break-word!important; " >
                                                <div class="social-text">
                                                    <?php echo $requestdata[$i]->student_address; ?>

                                                </div>
                                            </td>
                                            <td>
                                                <?php?>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input"  id="checkbox_<?php echo $requestdata[$i]->id; ?>" onclick="checkToggle(<?php echo $requestdata[$i]->id; ?>)" <?php if($requestdata[$i]->action == 1) echo "checked"; ?> >
                                                    <label class="form-check-label" for="customSwitch1"></label>
                                                 </div>
                                            </td>
                                            <td >
                                                 <?php echo $requestdata[$i]->date; ?>

                                            </td>
                                            <td>
                                                <div  class="text-center d-flex gap-2">
                                                    <a href="<?php echo base_url('add-news/'.$requestdata[$i]->id); ?>" data-toggle="tooltip" data-placement="top" title="edit" class="btn btn-sm btn-outline-theme1 shadow-focus" id="btn_data"><i class="fa-solid fa-pen-to-square"></i></a>

                                                    <button class="btn btn-sm btn-outline-theme1 delete shadow-focus" data-toggle="tooltip" data-placement="top" title="delete" id="delete-news" onclick="$('#deleteEventPopup').modal('show');$('#delet_id').val(<?php echo $requestdata[$i]->id; ?>) "><i class="fa-solid fa-trash-can"></i></button>
                                                    <?php ?>

                                                    <a href="<?= base_url('info/newsdetails/'.$requestdata[$i]->id)?>" data-toggle="tooltip" data-placement="top" title="Preview" id="btn_data" target="_blank" class="btn btn-sm btn-outline-theme1 shadow-focus"><i class="fa-solid fa-eye"></i></a>
                                                    <?php  } ?>

                                                </div>
                                            </td>
                                        </tr>
                                <?php
                            ?>

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
                            <button type="button" id="deleteNews" class="btn btn-success ">Yes, Delete it</button>
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

<script type="text/javascript">

    function checkToggle(id)
    {
        if($('#checkbox_'+id).prop('checked')) {
            $('#checkbox_'+id).attr('checked',true);
            $.ajax({
                url: base_url + "news_mark_toggle",
                data: {"id":id,"value":1},
                type: 'POST',
                success: function (data) {
                    successToster(' Marked as active successfully');
                },

            });
        } else {
            $('#checkbox_'+id).removeAttr('checked');
            $.ajax({
                url: base_url + "news_mark_toggle",
                data: {"id":id,"value":0},
                type: 'POST',
                success: function (data) {
                    successToster(' Marked as inactive successfully');
                },

            });
        }
    }
</script>