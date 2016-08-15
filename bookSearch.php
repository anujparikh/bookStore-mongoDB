<?php
include("commonFunctions.php");
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set("America/New_York");
$time = date("h:i:sa");
$uuid = uniqid();
urlDataInsert("BookSearchPage", $actual_link, $time, $uuid);
include("detailsHeader.php");
include("left.php");
//$var = $_GET['var'];
//echo $var;
//$bookFlg = $_GET['bookFlg'];
//echo $bookFlg;
// if($bookFlg == "")
// {
// 	$bookFlg = "D";
// }
$dataPerPage = 20;
$_GET["page"];
$pagenum = $_GET["page"];
$itemfrom = ($pagenum-1) * $dataPerPage;
if($itemfrom < 0)
{
	$itemfrom = 0;
}

	$cursor = $collection->find ();
	$cursor = $cursor->sort (array('Title'=>1));
	$cursor = $cursor->skip ($itemfrom);
	$cursor = $cursor->limit ($dataPerPage);
	$noOfBooks = $cursor->count();

//echo "no of books $noOfBooks";
$maxpage = ceil($noOfBooks / $dataPerPage);
//echo "max page $maxpage";
?>
<div id="templatemo_content_right">
	<div class="templatemo_detailsBookPage_box">
		<h1>
			List of Books</span>
		</h1>
		<?php								
			foreach ( $cursor as $obj ) 
			{ ?>
				<li><a href="bookDetails.php?var=<?php echo $obj['Title'];?>"> <?php echo $obj['Title']; ?></u></b> by <?php echo $obj['Author']; ?> </a></li>
		<?php } ?>
	</div>
	<div class="cleaner_with_height">&nbsp;</div>
</div>
<div class="cleaner_with_width">&nbsp;</div>
<div>
	<?php 
		if ($_GET['page'] != "")
			$page = $_GET['page'];
		else $page = 1;
		
		require_once('numlinkfunctions.php');
		
		numlinks($page, $maxpage, 11, '', '');
	?>
</div>
<?php 
include("footer.php");
?>