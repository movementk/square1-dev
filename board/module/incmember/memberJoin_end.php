<table width="560" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				  <td><img src="../images/bbs/bt01_nor.jpg"></td>
				  <td width="30" align="center"><img src="../images/bbs/step_arrow.jpg" /></td>
				  <td align="center"><img src="../images/bbs/bt02_nor.jpg"></td>
				  <td width="30" align="center"><img src="../images/bbs/step_arrow.jpg" /></td>
				  <td align="right"><img src="../images/bbs/bt03_over.jpg"></td>
			  </tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="150" align="center" valign="top"><img src="../images/bbs/join03_img.jpg"></td>
	</tr>
	<tr>
		<td align="center">
		
			<table width="560" border="0" align="center" cellpadding="0" cellspacing="0" class="textbox_nobg">
				<tr>
					<td height="2" bgcolor="#19aab9"></td>
				</tr>
				<tr>
					<td height="1" bgcolor="#e7e7e7"></td>
				</tr>
				<tr>
					<td align="center" style="padding:10px;">
					<font class="font_pink_b"><?=$_COOKIE["MemberName"]?></font> 님은 비유엠컴퍼니에 
					<font class="font_pink_b"><?=$UserID?></font>으로 비유엠컴퍼니 회원가입 되었습니다.<br>
					<br>
					<font class="font_pink_b"><?=$MemberEmail?></font>으로 메일이 발송되었습니다.<br>
					<? if($_COOKIE["MemberType"]=="c"){?>
						<!-- 메일로 보내진 메일을 읽고 메일인증확인을 하고<br> -->
						사업자등록증 사본을 비유엠컴퍼니 팩스로 또는 이메일 보내시면<br>
						로그인후 비유엠컴퍼니 사이트 이용을 하실수있습니다.<br>
						이메일 : <?=$adminmail?> / FAX : 02-000-0000<br>
					<? }else{?>
						비유엠컴퍼니 사이트 이용을 하실수있습니다.
					<? }?>
					
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#e7e7e7"></td>
				</tr>
				<tr>
					<td height="2" bgcolor="#19aab9"></td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td height="40" align="center" valign="bottom"><a href="../index.php"><img src="../images/bbs/btn_home.jpg"></a></td>
	</tr>
</table>
