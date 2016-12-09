<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";

//print_r2($_REQUEST);

//echo $sel_id;

$sql = " select * from ".$site_prefix."category where ca_id like '".$ca_id."__' order by ca_order asc ";
$result = sql_query($sql);
?>
<select name="bd2">
	<option value=''>선택</option>
	<?
	for($i=0;$row = sql_fetch_array($result);$i++){
		if($row["ca_id"] == $sel_id) $csel = "selected";
		else $csel = "";
		echo "<option value='".$row["ca_id"]."' $csel>".$row["ca_name"]."</option>";
	}
	?>
</select>