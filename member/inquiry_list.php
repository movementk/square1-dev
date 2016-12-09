<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php');
if($is_guest) GetAlert("로그인 후 이용하시기 바랍니다.","/member/login.php?URI=".urlencode($_SERVER['PHP_SELF']));
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/member.css">
</head>
<body class="sub member mypage">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>회원전용</small>MEMBERSHIP</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의<br class="visible-xs">
					라이프 스타일 공간입니다.<br class="hidden-xs"> FASHION · F&amp;B · CGV <br class="visible-xs">
					<span class="hidden-xs"> · </span>HOME PLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
				<h2>1:1 문의현황</h2>
				<hr>
				<p>
					고객님께서 Q&amp;A에 올려주신 소중한 의견을 확인 하실 수 있습니다.
				</p>
				<div class="snb">
					<div class="container">
						<button class="btn btn-block" type="button">
							1:1 문의현황
						</button>
						<nav>
							<ul>
								<li><a href="/member/edit_form.php">회원정보 수정</a></li>
								<li><a href="/member/mypoint.php">마이포인트</a></li>
								<li class="active"><a href="/member/inquiry_list.php">1:1 문의</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="inquiry-list">
					<div class="inquiry-content">
						<div class="search-form">
							<form name="search_form" action="" method="get">
								<div class="form-group">
									<select class="form-control" name="sT">
										<option value="Title">제목</option>
										<option value="Content" <?=$_GET["sT"]=="Content"?"selected":""?>>내용</option>
									</select>
									<label for="search-keyword" class="sr-only">검색어</label>
									<input id="search-keyword" type="text" class="form-control" name="sF" value="<?=$_GET['sF']?>">
								</div>
								<button type="submit" class="btn">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</form>
						</div>
						<?
						$mode = $site_prefix."board_qna";
						$BoardName = "qna";
						$PageBlock   = 5;  //넘길 페이지 갯수
						if(!$board_list_num) $board_list_num = 5;                     //게시판 게시글 수
						$TotalSQL = "select * from ".$mode." where Notice != '1' and UserID = '".$member["UserID"]."'";
						if($sF && $sT){
							$TotalSQL .= " AND ".$sT." like '%".$sF."%'";
							$is_search = true;
						}
						$TotalSQL.= "order by RegDate desc, Ref desc, ReLevel asc, ReStep asc";
						$TotalResult = mysql_query($TotalSQL);
						$TotalCount  = mysql_num_rows($TotalResult);

						$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
						if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
						$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

						$SQL = $TotalSQL." limit $from_record, $board_list_num";
						$Result      = mysql_query($SQL);
						$Count       = mysql_num_rows($Result);

						$new_img = "&nbsp;<img src=\"/image/board_img/new_icon.gif\" align=\"absmiddle\" >";

						$searchVal = "Category=".urlencode($Category)."&sF=".$sF."&sT=".$sT."&workType=".$workType."&mode=".$mode;

						$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&page=");

						?>
						<div class="table-wrap">
							<table class="table table-bordered notice-table">
								<thead>
									<tr>
										<th>번호</th>
										<th>제목</th>
										<th>작성일</th>
										<th>조회수</th>
									</tr>
								</thead>
								<tbody>
									<?
									$nsql = " select * from ".$mode." where Notice = '1' order by BoardIdx desc ";
									$nresult = sql_query($nsql);
									for($i=0;$nrow = sql_fetch_array($nresult);$i++){
										$Title = $nrow[Title];
										$Title = cut_string($Title, 120);
										$wdate = $nrow["RegDate"];
										$today		= date("Y-m-d H:i:s");
										$chk		= strtotime($today) - strtotime($wdate);			
										$chk_new	= (60 * 60 * 24) * 1;
										if(($chk_new - $chk)>0){
											$new_ck = true;
										}
										$auth_link = '<a href="'.$_SERVER["PHP_SELP"].'?board_code=board_view&board_idx='.$nrow["BoardIdx"].'&page='.$page.'&'.$searchVal.'">';
										$list_href = $auth_link;
										
										if($new_ck) echo $new_img;
										echo $secret_img;

										$nrow["files"] = get_file($mode,$nrow["BoardIdx"]);
										if($nrow["files"]["count"] > 0){
											$nrow["img"] = $nrow["files"][0]["path"]."/".$nrow["files"][0]["file_soruce"];
										} else {
											$nrow["img"] = "/assets/images/promotional/promote_no_img.jpg";
										}
									?>
									<tr>
										<td>[공지]</td>
										<td class="t-content"><?=$list_href.$Title?></a></td>
										<td class="date"><?=substr($nrow["RegDate"],0,10)?></td>
										<td><?=number_format($nrow["ReadNum"])?></td>
									</tr>
									<?
									}
									$num = $TotalCount - ($page-1)*$board_list_num;
									for($i=0;$row = sql_fetch_array($Result);$i++){
										$Title = $row[Title];
										$Title = cut_string($Title, 120);
										
										$str="";
										$wdate = $row["RegDate"];
										$today		= date("Y-m-d H:i:s");
										$chk		= strtotime($today) - strtotime($wdate);			
										$chk_new	= (60 * 60 * 24) * 1;
										if(($chk_new - $chk)>0){
											$new_ck = true;
										}

										$c_sql = " select count(*) as cnt from ".$CommentName." where DBName = '".$mode."' and BoardIdx = '".$row[BoardIdx]."' ";
										$c_row = sql_fetch($c_sql);
										$Comment_count = $c_row[cnt];
										$img = "";

										if($row[Secret]){
											$secret_img = '<img style="margin-left:5px;" src="/images/community/icon_secret.gif" alt="Secret" />';
										} else {
											$secret_img = "";
										}

										$username = $row["UserName"];

										$auth_link = '<a href="inquiry_view.php?board_idx='.$row["BoardIdx"].'&page='.$page.'&'.$searchVal.'">';
										$pwd_link = "<a href=\"javascript:pwd_ck('".$row[BoardIdx]."');\">";

										if($secret_img){
											if(!$is_admin && !$is_manager){
												if(!empty($row["UserID"]) && $member["UserID"] == $row["UserID"]) $list_href = $auth_link;
												else {
													$list_href = $pwd_link;
													$osql = " select * from ".$mode." where Ref = '".$row["Ref"]."' and ReLevel = 0 ";
													$orow = sql_fetch($osql);
													if($row["ReLevel"] > 0 && $member["UserID"] == $orow["UserID"]){
														$list_href = $auth_link;
														if($is_guest) $list_href = $pwd_link;
													}
												}
											} else {
												$list_href = $auth_link;
											}
										} else {
											$list_href = $auth_link;
										}

										$row["files"] = get_file($mode,$row["BoardIdx"]);
										if($row["files"]["count"] > 0){
											$row["img"] = $row["files"][0]["path"]."/".$row["files"][0]["file_source"];
										} else {
											$row["img"] = "/assets/images/promotional/promote_no_img.jpg";
										}
									?>
									<tr>
										<td><?=$num?></td>
										<td class="t-content"><?=$list_href?>[<?=$row["Category"]?>] <?=$Title?></a></td>
										<td class="date"><?=substr($row["RegDate"],0,10)?></td>
										<td><?=number_format($row["ReadNum"])?></td>
									</tr>
									<?
										$num--;
									}

									if($Count == 0){ echo "<tr><td colspan='5' style='text-align:center;padding:100px 0px;'>게시물이 없습니다</td></tr>"; }
									?>
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation" class="paging">
							<ul class="pagination">
								<?
								if($Count>0){
									echo $write_pages;
								}
								?>
							</ul>
						</nav>
					</div>    
				</div>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>