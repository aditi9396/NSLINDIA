<div class="container">
	<form action="" method="POST">
		<div class="table-responsive text-nowrap">
			<h4>City Master</h4><div class="table-responsive">

			</div><table class="table table-bordered shadow p-4 mb-4 bg-white" id="employee_table">

				<thead>
					<tr>
						<th>Country</th>
						<th>State</th>
						<th>District</th>
						<th>Taluka</th>
						<th>Post Name</th>
						<th>Pincode</th>
						<th>Village Name</th>
						<th>village (Marathi)</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Zone</th>
						<th>Route No</th>
						<th>Route AKL</th>
						<th>Delivery Depot</th>
						<th>Nearest State Highway</th>
						<th>Nearest National Highway</th>
						<th>Active</th>
					</tr>
				</thead>
				<tbody>
					<tr id="row1">
						<input type="hidden" name="villageid" value="">
						<td>
							<select class="form-controls" name="country[]" id="country1" onchange="getstate(this.value,this.id)" autofocus="">
								<option value="" disabled="" selected="">Select Country</option>
								<option value="india">India</option>
								<option value="Nepal">Nepal</option>
							</select>

						</td>
						<td>
							<select class="form-controls" name="state[]" id="state1" onchange="statechange(this.value,this.id)" autofocus="" required=""><option disabled="" selected="">Select District</option><option value="ANDAMAN &amp; NICOBAR ISLANDS"> ANDAMAN &amp; NICOBAR ISLANDS </option><option value="ANDHRA PRADESH"> ANDHRA PRADESH </option><option value="ARUNACHAL PRADESH"> ARUNACHAL PRADESH </option><option value="ASSAM"> ASSAM </option><option value="BIHAR"> BIHAR </option><option value="CHANDIGARH"> CHANDIGARH </option><option value="CHATTISGARH"> CHATTISGARH </option><option value="DADRA &amp; NAGAR HAVELI"> DADRA &amp; NAGAR HAVELI </option><option value="DAMAN &amp; DIU"> DAMAN &amp; DIU </option><option value="DELHI"> DELHI </option><option value="GOA"> GOA </option><option value="GUJARAT"> GUJARAT </option><option value="HARYANA"> HARYANA </option><option value="HIMACHAL PRADESH"> HIMACHAL PRADESH </option><option value="JAMMU &amp; KASHMIR"> JAMMU &amp; KASHMIR </option><option value="JHARKHAND"> JHARKHAND </option><option value="KARNATAKA"> KARNATAKA </option><option value="KERALA"> KERALA </option><option value="LAKSHADWEEP"> LAKSHADWEEP </option><option value="MADHYA PRADESH"> MADHYA PRADESH </option><option value="MAHARASHTRA"> MAHARASHTRA </option><option value="MANIPUR"> MANIPUR </option><option value="MEGHALAYA"> MEGHALAYA </option><option value="MIZORAM"> MIZORAM </option><option value="NAGALAND"> NAGALAND </option><option value="ODISHA"> ODISHA </option><option value="PONDICHERRY"> PONDICHERRY </option><option value="PUNJAB"> PUNJAB </option><option value="RAJASTHAN"> RAJASTHAN </option><option value="SIKKIM"> SIKKIM </option><option value="TAMIL NADU"> TAMIL NADU </option><option value="TELANGANA"> TELANGANA </option><option value="TRIPURA"> TRIPURA </option><option value="UTTAR PRADESH"> UTTAR PRADESH </option><option value="UTTARAKHAND"> UTTARAKHAND </option><option value="WEST BENGAL"> WEST BENGAL </option></select>

						</td>
						<td>
							<select class="form-controls" name="district[]" id="district1" onchange="districtchange(this.value,this.id)" required="">
								<option disabled="" selected="">Select District</option>
								<option value="Akola"> Akola </option>
								<option value="AMRAVATI"> AMRAVATI </option>
								<option value="AURANGABAD"> AURANGABAD </option>
								<option value="BEED"> BEED </option>
								<option value="BHANDARA"> BHANDARA </option>
								<option value="BULDHANA"> BULDHANA </option>
								<option value="CHANDRAPUR"> CHANDRAPUR </option>
								<option value="DHULE"> DHULE </option>
								<option value="GADCHIROLI"> GADCHIROLI </option>
								<option value="GONDIYA"> GONDIYA </option>
								<option value="HINGOLI"> HINGOLI </option>
								<option value="JALGAON"> JALGAON </option>
								<option value="JALNA"> JALNA </option>
								<option value="KOLHAPUR"> KOLHAPUR </option>
								<option value="LATUR"> LATUR </option>
								<option value="MUMBAI"> MUMBAI </option>
								<option value="NAGAR"> NAGAR </option>
								<option value="NAGPUR"> NAGPUR </option>
								<option value="NANDED"> NANDED </option>
								<option value="NANDURBAR"> NANDURBAR </option>
								<option value="NASHIK"> NASHIK </option>
								<option value="OSMANABAD"> OSMANABAD </option>
								<option value="PALGHAR"> PALGHAR </option>
								<option value="PARBHANI"> PARBHANI </option>
								<option value="PUNE"> PUNE </option>
								<option value="RAIGAD"> RAIGAD </option>
								<option value="RATNAGIRI"> RATNAGIRI </option>
								<option value="SANGLI"> SANGLI </option>
								<option value="SATARA"> SATARA </option>
								<option value="SINDHUDURG"> SINDHUDURG </option>
								<option value="SOLAPUR"> SOLAPUR </option>
								<option value="THANE"> THANE </option>
								<option value="WARDHA"> WARDHA </option>
								<option value="WASHIM"> WASHIM </option>
								<option value="YEOTMAL"> YEOTMAL </option></select>
							</td>
							<td>
								<select class="form-controls" name="taluka[]" id="taluka1" onchange="talukachange(this.value,this.id)" required="">
									<option disabled="" selected="">Select Taluka</option>
									<option value="Akkaikot"> Akkaikot </option>
									<option value="Akkalkot"> Akkalkot </option>
									<option value="Barshi"> Barshi </option>
									<option value="Karmala"> Karmala </option>
									<option value="Karmalaa"> Karmalaa </option>
									<option value="Madha"> Madha </option>
									<option value="Mahda"> Mahda </option>
									<option value="Malshira"> Malshira </option>
									<option value="Malshiras"> Malshiras </option>
									<option value="Malsiras"> Malsiras </option>
									<option value="Malsras"> Malsras </option>
									<option value="Mangalvedha"> Mangalvedha </option>
									<option value="Mangalvedhe"> Mangalvedhe </option>
									<option value="Mangalwedha"> Mangalwedha </option>
									<option value="Mhol"> Mhol </option>
									<option value="Mohol"> Mohol </option>
									<option value="N.solapur"> N.solapur </option>
									<option value="NA"> NA </option>
									<option value="Nort Solapur"> Nort Solapur </option>
									<option value="North  Solapur"> North  Solapur </option>
									<option value="North Solapur"> North Solapur </option>
									<option value="Pamdharpur"> Pamdharpur </option>
									<option value="Pandharpur"> Pandharpur </option>
									<option value="S.solapur"> S.solapur </option>
									<option value="Sangola"> Sangola </option>
									<option value="Sangole"> Sangole </option>
									<option value="Snagola"> Snagola </option>
									<option value="Sngola"> Sngola </option>
									<option value="Solapur"> Solapur </option>
									<option value="Solapur North"> Solapur North </option>
									<option value="Solapur South"> Solapur South </option>
									<option value="South Solapur"> South Solapur </option>
								</select>
							</td>
							<td>
								<select class="form-controls" name="postname[]" id="postname1" onchange="postchange(this.value,this.id)">
									<option disabled="" selected="">Select Post Office</option>
									<option value="Achakdani  "> Achakdani   </option>
									<option value="Ajnale  "> Ajnale   </option>
									<option value="Akola Wasud  "> Akola Wasud </option>
									<option value="Alegaon  "> Alegaon </option>
									<option value="Balwadi  "> Balwadi   </option>
									<option value="Bohali  "> Bohali   </option>
									<option value="Chikmahud  "> Chikmahud   </option>
									<option value="Chinke  "> Chinke  </option>
									<option value="Chopadi  "> Chopadi  </option>
									<option value="Dhyati (E)  "> Dhyati (E) </option>
									<option value="Dongargaon  "> Dongargaon </option>
									<option value="Ekhatpur  "> Ekhatpur </option>
									<option value="Gaigavan  "> Gaigavan</option>
									<option value="Gardi  "> Gardi   </option>
									<option value="Gaudwadi  "> Gaudwadi   </option>
									<option value="Hatid  "> Hatid   </option>
									<option value="Jawala   (Solapur)"> Jawala   (Solapur) </option>
									<option value="Junoni  "> Junoni   </option>
									<option value="Kadlas  "> Kadlas   </option>
									<option value="Kamalapur  "> Kamalapur   </option>
									<option value="Katphal  "> Katphal   </option>
									<option value="Khavaspur  "> Khavaspur   </option>
									<option value="Kole   (Solapur)"> Kole   (Solapur) </option>
									<option value="Kolegaon  "> Kolegaon   </option>
									<option value="Lonvire  "> Lonvire   </option>
									<option value="Lotewadi  "> Lotewadi   </option>
									<option value="Mahim  "> Mahim   </option>
									<option value="Mahud  "> Mahud   </option>
									<option value="Manjari  "> Manjari   </option>
									<option value="Medshingi  "> Medshingi   </option>
									<option value="Methawade  "> Methawade   </option>
									<option value="Nazara  "> Nazara   </option>
									<option value="Pachegaon  "> Pachegaon   </option>
									<option value="Pachegaon (BK)  "> Pachegaon (BK)   </option>
									<option value="Pare  "> Pare   </option>
									<option value="Rajuri  "> Rajuri   </option>
									<option value="Sangewadi  "> Sangewadi   </option>
									<option value="Sangola  "> Sangola   </option>
									<option value="Save  "> Save   </option>
									<option value="Shetphal  "> Shetphal   </option>
									<option value="Shirbhavi  "> Shirbhavi   </option>
									<option value="Shivane  "> Shivane   </option>
									<option value="Sonand  "> Sonand   </option>
									<option value="Udanwadi  "> Udanwadi   </option>
									<option value="Wadhegaon  "> Wadhegaon   </option>
									<option value="Watambre  "> Watambre   </option>
									<option value="Yelmarmangewadi  "> Yelmarmangewadi   </option>
								</select>
							</td>
							<td>
								<select class="form-controls" name="pincode[]" id="pincode1" pattern="[0-9]{6}">
								</select>
							</td>
							<td>
								<input type="text" id="villagenameid1" name="villagename[]" value="" pattern="[A-Za-z ]+" onkeyup="copytext(this.value,this.id)" onkeydown="upperCaseF(this)" onchange="cityname(this.id)" required="">
							</td>
							<td>
								<input type="text" id="villagenamemarathi1" name="villagenamemarathi[]" value="" required="">
							</td>
							<td>
								<input type="text" name="latitude[]" pattern="-?\d{1,3}\.\d+" value="" required="">
							</td>
							<td>
								<input type="text" name="longitude[]" pattern="-?\d{1,3}\.\d+" value="" required="">
							</td>
							<td>
								<input type="text" name="zone[]" onkeydown="upperCaseF(this)" value="">
							</td>
							<td>
								<input type="text" name="routeno[]" onkeydown="upperCaseF(this)" value="" required="">
							</td>
							<td>
								<input type="text" name="routenoakl[]" value="" required="">
							</td>
							<td>
								<input type="text" name="deldepot[]" onkeydown="upperCaseF(this)" value="" required="">
							</td>

							<td>
								<input type="text" name="statehighway[]" onkeydown="upperCaseF(this)" value="" required="">
							</td>
							<td>
								<input type="text" name="nationalhighway[]" onkeydown="upperCaseF(this)" value="" required="">
							</td>
							<td>
								<input type="checkbox" name="active[]" id="active" value="1" onclick="check(this.id)" checked="">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="button" class="btn btn-outline-dark btn-fw" onclick="add_row()" value="AddRow">
			<button type="submit" class="btn btn-outline-dark btn-fw" name="submit">Save</button>
		</form></div>