<?
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=memberlist".date("YmdHis").".xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir."/config/common_top.php";

$mode = $site_prefix."member";

$sql = "select * from ".$mode." where 1=1 $sql_common order by idx asc ";
$result = sql_query($sql);
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr>
		<td width="200" align="center" bgcolor="eff1ee">아이디</td>
		<td width="100" align="center" bgcolor="eff1ee">이름</td>
		<td width="250" align="center" bgcolor="eff1ee">이메일</td>
		<td width="150" align="center" bgcolor="eff1ee">생년월일</td>
		<td width="50" align="center" bgcolor="eff1ee">성별</td>
		<td width="150" align="center" bgcolor="eff1ee">전화번호</td>
		<td width="150" align="center" bgcolor="eff1ee">핸드폰번호</td>
		<td width="500" align="center" bgcolor="eff1ee">주소</td>
	</tr>
	<?
	for($i=0;$row = sql_fetch_array($result);$i++){
		switch($row["Sex"]){
			case "M":
				$sex = "남자";
				break;
			default:
				$sex = "여자";
		}
	?>
	<tr>
		<td align="center"><?=$row["UserID"]?></td>
		<td align="center"><?=$row["UserName"]?></td>
		<td align="center"><?=$row["Email"]?></td>
		<td align="center"><?=date("Y-m-d",strtotime($row["BirthDay"]))?></td>
		<td align="center"><?=$sex?></td>
		<td align="center" style="mso-number-format:\@"><?=$row["Phone"]?></td>
		<td align="center" style="mso-number-format:\@"><?=$row["Mobile"]?></td>
		<td align="center">(<?=$row["ZipCode"]?>) <?=$row["Address1"]?> <?=$row["Address2"]?></td>
	</tr>
	<?
	}
	?>
</table> 