<div id="header">
	<ul>
		<li class="head_logo"><img src="/board/admn/images/mk_logo.gif"></li>
		<li class="head_btn">
			<button type="button" class="btn_a_n" onclick="window.open('about:blank').location.href = '/';">홈페이지 바로가기</button>
			<!--button type="button" class="btn_a_b">정보수정</button-->
			<button type="button" class="btn_a_b" onclick="admin_logout();">로그아웃</button>
		</li>
	</ul>
</div>

<div id="navigation_top">
	<div class="navi_tab">
		<ul>
			<li class="top_menu"><a href="/board/admn/main.php" class="<?=$t000?>">관리자홈</a></li>
			<li class="top_menu"><a href="javascript:;" onclick="gf_goUrl('101')" class="<?=$t100?>">홈페이지관리</a></li>
			<li class="top_menu"><a href="javascript:;" onclick="gf_goUrl('201')" class="<?=$t200?>">게시판관리</a></li>
			<? if($member_use){ ?>
			<li class="top_menu"><a href="javascript:;" onclick="gf_goUrl('401')" class="<?=$t400?>">회원관리</a></li>
			<? } ?>
			<li class="top_menu"><a href="javascript:;" onclick="gf_goUrl('500')" class="<?=$t500?>">접속통계</a></li>
		</ul>
	</div>
	<div class="top_info"><strong><?=$admin["admin_name"]?></strong>님으로 로그인되었습니다.</div>
	<div class="top_bottom"></div>
</div>