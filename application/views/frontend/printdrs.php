<center>
	<?php  
		$arr_segment = $this->uri->segment_array();
		$last_segment = array_slice($arr_segment, 1);
		$str_segment = implode('/',$last_segment);
	?>
	<p style="color:blue; font-size: 25px;">DRS NO.<?php echo $str_segment;?> created sucessfully </p> 
</center>
<center>
<p>Consolidated Eway Bill Status: NO Eway Bill No. found in given LR List for Consolidated E-Way Bill Generation</p>
 <input type="button" value="ok" onclick="window.open(base_url+'printdrsdemo?DRSNO=<?php echo $str_segment;?> ', '_blank', 'width=1200,height=600');">
</center>