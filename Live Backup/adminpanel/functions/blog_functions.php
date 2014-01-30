<?php

$GLOBALS['cfg'] = $cfg;

function getBlogsList($catName, $archiveId, $pageno=0, $limit=0) {
    // var_dump($GLOBALS['cfg']['db_prefix']);
    $extraQry = "";
	$limitQuery = "";
	// Prepare data for pagination
	if($pageno != 0) {
		$start = ($pageno - 1) * $limit;
		//$limitQuery = "";
	}else{
		$start = 0;
	}
	// Prepared
	
    if ($catName != "") {
        $catName = str_replace("-", " ", $catName);
        $extraQry = " AND t2.catName = '" . $catName . "'";
    }
    if ($archiveId != 0) {
        $archiveArry = explode("_", $archiveId);
        $blogYear = $archiveArry[0];
        $blogMonth = $archiveArry[1];
        $blogYearMonthStart = $blogYear . "-" . $blogMonth;
        $blogYearMonthEnd = $blogYear . "-" . $blogMonth . '31';
        $extraQry = " AND DATE_FORMAT( t1.add_date, '%Y-%m' ) = '" . $blogYearMonthStart . "'";
    }
    $sql = "select t1.*, t2.catName from " . $GLOBALS['cfg']['db_prefix'] . "blog as t1 JOIN " . $GLOBALS['cfg']['db_prefix'] . "blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 $extraQry ORDER BY t1.add_date DESC LIMIT $start, $limit";
    $query = mysql_query($sql);
    $blogLists = array();
    if (mysql_num_rows($query) == 0) {
        return false;
    } else {
        while ($row = mysql_fetch_assoc($query)) {
            $blogLists[] = $row;
        }
    }
    return $blogLists;
}

function getBlogsListCount($catName, $archiveId){
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
	$sql = "select t1.*, t2.catName from " . $GLOBALS['cfg']['db_prefix'] . "blog as t1 JOIN ".$GLOBALS['cfg']['db_prefix']."blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 $extraQry";
	$query = mysql_query($sql);
	$blogListsCount = mysql_num_rows($query);
	return $blogListsCount;
}

function getBlogsDetails($blogCat, $blogName) {
    $blogCat = str_replace("-", " ", $blogCat);
    $sql = "select t1.* from " . $GLOBALS['cfg']['db_prefix'] . "blog as t1 JOIN " . $GLOBALS['cfg']['db_prefix'] . "blog_category as t2 ON t1.categoryId = t2.id WHERE t2.catName = '$blogCat' AND blog_name = '$blogName' AND t1.status = 1";
    $query = mysql_query($sql);
    $blogDetailsData = array();
    if (mysql_num_rows($query) == 0) {
        return false;
    } else {
        while ($row = mysql_fetch_assoc($query)) {
            $blogDetailsData[] = $row;
        }
    }
    return $blogDetailsData;
}

function getRecentBlogsList() {
    $sql = "select t1.*, t2.catName from " . $GLOBALS['cfg']['db_prefix'] . "blog as t1 JOIN " . $GLOBALS['cfg']['db_prefix'] . "blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 ORDER BY t1.add_date DESC limit 7";
    $query = mysql_query($sql);
    $recentBlogLists = array();
    if (mysql_num_rows($query) == 0) {
        return false;
    } else {
        while ($row = mysql_fetch_assoc($query)) {
            $recentBlogLists[] = $row;
        }
    }
    return $recentBlogLists;
}

function getCategoryList($id = '') {
    $sql = "select count(*) as total, t2.catName, t2.id FROM " . $GLOBALS['cfg']['db_prefix'] . "blog as t1 JOIN " . $GLOBALS['cfg']['db_prefix'] . "blog_category as t2 ON t1.categoryId = t2.id WHERE t1.status = 1 GROUP BY t1.categoryId ORDER BY t2.catName";
    $query = mysql_query($sql);
    $catLists = array();
    while ($row = mysql_fetch_assoc($query)) {
        $catLists[] = $row;
    }
    return $catLists;
}

function getArchiveList() {
    $sql = "SELECT archiveDetails.* FROM ( SELECT DATE_FORMAT( add_date, '%Y' ) AS `year` , DATE_FORMAT( add_date, '%M' ) AS `monthName`, DATE_FORMAT( add_date, '%m' ) AS `monthNo` , COUNT( * ) AS `count` FROM " . $GLOBALS['cfg']['db_prefix'] . "blog WHERE status = 1 GROUP BY `year`, `monthName` order by `year` DESC, `monthNo` DESC ) AS archiveDetails";
    $query = mysql_query($sql);
    $archiveLists = array();
    while ($row = mysql_fetch_assoc($query)) {
        $archiveLists[] = $row;
    }
    return $archiveLists;
}

/* function getBlogCatName($id) {
  if (isset($id) && !is_null($id)) {
  $blogCatName = $this->getCategoryList($id);
  if (is_array($blogCatName)) {
  foreach ($blogCatName as $bCatname)
  return $bCatname['catName'];
  }
  }
  } */
  
  /******************* Pagination Starts ************************/
function pagination($limit,$pageNo,$totalBlogs,$targetPage){
	//$tblName = $tblName;
	$adjacents = 2;
	
	//$query = "SELECT COUNT(*) as num FROM $tblName";
	//$totalPages = mysql_fetch_array(mysql_query($query));
	$totalPages = $totalBlogs;
	
	$targetpage = $targetPage; 
	$limit = $limit;
	$pageno = $pageNo;
	
	if ($pageno == 0) $pageno = 1;
	$prev = $pageno - 1;			
	$next = $pageno + 1;			
	$lastpage = ceil($totalPages/$limit);
	$lpm1 = $lastpage - 1;
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= '<div class="pagination pagination-centered"><ul>';
		if ($pageno > 1) 
			$pagination.= '<li><a href="'.$targetpage.'/'.$prev.'">Prev</a></li>';
		else
			$pagination.= '<li class="disabled"><a href="#">Prev</a></li>';	
		
		if ($lastpage < 7 + ($adjacents * 2))
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $pageno)
					$pagination.= '<li class="active"><a href="#">'.$counter.'</a></li>';
				else
					$pagination.= '<li><a href="'.$targetpage.'/'.$counter.'">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($pageno < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $pageno)
						$pagination.= '<li class="active"><a href="#">'.$counter.'</a></li>';
					else
						$pagination.= '<li><a href="'.$targetpage.'/'.$counter.'">'.$counter.'</a></li>';
				}
				$pagination.= '<li><a href="#">..</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			elseif($lastpage - ($adjacents * 2) > $pageno && $pageno > ($adjacents * 2))
			{
				$pagination.= '<li><a href="'.$targetpage.'/'. 1 .'">1</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'. 2 .'">2</a></li>';
				$pagination.= '<li><a href="#">..</a></li>';
				for ($counter = $pageno - $adjacents; $counter <= $pageno + $adjacents; $counter++)
				{
					if ($counter == $pageno)
						$pagination.= '<li class="active"><a href="#">'.$counter.'</a></li>';
					else
						$pagination.= '<li><a href="'.$targetpage.'/'.$counter.'">'.$counter.'</a></li>';
				}
				$pagination.= '<li><a href="#">..</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'.$lpm1.'">'.$lpm1.'</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'.$lastpage.'">'.$lastpage.'</a></li>';
			}
			else
			{
				$pagination.= '<li><a href="'.$targetpage.'/'. 1 .'">1</a></li>';
				$pagination.= '<li><a href="'.$targetpage.'/'. 2 .'">2</a></li>';
				$pagination.= '<li><a href="#">..</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $pageno)
						$pagination.= '<li class="active"><a href="#">'.$counter.'</a></li>';
					else
						$pagination.= '<li><a href="'.$targetpage.'/'.$counter.'">'.$counter.'</a></li>';			
				}
			}
		}
		
		if ($pageno < $counter - 1) 
			$pagination.= '<li><a href="'.$targetpage.'/'.$next.'">Next</a></li>';
		else
			$pagination.= '<li class="disabled"><a href="#">Next</a></li>';	
		$pagination.= "</ul></div>";		
	}
	return $pagination;
}
/******************* Pagination Ends ************************/
?>