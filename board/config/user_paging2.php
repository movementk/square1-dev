<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="95">
			<?
			if($spage > $spageblock ){
			?>
			<a href="<?=$_SERVER["PHP_SELP"]?>?<?=$ssearchVal?>&board_code=<?=$board_code?>&board_idx=<?=$BoardViewRow["BoardIdx"]?>&spage=<?=$sstart_for-$spageblock?>&sstart_page=<?=$sstart_page-1?>"><img src="<?=$pagebt2?>" align="absmiddle" /></a>
			<? } ?>
		</td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<?
					for($i=$sstart_for;$i<=$slast_for;$i++){
						if($i > $totalpage){
							continue;
						}
					?>
					<TD align="center" height="40" style="padding:2px;">
						<a href="<?=$_SERVER["PHP_SELP"]?>?<?=$ssearchVal?>&board_code=<?=$board_code?>&board_idx=<?=$BoardViewRow["BoardIdx"]?>&spage=<?=$i?>&sstart_page=<?=$sstart_page?>">
						<?
						if($spage == $i){
							echo "<font color='#ec7ea5'><strong>".$i."</strong></font>";
						}else{
							echo "<font color='#666666'>".$i."</font>";
						}
						?>
						</a>
					</td>
					<?
					}
					if(!$count || $spage == ""){
						echo "<TD align='center' height='40'><font color='#666666'><strong> 1 </strong></font></td>";
					}
					?>
				</tr>
			</table>
		</td>
		<td width="95">
			<?
			if($sstart_for+$spageblock <= $totalpage){
			?>
			<a href="<?=$_SERVER["PHP_SELP"]?>?<?=$ssearchVal?>&board_code=<?=$board_code?>&board_idx=<?=$BoardViewRow["BoardIdx"]?>&spage=<?=$sstart_for+$spageblock?>&sstart_page=<?=$sstart_page+1?>">&nbsp;&nbsp;<img src="<?=$pagebt3?>" align="absmiddle" /></a>
			<? } ?>
		</td>
	</tr>
</table>
