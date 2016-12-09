<?

$header.= "From: ".$company_name." <".$adminmail.">\n"; 
$header.= "Return-Path: ".$adminmail." \n";  
$header.= "Content-Type: text/html; charset=utf-8"; 

$content = "

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>$subject</title>
<link href='$siteurl/config/css/popup.css' rel='stylesheet' type='text/css'>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
	<td height='15'><a href='$siteurl'><img src='$siteurl/config/mail/top_sub_logo.jpg'></a> </td>
</tr>
<tr>
  <td height='15' align='center'>
    <table width='550' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td height='30' colspan='2'>&nbsp;</td>
      </tr>
      <tr>
        <td width='25' height='5'><img src='$siteurl/config/mail/icon_01.gif' width='18' height='18'></td>
        <td width='525' align='left'>$subject</td>
      </tr>
      <tr>
        <td height='5' colspan='2'>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='2' align='left'><img src='$siteurl/config/mail/mail_01.jpg'></td>
      </tr>
      <tr>
        <td height='300' colspan='2' align='center' background='$siteurl/config/mail/mail_bg.jpg'>
		
								$table_content


		</td>
      </tr>
      <tr>
        <td colspan='2' align='left'><img src='$siteurl/config/mail/mail_02.jpg'></td>
      </tr>
      <tr>
        <td height='20' colspan='2'>&nbsp;</td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td height='30'><img src='$siteurl/image/bottom_img/bottom_sub_txt.gif'></td>
</tr>
</table>
</map></body>
</html>";


mail($Email,$subject,$content,$header);
 

?>