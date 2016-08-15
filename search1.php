<script type="text/javascript" src="scripts/jquery-1.8.2.js">
</script>
<script type="text/javascript">
//alert("hi");
$(document).ready(function(e){
	$('.display_box').click(function(a){
//alert();
          var id = $(this).find('.name').attr('id');
             //alert(id);
            $.ajax({
                type : 'post',
                url : 'selectsearch.php',
                data:{
                     id : id
                    },
                success : function(resp){
                    $('.searchresults').empty();
                	 $('.searchresults').append(resp);
                     $('#divResult').empty();
                    }
                });
		});
});
</script>
<?php
ini_set('mongo.long_as_object', 1);
include 'commonFunctions.php';
if($_POST)
{
	$q=$_POST['searchword'];
	$collection=fnConnection('mydb', 'project');
	$cursor = $collection->find(array("Title"=>array('$regex' => $q)))->sort(array("Rating"=>-1))->limit(5);
	foreach ($cursor as $value){

		?>
<div class="display_box" align="left">
<span class="name" id="<?php echo $value['_id'];?>"><?php echo $value['Title']; ?></span></div>
<?php
 }
 }
?>