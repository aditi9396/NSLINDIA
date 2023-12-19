<style type="text/css">
	h2{
		margin-top: 9%;
	}
	h2,p{
		text-align: center;
	}
	.login-form {
		color: #000;
		margin: 0 auto;
	}
	.login-container {
		text-align: center;
		width: 100%;
		max-width: 500px;
		margin: auto;=
		padding: 20px;
		color: #FFFFFF;
		box-sizing: border-box;
	}
	.form-table td {
		padding: 10px;
	}
</style>
<h2>VTC3PL Attendance</h2>
<p>Enter Your Username and Password</p>
<div class="login-container">
	<form action="" method="post" id="formLoginAttendence" class="login-form">
		<fieldset>
			<table class="form-table">
				<tbody>
					<tr>
						<td>UserName</td>
						<td>:</td>
						<td><input type="text" name="UserName" onkeyup="this.value = this.value.toUpperCase();"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td colspan="3">
							<input class="btn-login" id="btnLoginAttendence" type="submit" value="LOGIN">
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
</div>