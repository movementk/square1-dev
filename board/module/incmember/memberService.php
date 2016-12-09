<!-- Content Begin -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="107" height="30"><a href="?workType=1"><img src="../images/members/tab01_<? if($workType==1 || $workType==""){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td width="106"><a href="?workType=2"><img src="../images/members/tab02_<? if($workType==2){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td width="106"><a href="?workType=3"><img src="../images/members/tab03_<? if($workType==3){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td width="106"><a href="?workType=4"><img src="../images/members/tab04_<? if($workType==4){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td width="106"><a href="?workType=5"><img src="../images/members/tab05_<? if($workType==5){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td width="106" style="background:url(../images/members/tab_bg.jpg) repeat-x;"><a href="?workType=6"><img src="../images/members/tab06_<? if($workType==6){echo "over";}else{echo "nor";}?>.jpg"></a></td>
					<td style="background:url(../images/members/tab_bg.jpg) repeat-x;"><a href="?workType=7"><img src="../images/members/tab07_<? if($workType==7){echo "over";}else{echo "nor";}?>.jpg"></a></td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
                                                
			 <? 
			if($workType==1 || $workType==""){
				$mode = "bum_map";
				include "../module/incmember/mypage_service_map.php";
			}else if($workType=="2"){
				$mode = "bum_property";
				$searchVal = "order_type=".$order_type."&align=".$align."&sF=".$sF."&sT=".$sT."&workType=".$workType."&mode=".$mode;
				if($board_code=="board_write"){ 
					include "../module/property/property_sell_form1.php";	
				}else{
					include "../module/incmember/mypage_service_property.php";
				}
			}else if($workType=="3"){
				if($user['Type']=="c"){
					include "../module/incmember/mypage_service_job_company.php";
				}else{
					include "../module/incmember/mypage_service_job.php";
				}
			}else if($workType=="4"){
				$mode = "bum_coupon";
				include "../module/incmember/mypage_service_coupon.php";
			}else if($workType=="5"){
				$mode = "bum_advertising";
				include "../module/incmember/mypage_service_ad.php";
			}else if($workType=="6"){
				$mode = "bum_banner";
				include "../module/incmember/mypage_service_banner.php";
			}else if($workType=="7"){
				$mode = "bum_company";
				$searchVal = "Category=".$Category."&order_type=".$order_type."&align=".$align."&sF=".$sF."&sT=".$sT."&workType=".$workType."&mode=".$mode;
				if($board_code=="" || $board_code=="board_list"){ include "../module/company_list.php";	}
				if($board_code=="board_view"){ include "../module/company_view.php";	}
				if($board_code=="board_write"){ include "../module/company_insert.php";	}
				?>
				<script type="text/javascript" src="../../config/map.js"></script>
				<?
			}
			 ?>
                                                
		
		</td>
	</tr>
</table>
<script>
	function extention(board_idx){
		var mode="<?=$mode?>";
		if(mode=="bum_map"){
		   location = "../module/map/map_issue_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}else if(mode=="bum_property"){
		   location = "../module/property/property_sell_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}else if(mode=="bum_coupon"){
		   location = "../module/coupon_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}else if(mode=="bum_advertising"){
		   location = "../module/advertising_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}else if(mode=="bum_banner"){
		   location = "../module/banner_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}else{
		   location = "../module/map/map_issue_ok.php?board_code=extension&mode=<?=$mode?>&Idx="+board_idx;
		}
	}
</script>
<!-- Content End -->
