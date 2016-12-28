<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s01 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store category">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>매장안내</small>SQUARE1 GUIDE</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의 라이프 스타일 공간입니다.<br>
					FASHION · F&amp;B · CGV · HOMEPLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s01 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb2.php');
			?>
			<div class="page-header">
				<h1><span class="square1">SQUARE<i>1</i></span> 카테고리별 안내</h1>
			</div>
			<!-- 컨텐츠 영역 -->
			<div class="page-summary">
				<div class="container">
					<h3>FASHION · F&amp;B · CGV · HOMEPLUS 등의 <br class="hidden-xs">다양한 서비스를 경험해 보세요</h3>
					<p>
						스퀘어원 매장 카테고리별 안내 입니다.
					</p>
				</div>
			</div>
			<div class="search-form">
				<form name="searchForm" method="get">
					<div class="form-group">
						<select class="form-control" name="sF">
							<option value="">전체</option>
							<option value="name" <?=$_GET["sF"]=="name"?"selected":""?>>매장명</option>
							<option value="number" <?=$_GET["sF"]=="number"?"selected":""?>>전화번호</option>
						</select>
						<label for="store-search-keyword" class="sr-only">검색어</label>
						<input id="store-search-keyword" type="text" class="form-control" name="sT" value="<?=$_GET["sT"]?>" />
					</div>
					<button type="submit" class="btn">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</form>
			</div>
			<div class="category-tabs">
				<div class="container">
					<button class="btn btn-block" type="button">
						ALL
					</button>
					<nav>
						<ul>
							<li class="<?=$Category==""?"active":""?>"><a href="<?=$_SERVER["PHP_SELF"]?>">ALL</a></li>
							<?
							$sql = " select * from ".$site_prefix."board_setting where BoardName = 'store' ";
							$row = sql_fetch($sql);
							$catAr = explode("|",$row["Category"]);
							for($i=0;$i<sizeof($catAr);$i++){
								if($catAr[$i] == "퇴점") continue;
							?>
							<li class="<?=$Category==$catAr[$i]?"active":""?>"><a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode($catAr[$i])?>"><?=$catAr[$i]?></a></li>
							<?
							}
							?>
						</ul>
					</nav>
				</div>
			</div>
			<div class="store-list category-list">
				<div class="container">
					<ul class="row" id="brand_ul">
						<?
						$mode = $site_prefix."board_store";
						$BoardName = "store";
						$fileURL = "../board/upload/".$BoardName."/";

						$thmPath = $dir."/upload/".$BoardName."/thumbs/";

						$dir_ck = is_dir($thmPath);

						if($dir_ck != "1"){
							if(!@mkdir("$thmPath", 0707)){ echo "디렉토리 생성실패"; exit;}
							if(!@chmod("$thmPath", 0707)){ echo "퍼미션변경 실패"; exit;}
						}

						include_once($dir."/config/skin.lib.php");

						if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

						$thumb_width = 198;
						$thumb_height = 80;

						if($sF){
							switch($sF){
								case "name":
									$sql_common = " and Title like '%".$sT."%' ";
									break;
								case "number":
									$sql_common = " and bd2 like '%".$sT."%' ";
									break;
							}
						} else {
							if($sT){
								$sql_common = " and (Title like '%".$sT."%' or bd2 like '%".$sT."%') ";
							}
						}
						if($Category){
							$sql_common .= " and Category = '".$Category."' ";
						}

						$tsql = " select count(*) as cnt from ".$site_prefix."board_store where Category != '퇴점' $sql_common ";
						$trow = sql_fetch($tsql);

						$sql = " select * from ".$site_prefix."board_store where Category != '퇴점' $sql_common order by BoardIdx desc limit 0, 6 ";
						$result = sql_query($sql);
						for($i=0;$row = sql_fetch_array($result);$i++){
							$row["files"] = get_file($mode,$row["BoardIdx"]);
							switch($row["files"][0]["image_type"]){
								case 1:
								case 2:
								case 3:
									if(file_exists($fileURL."/thumbs/".$row["files"][0][file_source])){
										$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
									} else {
										if($row["files"][0]["image_width"] <= $thumb_width && $row["files"][0]["image_height"] <= $thumb_height){
											$row["img"] = "<img src='/board/upload/".$BoardName."/".$row["files"][0][file_source]."' class='img-responsive'>";
										} else {
											$row["img"] = makeThumbs($fileURL, $row["files"][0][file_source], $thumb_width, $thumb_height, $thmPath,"");
											$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
										}
									}
									break;
								case 6:
									$row["img"] = "<img src='".$row["files"][0]["path"]."/thumbs/".$row["files"][0][file_source]."' class='img-responsive'>";
									break;
								default:
									$row["img"] = "<img src='/assets/images/introduce/brand_logo01.jpg' class='img-responsive'/>";
							}

							switch($row["bd1"]){
								case "0":
									$floor = "B1";
									break;
								case "1":
								case "2":
								case "3":
								case "4":
								case "5":
								case "6":
								case "7":
									$floor = $row["bd1"]."F";
									break;
							}
						?>
						<li class="col-xs-12 col-sm-6">
							<div class="category-item">
								<div class="row">
									<div class="col-xs-6">
										<div class="figure">
											<p>
												<?=$row["img"]?>
											</p>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="details">
											<dl>
												<dt><?=$row["Title"]?></dt>
												<dd class="c-tel">
													<i class="icon-phone"></i>
													<? if($is_mobile){ ?>
													<a href="tel:<?=$row["bd2"]?>"><?=$row["bd2"]?></a>
													<? } else { ?>
													<?=$row["bd2"]?>
													<? } ?>
												</dd>
												<dd class="c-clock">
													<i class="icon-clock"></i><?=$row["bd3"]?>
												</dd>
												<dd class="c-floor">
													<i class="icon-location"></i><?=$floor?>
												</dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?
						}
						?>
					</ul>
				</div>
				<? if($trow["cnt"] > $i){ ?>
				<div class="btn-area">
					<p>
						<a href="javascript:;" class="btn btn-orange" role="button" id="storeLoad">더보기</a>
					</p>
				</div>
				<? } ?>
			</div>
			<!-- // 컨텐츠 영역 -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script>
		(function($) {
			var page = 1;
			var isLoad = false;

			$(document).on('click', '#content .category-tabs .btn', function() {
				$('#content .category-tabs').toggleClass('open');
			});

			$(document).on("click", "#storeLoad", function(){
				if(isLoad == false){
					isLoad = true;
					jQuery.ajax({
						url: "ajax_store.php",
						type: 'POST',
						data: "page="+page+"&sF=<?=$sF?>&sT=<?=urlencode($sT)?>&Category=<?=urlencode($Category)?>",

						error: function(xhr,textStatus,errorThrown){
							alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
						},
						success: function(data){
							$("#brand_ul").append(data);
						},
						complete: function(){
							page++;
							isLoad = false;
							if((page * 6) >= <?=$trow["cnt"]?>){
								$("#storeLoad").hide();
							}
						}
					});
				}
			});
			
			// 컨텐츠 영역으로 바로 스크롤
			if ($(document).width() > 768) {
				$(window).scrollTop($('#content').offset().top - $('#gnb').height());
			} else {
				$(window).scrollTop($('#content').offset().top - $('#top-nav').height());
			}
		})(jQuery);
	</script>
	
</body>
</html>