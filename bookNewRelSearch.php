<?php
include("detailsHeader.php");
include("left.php");

$dataPerPage = 20;
$_GET["page"];
$pagenum = $_GET["page"];
//echo "pagenum : $pagenum";
$itemfrom = ($pagenum-1) * $dataPerPage;

//echo "items from $itemfrom";

	$rangeQuery = array('YOPublication' => array( '$gt' => 2000));
	$cursor = $collection->find ($rangeQuery);
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
			New Releases</span>
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