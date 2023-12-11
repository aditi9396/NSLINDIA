<table width="600" border="0" cellspacing="5" cellpadding="5">
  <tr style="background:#CCC">
    <th>Sr No</th>
    <th>First_name</th>
    <th>Address</th>
    <th>Mobile NO</th>
  </tr>
  <?php
  $id=1;
  foreach($data as $row)
  {
  echo "<tr>";
  echo "<td>".$id."</td>";
  echo "<td>".$row->student_name."</td>";
  echo "<td>".$row->student_address."</td>";
  echo "<td>".$row->mobile_no."</td>";
  echo "</tr>";
  $i++;
  }
   ?>