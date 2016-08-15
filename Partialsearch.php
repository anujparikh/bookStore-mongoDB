<?php
ini_set ( 'mongo.long_as_object', 1 );
include 'commonFunctions.php';
$string = $_POST ['string'];
$collection = fnConnection ( 'mydb', 'project' );
$cursor = $collection->find ( array (
		"Title" => array (
				'$regex' => $string 
		) 
) );
?>
<script type="text/javascript" src="scripts/jquery-1.8.2.js">

</script>
<script type="text/javascript">
// $(document).ready(function(a){
// 	$('.searchbook').click(function(){
//      var isbn= $(this).attr('id');
//      $.ajax({
         
//          })
// 		});
// });
</script>
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
<?php
foreach ( $cursor as $value ) {
// 	echo $value['URLs'];
// 	echo $value['Title'];
	?>

<div class="searchbook" id='<?php echo $value['ISBN'];?>'>
	<a href="bookDetails.php?var=<?php echo $value['Title'];?>">
	<span class="searchbooktitle"><?php echo $value ['Title'];?></span></a>
</div>
<?php
}
?>