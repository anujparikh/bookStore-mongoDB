<?php
include 'commonFunctions.php';
$id=$_POST['id'];
$collection=fnConnection('mydb', 'project');
$objectid=new MongoId($id);
$cursor = $collection->find(array("_id"=>$objectid));
?>
<style>
.searchbook {
	float: left;
	margin-left: 20px;
	margin-top: 10px;
	width: 600px;
}

.searchbooktitle {
	margin-top: 4px;
}
</style>
<div class="cleaner">&nbsp;</div>
<?php
foreach ($cursor as $value){?>

	<div class="searchbook" id='<?php echo $value['ISBN'];?>'>
	<a href="bookDetails.php?var=<?php echo $value['Title'];?>">
	<span class="searchbooktitle"><?php echo $value ['Title'];?></span></a>
</div>
<?php	
} ?>