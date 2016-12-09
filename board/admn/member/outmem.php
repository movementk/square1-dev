<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>:::관리자페이지:::</title>
	<link href="/admin/css/basic.css" type="text/css" rel="stylesheet">
	<script src="/admin/js/link.js" type="text/javascript" language="javascript"></script>
</head>

	<body>
		<div id="sub">
			<div class="wrap mt160">
				<div id="container">

					<!--top-->
					<div id="top">

						<!--관리자 상태정보창-->
						<div class="infobox">
							<h1 class="mt20 ml15"><img src="/admin/images/common/logo.png"></h1>
							<img src="/admin/images/common/last_date.png" class="mt20 ml45">
							<p>2013 - 01 - 28</p>
							<div class="mt10 ml15 btn">
								<input type="image" src="/admin/images/common/home_btn.png">
								<input type="image" src="/admin/images/common/logout_btn.png">
							</div>
						</div>
						<!--관리자 상태정보창-->

						<!--메뉴-->
						<div class="menu">
							<img src="/admin/images/common/sentence.png" class="pl20">
							<ul class="mt20">
								<li>
									<a href="javascript:;" onclick="gf_goUrl('101')">
										<img src="/admin/images/menu/m1<?=$t101?>.png"
										onmouseover='this.src="/admin/images/menu/m1_on.png"' 
										onmouseout='this.src="/admin/images/menu/m1<?=$t101?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('201')">
										<img src="/admin/images/menu/m2<?=$t201?>.png"
										onmouseover='this.src="/admin/images/menu/m2_on.png"' 
										onmouseout='this.src="/admin/images/menu/m2<?=$t201?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('301')">
										<img src="/admin/images/menu/m3<?=$t301?>.png"
										onmouseover='this.src="/admin/images/menu/m3_on.png"' 
										onmouseout='this.src="/admin/images/menu/m3<?=$t301?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('401')">
										<img src="/admin/images/menu/m4<?=$t401?>.png"
										onmouseover='this.src="/admin/images/menu/m4_on.png"' 
										onmouseout='this.src="/admin/images/menu/m4<?=$t401?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('501')">
										<img src="/admin/images/menu/m5<?=$t501?>.png"
										onmouseover='this.src="/admin/images/menu/m5_on.png"' 
										onmouseout='this.src="/admin/images/menu/m5<?=$t501?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('601')">
										<img src="/admin/images/menu/m6<?=$t601?>.png"
										onmouseover='this.src="/admin/images/menu/m6_on.png"' 
										onmouseout='this.src="/admin/images/menu/m6<?=$t601?>.png"'>
									</a>
								</li>
							</ul>
						</div>
						<!--메뉴-->
					</div>
					<!--top-->

					<!--bottom-->
					<div id="bottom">

						<!--left메뉴-->
						<div class="left">
							<ul>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('501')">
										<img src="/admin/images/menu/m5s1<?=$t501?>.png"
										onmouseover='this.src="/admin/images/menu/m5s1_on.png"' 
										onmouseout='this.src="/admin/images/menu/m5s1<?=$t501?>.png"'>
									</a>
								</li>
								<li>
									<a href="javascript:;" onclick="gf_goUrl('502')">
										<img src="/admin/images/menu/m5s2<?=$t502?>.png"
										onmouseover='this.src="/admin/images/menu/m5s2_on.png"' 
										onmouseout='this.src="/admin/images/menu/m5s2<?=$t502?>.png"'>
									</a>
								</li>
								<li></li>
							</ul>
						</div>
						<!--left메뉴-->

						<!--컨텐츠-->
						<div class="right">
							<!--순서네비-->
							<ul class="ordernavi mt20 mr10 floatR">
								<li><a href="#">관리자설정</a></li>
								<li> > 이용약관</li>
							</ul>
							<!--순서네비-->
							
							<!--내용-->
							<div class="contents">
								<h2><img src="/admin/images/title/m5s2_title.gif"></h2>
								<table class="tb02 mt15">
									<colgroup>
										<col width="10%">
										<col width="10%">
										<col width="15%">
										<col width="15%">
										<col width="20%">
										<col width="15%">
										<col width="15%">
									</colgroup>
									<tr>
										<th>구분</th>
										<th>아이디</th>
										<th>비밀번호</th>
										<th>이름</th>
										<th>마지막접속일</th>
										<th>등록일</th>
										<th width="140">관리</th>
									</tr>
									<tr>
										<td>일반</td>
										<td>abcde</td>
										<td>1111</td>
										<td>홍길동</td>
										<td>2013-01-28</td>
										<td>2013-01-28</td>
										<td>
											<input type="image" src="/admin/images/btn/modify_btn.gif">
											<input type="image" src="/admin/images/btn/detail_btn.gif">
										</td>
									</tr>
									<tr>
										<td>일반</td>
										<td>abcde</td>
										<td>1111</td>
										<td>홍길동</td>
										<td>2013-01-28</td>
										<td>2013-01-28</td>
										<td>
											<input type="image" src="/admin/images/btn/modify_btn.gif">
											<input type="image" src="/admin/images/btn/detail_btn.gif">
										</td>
									</tr>
									<tr>
										<td>일반</td>
										<td>abcde</td>
										<td>1111</td>
										<td>홍길동</td>
										<td>2013-01-28</td>
										<td>2013-01-28</td>
										<td>
											<input type="image" src="/admin/images/btn/modify_btn.gif">
											<input type="image" src="/admin/images/btn/detail_btn.gif">
										</td>
									</tr>
								</table>

								<div class="paging mt10">
									<ul>
										<li><a href="#"><img src="/admin/images/common/start_btn.gif"></a></li>
										<li><a href="#"><img src="/admin/images/common/prev_btn.gif"></a></li>
										<li><a href="#" class="now">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"><img src="/admin/images/common/next_btn.gif"></a></li>
										<li><a href="#"><img src="/admin/images/common/end_btn.gif"></a></li>
									</ul>
								</div>
								<div class="mt5 mr10 btn"><input type="image" src="/admin/images/btn/regist_btn.gif"></div>
								<div class="search">
									<select class="middle">
										<option value="이름">이름</option>
										<option value="제목">제목</option>
										<option value="내용">내용</option>
									</select>
									<input type="text" id="search_string" name="search_string" value="" class="wd100 input">
									<input type="image" src="/admin/images/btn/search_btn.gif">
								</div>
							</div>
							<!--내용-->

						</div>
						<!--컨텐츠-->

					</div>
					<!--bottom-->

				</div>
			</div>
			<div id="footer">
				<div class="con">
					<p class="logo"><img src="/admin/images/common/footer_logo.png" class="mt10 ml15"></p>
					<p class="add">
						개인정보등등 모든관리책임자 : 정규정 ☎ : 010-6332-9327 / 서울시 중구 중림동 새마을금고 B/D 3층<br>
						Copyright ⓒ 2012 Movement k. All rights reserved.
					</p>
				</div>
			</div>
		</div>
	</body>

</html>