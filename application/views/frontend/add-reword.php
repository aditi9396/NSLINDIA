
<style>
  @keyframes rotate {
    to {
      transform: rotate(1turn);
    }
  }
</style>
<div id="content" class="app-content" data-scrollbar="true" data-height="100%" 
data-skip-mobile="true">
<div class="site-settings">
  <div class="nk-block">   
    <div class="col-sm-12 ">
      <h2>Add Rewards <a class="btn btn-outline-theme1 shadow-focus" href="<?php echo base_url('reward-list')?>" style="float: right;" id="add-news">Reward List</a></h2>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">REWARD DISTRIBUTED</a></li>
        <li class="breadcrumb-item active">ADD REWARDS</li>
      </ul>
    </div>
    <div class="card card-preview">
      <div class="card-inner">
        <div class="card">
          <div class="card-body">
            <form id="reword">
              <div class="form-group ">
                <label for="reward" class="col-sm-2 col-form-label"> Reward Title</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($requestdata)) echo $requestdata->title; ?>" onkeydown="$('.btn-check-key-press').removeAttr('disabled')">
                </div>
              </div>
              <div class="form-group  ">
                <label for="reward" class="col-sm-2 col-form-label">Reward Amount</label>
                <div class="col-sm-5">
                  <input type="number" class="form-control" id="reword_amt" name="reword_amt" value="<?php if(isset($requestdata)) echo $requestdata->reward_amount; ?>" onkeydown="$('.btn-check-key-press').removeAttr('disabled')">
                </div>
              </div>
              <div class="form-group ">
                <label for="reword" class="col-sm-2 col-form-label">Next Payout</label>
                <div class="col-sm-5">
                  <input type="datetime-local" max="9999-12-31" class="form-control" id="valid_till" name="valid_till" value="<?php if(isset($requestdata)) echo $requestdata->til_datetime;else echo date('Y-m-d H:s'); ?>" onchange="$('.btn-check-key-press').removeAttr('disabled')">   
                </div>
              </div>
              <?php if(isset($requestdata)){ ?>
                <input type="hidden" name="id" value="<?php echo $requestdata->id; ?>">
              <?php } ?>
              <button type="button"  class="btn btn-outline-theme1 shadow-focus mt-3 btn-check-key-press" id="<?php if (isset($requestdata)) echo "btnreword_update";else echo "btnreword"?>" <?php if (isset($requestdata)) echo "disabled"; ?> >Save</button>
              <button class="d-none btn btn-outline-theme1 shadow-focus d-flex align-items-center mt-3" id="custome-loader1">
									<span class="loading__anim"></span>
									<span class="mx-1">Loading...</span>
								</button>
            </form>
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


