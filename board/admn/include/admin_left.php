<!--left메뉴-->
<div id="navigation_left">
	<div class="navi_box mt100">
		<div class="navi_homename">무브먼트케이</div>
	</div>
	<?
	switch($left){
		case "l0":
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">관리자홈</li>
			<li class="navi_menu"><a href="/board/admn" class="<?=$t001?>">관리자홈</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('101')">홈페이지관리</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('201')">게시판관리</a></li>
			<? if($member_use){ ?>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('401')">회원관리</a></li>
			<? } ?>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('501')">접속통계</a></li>
		</ul>
	</div>
	<?
			break;
		case "l1":
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">홈페이지관리</li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('101')" class="<?=$t101?>">정보설정</a></li>
			<? if($member_use){ ?>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('102')" class="<?=$t102?>">이용약관</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('103')" class="<?=$t103?>">개인정보취급방침</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('108')" class="<?=$t108?>">이메일무단수집거부</a></li>
			<? } ?>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('104')" class="<?=$t104?>">팝업관리</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('105')" class="<?=$t105?>">배너관리</a></li>
			<? if($category_use){ ?>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('106')" class="<?=$t106?>">분류관리</a></li>
			<? } ?>
			<?
			$blist = get_board_setting("");
			for($i=0;$i<sizeof($blist);$i++){
				$lb = "";
				if($blist[$i]["Idx"] == $bidx) $lb = "navi_mon";
				switch($blist[$i]["BoardName"]){
					case "lost":
					case "store":
					case "floor":
						$is_skip = false;
						break;
					default:
						$is_skip = true;
				}

				if($is_skip) continue;
			?>
			<li class="navi_menu"><a href="/board/admn/board/board.php?bidx=<?=$blist[$i]["Idx"]?>" class="<?=$lb?>"><?=$blist[$i]["BoardTitle"]?></a></li>
			<? } ?>
		</ul>
	</div>
	<?
			break;
		case "l2":
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">게시판관리</li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('201')" class="<?=$t201?>">정보설정</a></li>
			<?
			$blist = get_board_setting("");
			for($i=0;$i<sizeof($blist);$i++){
				$lb = "";
				if($blist[$i]["Idx"] == $bidx) $lb = "navi_mon";
				switch($blist[$i]["BoardName"]){
					case "lost":
					case "store":
					case "floor":
						$is_skip = true;
						break;
					default:
						$is_skip = false;
				}

				if($is_skip) continue;
			?>
			<li class="navi_menu"><a href="/board/admn/board/board.php?bidx=<?=$blist[$i]["Idx"]?>" class="<?=$lb?>"><?=$blist[$i]["BoardTitle"]?></a></li>
			<? } ?>
		</ul>
	</div>
	<?
			break;
		case "l4":
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">홈페이지관리</li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('401')" class="<?=$t401?>">회원관리</a></li>
		</ul>
	</div>
	<?
			break;
		case "l5":
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">홈페이지관리</li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('501')" class="<?=$t501?>">접속자수</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('502')" class="<?=$t502?>">페이지뷰</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('503')" class="<?=$t503?>">접근URL</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('504')" class="<?=$t504?>">유입URL</a></li>
			<li class="navi_menu"><a href="javascript:;" onclick="gf_goUrl('505')" class="<?=$t505?>">브라우저</a></li>
		</ul>
	</div>
	<?
			break;
		default:
	?>
	<div class="navi_box mt10">
		<ul>
			<li class="navi_title">관리자홈</li>
			<li class="navi_menu"><a href="/manager/main/main.html" class="navi_mon">관리자홈</a></li>
			<li class="navi_menu"><a href="/manager/homepage/home_info.html">홈페이지관리</a></li>
			<li class="navi_menu"><a href="/manager/member/member_list.html">회원관리</a></li>
			<li class="navi_menu"><a href="/manager/board/board_list.html">게시판관리</a></li>
			<li class="navi_menu"><a href="/manager/visit/visit_user.html">접속통계</a></li>
		</ul>
	</div>
	<?
	}
	?>
	<div class="navi_box mt10">
		<div class="navi_customer"><img src="/board/admn/images/mk_cscenter.gif"></div>
	</div>
	<div class="navi_copy mt10">
		Copyright(c) 2013 Movement K<br />
		Group.<br />
		All Right Reserved.<br />
	</div>
</div>
<!--left메뉴-->