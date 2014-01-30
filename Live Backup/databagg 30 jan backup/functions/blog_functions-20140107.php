<?php
function getBlogsList($catName, $archiveId){
	$extraQry = "";
	if($catName != ""){
		$catName = str_replace("-"," ",$catName);
		$extraQry = " AND t2.catName = '".$catName."'";	
	}
	if($archiveId != 0){
		$archiveArry = explode("_",$archiveId);
		$blogYear = $archiveArry[0];
		$blogMonth = $archiveArry[1];
		$blogYearMonthStart = $blogYear."-".$blogMonth;
		$blogYearMonthEnd = $blogYear."-".$blogMonth.'31';
		$extraQry = " AND DATE_FORMAT( t1.add_date, '%Y-%m' ) = '".$blogYearMonthStart."'";	
	}
	$sql = "select t1.*, t2.catName from cms_tbl_blog as t1 JOIN tbl_blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 $extraQry ORDER BY t1.add_date DESC limit 3";
	$query = mysql_query($sql);
	$blogLists = array();
	if(mysql_num_rows($query) == 0){
		return false;
	}
	else{
		while($row = mysql_fetch_assoc($query)){
			$blogLists[] = $row;
		}
	}
	return $blogLists;
}

function getBlogsDetails($blogCat,$blogName){
	$blogCat = str_replace("-", " ", $blogCat);
	$sql = "select t1.* from cms_tbl_blog as t1 JOIN tbl_blog_category as t2 ON t1.categoryId = t2.id WHERE t2.catName = '$blogCat' AND blog_name = '$blogName' AND t1.status = 1";
	$query = mysql_query($sql);
	$blogDetailsData = array();
	if(mysql_num_rows($query) == 0){
		return false;
	}
	else{
		while($row = mysql_fetch_assoc($query)){
			$blogDetailsData[] = $row;
		}
	}
	return $blogDetailsData;
}

function getRecentBlogsList(){
	$sql = "select t1.*, t2.catName from cms_tbl_blog as t1 JOIN tbl_blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 ORDER BY t1.add_date DESC limit 7";
	$query = mysql_query($sql);
	$recentBlogLists = array();
	if(mysql_num_rows($query) == 0){
		return false;
	}
	else{
		while($row = mysql_fetch_assoc($query)){
			$recentBlogLists[] = $row;
		}
	}
	return $recentBlogLists;
}

function getCategoryList($id = '') {
	$sql = "select count(*) as total, t2.catName, t2.id FROM cms_tbl_blog as t1 JOIN tbl_blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 GROUP BY t1.categoryId ORDER BY t2.catName";
	$query = mysql_query($sql);
	$catLists = array();
	while($row = mysql_fetch_assoc($query)){
		$catLists[] = $row;
	}
	return $catLists;
}

function getArchiveList() {
	$sql = "SELECT archiveDetails.* FROM ( SELECT DATE_FORMAT( add_date, '%Y' ) AS `year` , DATE_FORMAT( add_date, '%M' ) AS `monthName`, DATE_FORMAT( add_date, '%m' ) AS `monthNo` , COUNT( * ) AS `count` FROM cms_tbl_blog WHERE status = 1 GROUP BY `year`, `monthName` order by `year` DESC, `monthNo` DESC ) AS archiveDetails";
	$query = mysql_query($sql);
	$archiveLists = array();
	while($row = mysql_fetch_assoc($query)){
		$archiveLists[] = $row;
	}
	return $archiveLists;
}

/*function getBlogCatName($id) {
	if (isset($id) && !is_null($id)) {
		$blogCatName = $this->getCategoryList($id);
		if (is_array($blogCatName)) {
			foreach ($blogCatName as $bCatname)
				return $bCatname['catName'];
		}
	}
}*/
?>