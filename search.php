<?php
include("commonFunctions.php");
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set("America/New_York");
$time = date("h:i:sa");
$uuid = uniqid();
urlDataInsert("SearchPage", $actual_link, $time, $uuid);
include ("detailsHeader.php");
include ("left.php");
?>
<style type="text/css">
body {
	font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
}

.contentArea {
	width: 600px;
	margin: 0 auto;
}

#inputSearch {
	width: 350px;
	border: solid 1px #000;
	padding: 3px;
}

.searchbutton {
	background-color: red;
	color: #fff;
	width: 40px;
	padding: 2px;
}

#divResult {
	position: absolute;
	width: 350px;
	display: none;
	margin-top: -1px;
	border: solid 1px #dedede;
	border-top: 0px;
	overflow: hidden;
	border-bottom-right-radius: 6px;
	border-bottom-left-radius: 6px;
	-moz-border-bottom-right-radius: 6px;
	-moz-border-bottom-left-radius: 6px;
	box-shadow: 0px 0px 5px #999;
	border-width: 3px 1px 1px;
	border-style: solid;
	border-color: #333 #DEDEDE #DEDEDE;
	background-color: white;
}

.display_box {
	padding: 4px;
	border-top: solid 1px #dedede;
	font-size: 12px;
	color : #999;
	height: 20px;
}

.display_box:hover {
	background: #3bb998;
	color: #FFFFFF;
	cursor: pointer;
}
</style>
<div id="templatemo_content_right">
	<h1>
		Search by Book name</span>
	</h1>
</div>
<div id="templatemo_content_right">
	<div class="contentArea">
		Book Name : <input type="text" class="search" id="inputSearch" /> <span
			class="searchbutton">Search</span><br />
		<div id="divResult"></div>
	</div>
	<div class="searchresults"></div>
</div>
<script type="text/javascript" src="scripts/jquery-1.8.2.js">

</script>
<script type="text/javascript">
	$(document).ready(function(e){
	$("#inputSearch").keyup(function(a) 
	{ 
		$("#divResult").empty();
		//alert($(this).val());
	var inputSearch = $(this).val();
	var dataString = 'searchword='+ inputSearch;
	if(inputSearch!='')
	{
		//alert("1213");
	      $.ajax({
	      type: "POST",
	      url: "search1.php",
	      data: dataString,
	      cache: false,
	      success: function(html)
	      {
	      	$("#divResult").html(html).show();
	      }
	      });
	}return false;    
	});
	$('.searchbutton').click(function(a){
		var searchstring=$('.search').val();
		//alert(searchstring);
		$.ajax({
              type : "post",
              url : "Partialsearch.php",
              data : {
                 string : searchstring
                  },
              success : function(resp){
            	  $('.searchresults').empty();
              $('.searchresults').append(resp);
              $('#divResult').empty();
                  }
			});
		});
// 	$(".display_box").click(function(a){
// 		alert();
//         var id = $(this).find('.name').attr(id);
        
//         $.ajax({
//             type : 'post',
//             url : 'selectsearch.php',
//             data:{
//                  id : id
//                 },
//             success : function(resp){
//                   $(this).getparent().getparent().append(resp);
//                 }
//             });
// 	});
// 	$("#divResult").live("click",function(e){ 
// 	      var $clicked = $(e.target);
// 	      var $name = $clicked.find('.name').html();
// 	      var decoded = $("<div/>").html($name).text();
// 	      $('#inputSearch').val(decoded);
	      
// 	});
// 	$(document).live("click", function(e) { 
// 	      var $clicked = $(e.target);
// 	      if (! $clicked.hasClass("search")){
// 	      $("#divResult").fadeOut(); 
// 	      }
// 	});
	$('#inputSearch').click(function(e){
	      $("#divResult").fadeIn();
	});
	});
</script>
<!-- end of content -->
<?php
include ("footer.php");
?>