<?php
include("detailsHeader.php");
include("left.php");
$var = $_GET['var'];
//echo $var;
// $bookFlg = $_GET['bookFlg'];
//echo $bookFlg;

$dataPerPage = 20;
$_GET["page"];
$pagenum = $_GET["page"];
//echo "pagenum : $pagenum";
$itemfrom = ($pagenum-1) * $dataPerPage;

//echo "items from $itemfrom";

	$cursor = $collection->find (array('Author'=>$var));
	$noOfBooks = $cursor->count();

//echo "no of books $noOfBooks";
$maxpage = ceil($noOfBooks / $dataPerPage);
//echo "max page $maxpage";
?>
<div id="templatemo_content_right">
	<div class="templatemo_detailsBookPage_box">
		<h1>
			List of Books from <?php echo $var ?></span>
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
		
		if($maxpage != 1)
		{
			numlinks($page, $maxpage, 11, '', 'var='.$var);
		}
	?>
</div>
<?php 
include("footer.php");
?>