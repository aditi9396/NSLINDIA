<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

<style>
	#popup {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: white;
		padding: 20px;
		border: 2px solid #000;
		width: 30%;
		height: 30%;
	}
	.modal {
		display: none;
		position: fixed;
		z-index: 1000;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
	}
</style>
<script type="text/javascript">
	var lastrowid = 0;
	var verified = false;
	var dialog;
	var drsobj;
	$(function () {
		dialog = $("#dialog-message").dialog({
			autoOpen: false,
			width: 500,
			position: {my: "center", at: "top+100", of: "#step1"},
			modal: true,
			buttons: {
				OK: function () {
					$(this).dialog("close");
					if (drsobj != undefined)
						if (drsobj.success == 1)
							window.location.href = "printdrsdemo.php?DRSNO=" + drsobj.DRSNO;
					}
				},
				close: function () {
					if (drsobj != undefined)
						if (drsobj.success == 1)
							window.location.href = "printdrsdemo.php?DRSNO=" + drsobj.DRSNO;
					}
				});
		$("#datepicker").datepicker({
			dateFormat: "dd/mm/yy",
			changeMonth: true,
			changeYear: true,
			minDate:0,
			maxDate: 0
		});
		$("#licexpdate").datepicker({
			dateFormat: "dd/mm/yy",
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});
		$("#txtlrno").autocomplete({
			minLength: 3,
			source: 'lrac.php'
		});
	});

	$(document).on("keypress", 'form', function (e) {
		if (e.target.className.indexOf("allowEnter") == -1) {
			var code = e.keyCode || e.which;
			if (code == 13) {
				e.preventDefault();
				return false;
			}
		}
	});
	$( function() {
		$( "#dialog1" ).hide();
	} );

	$(document).ready(function() {
		$('#vendortype').change(function() {
			fetch_vendor();
		});
	});

	function fetch_vendor() {
		document.getElementById('btnstep1').disabled = false;
		$.ajax({
			type: 'post',
			url: "fetch_vendor",
			data: {
				vendorname: $('#vendorname').val(),
				vendortype: $('#vendortype').val()
			},
			success: function(response) {
				if (response.length < 3) {
					document.getElementById('ftype').style.display = 'inline';
					document.getElementById('ftperkm').checked = true;
				} else if (response == "no data set.") {
					document.getElementById('ftype').style.display = 'none';
					document.getElementById('ftfix').checked = true;
				} else {
					document.getElementById('vehicleno').innerHTML = response;
					document.getElementById('ftfix').checked = true;
					document.getElementById('ftype').style.display = 'none';
				}
			},
			error: function(response) {
				alert(response);
			}
		});
	}


	function fetch_vehicleno() {

		document.getElementById('btnstep1').disabled = false;
		$.ajax({
			type: 'post',
			url: "fetch_vendor",
			data: {
				vendorname: document.getElementById('vendorname').value,
			},
			success: function (response) {
				if (response.length < 3) {
					document.getElementById('ftype').style.display = 'inline';
					document.getElementById('ftperkm').checked = true;

				} else if (response == "no data set.") {
					document.getElementById('ftype').style.display = 'none';
					document.getElementById('ftfix').checked = true;
				}
				else {
					document.getElementById('vehicleno').innerHTML = response;
					document.getElementById('ftfix').checked = true;
					document.getElementById('ftype').style.display = 'none';
				}
			},
			error: function (response) {
				alert(response);
			}
		});



		$.ajax({
			type: 'post',
			url: 'fetch_vendor2.php',
			data: {
				vendorname: document.getElementById('vendorname').value,
				vendortype: document.getElementById('vendortype').value
			},
			success: function (response) {
				if(document.getElementById('vendortype').value=="Attached"){
					if (response != 1) {
						console.log('3rd'+response);
						<?php if(in_array('blockvendor', $_SESSION['PageAccess'])){
							echo"$('#btnstep1').attr('disabled',false)";
						}else{
							echo"$('#btnstep1').attr('disabled',true)";
						} ?>

//alert("Please upload vendor contract");

						var message="Please upload vendor contract";
						document.getElementById("abc").innerHTML = message;

						$( function() {
							$( "#dialog1" ).dialog();

						} );

					}
					console.log('3th'+response);

				}
				else {
					console.log('4th'+response);
					document.getElementById('btnstep1').disabled = false;

				}
			},
//alert(response + response.length);
// },
			error: function (response) {
				alert(response);
			}
		});
	}

	function fetch_driver() {
		if (document.getElementById('vendortype').value == "Attached")
			return;
		if (document.getElementById('driver').value == "")
			return;
		$.ajax({
			type: 'post',
			url: 'fetch_vendor.php',
			data: {
				DName: document.getElementById('driver').value
			},
			success: function (response) {
				var str = response.split("\n");
				document.getElementById('drivername').value = document.getElementById('driver').value;
				document.getElementById('mobileno').value = str[0];
				document.getElementById('licenseno').value = str[1];
				document.getElementById('licexpdate').value = str[2];
			},
			error: function (response) {
				alert(response);
			}
		});
	}

	function add_row() {
		document.getElementById('btnaddrow').disabled = true;
		var lrnolist = document.getElementsByName('LRNO[]');
		var iLen = lrnolist.length;
		var val = document.getElementById('txtlrno').value.trim();
		for (var i = 0; i < iLen; i++) {
			if (lrnolist[i].value == val.toUpperCase()) {
				document.getElementById('warntext').innerText = "LR No. already Present.";
				document.getElementById('txtlrno').value = "";
//alert("LR No. already Present.");
				document.getElementById('btnaddrow').disabled = false;
				return;
			}
		}
		$.ajax({
			type: 'post',
			// url: 'getlrdataJUNE.php',
			data: {
				LRNO: document.getElementById('txtlrno').value
			},
			success: function (response) {
//alert(response);
				if (response == "No Data.") {
document.getElementById('warntext').innerText = "LR No. Not Found"; //alert("LR No. Not Found");
document.getElementById('txtlrno').value = "";
document.getElementById('btnaddrow').disabled = false;
} else {
	lastrowid = lastrowid + 1;
	$("#lrdetails tr:last").before("<tr id='row" + lastrowid + "'>" + response + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "')></td></tr>");
	var tabrow = document.getElementById('row' + lastrowid);
//alert(tabrow);
	var tabcells = tabrow.getElementsByTagName("td");
	if (tabcells[2].innerText == "TO PAY")
		document.getElementById('totaltopay').value = parseInt(document.getElementById('totaltopay').value) + parseInt(tabcells[8].innerText);
	document.getElementById('totalqty').innerText = parseInt(document.getElementById('totalqty').innerText) + parseInt(tabcells[6].innerText);

	document.getElementById('totalwt').innerText = parseInt(document.getElementById('totalwt').innerText) + parseInt(tabcells[7].innerText);
	document.getElementById('totaldockettotal').value = parseInt(document.getElementById('totaldockettotal').value) + parseInt(tabcells[8].innerText);
	document.getElementById('totaldockettotalthc').value = parseInt(document.getElementById('totaldockettotalthc').value) + parseInt(tabcells[10].innerText);
	var a = document.getElementById('totalwt').innerText;


	document.getElementById('txtlrno').value = "";
	document.getElementById('warntext').innerText = "";
	document.getElementById('btnaddrow').disabled = false;
}
}
,
error: function (response) {
	alert(response);
	document.getElementById('btnaddrow').disabled = false;
}
});
		var  vehicle_no = document.getElementById('vehicleno').value;

		$.ajax({
			type: 'post',
			url: 'getcapacity.php',
			data: {
				vehicleno: document.getElementById('vehicleno').value
			},
			success: function (response){
				console.log("Vehicle capicity"+response);
				if (response != "0") {
					document.getElementById("capicitynew").value =response;

					var kgtotonnes1; 
					var kgtotonnes1=document.getElementById('totalwt').innerText/1000;
					console.log(kgtotonnes1+" kg tones    CONVERTED AND "+response);


					document.getElementById("wtones1").value =kgtotonnes1;

					if (kgtotonnes1>response) {

						var message=vehicle_no +"Actual Weight Is More Than Capacity "+response;
						document.getElementById("abc").innerHTML = message;

						$( function() {
							$( "#dialog1" ).dialog();

						} );


					}
					else{

					}
				}
			},
			error: function (response) {
				alert(response);
				document.getElementById('btnaddrow').disabled = false;
			}
		});
	}

	function delete_row(rowno) {
		var tabrow = document.getElementById(rowno);
		var tabcells = tabrow.getElementsByTagName("td");
		if (tabcells[2].innerText == "TO PAY")
			document.getElementById('totaltopay').value = parseInt(document.getElementById('totaltopay').value) - parseInt(tabcells[8].innerText);
		document.getElementById('totalqty').innerText = parseInt(document.getElementById('totalqty').innerText) - parseInt(tabcells[6].innerText);
		document.getElementById('totalwt').innerText = parseInt(document.getElementById('totalwt').innerText) - parseInt(tabcells[7].innerText);

		var kgtotonnes1=document.getElementById('totalwt').innerText/1000;
		var capacitydel=document.getElementById("capicitynew").value;
		if(kgtotonnes1>capacitydel && document.getElementById('vendortype').value == "Own"){
			console.log('If'+  kgtotonnes1 );
			document.getElementById("wtones1").value =kgtotonnes1;
		}     
		else{
			console.log('else'+  kgtotonnes1 );
		}


		document.getElementById('totaldockettotal').value = parseInt(document.getElementById('totaldockettotal').value) - parseInt(tabcells[8].innerText);
		document.getElementById('totaldockettotalthc').value = parseInt(document.getElementById('totaldockettotalthc').value) - parseInt(tabcells[10].innerText);
		$('#' + rowno).remove();
	}

	function checklist() {
		var vehicleno = $('#vehicleno').val();

		$.ajax({
			type: 'post',
			url: "validateVehicle",
			data: { vehicleno: vehicleno },
			success: function (response) {
				if (response == 'valid') {
					$('#btnstep1').attr('disabled', false);
				} else {
					$('#btnstep1').attr('disabled', true);
				}
			},
			error: function (response) {
				alert('Error occurred while validating vehicle number');
			}
		});
	}
	$('#loading-image').show();
	$.ajax({
		type: 'post',
		url: 'gettripavailibitytu.php',
		data: {

			vehicleno: document.getElementById('vehicleno').value
		},
		success: function (response) {
			console.log(response);
			if (response!=0) {

				$('#btnstep1').attr('disabled',true);
				document.getElementById('btnstep1').disabled = true;
				document.getElementById('btnstep1').disabled = true;
				document.getElementById('Submit').disabled = true;
				var message=" This Vehicle Not Available For Tripsheet."+response;
				document.getElementById("abc").innerHTML = message;

				$( function() {
					$( "#dialog1" ).dialog();

				} );
			}

			else{
			}
		},
		error: function (response) {
			alert(response);
		}
	});

	function validateVehicle() {
		if ($('#vendortype').val() == "Own") {
			return true;
		}
		var pattern1 = /^[A-Z]{2}[0-9]{2}[A-Z]{0,2}[0-9]{4}$/;
		var pattern2 = /^[A-Z]{3}[0-9]{4}$/;
		var pattern3 = /^[A-Z]{2}[0-9]{3}[A-Z]{1}[0-9]{4}$/;
		var pattern4 = /^[A-Z]{2}[0-9]{2}[A-Z]{3}[0-9]{4}$/;

		if (args.val().length >= 6 && !args.prop('disabled')) {
			if (pattern1.test(args.val()) || pattern2.test(args.val()) || pattern3.test(args.val()) || pattern4.test(args.val())) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function validateVeh() {
		$('#podpending').prop('disabled', true);
		if (validateVehicle($('#avehicleno').val())) {
			$('#vehtxt').html('');
		} else {
			$('#vehtxt').html('Invalid Vehicle No.');
		}
		$('.loader').show();

		var drs = 'DRS';

		if (drs === 'DRS') {
			var a = $('#avehicleno').val();
			var message = 'vehicle no-' + a + ' Not Financially Close Please Clear All POD First';
			$('#abc').html(message);
			$('#dialog1').dialog();
		} else {
			$('#dialog1').hide();
		}

		$('.loader').hide();

		$.post('driverpodstatus.php', { avehicleno: $('#avehicleno').val() }, function (response) {
			document.getElementById("podpending").style.display = "none";
			if ($('#vendortype').val() == "Attached") {
				var temp = JSON.parse(response);
				if (temp != "OK") {
					$("#podpending").show();
					$("#target").show();
				} else {
					document.getElementById("podpending").style.display = "none";
				}
			} else {
				document.getElementById("podpending").style.display = "none";
			}
		}).fail(function (response) {
			alert(response);
		});

		$.post('pendingpodcount.php', { avehicleno: $('#avehicleno').val() }, function (response) {
			var temp1 = JSON.parse(response);
			$("#target").text(temp1);
		}).fail(function (response) {
			alert(response);
		});

		$.post('checkvoucherdrs.php', { avehicleno: $('#avehicleno').val() }, function (response) {
			if (response != "No data Found") {
				var message = response;
				$("#abc2").html(message);
				$("#dialog3").dialog();
			} else {
				$("#dialog3").hide();
			}
		}).fail(function (response) {
			alert(response);
		});
	}
	function toggleVehicleInput() {
		var selectedVehicle = document.getElementById('vehicleno').value;
		var avehiclenoInput = document.getElementById('avehicleno');

		if (selectedVehicle === '') {
			avehiclenoInput.style.display = 'none';
			avehiclenoInput.disabled = true;
		} else {
			avehiclenoInput.style.display = 'block';
			avehiclenoInput.disabled = false;
		}
	}



	function fixclick() {
		$('#drskm').prop('disabled', true);
	}

	function fixclick1() {
		$('#drskm').prop('disabled', true);
	}

	function kmclick() {
		$('#drskm').prop('disabled', false);
	}

	function rateclick() {
		var vehicle_no = $('#avehicleno').val();
		var kmdrs = $('#drskm').val();

		$.post('getdiliverykm.php', { vehicleno: $('#avehicleno').val() }, function (response) {
			$('#responsekm').val(response);

			if (response != 0) {
				if (kmdrs > response) {
					var message = "<b style='color:red; font-family:Times New Roman, Times, serif'>" + vehicle_no + " DRS KM LIMIT IS " + response + " km";
					$('#abc').html(message);
					$('#dialog1').dialog();
				}
			}
		}).fail(function (response) {
			alert(response);
		});
	}

	function checkDuplicates() {
		var $elems = $("input[name='LRNO[]']");
		var values = [];
		var isDuplicated = false;
		$elems.each(function () {
			if (!this.value) return true;
			if (values.indexOf(this.value) !== -1) {
				var message="Duplicate LR NO. " + this.value + " Found in LR List.";
				document.getElementById("abc").innerHTML = message;

				$( function() {
					$( "#dialog1" ).dialog();

				} );

				isDuplicated = true;
				return false;
			}
// store the value
			values.push(this.value);
		});
		return isDuplicated;
	}

	function IsJsonString(str) {
		try {
			JSON.parse(str);
		} catch (e) {
			return false;
		}
		return true;
	}

	function contrcheck()
	{
		$.ajax({
			type: 'post',
			url: 'checkdrsthcfright',
			data: {
				avehicleno: document.getElementById('avehicleno').value,
				vendorname: document.getElementById('vendorname').value,
			},
			success: function (response) {
//alert(response);
			},
			error: function (response) {
// alert(response);
			}

		});

		$.ajax({
			type: 'post',
			url: 'checkdrsthcallowcreatedemo',
			data: {
				avehicleno: document.getElementById('avehicleno').value,
				vendorname: document.getElementById('vendorname').value,
			},
			success: function (response) {
				alert(response);

				if(response==0)
				{
					if(document.getElementById('vendortype').value == "Attached")
					{
						var n11 = parseInt(document.getElementById('totaldockettotal').value);
						var n12 = parseFloat(document.getElementById('contractamt').value);
						var n13 = n11-n12;
						var n14 = n13*100/n11;
						const result2 = n14.toFixed(2);
// alert(result2);
						var n15=document.getElementById('percentage').value=result2;
						if(result2>=40)
						{
							document.getElementById('percentage').value='';
						}
						if (result2<40) {
							alert("Contract Amount cannot be greater than Docket Amount. Contact to Control Tower Team.");
							document.getElementById('Submit').disabled = true; 
							document.getElementById('Hvendor').disabled = true; 


							document.getElementById('advamt').disabled = true; 
							document.getElementById('advancetype').disabled = true;
							document.getElementById('hamali').disabled = true;


							return false;
						}
						else
						{
							document.getElementById('Submit').disabled = false; 
							document.getElementById('Hvendor').disabled = false; 

							document.getElementById('advamt').disabled = false; 
							document.getElementById('advancetype').disabled = false;
							document.getElementById('hamali').disabled = false;

						}

					}
				}

				if(response==0)
				{
					if(document.getElementById('vendortype').value == "Own")
					{
						var n11 = parseInt(document.getElementById('totaldockettotal').value);
						var n12 = parseFloat(document.getElementById('contractamt').value);
						var n13 = n11-n12;
						var n14 = n13*100/n11;
						const result2 = n14.toFixed(2);
// alert(result2);
						var n15=document.getElementById('percentage').value=result2;
						if(result2>=40)
						{
							document.getElementById('percentage').value='';
						}
						if (result2<40) {
							alert("Contract Amount cannot be greater than Docket Amount. Contact to Control Tower Team.");
							document.getElementById('Submit').disabled = true; 
							document.getElementById('Hvendor').disabled = true; 

							document.getElementById('advamt').disabled = true; 
							document.getElementById('advancetype').disabled = true;
							document.getElementById('hamali').disabled = true;
							return false;
						}
						else
						{
							document.getElementById('advamt').disabled = false; 
							document.getElementById('advancetype').disabled = false;
							document.getElementById('hamali').disabled = false;
							document.getElementById('Submit').disabled = false; 
							document.getElementById('Hvendor').disabled = false;  
						}

					}
				}
			},
			error: function (response) {
//alert(response);
			}

		});
	}

	function contrcheck1()
	{
		$.ajax({
			type: 'post',
			url: 'checkdrsthcfright',
			data: {
				avehicleno: document.getElementById('avehicleno').value,
				vendorname: document.getElementById('vendorname').value,
			},
			success: function (response) {

				if(document.getElementById('vendortype').value == "Attached" || document.getElementById('totaltopay').value == "TO PAY" )
				{
					var totalpay=document.getElementById('totaltopay').value;
					var contractamt=document.getElementById('contractamt').value;
					var advanceamt=document.getElementById('advamt').value;
					var rk=contractamt*10/100;
					var remain=contractamt-rk;
					var advance=remain-totalpay;
					if(advance<=0)
					{
						var advanceamt=document.getElementById('advamt').value;  
					}
					if(advanceamt>advance)
					{
						var advanceamt=document.getElementById('advamt').value=0; 
					}
					if(advance>0)
					{
						alert(" Maximum Advance Allowed Rs " + advance);
					}
					else
					{
						alert("  No Advance Allowed Rs " + advance);
					}

				}

			},
			error: function (response) {
				alert(response);
			}

		});

		$.ajax({
			type: 'post',
			url: 'checkdrsthcallowcreate',
			data: {
				avehicleno: document.getElementById('avehicleno').value,
				vendorname: document.getElementById('vendorname').value,
			},
			success: function (response) {
// alert(response);

				if(response==0)
				{
					if(document.getElementById('vendortype').value == "Own")
					{
						var cal=parseInt(document.getElementById('advamt').value)<='contractamt';
						var Result24 = document.getElementById('advamt').value;
						var Quantity112 = document.getElementById('contractamt').value;
						if(parseInt(Result24) >=parseInt(Quantity112)){
							return false;
						}
						else
						{
							return false;
						}
					}
				}
				if(response==0)
				{
					if(document.getElementById('vendortype').value == "Attached")
					{
						var cal=parseInt(document.getElementById('advamt').value)<='contractamt';
						var Result244 = document.getElementById('advamt').value;
						var Quantity1122 = document.getElementById('contractamt').value;
						if(parseInt(Result244) >=parseInt(Quantity1122)){
							return false;
						}
						else
						{
							return false;
						}
					}
				}
			},
			error: function (response) {
				alert(response);
			}

		});

	}
</script>
<body>
	<form method="post" id="form1" name="form1" enctype='multipart/form-data' action="<?php echo site_url("validate")?>" style=" padding: 30px;">
		<center>
			<p>&nbsp;</p>
			<?php echo "<h1>Create THC  Depot</h1>"; ?>
		</center>
		<br><br>
		<br>      
		<div id="step0">
			<center>  
				<table class= "table table-borderless" style=" border-top:hidden!important;"  width="100%" cellpadding='20' collspadding="100" >
					<tr  style="border-bottom:hidden!important;border-top:hidden!important;">
						<td>DRS Date :</td>
						<td colspan=3><input type="date" id="datepicker" name='drsdate'
							size="30"
							value="" >
						</td>
					</tr>
					<tr style="border-bottom:hidden!important;border-top:hidden!important;">
						<td>VENDOR TYPE :</td>
						<td>
							<select id="vendortype" name="vendortype" style="width:200px">
								<option value="">SELECT VENDOR TYPE</option>
								<option value="Attached">Attached</option>
								<option value="Own">Own</option>
							</select>						
						</td>
						<td>SELECT VENDOR NAME :</td>
						<td>
							<select id="vendorname" name="vendorname" style="width:200px" >
								<option value="">SELECT VENDOR NAME</option>
								<?php foreach ($vendor as $vendor) { ?>
									<option value="<?php echo $vendor['VendorCode']; ?>"><?php echo $vendor['VendorCode'] . '-' . $vendor['VendorName']; ?></option>
								<?php } ?>
							</select>

							<select id="vendorname1" name="vendorname1" style="width:200px"  oninvalid="this.setCustomValidity('select')" oninput="this.setCustomValidity('')" ><option value="" >Select</option>
								<option id="KALBHOR" value="VTC 3 PL SERVICES LTD (KALBHOR)">-VTC 3 PL SERVICES LTD (KALBHOR)</option>
								<option id="AKOLA" value="VTC 3 PL SERVICES LTD AKOLA">-VTC 3 PL SERVICES LTD AKOLA</option>
								<option  id="PUNE" value="VTC 3 PL SERVICES LTD PUNE">-VTC 3 PL SERVICES LTD PUNE</option>
							</select>

							<div id="dialog1" title="Dialog Title" style="display: none;">
								<div id="abc"></div>
							</div>

							<div id="dialog2" title="Dialog Title" style="display: none;">
								<div id="xyz"></div>
							</div>

							<div id="dialog3" title="Dialog Title" style="display: none;">
								<div id="pqr"></div>
							</div>
						</td>
					</tr>

					<tr style="border-bottom:hidden!important;border-top:hidden!important;" >
						<td  >Owner Name As Per Bank Details :<span style='color:red'>*</span></td> 
						<td><input id='ownername' name='ownername'
							pattern="[a-zA-Z\s]+"
							onchange="fetch_ownername(this)"
							onkeyup="this.value=this.value.toUpperCase()"
							oninvalid="this.setCustomValidity('Please Enter Driver Name.')"
							oninput="this.setCustomValidity('')"
							maxlength=40 required></td>
						</tr>
						<tr style="border-bottom:hidden!important;border-top:hidden!important;">
							<td>Vehicle No.</td>
							<td>
								<input type="hidden" name="depocheck" id="depocheck" value="" >
								<select id='vehicleno' name='vehicleno' style="width:200px;
								display:none;"    >
								<option value=''>SELECT VEHICLE NO.</option>
								<?php 
								$vehiclenonew= array("Vehicle_No");    							
								foreach ($vehicleno as $vehicleno){ 
									echo "<option value = ".$vehicleno['Vehicle_No'].">".$vehicleno['Vehicle_No']."</option>";
								}?>
							</select>
							<input type="hidden" name="depocheck1" id="depocheck" value="" >
							<select id='vehicleno1' name='vehicleno1' style='width:200px; display:none' >
								<option value=''>SELECT VEHICLE NO.</option>
								<?php 
								$vehiclenonew1= array("Vehicle_No");    							
								foreach ($vehicleno1 as $vehicleno1){ 
									echo "<option value = ".$vehicleno1['Vehicle_No'].">".$vehicleno1['Vehicle_No']."</option>";
								}?>
							</select>
							<input type="hidden" name="depocheck2" id="depocheck" value="" >
							<select id='vehicleno2' name='vehicleno2' style='width:200px;display:none' >
								<option value=''>SELECT VEHICLE NO.</option>
								<?php 
								$vehiclenonew2= array("Vehicle_No");    							
								foreach ($vehicleno2 as $vehicleno2){ 
									echo "<option value = ".$vehicleno2['Vehicle_No'].">".$vehicleno['Vehicle_No']."</option>";
								}?>
							</select>
							<input type="text" id='avehicleno' name='avehicleno'>

							<span id="vehtxt"
							style='color:red;'></span>
							<a style='display:none;' id="podpending" href="" target="_blank" onclick="this.href='http://vtc3pl.esy.es/pendingpod.php?avehicleno='+document.getElementById('avehicleno').value"><u>Pending POD's :</u></a><a id="target"></a>

						</td>
						<td>Freight Type :</td>
						<td>
							<div id="ftype" style='display:none;'><input type='radio'
								id="ftperkm"
								name='freighttype'
								value='perKM'
								onclick="kmclick()">Rate
								Per KM &nbsp;&nbsp;
								<input type='radio' id="ftfix" name='freighttype'
								value='Fix' onclick="fixclick()" checked>Fixed
								Rate
							</div>
						</td>

					</tr>
					<tr style="border-bottom:hidden!important;border-top:hidden!important;">
						<td>Vehicle Meter Reading :</td>
						<td><input type="number" id="mreading" name="mreading"
							pattern="[0-9]+" maxlength=10
							oninvalid="this.setCustomValidity('Please enter Vehicle Meter Reading.')"
							oninput="this.setCustomValidity('')" required></td>
							<td>DRS KM</td>
							<td><input type="number" id='drskm' name='drskm' maxlength=4
								pattern="[0-9]+" onclick="rateclick()"
								oninvalid="this.setCustomValidity('Please enter DRS KM.')"
								oninput="this.setCustomValidity('')" 
								required><input type='hidden' name='responsekm' id='responsekm' ></td>
							</tr>
							<tr style="border-bottom:hidden!important;border-top:hidden!important;">
								<td>Driver Name :</td>
								<td>
									<select id='driver' name='driver' onchange="fetch_driver()"
									style='display:none;width:200px'
									oninvalid="this.setCustomValidity('Please select Driver Name.')"
									oninput="this.setCustomValidity('')" disabled
									required>
									<option value=''>SELECT Driver Name</option>
									<?php
									$sql
									= "SELECT DName  FROM DriverMaster WHERE Active='1' and CloseTrip = 1 AND EmpId !='' ORDER BY DName ASC;";
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='" . $row["DName"] . "'>" . $row["DName"] . "</option>";
									}
									?>
								</select>
								<input type="text" id="drivername" placeholder="Enter Driver Name" required>
								<div id="drivername-list" style="width: 200px;"></div>


								<script>
									$(document).ready(function() {
										var searchInput = $('#drivername');
										var searchResultsList = $('#drivername-list');

										searchInput.on('keyup', function() {
											var keyword = searchInput.val().trim();

											if (keyword !== '') {
												$.ajax({
													url: '<?php echo site_url('driver_data'); ?>',
													type: 'GET',
													data: { keyword: keyword },
													success: function(response) {
														searchResultsList.html(response);
													}
												});
											} else {
												searchResultsList.html('');
											}
										});
									});
								</script>
							</td>
							<td>Vehicle Capacity Model No</td>
							<td>
								<select id="FTLType" name="FTLType" style='width:200px'
								oninvalid="this.setCustomValidity('Please select Vehicle Capacity.')"
								oninput="this.setCustomValidity('')" required>
								<option value="">SELECT</option>
								<option value="MINI TEMPO UPTO 1 MT">MINI TEMPO UPTO 1 MT</option>
								<option value="PICK UP 1 MT TO 2 MT">PICK UP 1 MT TO 2 MT</option>
								<option value="TEMPO 2 MT TO 3.5 MT">TEMPO 2 MT TO 3.5 MT</option>
								<option value="TEMPO 3.5 MT TO 5 MT">TEMPO 3.5 MT TO 5 MT</option>
								<option value="TEMPO 5 MT TO 7 MT">TEMPO 5 MT TO 7 MT</option>
								<option value="TRUCK 7 MT TO 9 MT">TRUCK 7 MT TO 9 MT</option>
								<option value="TAURAS 9 MT TO 16 MT">TAURAS 9 MT TO 16 MT
								</option>
								<option value="TAURAS 16 MT TO 21 MT">TAURAS 16 MT TO 21 MT
								</option>
								<option value="20 FT MULTI EXLE 13 TO 21 MT">20 FT MULTI EXLE 13 TO 21 MT
								</option>
								<option value="20 FT MULTI EXLE 21 TO 26 MT">20 FT MULTI EXLE 21 TO 26 MT
								</option>
								<option value="20 FT MULTI EXLE UPTO 13 MT">20 FT MULTI EXLE UPTO 13 MT
								</option>
								<option value="40 FT MULTI EXLE 13 TO 21 MT">40 FT MULTI EXLE 13 TO 21 MT
								</option>
								<option value="40 FT MULTI EXLE 21 TO 26 MT">40 FT MULTI EXLE 21 TO 26 MT
								</option>
								<option value="40 FT MULTI EXLE UPTO 13 MT">40 FT MULTI EXLE UPTO 13 MT
								</option>
							</select>  
						</td>
					</tr>
					<tr style="border-bottom:hidden!important;border-top:hidden!important;">
						<td>License Number :</td>
						<td><input type="text" id="licenseno" name="licenseno"
							placeholder="MH1420110062821"
							onchange="patfunction()"
							oninvalid="this.setCustomValidity('Please enter License Number.')"
							oninput="this.setCustomValidity('')" required></td>
							<td>License Expiry Date :</td>
							<td><input type="date" id="licexpdate" name="licexpdate" value="" ></td>
						</tr>
						<tr style="border-bottom:hidden!important;border-top:hidden!important;">
							<td> Account Number: </td>
							<td>
								<input type="text" id="AccountNO" name="AccountNO" required placeholder="Account Number">
							</td>
							<td>IFSC Code:</td>
							<td><input type="text" id="IFSC" name="IFSC" 
								style="  text-transform: uppercase;"
								placeholder="ABCD0000123 "
								required ></td>
							</tr>
							<tr>
								<td>Bank:</td>
								<td><input type="text" id="BankName" name="BankName"
									placeholder="BANK NAME "
									></td>
									<td>Branch:</td>
									<td><input type="text" id="branch" name="branch"></td>
								</tr>
								<tr>
									<td><input type="hidden" id="HAccountNO" name="HAccountNO"  ></td>
									<td><input type="hidden" id="HIFSC" name="HIFSC"  ></td>
									<td><input type="hidden" id="Hbank" name="Hbank"  ></td>
									<td><input type="hidden" id="Hbranch" name="Hbranch"  ></td>
									<td><input type="hidden" id="HVendorCode" name="HVendorCode"  ></td>
								</tr>
							</table>
							<br>
							<input type="button" id="btnstep1" onclick="step1click()" value="Step 1">
						</div>
						<script>
							$(document).ready(function() {
								var searchInput = $('#txtlrno');
								var searchResultsList = $('#search-txtlrno-list');

								searchInput.on('keyup', function() {
									var keyword = searchInput.val().trim();

									if (keyword !== '') {
										$.ajax({
											url: '<?php echo site_url('str_lr_no'); ?>',
											type: 'GET',
											data: { keyword: keyword },
											success: function(response) {
												searchResultsList.html(response);
											}
										});
									} else {
										searchResultsList.html('');
									}
								});
							});
						</script>

						<div id="step1" style='display:none;'>
							<center>
								<table cellpadding='8' class="table table-hover" style="width:40%">
									<tr>
										<td>Driver Mobile No.:</td>
										<td>
											<input type="number" id="mobileno" name="mobileno" pattern="[0-9]+" required="">
										</td>
										<td>
											<input type="button" id="btnsendotp" value="Send OTP">
										</td>
										<td id="mobtxt" align="center" style="border-radius: 10px;">
										</td>
										<td style="text-align:;color:red"><input type="number" id="otp" name="otp" pattern="[0-9]+"></td>
										<td><input type="button" id="btnverifyotp" value="Verify" maxlength="6" disabled="">
										</td>
									</tr>
									

								</table>
							</center>
							<center>
								<p><b>Enter LR Number</b></p>
								<input type="text" id="txtlrno" maxlength=15 placeholder="Search LR Number">
								<div id="search-txtlrno">
									<select id="search-txtlrno-list">
									</select>
								</div>


								<br>

								<br>
								<input type="button"
								id="btnaddrow"
								onclick="add_row()"
								value="Add Row">
								<span
								id="warntext"
								style='margin-left:5px;color:red'></span></center>
								<table id="lrdetails" align='center' class='blueTable table table-hover'>
									<tr align='center'>
										<th>LR NO</th>
										<th>LR Date</th>
										<th>Pay Basis</th>
										<th>From</th>
										<th>To</th>
										<th>Arrive Date</th>
										<th>PkgsNo</th>
										<th>Actual Weight</th>
										<th>Docket Total</th>
										<th style="display: none;"></th>
										<th style="display: none;"></th>

										<th>DELETE</th>
									</tr>
									<tr>
										<td colspan=5></td>
										<td align='right'><b>Total</b></td>
										<td id="totalqty">0</td>
										<td id="totalwt">0</td>
										<td colspan=4></td>
									</tr>
								</table>
								<table cellpadding='8' class="table table-hover">
									<tr style="border-bottom:hidden!important;border-top:hidden!important;">
										<input type='hidden'  name='wtones1' id='wtones1'>
										<input type='hidden' name='capicitynew' id="capicitynew">
										<td>Total ToPay :</td>
										<td><input type="number" id="totaltopay" name="totaltopay"
											value="0" readonly></td>

											<td>Contract Amount :<span style='color:red'>*</span></td>
											<td><input type="number" id="contractamt" name="contractamt"
												pattern="[0-9]+"
												oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
												oninput="this.setCustomValidity('')" onchange="contrcheck()" required
												disabled>
											</td>
											<td>Advance Amount :<span style='color:red'>*</span>
											</td>
											<td>
												<input type="number" id="advamt" name="advamt"
												pattern="[0-9]+"
												oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
												oninput="this.setCustomValidity('')" 
												onchange="contrcheck1()" required
												disabled>
												<span id="advamt">
												</span>
											</td>
											<td> Hamali Received From Driver:<span style='color:red'>*</span></td>
											<td>
												<input type="text" id="advancetype" name="advancetype">
											</td>
										</tr>

										<tr style="border-bottom:hidden!important;border-top:hidden!important;">
											<tr style="border-bottom:hidden!important;border-top:hidden!important;">
												<td>Fuel Quantity (ltr/kg) :<span style='color:red'>*</span>
												</td>
												<td>
													<input type="number" id="liter" name="liter"
													oninvalid="this.setCustomValidity('Please enter Contract Amount.')"
													oninput="this.setCustomValidity('')" 
													onchange="sum()" 
													>
													<span id="liter">
													</span>
												</td>
												<td> Fuel Rate (ltr/kg) :<span style='color:red'>*</span></td>
												<td><input type="number" id="Rate" name="Rate"  
													oninvalid="this.setCustomValidity('Please enter Advance Amount.')"
													oninput="this.setCustomValidity('')"  onchange="sum()"
													><span id="Rate">
													</span>
												</td>
												<td>Fuel Amount:</td>
												<td>
													<input type="number" id="dieselamt" name="dieselamt"
													pattern="[0-9]+" 
													oninvalid="this.setCustomValidity('Please enter Diesel Amount.')"
													oninput="this.setCustomValidity('')"  readonly  >
													<span id="dieselamt">
													</span>
												</td>
												<td>
													<label>Upload Image Fuel Bill:<span style='color:red'>*</span>
													</label>
												</td>
												<td>
													<input type="file" name="image">
													<br><br>
												</td>
											</tr>
											<tr style="border-bottom:hidden!important;border-top:hidden!important;">
												<td>Fuel Vendor Name :<span style='color:red'>*</span>
												</td>
												<td>
													<select id='dieselvendorname' name='dieselvendorname'
													style='width:200px'>
													<option value='' required>SELECT VENDOR NAME</option>
													<?php
													$sql = "SELECT `PetrolPumpName` FROM `PetrolPump` WHERE `Status`=1 AND `Location` LIKE '%$depot%'";

													$result = mysqli_query($conn,$sql);
													$rowscout=mysqli_num_rows($result);
													if($rowscout>0){

														while($row = mysqli_fetch_assoc($result))
														{
															echo "<option value ='".$row['PetrolPumpName']."'>".$row['PetrolPumpName']."</option>";
														}
													}?>

												</select>
											</td>
											<td>Fuel Bill No<span style='color:red'>*</span>
											</td>
											<td>
												<input type="text" id="Dieselbillno" name="Dieselbillno"
												pattern="[0-9]+"
												oninvalid="this.setCustomValidity('Please enter Hamali.')"
												oninput="this.setCustomValidity('')">
											</td>

											<td> Loading Hamali Vendor Name :<span style='color:red'>*</span>
											</td>
											<td>
												<select id='Hvendor' name='Hvendor' onchange="fetch_hamali(this)"
												style='width:200px'>
												<option value='0' required>SELECT Hamali Vendor</option>
												<option value='' required>No Hamali Vendor</option>
												<?php


												$sql1 = "SELECT `Hvendor` FROM `HamaliVendor` WHERE `DEPOT`= '$depot' ";

												$result1 = mysqli_query($conn,$sql1);
												$rowscout=mysqli_num_rows($result1);
												if($rowscout>0){

													while($row = mysqli_fetch_assoc($result1))
													{
														echo "<option value ='".$row['Hvendor']."'>".$row['Hvendor']."</option>";
													}
												}?>

											</select></td>
											<td>Loading Hamali Amount :<span style='color:red'>*</span></td>
											<td><input type="number" id="hamali" name="hamali"
												pattern="[0-9]+"
												oninvalid="this.setCustomValidity('Please enter 	Loading Hamali Amount.')"
												oninput="this.setCustomValidity('')" required
												disabled></td>
											</tr>
											<tr>
												<td><input type="hidden" id="totaldockettotal" onchange="contrcheck()" name="totaldockettotal"
													value="0" readonly><span id="totaldockettotal"></span></td><td><input type="hidden" id="totaldockettotalthc" name="totaldockettotalthc"
														value="0" readonly></td>
														GP For This DRS : 
														<input type="text" id="percentage"  name="percentage" style="width: 51px;" readonly  ><span id="gppercentage"> &nbsp %</span>
													</tr> 
													<span>पोच भाडे 10% राहणार</span>
													<br>
												</table>
											</center>
											<div class="d-flex justify-content-center">
												<input type="submit" id="CreateTHC" name="CreateTHC" value="Create THC"   class="btn btn-primary">
												<input type="hidden" name="CreateTHC" value="Create DRS">
											</div>
											<div id="popup" style="display: none;">
												<!-- Popup content goes here -->
												<h3>Popup Content</h3>
												<p>This is a popup!</p>
											</div>
										</form>
									</body>

									<script>
										$(document).ready(function(){
											var timer;
											var countdown = 60;
											function startTimer(){
												countdown = 60;
												timer = setInterval(updateTimer, 1000);
												$("#btnsendotp").prop("disabled", true);
											}
											function updateTimer(){
												if(countdown === 0){
													clearInterval(timer);
													$("#timer").text('');
													$("#btnsendotp").prop("disabled", false);
												} else {
													$("#timer").text('Resend OTP in ' + countdown + ' seconds');
													countdown--;
												}
											}
											function sendSMS(){
												var mobileno = $("#mobileno").val();

												if(mobileno !== ''){
													$.ajax({
														url: "<?php echo base_url('sendSMS'); ?>",
														type: "POST",
														data: {mobileno: mobileno},
														success: function(response){
															if(response.status === 'success'){
																startTimer();
																$("#mobtxt").html('OTP sent to ' + mobileno);
															} else {
																$("#mobtxt").html('Failed to send OTP');
															}
														}
													});
												}
											}
											function verifyOtp(){
												var otp = $("#otp").val();
												if(otp !== ''){
													$.ajax({
														url: "<?php echo base_url('verify_otp'); ?>",
														type: "POST",
														data: {otp: otp},
														success: function(response){
															if(response.status === 'success'){
																alert('OTP verified successfully');
															} else {
																alert('Invalid OTP');
															}
														}
													});
												}
											}

											$("#btnsendotp").click(function(){
												sendSMS();
											});

											$("#btnverifyotp").click(function(){
												verifyOtp();
											});
										});
									</script>
									<script>
										$(document).ready(function() {
											$('#CreateTHC').click(function() {
												var name = 'John Doe';
												var email = 'john@example.com';
												$('#popup').show();
											});
										});
									</script>

									<script>
										$(document).ready(function() {
											$("#totalwt").on("mouseover", function () {
												var hText = $("#totalwt").text();
												var vehicleNumbers = ['MH12TV5860', 'MH12TV5861', 'MH12TV5862' , 'MH12TV5863' , 'MH12TV5864', 'MH12TV5865', 
													'MH12TV5866' , 'MH12TV5867' , 'MH12TV5868', 'MH12TV5869', 'MH12TV5870'];
												var vehicleno = document.getElementById('vehicleno').value;
												let exists = false;

												for (let i = 0; i < vehicleNumbers.length; i++) {
													if (vehicleNumbers[i] === vehicleno) {
														exists = true;
														break;
													}
												}
												if(document.getElementById('vendortype').value == "Own")
												{
													if (exists && 2000<=parseInt(hText)) {
														console.log(`${vehicleno} exists in the array`);
														alert("Actual Weight Is More Than Capacity 2000 KG"+hText);

														document.getElementById("Submit").disabled = true;
														document.getElementById('advamt').disabled = true; 
														document.getElementById('advancetype').disabled = true;
														document.getElementById('hamali').disabled = true;
														document.getElementById('contractamt').disabled = true; 
														document.getElementById('Hvendor').disabled = true; 

													} else {
														console.log(`${vehicleno} does not exist in the array`);
														alert("Vehicle number is not match");
														document.getElementById("Submit").disabled = false;
														document.getElementById('advamt').disabled = false; 
														document.getElementById('advancetype').disabled = false;
														document.getElementById('hamali').disabled = false;
														document.getElementById('contractamt').disabled = false; 
														document.getElementById('Hvendor').disabled = false; 
													}                                 
												}
											});
										});
									</script>

									<script type="text/javascript">
										function validateVehicle(vehicleNumber) {
											if (vehicleNumber !== '') {
												return true;
											} else {
												return false;
											}
										}
										function step1click() {
											alert('step1click');
											if ($("#form1")[0].checkValidity()) {
												if (!validateVehicle(document.getElementById('avehicleno'))) {
													return;
												}
												document.getElementById('vendortype').disabled = true;
												document.getElementById('vendorname').disabled = true;
												document.getElementById('avehicleno').readOnly = true;
												document.getElementById('mreading').readOnly = true;
												document.getElementById('driver').disabled = true;
												document.getElementById('drivername').readOnly = true;
												document.getElementById('licenseno').readOnly = true;
												document.getElementById('FTLType').readOnly = true;
												document.getElementById('ownername').readOnly = true;

												$("#step0").css("pointer-events", "none");
												$("#step0").css("opacity", "0.5");
												document.getElementById('btnstep1').disabled = true;
												document.getElementById('step1').style.display = 'block';
												alert('step1');
												document.getElementById('mobileno').disabled = false;
												alert('mobileno');
												document.getElementById('contractamt').disabled = false;
												document.getElementById('advamt').disabled = false;
												document.getElementById('hamali').disabled = false;
											} else {
// $("#form1")[0].reportValidity();
											}
										}

									</script>
									<script>
										$(document).ready(function () {
											$("#Submit").button({
												icons: {
													secondary: "ui-icon-info"
												}
											});
											$("#Hvendor").addClass("ui-selectmenu-button ui-widget ui-state-default ui-corner-all");
											var demoSelectValue = $("#Hvendor").val();
											if (demoSelectValue == "0") {
												$("#Submit").button("disable")
											}
											$("#Hvendor").change(function () {
												if ($(this).val() == "0") {
													$("#Submit").button("disable")
												} else {
													$("#Submit").button("enable")
												}
											});
										});

									</script>
									<script>
										function lettersValidate(key) {
											var keycode = (key.which) ? key.which : key.keyCode;

											if ((keycode > 64 && keycode < 91) || (keycode > 96 && keycode < 123))  
											{    
												return true;    
											}
											else
											{
												return false;
											}

										}
									</script>
									<script type="text/javascript">
										$("#txtlrno").keypress(function (event) {
											if (event.keyCode === 13 || event.which === 13) {
												add_row();
											}
										});
									</script>

									<script>
										function onlyAlphabets(e, t) {
											var regexp = new RegExp(/^[A-Z0-9 ]*$/);
											if (window.event) {
												keynum = e.keyCode;
											} else if (e.which) {
												keynum = e.which;
											}
											var test = regexp.test(String.fromCharCode(keynum));
											return test;

										}
									</script>
									<script>
										function sum()
										{
											var n1 = parseFloat(document.getElementById('liter').value);
											var n2 = parseFloat(document.getElementById('Rate').value);
											var n3 =n1*n2;
//var n3 =n1*n2*n5/1728;
											var n4=document.getElementById('dieselamt').value=n3;



										}
									</script>
									<script type="text/javascript">
										function fetch_ownername(e){
//alert('ownername')

											var ownername;
											var AccountNO;
											var IFSC;
											var BankName;
											var branch;

											var Ownername_valid_check=true;
											var accountNO_valid_check=true;
											var iFSC_valid_check=true;
											var bankName_valid_check=true;
											var Branch_valid_check=true;

											ownername = document.getElementsByName('ownername');
											AccountNO= document.getElementsByName('AccountNO');
											IFSC= document.getElementsByName('IFSC');
											BankName= document.getElementsByName('BankName');
											branch= document.getElementsByName('branch');


											for (i = 0; i < ownername.length; i++) {
												if (ownername[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < AccountNO.length; i++) {
												if (AccountNO[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < IFSC.length; i++) {
												if (IFSC[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < BankName.length; i++) {
												if (BankName[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < branch.length; i++) {
												if (branch[i] == e) {
													index = i;
													break;
												}
											}

											if(Ownername_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'createdrsdemo1accountno.php',
													data: {
														ownername:ownername[index].value,
														AccountNO:AccountNO[index].value,

													},
													success: function (response) {
														if(response==''){ 
															accountNO_valid_check=false;
														}
//alert(response);

														AccountNO[index].value=response;

													},
													error: function(response) {
													}
												});
											}
											if(Ownername_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'createdrsdemo1ifsc.php',
													data: {
														ownername:ownername[index].value,
														IFSC:IFSC[index].value,

													},
													success: function (response) {
														if(response==''){ 
															iFSC_valid_check=false;
														}
//alert(response);
														IFSC[index].value=response;

													},
													error: function(response) {
													}
												});
											}
											if(Ownername_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'createdrsdemo1bank.php',
													data: {
														ownername:ownername[index].value,
														BankName:BankName[index].value,

													},
													success: function (response) {
														if(response==''){ 
															bankName_valid_check=false;
														}
//alert(response);
														BankName[index].value=response;

													},
													error: function(response) {
													}
												});
											}
											if(Ownername_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'createdrsdemo1branch.php',
													data: {
														ownername:ownername[index].value,
														branch:branch[index].value,

													},
													success: function (response) {
														if(response==''){ 
															Branch_valid_check=false;
														}
//alert(response);
														branch[index].value=response;

													},
													error: function(response) {
													}
												});
											}



										}
									</script>


									<script type="text/javascript">

										$(function () {

											$("#Hvendor").autocomplete({
												minLength: 1,
												source: 'hamalivendorfech.php',
												select: function (event, ui) {
// alert(Hvendor);
													$("#Hvendor").val(ui.item.Hvendor);
													return false;
												},
												change: function (event, ui) {
													if (ui.item == null) {
														event.currentTarget.value = '';
														event.currentTarget.focus();
													}
												},
												open: function () {
													$('.ui-autocomplete').css('width', '400px');
												}
											})
											$("#Hvendor").autocomplete().data("uiAutocomplete")._renderItem =  function( ul, item )
											{
												return $( "<li>" )
												.append( "<a>" + item.Hvendor + "</a>" )
												.appendTo( ul );
											};
										});

									</script>

									<script>
										function fetch_hamali(e){
//alert('ownername')

											var Hvendor;
											var HAccountNO;
											var HIFSC;
											var Hbank;
											var Hbranch;
											var HVendorCode;

											var HvendoR_valid_check=true;
											var HAccountNo_valid_check=true;
											var HIFSc_valid_check=true;
											var HbanK_valid_check=true;
											var Branch_valid_check=true;
											var HVendorCodE_valid_check=true;

											Hvendor = document.getElementsByName('Hvendor');
											HAccountNO= document.getElementsByName('HAccountNO');
											HIFSC= document.getElementsByName('HIFSC');
											Hbank= document.getElementsByName('Hbank');
											Hbranch= document.getElementsByName('Hbranch');

											HVendorCode= document.getElementsByName('HVendorCode');

											for (i = 0; i < Hvendor.length; i++) {
												if (Hvendor[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < HAccountNO.length; i++) {
												if (HAccountNO[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < HIFSC.length; i++) {
												if (HIFSC[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < Hbank.length; i++) {
												if (Hbank[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < Hbranch.length; i++) {
												if (Hbranch[i] == e) {
													index = i;
													break;
												}
											}


											for (i = 0; i < HVendorCode.length; i++) {
												if (HVendorCode[i] == e) {
													index = i;
													break;
												}
											}


//alert("ownername code pass "+ownername[index].value);    


											if(HvendoR_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'hamaliaccount.php',
													data: {
														Hvendor:Hvendor[index].value,
														HAccountNO:HAccountNO[index].value,

													},
													success: function (response) {
														if(response==''){ 
															HAccountNo_valid_check=false;
														}
//alert(response);

														HAccountNO[index].value=response;

													},
													error: function(response) {
													}
												});
											}




											if(HvendoR_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'hamaliifsc.php',
													data: {
														Hvendor:Hvendor[index].value,
														HIFSC:HIFSC[index].value,

													},
													success: function (response) {
														if(response==''){ 
															HIFSc_valid_check=false;
														}
//alert(response);
														HIFSC[index].value=response;

													},
													error: function(response) {
													}
												});
											}



											if(HvendoR_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'hamalibank.php',
													data: {
														Hvendor:Hvendor[index].value,
														Hbank:Hbank[index].value,

													},
													success: function (response) {
														if(response==''){ 
															HbanK_valid_check=false;
														}
//alert(response);
														Hbank[index].value=response;

													},
													error: function(response) {
													}
												});
											}





											if(HvendoR_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'hamalibranch.php',
													data: {
														Hvendor:Hvendor[index].value,
														Hbranch:Hbranch[index].value,

													},
													success: function (response) {
														if(response==''){ 
															Branch_valid_check=false;
														}
//alert(response);
														Hbranch[index].value=response;

													},
													error: function(response) {
													}
												});
											}



											if(HVendorCodE_valid_check ==true){

												$.ajax({
													type: 'post',
													url: 'hamaliVendorCode.php',
													data: {
														Hvendor:Hvendor[index].value,
														HVendorCode:HVendorCode[index].value,

													},
													success: function (response) {
														if(response==''){ 
															HVendorCodE_valid_check=false;
														}
//alert(response);
														HVendorCode[index].value=response;

													},
													error: function(response) {
													}
												});
											}



										}
									</script>

									<script>
										jQuery(document).ready(function(e) {
											document.getElementById("vendorname").style.display = "none";
											document.getElementById("vendorname1").style.display = "none";

											$("#vendortype").on('change', function() {

												var hText = $("#vendortype").val();
												alert(hText);
												if(hText=="Attached"){
													document.getElementById("vendorname").style.display = "block";
													document.getElementById("vendorname1").style.display = "none";
												}
												else if(hText=="Own"){
													document.getElementById("vendorname").style.display = "none";
													document.getElementById("vendorname1").style.display = "block";
												}

											});

										});
									</script>

									<script>
										jQuery(document).ready(function($) {
											$("#vendorname1").on('change', function() {
												var hText1 = $("#vendortype").val();
												var hText = $("#vendorname1").val();
												alert(hText1 + hText);

												if (hText === "VTC 3 PL SERVICES LTD (KALBHOR)") {
													document.getElementById("vehicleno").style.display = "block";
													document.getElementById("vehicleno1").style.display = "none";
													document.getElementById("vehicleno2").style.display = "none";
												} else if (hText === "VTC 3 PL SERVICES LTD AKOLA") {
													document.getElementById("vehicleno1").style.display = "block";
													document.getElementById("vehicleno").style.display = "none";
													document.getElementById("vehicleno2").style.display = "none";
												} else if (hText === "VTC 3 PL SERVICES LTD PUNE") {
													document.getElementById("vehicleno1").style.display = "none";
													document.getElementById("vehicleno").style.display = "none";
													document.getElementById("vehicleno2").style.display = "block";
												} else {
													document.getElementById("vehicleno").style.display = "none";
													document.getElementById("vehicleno1").style.display = "none";
													document.getElementById("vehicleno2").style.display = "none";
												}
											});
										});
									</script>
									<script type="text/javascript">
										var dialog = $("#dialog1").dialog({
											autoOpen: false,
											modal: true,
											buttons: {
												Ok: function() {
													$(this).dialog('close');
												}
											}
										});
									</script>
									<script type="text/javascript">
										$(document).ready(function() {
											$('#yourForm').submit(function(e) {
												e.preventDefault();

												var rows = parseInt($('#lrdetails').val());
												if (rows < 3) {
													var message = "Please add LR NO.";
													$('#abc').html(message);
													$('#dialog1').dialog();
													return false;
												}

// Add other validation checks and logic as needed

												var formData = new FormData(this);
												formData.delete('Submit');

												$.ajax({
													type: "POST",
													url: $(this).attr('action'),
													data: formData,
													processData: false,
													contentType: false,
													success: function(response) {
														if (IsJsonString(response)) {
															var drsobj = JSON.parse(response);
															if (drsobj.success == 1) {
																$('#diagmsg').html(drsobj.msg);
																$('#diagimg').attr('src', 'images1/success.png');
																dialog.dialog('open');
															} else {
																$('#diagmsg').html(drsobj.msg);
																$('#diagimg').attr('src', 'images1/error.png');
																dialog.dialog('open');
																$('#Submit').prop('disabled', false);
															}
														} else {
															$('#diagmsg').html(response);
															$('#diagimg').attr('src', 'images1/error.png');
															dialog.dialog('open');
															$('#Submit').prop('disabled', false);
														}
													},
													error: function(response) {
														$('#diagmsg').html(response);
														$('#diagimg').attr('src', 'images1/error.png');
														dialog.dialog('open');
														$('#Submit').prop('disabled', false);
													}
												});
											});
										});
									</script>
									<script type="text/javascript">
										const btnstep1 = document.getElementById('btnstep1');
										const step1 = document.getElementById('step1');

										btnstep1.addEventListener('click', function() {
											if (step1.style.display === 'none') {
												step1.style.display = 'block';
												$("#step0").css("pointer-events", "none");
												$("#step0").css("opacity", "0.5");
											} else {
												step1.style.display = 'none';
											}
										});

									</script>





