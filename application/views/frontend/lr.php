<div class="container">
	<div>
		<h1>PNA Depot</h1>
		<form name="myForm" id="depo_form" method="post" >
			&nbsp;&nbsp;Depo:
			<select id="depot" class="form-control w-25" name="depot">
				<?php foreach ($country as $country) { ?>
					<option value="<?php echo $country['CPCODE']; ?>">
						<?php echo $country['CPCODE'] . "-" . $country['DEPO_NAME']; ?>
					</option>
				<?php } ?>
			</select>
			<br><br>
			<input class="btn btn-outline-dark btn-fw" id="submit_PNADEPO" type="submit" value="Submit">
		</form>
	</div>
</div>


