<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

/*
M_NO = old_idx
M_ID = UserID
M_PASS = Password 
M_NAME = UserName
M_ENAME = NIckName
M_EMAIL = Email
M_BIRTH = srttotime(BirthDay)
M_SEX = 1 = M, 0 = F
M_PCSTYPE = MobileCompany
M_PCS = Mobile
M_TEL = Phone
M_CTEL = Fax
M_Z_SEQ = $zip_row = sql_fetch('select * from ZIPCODE where Z_SEQ = M_Z_SEQ');
		ZipCode = $zip_row["Z_ZIP"];
		Address1 = $zip_row["Z_SIDO"]." ".$zip_row["Z_GUGUN"]." ".$zip_row["Z_DONG"]." ".$zip_row["Z_BUNJI"];
M_ADDR = Address2
M_ZIP_OLD = m_zip_old
M_ADDR_OLD = m_addr_old
M_ADDRADD_OLD = m_addradd_old
M_SCHOOL = lastSchool1
M_MAJOR = lastSchool2
M_GYEAR = lastSchool3
M_JC_NO = job
M_JOBKIND = jobkind
M_ETC1 = '' //해외거주경력
M_TEST1 = test_type1 // 시험종류1
M_TEST2 = test_type2 // 시험종류2
M_TEST3 = test_type3 // 시험종류3
M_SCORE1 = test_grade1 //시험점수1
M_SCORE2 = test_grade2 //시험점수2
M_SCORE3 = test_grade3 //시험점수3
M_ETC2 = Content //지원동기
M_FLC_NO = m_flc_no //봉사언어
M_PC_NO = '' //선호분야
			switch(M_PC_NO){
				case 1:
					선택없음
					break;
				case 2:
					공항
					break;
				case 3:
					은행
					break;
				case 4:
					관광
					break;
				case 5:
					숙박
					break;
			}
M_BNOTIME = m_bnotime //봉사불가능시작시간
M_ENOTIME = m_enotime //봉사불가능종료시간
M_NODAY1 = '' //봉사불가능요일(월)
M_NODAY2 = '' //봉사불가능요일(화)
M_NODAY3 = '' //봉사불가능요일(수)
M_NODAY4 = '' //봉사불가능요일(목)
M_NODAY5 = '' //봉사불가능요일(금)
M_NODAY6 = '' //봉사불가능요일(토)
M_NODAY7 = '' //봉사불가능요일(일)
M_BNODATE = m_bnodate //봉사중지신청 시작일
M_ENODATE = m_enodate //봉사중지신청 종료일
M_FILEID = '' //회원사진 아이디?
M_FILENAME = mem_photo //회원사진명
M_FILESIZE = '' //회원사진 사이즈
M_SAVEDPATH = ''// '/board/upload/member/old_member' 회원사진 저장경로
M_GC_NO = m_gc_no //회원등급 (UserLevel은 회원/비회원/관리자구분용)
M_EMAILOK = ''
M_VIP = ''
M_MEMO = '' //비고? 메모란이었던거같은데 현재 미사용
M_CPASS = '' //이메일 인증번호? 인듯한데 신규사이트에서 필요없음
M_CSTATE = '' //이메일 인증여부
M_STATUS = Flag // 1 = 'Y' , 0 = 'N'
M_HDATE = strtotime(m_hdate)//봉사자 전환일
M_LDATE = strtotime(m_ldate)//??
M_DATE = JoinDate //가입일
M_STOP_REASON = '' //봉사중지 신청사유
m_testYY1 = test_year1 // 시험연도1
m_testYY2 = test_year2 // 시험연도2
m_testYY3 = test_year3 // 시험연도3
m_apply_path = join_route1 // 신청경로
			switch(m_apply_path){
				case "P01":
					온라인 광고
					break;
				case "P02":
					신문, 잡지등 오프라인 광고
					break;
				case "P03":
					지인소개
					break;
				case "P04":
					기타매체
					break;
				case "P05":
					bbb 협력 기업/기관 사내 안내
					break;
			}
m_apply_path_etc = join_route2 // 신청경로 기타텍스트
m_lang_motive = lan_reason // 언어를 익힌계기
			switch(m_lang_motive){
				case "M01":
					유학·파견등 해외체류
					break;
				case "M02":
					대학전공
					break;
				case "M03":
					독학
					break;
				case "M04":
					관련직 종사
					break;
				case "M05":
					기타
					break;
			}
m_lang_motive_etc = lan_reason_etc_txt // 언어를 익힌계기 기타 텍스트
m_dropReason = dropreason //탈퇴 사유
M_SGC_NO = m_sgc_no //특임여부
			switch(M_SGC_NO){
				case 12:
					특임
					break;
				case 13:
					비특임
					break;
			}
*/

//$sql = " select * from member_old where 1=1 order by M_NO asc limit 0, 5000 ";
//$sql = " select * from member_old where 1=1 order by M_NO asc limit 5000, 5000 ";
//$sql = " select * from member_old where 1=1 order by M_NO asc limit 10000, 5000 ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){

	switch($row["M_SEX"]){
		case "0":
			$sex = "F";
			break;
		case "1":
			$sex = "M";
			break;
		default:
			$sex = "M";
	}

	$ziprow = sql_fetch("select * from old_zip where Z_SEQ = '".$row["M_Z_SEQ"]."' ");
	$zipcode = $ziprow["Z_ZIP"];
	$Addresss1 = $ziprow["Z_SIDO"]." ".$ziprow["Z_GUGUN"]." ".$ziprow["Z_DONG"]." ".$ziprow["Z_BUNJI"];

	switch($row["M_STATUS"]){
		case "0":
			$flag = "N";
			break;
		case "1":
			$flag = "Y";
			break;
	}

	switch($row["m_apply_path"]){
		case "P01":
			$join_route1 = "온라인 광고";
			break;
		case "P02":
			$join_route1 = "신문, 잡지등 오프라인 광고";
			break;
		case "P03":
			$join_route1 = "지인소개";
			break;
		case "P04":
			$join_route1 = "기타매체";
			break;
		case "P05":
			$join_route1 = "bbb 협력 기업/기관 사내 안내";
			break;
	}

	switch($row["m_lang_motive"]){
		case "M01":
			$lan_reason = "유학·파견등 해외체류";
			break;
		case "M02":
			$lan_reason = "대학전공";
			break;
		case "M03":
			$lan_reason = "독학";
			break;
		case "M04":
			$lan_reason = "관련직 종사";
			break;
		case "M05":
			$lan_reason = "기타";
			break;
	}

	$isql = " insert into mk_member2 set
							old_idx = '".$row["M_NO"]."',
							UserID = '".$row["M_ID"]."',
							Password = '".sql_password($row["M_PASS"])."',
							old_pwd = '".$row["M_PASS"]."',
							UserName = '".$row["M_NAME"]."',
							NickName = '".$row["M_ENAME"]."',
							Email = '".$row["M_EMAIL"]."',
							BirthDay = '".strtotime($row["M_BIRTH"])."',
							Sex = '".$sex."',
							MobileCompany = '".$row["M_PCSTYPE"]."',
							Mobile = '".$row["M_PCS"]."',
							Phone = '".$row["M_TEL"]."',
							Fax = '".$row["M_CTEL"]."',
							ZipCode = '".$zipcode."',
							Address1 = '".$Address1."',
							Address2 = '".$row["M_ADDR"]."',
							m_zip_old = '".$row["M_ZIP_OLD"]."',
							m_addr_old = '".$row["M_ADDR_OLD"]."',
							m_addradd_old = '".$row["M_ADDRADD_OLD"]."',
							lastSchool1 = '".$row["M_SCHOOL"]."',
							lastSchool2 = '".$row["M_MAJOR"]."',
							lastSchool3 = '".$row["M_GYEAR"]."',
							job = '".$row["M_JC_NO"]."',
							jobkind = '".$row["M_JOBKIND"]."',
							test_type1 = '".$row["M_TEST1"]."',
							test_type2 = '".$row["M_TEST2"]."',
							test_type3 = '".$row["M_TEST3"]."',
							test_grade1 = '".$row["M_SCORE1"]."',
							test_grade2 = '".$row["M_SCORE2"]."',
							test_grade3 = '".$row["M_SCORE3"]."',
							Content = '".preg_replace("/\"/", "&#034;", get_text($row["M_ETC2"]))."',
							m_flc_no = '".$row["M_FLC_NO"]."',
							m_bnotime = '".$row["M_BNOTIME"]."',
							m_enotime = '".$row["M_ENOTIME"]."',
							m_bnodate = '".strtotime($row["M_BNODATE"])."',
							m_enodate = '".strtotime($row["M_ENODATE"])."',
							mem_photo = '".get_text($row["M_FILENAME"])."',
							m_gc_no = '".$row["M_GC_NO"]."',
							Flag = '".$flag."',
							m_hdate = '".strtotime($row["M_HDATE"])."',
							m_ldate = '".strtotime($row["M_LDATE"])."',
							JoinDate = '".strtotime($row["M_DATE"])."',
							m_stop_reason = '".preg_replace("/\"/", "&#034;", get_text($row["M_STOP_REASON"]))."',
							test_year1 = '".$row["m_testYY1"]."',
							test_year2 = '".$row["m_testYY2"]."',
							test_year3 = '".$row["m_testYY3"]."',
							join_route1 = '".$join_route1."',
							join_route2 = '".get_text($row["m_apply_path_etc"])."',
							lan_reason = '".$lan_reason."',
							lan_reason_etc_txt = '".get_text($row["m_lang_motive_etc"])."',
							dropreason = '".preg_replace("/\"/", "&#034;", get_text($row["m_dropReason"]))."',
							m_sgc_no = '".$row["M_SGC_NO"]."' ";
	$iresult = sql_query($isql);
}
?>