<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/misc.js"></script>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">REGISTRATION</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Forms</a></li>
					<li class="breadcrumb-item active" aria-current="page">User Registration</li>
				</ol>
			</nav>
		</div>
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form class="form-sample"  id="frmRegister" enctype="multipart/form-data" role="form" method="post" action="">
							<div class="row">
								<span class="help-block"><b>PERSONAL INFORMATION EMPLOYEE</b></span>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label> Employee Salary Mode</label><br>
									<select class="form-control"  name="empidtype" id="empidtype" required>
										<option value="">Select</option>
										<option value="CASH">CASH</option>
										<option value="BANK">BANK</option>
									</select>
								</div>
								<div class="col">
									<label> Employee Company name</label><br>
									<select  class="form-control"  name="empcompname" id="empcompname" required="">
										<option value="">Select</option>
										<option value="VTC 3PL SERVICES PVT LTD">VTC 3PL SERVICES PVT LTD</option>
										<option value="VISHAL SCM PVT LTD">VISHAL SCM PVT LTD</option>
										<option value="NORTHAN STAR">NORTHAN STAR</option>
										<option value="MOTHER EARTH">MOTHER EARTH</option>
										<option value="JAYESH ENTERPRISES">JAYESH ENTERPRISES</option>
									</select>
								</div>

								<div class="col">
									<label>Division</label>
									<br>
									<select  class="form-control"   id="division" name="division" required="">
										<option value="" selected="">Select</option>
										<option value="CNF">C &amp; F</option>
										<option value="TRANSPORT">TRANSPORT</option>
										<option value="SUPPORT">SUPPORT</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Employee Id</label><br>
									<input type="text" class="form-control"  id="EmpID" placeholder="ID" name="EmpID"  value="<?php echo $new_emp_id; ?>" readonly="">
								</div>
								<div class="col">
									<label>Employee Name</label><br>
									<input type="text" class="form-control"  id="Name" placeholder=" Name" name="EmpName" onkeyup="this.value = this.value.toUpperCase();" required="">
								</div>

								<div class="col">
									<label>Phone Number</label><br>
									<input type="text" class="form-control"  id="phoneNumber" placeholder="Phone number" name="Phone" maxlength="10" onkeyup="num(this);" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Date of Birth
									</label><br>
									<input  class="form-control"  type="date" name="DOB" id="birthDate" required="">
								</div>
								<div class="col">
									<label>Date of Joining</label><br>
									<input  class="form-control"  type="date" name="DOJ" id="DOJ"  required="">
								</div>
								<div class="col">
									<label>Email</label><br>
									<input type="text" class="form-control"  id="email" placeholder="Email"  name="Email" onkeyup="emaill(this);" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Address</label><br>
									<textarea id="address" class="form-control"  name="EmpAdd" rows="4" cols="50" required=""></textarea>
								</div>
								<div class="col">
									<label>Permanent Address</label>
									<br>
									<textarea id="paddress" class="form-control"  name="EmpPerAdd" rows="4" cols="50" required=""></textarea>
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Employee Form</label>
									<input type="file" class="form-control"  id="empform" name="empform" accept=".jpg">
								</div>
								<div class="col">
									<label>Gender</label><br>
									<label class="radio-inline">
										<input type="radio"   value="FEMALE" name="Gender" required="">Female
									</label>
									<label class="radio-inline"> 
										<input type="radio"   id="male" value="MALE" name="Gender" required="">Male
									</label>
								</div>
								<div class="col">
									<label>Religion</label><br>
									<select class="form-control"  name="Religion">
										<option value="Hindu">Hindu</option>
										<option value="Muslim">Muslim</option>
										<option value="Sikh">Sikh</option>
										<option value="Buddhist">Buddhist</option>
										<option value="Jain">Jain</option>
										<option value="Other">Other</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>ESI_NO</label><br>
									<input type="Text" class="form-control"  id="esi" placeholder="ESI" name="ESINO" required="">
								</div>
								<div class="col">
									<label>Depot</label><br>
									<select name="Depot" class="form-control"  id="depot" onchange="fetch_depo()" required="">
										<option value="Please Select Depot">Please Select Depot</option>
										<option value="AKJ">AKJ-AKLUJ</option>
										<option value="AKL">AKL-AKOLA</option>
										<option value="AKLB">AKLB-AKOLA DIVISION 2</option>
										<option value="ANK">ANK-ANKLESHWAR</option>
										<option value="ASL">ASL-ASLALI</option>
										<option value="AUR">AUR-AURANGABAD</option>
										<option value="BEL">BEL-BELLARY</option>
										<option value="BIJ">BIJ-BAIJAPUR</option>
										<option value="BNG">BNG-BANGLORE</option>
										<option value="BPL">BPL-BHOPAL</option>
										<option value="BRD">BRD-BARODA</option>
										<option value="BRS">BRS-BARSHI</option>
										<option value="BWD">BWD-BHIWANDI THANE</option>
										<option value="CHF">CHF-CHANDIGARH FTL</option>
										<option value="COI">COI-COIMBATORE</option>
										<option value="CTK">CTK-CUTTUCK</option>
										<option value="DGH">DGH-DIGHI PUNE</option>
										<option value="DHI">DHI-DHULE</option>
										<option value="DHRD">DHRD-DEHRADUN </option>
										<option value="GJF">GJF-GUJRAT FTL</option>
										<option value="GNP">GNP-GANESH PETH PUNE</option>
										<option value="GNT">GNT-GUNTUR</option>
										<option value="GWH">GWH-GUWAHATI</option>
										<option value="GZB">GZB-GHAZIABAD UP</option>
										<option value="HDD">HDD-HANDEWADI PUNE</option>
										<option value="HDW">HDW-HARIDWAR</option>
										<option value="HSR">HSR-HISAR</option>
										<option value="HYD">HYD-HYDERABAD</option>
										<option value="IND">IND-INDORE</option>
										<option value="INF">INF-INDORE FTL</option>
										<option value="ISL">ISL-ISLAMPUR</option>
										<option value="JAI">JAI-JAIPUR</option>
										<option value="JBL">JBL-JABALPUR</option>
										<option value="JJR">JJR-JEJURI</option>
										<option value="JLN">JLN-JALNA</option>
										<option value="JNPT">JNPT-NAVA-SHIVA</option>
										<option value="KLG">KLG-KHALGHAT DHAR</option>
										<option value="KLK">KLK-KOLKATA</option>
										<option value="KLL">KLL-KALOL</option>
										<option value="KNP">KNP-KANPUR</option>
										<option value="KOP">KOP-KOLHAPUR</option>
										<option value="LCK">LCK-LUCKNOW</option>
										<option value="NAG">NAG-NAGPUR</option>
										<option value="NAN">NAN-NANDED</option>
										<option value="NCKL">NCKL-CHIKHALI PUNE</option>
										<option value="NCKN">NCKN-CHAKAN</option>
										<option value="NPCV">NPCV-PANCHAVATI NASHIK(N)</option>
										<option value="NRG">NRG-NARAYANGAON</option>
										<option value="NSK">NSK-NASHIK</option>
										<option value="OZAR">OZAR-OZAR</option>
										<option value="PBN">PBN-PARBHANI</option>
										<option value="PCV">PCV-PANCHAVATI NASHIK</option>
										<option value="PDR">PDR-PANDHARPUR</option>
										<option value="PNA">PNA-PUNE</option>
										<option value="PTN">PTN-PATNA</option>
										<option value="RAI">RAI-RAIPUR</option>
										<option value="RJP">RJP-RAJAPUR</option>
										<option value="RNC">RNC-RANCHI</option>
										<option value="SGL">SGL-SANGLI</option>
										<option value="SGN">SGN-SANGAMNER</option>
										<option value="SHV">SHV-SHIVARI</option>
										<option value="SNR">SNR-SINNER</option>
										<option value="SOL">SOL-SOLAPUR</option>
										<option value="STN">STN-SATPUR NASHIK</option>
										<option value="TLD">TLD-TALEGAON DABHADE</option>
										<option value="TRI">TRI-TRICHY</option>
										<option value="URL">URL-URULIDEVACHI</option>
										<option value="WGL">WGL-WAGHOLI</option>
										<option value="BPNA">BPNA-SHIVANE</option>
										<option value="BBRM">BBRM-BARAMATI</option>
										<option value="BCKN">BCKN-CHAKAN</option>
										<option value="BKKB">BKKB-KURKUMBH</option>
										<option value="BSNW">BSNW-SANASWADI</option>
										<option value="BNAF">BNAF-NANDED PHATA</option>
										<option value="BLSR">BLSR-LASUR STATION</option>
										<option value="BVJP">BVJP-VAIJAPUR</option>
										<option value="BAMI">BAMI-Amravati</option>
										<option value="BGNP">BGNP-GANESHPETH PUNE</option>
										<option value="BLNK">BLNK-LONIKAND</option>
									</select>
								</div>
								<div class="col">
									<label>Aadhaar card No</label>
									<input type="Text" class="form-control"  id="adhar" placeholder="Adhar card No. " name="AadharNo" maxlength="12" onkeyup="aadhar(this);" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Aadhaar card photo</label><br>
									<input type="file" class="form-control"  id="acp" name="acp" accept=".jpg">
								</div>
								<div class="col">
									<label>Pan card No. </label><br>
									<input type="Text" class="form-control"  id="pan" placeholder="Pan card No. " maxlength="10" name="PAN" onkeyup="panc(this);" required="">
								</div>
								<div class="col">
									<label>Pan card photo</label><br>
									<input type="file" class="form-control"  id="pcp" name="pcp" accept=".jpg"><br>
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Voter ID Card  NO. </label>
									<input type="Text" class="form-control"  id="vote" placeholder="vote card No. " maxlength="10" name="VoterIdNo" required="">
								</div>
								<div class="col">
									<label>VoterIdcard photo</label>
									<input type="file" class="form-control"  id="vcp" name="vcp" accept=".jpg">
								</div>
								<div class="col">
									<label>License  No.</label><br>
									<input type="Text" class="form-control"  id="License" placeholder="License No." name="License" required="">
								</div>
							</div>
							<br>
							<div class="row  justify-content-center">
								<div class="col">
									<label>License photo</label>
									<input type="file" class="form-control"  id="licp" name="licp" accept=".jpg">               
								</div>
								<div class="col">
									<label>Passport Num </label><br>
									<input type="Text" class="form-control"  id="passport" placeholder="passport No. " maxlength="8" name="PassportNo" required="">
								</div>
								<div class="col">
									<label>Passport photo</label>
									<input type="file" class="form-control"  id="pscp" name="pscp" accept=".jpg">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Bank PassBook Num</label>
									<input type="text" class="form-control"  id="Bank" name="PassBookNo" required=""><br>
								</div>
								<div class="col">
									<label>Bank PassBook Photo</label>
									<input type="file" class="form-control"  id="Bankp" name="bankp" accept=".jpg">
								</div>
								<div class="col">
									<label>Form 16</label>
									<input type="file" class="form-control"  id="f16" name="f16" accept=".jpg">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Upload Photo</label>
									<input type="file" class="form-control"  id="Upphoto" name="Upphoto" accept=".jpg"> 
								</div>
								<div class="col">
									<label>Bank Name </label><br>
									<input type="Text" class="form-control"  id="Bname" placeholder="Bank Name" name="Bname" required="">
								</div>
								<div class="col">
									<label>Bank Branch Name </label>
									<input type="Text" class="form-control"  id="branchname" placeholder="Bank Branch Name" name="branchname" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Bank Account No</label>
									<input type="Text" class="form-control"  id="baccno" placeholder="Account No" name="baccno" onkeyup="baccount(this);" required="">
								</div>
								<div class="col">
									<label>Bank IFSC Code</label><br>
									<input type="Text" class="form-control"  id="bifsc" placeholder="IFSC Code" name="bifsc" onkeyup="bifsc(this);" required="">
								</div>
								<div class="col">
									<label>UAN</label><br>
									<input type="Text"  class="form-control"  id="uan" placeholder="UAN" name="UAN" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Qualification</label><br>
									<input type="Text"  class="form-control"  id="quali" placeholder="Qualification" name="Qualification" required="">
								</div>
								<div class="col">
									<label>Department</label><br>
									<select  class="form-control"  name="Dept" id="Dept">
										<option value="TPT">TPT</option>
										<option value="CNF">CNF</option>
										<option value="Account">Account</option>
										<option value="Finanace">Finanace</option>
										<option value="HR">HR</option>
										<option value="CP">CP</option>
										<option value="Marketing">Marketing</option>
										<option value="Customer Care">Customer Care </option>
										<option value="POD ">POD</option>
										<option value="Legal">Legal</option>
										<option value="IT">IT</option>
										<option value="Maintenance">Maintenance</option>
									</select>
								</div>
								<div class="col">
									<label>Designation</label>
									<select class="form-control"  id="desig"  name="Designation"  required="">
										<option value=""> Select</option>
										<option value="BOARD OF DIRECTORS">BOARD OF DIRECTORS</option>
										<option value="DIRECTOR">DIRECTOR</option>
										<option value="EXECUTIVE DIRECTOR">EXECUTIVE DIRECTOR</option>
										<option value="CEO (CHIEF EXECUTIVE OFFICER)">CEO (CHIEF EXECUTIVE OFFICER)</option>
										<option value="COO CHIEF OPERATING OFFICER">COO CHIEF OPERATING OFFICER</option>
										<option value="SBU -BUSINESS HEAD">SBU -BUSINESS HEAD</option>
										<option value="GENERAL MANAGER">GENERAL MANAGER</option>
										<option value="ASSISTANT GENERAL MANAGER">ASSISTANT GENERAL MANAGER</option>
										<option value="ZONAL MANAGER">ZONAL MANAGER</option>
										<option value="REGIONAL MANAGER">REGIONAL MANAGER</option>
										<option value="BRANCH MANAGER">BRANCH MANAGER</option>
										<option value="MANAGER">MANAGER</option>
										<option value="ASSISTANT MANAGER">ASSISTANT MANAGER</option>
										<option value="EXECUTIVE">EXECUTIVE</option>
										<option value="SAP OPERATOR">SAP OPERATOR</option>
										<option value="DATA ENTRY OPERATOR">DATA ENTRY OPERATOR</option>
										<option value="COORDINATOR">COORDINATOR</option>
										<option value="COMPUTER OPERATOR">COMPUTER OPERATOR</option>
										<option value="WAREHOUSE MANAGER">WAREHOUSE MANAGER</option>
										<option value="WAREHOUSE SUPERVISOR">WAREHOUSE SUPERVISOR</option>
										<option value="WAREHOUSE KEEPER">WAREHOUSE KEEPER</option>
										<option value="HOUSE KEEPER">HOUSE KEEPER</option>
										<option value="DRIVER">DRIVER</option>
										<option value="HAMAL">HAMAL</option>
										<option value="OFFICE BOY">OFFICE BOY</option>
										<option value="SECURITY">SECURITY</option>
										<option value="SWEEPER">SWEEPER</option>
										<option value="JR.SOFTWARE DEVELOPER">JR.SOFTWARE DEVELOPER</option>
										<option value="JR.SOFTWARE TEST ENGINEER">JR.SOFTWARE TEST ENGINEER</option>
										<option value="FLEET MAINTENANCE">FLEET MAINTENANCE</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								<span class="help-block"><b>Previous Company Details If worked before this</b></span>
							</div><br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Previous Company Name</label>
									<input class="form-control"  type="Text" id="company" placeholder="Previous Company" name="PreCompName" required="">
								</div>
								<div class="col">
									<label>Salary</label><br>
									<input class="form-control"  type="Text" id="salary" placeholder="Salary" name="Salary" required="">
								</div>
								<div class="col">
									<label>Salary Slips</label>
									<input type="file" id="salslip" name="salslip" accept=".jpg">
								</div>
							</div><br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Relieving Letter</label>
									<input class="form-control"  type="file" id="relletter" name="relletter" accept=".jpg">
								</div>
								<div class="col">
									<label class="col-sm-3 control-label">Experience Certificate</label>
									<input class="form-control"  type="file" id="expcert" name="expcert" accept=".jpg">
								</div>
								<div class="col">
									<label>Bank Statement</label>
									<input class="form-control"  type="file" id="bankstat" name="bankstat" accept=".jpg">
								</div>
							</div><br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Educational Certificate</label>
									<input class="form-control"  type="file" id="educert" name="educert" accept=".jpg">
								</div>
								<div class="col">
									<label>Resume</label>
									<input class="form-control"  type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
								</div>
								<div class="col">
									<label>Form 16</label>
									<input class="form-control"  type="file" id="expcert" name="expcert" accept=".jpg">
								</div>
							</div><br>
							<div class="row  justify-content-center">
								<div class="col">
									<label>Shift Type</label><br>
									<select class="form-control" name="ShiftType" required="">
										<option value="Seasonal">Seasonal</option>
										<option value="Non Seasonal">Non Seasonal</option>
										<option value="Standard">Standard</option>
									</select>
								</div>
								<div class="col">
									<label>In Time</label><br>
									<input type="time" class="form-control"  name="Intime" required="">
								</div>
								<div class="col">
									<label>Out Time</label><br>
									<input type="time" class="form-control"  name="Outtime" required="">
								</div>
								<div class="col">
									<label>Select Zone</label><br>
									<select class="form-control"  name="zone" id="zone" onchange="fetch_zone()" required="">
										<option value="">Select</option>
										<option value="zone1">Zone-1</option>
										<option value="zone2">Zone-2</option>
										<option value="zone3">Zone-3</option>
										<option value="zone4">Zone-4</option>
									</select>
								</div>
							</div>
							<br>
							<div  class="row justify-content-center">
								<div class="col">
									<label>Location</label><br>
									Latitude:-<input type="number" class="form-control"  id="lat" placeholder="Latitude" name="lat" step="0.00000001" required="" readonly=""> Longitude:-<input type="number" class="form-control"  id="long" placeholder="Latitude" name="long" step="0.00000001" required="" readonly="">
								</div>
								<div class="col mt-4">
									<label>Reporting Person</label>
									<input type="text" class="form-control"  id="reportingid" placeholder="Reporting Person" name="reportingid" required="">
								</div>
								<div class="col mt-4">
									<label>Gross Salary</label><br>
									<input type="number" class="form-control"  id="gsal" placeholder="Gross Salary" name="gsal" min="0" required="">
								</div>
							</div><br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Basic</label><br>
									<input type="number" class="form-control"  id="basic" placeholder="Basic Salary" name="basic" min="0"  required="">
								</div>
								<div class="col">
									<label>HRA</label><br>
									<input type="number" class="form-control"  id="Hra" placeholder="HRA" name="Hra" min="0"  required="">
								</div>
								<div class="col">
									<label>Other</label><br>
									<input type="number" class="form-control"  id="other" placeholder="Other" name="other" min="0"  required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>ESIC</label><br>
									<input type="number" class="form-control"  id="esic" placeholder="ESIC" name="esic" min="0"  required="">
								</div>
								<div class="col">
									<label>Professional Tax</label>
									<input type="number" class="form-control"  id="Proftax" placeholder="Professional Tax" name="Proftax" min="0"  required="">
								</div>
								<div class="col">
									<label>Provident Fund</label><br>
									<input type="number" class="form-control"  id="Pf" placeholder="Provident Fund" name="Pf" min="0"  required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Legal Joining Date</label><br>
									<input type="date" class="form-control"  name="legaljoindate" id="legaljoindate"  required="">
								</div>
								<div class="col">
									<label>Ofiice Mobile No</label>
									<input type="text" class="form-control"  id="officemobile" placeholder="Ofiice Mobile No" name="officemobile" required="">
								</div>
								<div class="col">
									<label>Emergency Mobile No</label>
									<input type="text" class="form-control"  id="emergencymobile" placeholder="Emergency Mobile No" name="emergencymobile" required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label>Ofiice Email ID</label><br>
									<input type="text" class="form-control"  id="officeemail" placeholder="Ofiice Email ID" name="officeemail" required="">
								</div>
								<div class="col">
									<label>Marrital Status</label><br>
									<select class="form-control"  id="marital" name="marital"  required="">
										<option value="">Select</option>
										<option value="SINGLE">Single</option>
										<option value="MARRIED">Married</option>
										<option value="DIVORCEE">Divorcee</option>
										<option value="WIDOW">WIDOW</option>
									</select>
								</div>
								<div class="col">
									<label>PF Number</label><br>
									<input type="text" class="form-control"  id="pfnumber" placeholder="PF Number" name="pfnumber"  required="">
								</div>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="col">
									<label class="col-sm-3 control-label">ESIC Subcode</label>
									<input type="text" class="form-control"  id="esicsubcode" placeholder="ESIC Subcode" name="esicsubcode"  required="">
								</div>
								<div class="col">
									<label>Business Head</label>
									<select id="businesshead" class="form-control"  name="businesshead"  required="">
										<option value="">Select</option>
										<option value="PNA42">PNA42-SHIVAJI SHINDE</option>
										<option value="PNA44">PNA44-GOVIND LIMHAN</option>
									</select>
								</div>
							</div>
							<br>
							<div class="d-flex justify-content-center">
								<button type="submit" name="Submit" class="btn btn-outline-dark btn-fw" id="btnRegister">Register
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(e) {    
		$(document).on('keydown',':input[type="number"]',function(e){

			if(e.which==69){
				e.preventDefault();
				e.stopPropagation();
			}

		});

	}); 


</script>

<script type="text/javascript">
	function fetch_depo(){
		var temp= document.getElementById('zone').value='';
		document.getElementById('lat').value='';
		document.getElementById('long').value='';

	}
	function fetch_zone(){
		document.getElementById('lat').value='';
		document.getElementById('long').value='';
		var temp= document.getElementById('zone').value;
		var temp1= document.getElementById('depot').value;
		alert("depot fetch");
		if (temp1 == 'AKL' && temp == 'zone1') {
			document.getElementById('lat').value='20.6828126';
			document.getElementById('long').value='77.070657';
		}
		else if(temp1 == 'AKL' && temp == 'zone2'){
			document.getElementById('lat').value='20.667585';
			document.getElementById('long').value='77.062291';
		}
		else if(temp1 == 'SHV' && temp == 'zone1'){
			document.getElementById('lat').value='18.3043991';
			document.getElementById('long').value='74.0905947';

		}
		else if(temp1 == 'NSK' && temp == 'zone1'){
			document.getElementById('lat').value='20.0724892';
			document.getElementById('long').value='73.891452';
		}
		else if(temp1 == 'NSK' && temp == 'zone2'){
			document.getElementById('lat').value='20.0636741';
			document.getElementById('long').value='73.8919497';
		}
		else if(temp1 == 'BNH' && temp == 'zone1'){
			document.getElementById('lat').value='13.0138382';
			document.getElementById('long').value='77.4997659';
		}
		else if(temp1 == 'PNA' && temp == 'zone1'){
			document.getElementById('lat').value='18.4774911';
			document.getElementById('long').value='73.9597261';

		}else if(temp1 == 'PNA' && temp == 'zone2'){
			document.getElementById('lat').value='18.4771606';
			document.getElementById('long').value='73.956722';

		}else if(temp1 == 'PNA' && temp == 'zone3'){
			document.getElementById('lat').value='18.4738335';
			document.getElementById('long').value='73.9599501';

		}else if(temp1 == 'PNA' && temp == 'zone4'){
			document.getElementById('lat').value='18.4781042';
			document.getElementById('long').value='73.631188';

		}else if(temp1 == 'HYD' && temp == 'zone1'){
			document.getElementById('lat').value='17.3294088';
			document.getElementById('long').value='78.6407933';

		}else if(temp1 == 'HYD' && temp == 'zone2'){
			document.getElementById('lat').value='17.3471071';
			document.getElementById('long').value='78.5768777';
		}else if(temp1 == 'HSR' && temp == 'zone1'){
			document.getElementById('lat').value='29.2008487';
			document.getElementById('long').value='75.6815495';

		}else if(temp1 == 'LCK' && temp == 'zone1'){
			document.getElementById('lat').value='26.7660543';
			document.getElementById('long').value='80.8672695';

		}else if(temp1 == 'ODS' && temp == 'zone1'){
			document.getElementById('lat').value='20.4911034';
			document.getElementById('long').value='85.9262656';

		}
		else if(temp1 == 'BRD' && temp == 'zone1'){
			document.getElementById('lat').value='22.4078167';
			document.getElementById('long').value='73.1334258';

		}
		else if(temp1 == 'BRD' && temp == 'zone2'){
			document.getElementById('lat').value='22.438372';
			document.getElementById('long').value='73.227099';

		}else if(temp1 == 'IND' && temp == 'zone1'){
			document.getElementById('lat').value='22.7912722';
			document.getElementById('long').value='75.91078';

		}else if(temp1 == 'PTN' && temp == 'zone1'){
			document.getElementById('lat').value='25.5345681';
			document.getElementById('long').value='85.2854845';
		}else if(temp1 == 'GZB' && temp == 'zone1'){
			document.getElementById('lat').value='28.690633';
			document.getElementById('long').value='77.4325807';

		}else if(temp1 == 'ANK' && temp == 'zone1'){
			document.getElementById('lat').value='21.6308574';
			document.getElementById('long').value='73.0256486';

		}else if(temp1 == 'AUR' && temp == 'zone1'){
			document.getElementById('lat').value='19.85554';
			document.getElementById('long').value='75.2118698';


		}else if(temp1 == 'BRS' && temp == 'zone1'){
			document.getElementById('lat').value='18.2554446';
			document.getElementById('long').value='75.7184596';


		}else if(temp1 == 'NAG' && temp == 'zone1'){
			document.getElementById('lat').value='21.1567239';
			document.getElementById('long').value='79.0057959';


		}else if(temp1 == 'NAG' && temp == 'zone2'){
			document.getElementById('lat').value='21.1431375';
			document.getElementById('long').value='78.883045';


		}else if(temp1 == 'NAG' && temp == 'zone3'){
			document.getElementById('lat').value='21.1424394';
			document.getElementById('long').value='78.8831937';

		}else if(temp1 == 'BEL' && temp == 'zone1'){
			document.getElementById('lat').value='15.14049';
			document.getElementById('long').value='76.9616755';


		}else if(temp1 == 'BEL' && temp == 'zone2'){
			document.getElementById('lat').value='15.1452743';
			document.getElementById('long').value='76.9264899';


		}else if(temp1 == 'BEL' && temp == 'zone3'){
			document.getElementById('lat').value='15.1421542';
			document.getElementById('long').value='76.9520002';

		}else if(temp1 == 'TRI' && temp == 'zone1'){
			document.getElementById('lat').value='10.8169066';
			document.getElementById('long').value='78.7174635';


		}else if(temp1 == 'BPL' && temp == 'zone1'){
			document.getElementById('lat').value='23.2532929';
			document.getElementById('long').value='77.5310372';

		}else if(temp1 == 'PCV' && temp == 'zone1'){
			document.getElementById('lat').value='20.0171516';
			document.getElementById('long').value='73.794702';


		}else if(temp1 == 'GWH' && temp == 'zone1'){
			document.getElementById('lat').value='26.1108769';
			document.getElementById('long').value='91.7676176';


		}else if(temp1 == 'COI' && temp == 'zone1'){
			document.getElementById('lat').value='10.9548608';
			document.getElementById('long').value='76.9750407';


		}else if(temp1 == 'URL' && temp == 'zone1'){
			document.getElementById('lat').value='18.4511649';
			document.getElementById('long').value='73.9689164';

		}else if(temp1 == 'ASL' && temp == 'zone1'){
			document.getElementById('lat').value='22.900876';
			document.getElementById('long').value='72.5952375';

		}else if(temp1 == 'KLK' && temp == 'zone1'){
			document.getElementById('lat').value='22.5825';
			document.getElementById('long').value='88.1912';

		}else if(temp1 == 'BNG' && temp == 'zone1'){
			document.getElementById('lat').value='13.0138382';
			document.getElementById('long').value='77.4997659';

		}
		else if(temp1 == 'SNR' && temp == 'zone1'){
			document.getElementById('lat').value='19.8590854';
			document.getElementById('long').value='73.9771752';

		}
		else if(temp1 == 'NAN' && temp == 'zone1'){
			document.getElementById('lat').value='37.390370';
			document.getElementById('long').value='122.081263';

		}
		else if(temp1 == 'SGN' && temp == 'zone1'){
			document.getElementById('lat').value='19.6152017';
			document.getElementById('long').value='74.1809849';

		}
		else if(temp1 == 'KOP' && temp == 'zone1'){
			document.getElementById('lat').value='16.7444';
			document.getElementById('long').value='74.2815';

		}
		else if(temp1 == 'JLN' && temp == 'zone1'){
			document.getElementById('lat').value='19.8499';
			document.getElementById('long').value='75.8797844';

		}
		else if(temp1 == 'SOL' && temp == 'zone1'){
			document.getElementById('lat').value='17.7279551';
			document.getElementById('long').value='75.8367089';

		}
		else if(temp1 == 'BPNA' && temp == 'zone1'){
			document.getElementById('lat').value='18.469415';
			document.getElementById('long').value='73.7942605';

		}
		else if(temp1 == 'RJP' && temp == 'zone1'){
			document.getElementById('lat').value='16.6616702';
			document.getElementById('long').value='73.5242796';

		}
		else if(temp1 == 'BNAN' && temp == 'zone1'){
			document.getElementById('lat').value='18.4538356';
			document.getElementById('long').value='73.7955387';

		}

		else if(temp1 == 'BGNP' && temp == 'zone1'){
			document.getElementById('lat').value='18.510861';
			document.getElementById('long').value='73.8632677';

		}

		else if(temp1 == 'BNAF' && temp == 'zone1'){
			document.getElementById('lat').value='18.453853';
			document.getElementById('long').value='73.7954397';

		}
		else if(temp1 == 'MYP' && temp == 'zone1'){

			document.getElementById('lat').value='18.4895139';
			document.getElementById('long').value='73.8674107';

		}
		else if(temp1 == 'BAMI' && temp == 'zone1'){

			document.getElementById('lat').value='21.0007901';
			document.getElementById('long').value='77.8118896';

		}
		else if(temp1 == 'DHI' && temp == 'zone1'){

			document.getElementById('lat').value='20.8375489';
			document.getElementById('long').value='74.7581169';

		}
		else if(temp1 == 'BBRM' && temp == 'zone1'){

			document.getElementById('lat').value='18.1869046';
			document.getElementById('long').value='74.6015807';

		}
		else if(temp1 == 'BLNK' && temp == 'zone1'){

			document.getElementById('lat').value='18.606473';
			document.getElementById('long').value='74.0149554';

		}

		else if(temp1 == 'BKKB' && temp == 'zone1'){

			document.getElementById('lat').value='18.3941714';
			document.getElementById('long').value='74.5308675';

		}
		else if(temp1 == 'BSNW' && temp == 'zone1'){

			document.getElementById('lat').value='18.6692';
			document.getElementById('long').value='74.0995';

		}
		else if(temp1 == 'BCKN' && temp == 'zone1'){

			document.getElementById('lat').value='18.7214527';
			document.getElementById('long').value='73.8515769';

		}
		else if(temp1 == 'RAI' && temp == 'zone1'){

			document.getElementById('lat').value='21.210368';
			document.getElementById('long').value='81.6048687';

		}
		else if(temp1 == 'JAI' && temp == 'zone1'){

			document.getElementById('lat').value='27.0087355';
			document.getElementById('long').value='75.7640277';

		}
		else if(temp1 == 'GZB' && temp == 'zone2'){
			document.getElementById('lat').value='28.6934';
			document.getElementById('long').value='77.6023';
		}

		else if(temp1 == 'GNT' && temp == 'zone1'){
			document.getElementById('lat').value='16.279569';
			document.getElementById('long').value='80.442878';
		}
		else if(temp1 == 'DHRD' && temp == 'zone1'){
			document.getElementById('lat').value='30.2807971';
			document.getElementById('long').value='78.083759';
		}
		else
		{

		}
	}
</script>


<script>
	function letter(input)
	{
		var reg=/[^a-z\s]/gi;
		input.value=input.value.replace(reg,"");
	}
	function num(input)
	{
		var reg = /[^0-9{10}]/gi;
		input.value=input.value.replace(reg,"");
	}
	function emaill(input)
	{
		var reg=/[^a-zA-Z0-9@.]/gi;
		input.value=input.value.replace(reg,"");
	}
	function aadhar(input)
	{
		var reg=/[^0-9]/gi;
		input.value=input.value.replace(reg,"");
	}

	function panc(input)
	{
		var reg=/[^0-9A-Z]/gi;
		input.value=input.value.replace(reg,"");
	}
	function baccount(input)
	{
		var reg=/[^0-9{9,18}]/gi;
		input.value=input.value.replace(reg,"");
	}
	function bifsc(input)
	{
		var reg=/^[A-Z{4}]0[A-Z0-9{6}]/gi;
		input.value=input.value.replace(reg,"");
	}


</script>


