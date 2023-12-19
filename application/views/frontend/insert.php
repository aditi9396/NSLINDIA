
<form method ="POST" action="<?= base_url() ?>News/savedata">
	<table width="600" border="1" cellspacing="5" cellpadding="5">
		<tr>
			<td width="230">First Name</td>
			<td width="239"><input type="text" name="student_name"/></td>
		</tr>
		<tr>
			<td width="230">address</td>
			<td width="239"><input type="text" name="student_address"/></td>
		</tr>
		<tr>
			<td width="230">Mobile No</td>
			<td width="239"><input type="number" name="mobile_no"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="save" value="save data"></a></td>
		</tr>
	</table>
</form>
