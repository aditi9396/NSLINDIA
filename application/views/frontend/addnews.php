<style>
	textarea {
		resize: none;
	}
	@keyframes rotate {
		to {
			transform: rotate(1turn);
		}
	}
	@media (max-width:1050px){
		#selectImagePreview {
			width: 200px !important;
			height:135px !important;
		}
	}
</style>

<div id="content" class="app-content" data-scrollbar="true" data-height="100%" data-skip-mobile="true">
	<div>
		<h2>REGISTER USER
			<a class="btn btn-primary" href="<?php echo base_url('news-List')?>" style="float: right;" id="add-news">USER LIST </a>
		</h2>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">REGISTER USER</a></li>
			<li class="breadcrumb-item active">USER LIST</li>
		</ul>

		<div class="card card-preview">
			<div class="card-inner">
				<div class="card">
					<div class="card-body">
						<form id="frmNews" class="row" method="POST"   enctype= 'multipart/form-data'>
							<div class="col-md-6">
								<div class="row">
									<div class="col">
										<div class="form-group mb-3">
											<label class="form-label btn-submit-for-js" for="exampleFormControlInput1">NAME</label>

											<textarea  rows="1" cols="50"  class="form-control" id="news_title"  rows="null" name="news_title" required><?= isset($news) ? $news['news_title'] : '' ?></textarea>

											<?php
											if(isset($news['id'])){ ?>
												<input type="text" class= "form-control" name="id"   id="id" value="<?= isset($news) ? $news['id'] : '' ?>"  hidden >
											<?php }?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="form-group mb-3">
											<label class="form-label" for="exampleFormControlTextarea1">Address</label>
											<textarea rows="1" cols="50" class="form-control" id="description"  rows="null" name="description"><?= isset($news) ? $news['description'] : '' ?></textarea>
										</div>
									</div>
								</div>
								<!-- changes -->
								<div class="form-group mb-3">
									<label class="form-label btn-submit-for-js" for="exampleFormControlInput1">Email</label>

									<input type="text" id="email" class="form-control" name="email" <?= isset($news) ? $news['Email'] : '' ?> placeholder="Your Email address ">

									<?php
									if(isset($news['id'])){ ?>
										<input type="text" class= "form-control" name="id"   id="id" value="<?= isset($news) ? $news['id'] : '' ?>"  hidden >
									<?php }?>
								</div>
								<!-- changes -->
								<div class="form-group mb-3">
									<label class="form-label btn-submit-for-js" for="exampleFormControlInput1">City</label>

									<input type="text" id="text" class="form-control" name="City" <?= isset($news) ? $news['City'] : '' ?> placeholder="enter your city ">

									<?php
									if(isset($news['id'])){ ?>
										<input type="text" class= "form-control" name="id"   id="id" value="<?= isset($news) ? $news['id'] : '' ?>"  hidden >
									<?php }?>
								</div>

								<!-- changes -->
								<div class="form-group mb-3">
									<label class="form-label btn-submit-for-js" for="exampleFormControlInput1">Designation</label>

									<input type="text" id="text" class="form-control" name="Designation" <?= isset($news) ? $news['Designation'] : '' ?> placeholder="enter your Designation">

									<?php
									if(isset($news['id'])){ ?>
										<input type="text" class= "form-control" name="id"   id="id" value="<?= isset($news) ? $news['id'] : '' ?>"  hidden >
									<?php }?>
								</div>

								<!-- changes -->
								<div class="form-group mb-3">
									<label class="form-label btn-submit-for-js" for="exampleFormControlInput1">Password</label>

									<input type="text" id="Password" class="form-control" name="Password" <?= isset($news) ? $news['Password'] : '' ?> placeholder="enter your Password ">

									<?php
									if(isset($news['id'])){ ?>
										<input type="text" class= "form-control" name="id"   id="id" value="<?= isset($news) ? $news['id'] : '' ?>"  hidden >
									<?php }?>
								</div>

								
							</div>
							<div class="col-md-6" style="margin: auto;position: relative;">
								<div class="text-center" style="display: flex; align-items: center; justify-content: center;"> 
									<img src="<?php echo isset($news) ? base_url($news['thumbnail']) : base_url('assets_old/frontend/images/FB-Share.jpg'); ?>" style="object-fit: cover;height: 250px; width: 350px; object-fit: cover;cursor: pointer; border: 1px solid;" onclick="$('#defaultFile').click();" id="selectImagePreview" alt="">

								</div>
								<br>
								<h3 class="text-center">Choose Thumbnail</h3>
								<input type="file" class="form-control d-none " id="defaultFile" name="thumbnail"  onchange="readURL(this,'selectImagePreview');" >
							</div>
							<div class="col-sm-10 mt2">
								<button type="button"  class="btn btn-primary"   id="btnsave" style=""><?= isset($news) ? "Update" : "Save" ?></button>
								<button class="d-none btn btn-outline-theme1 shadow-focus d-flex align-items-center" id="custome-loader1">
									<span class="loading__anim"></span>
									<span class="mx-1">Loading...</span>
								</button>
							</div>
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