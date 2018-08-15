<?php require_once 'header.php';?>

<div class="container">
	<div class="w3-padding-8"></div>
	<div class="row">
		<div class="col s12">
			<nav class="tabs w3-blue-grey">
			    <div class="nav-wrapper">
			      <div class="col s12">
			      	<div id="bread"></div>
			      </div>
			    </div>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="progress w3-blue-grey">
			    <div class="indeterminate"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="category"></div>
	</div>
	<div class="divider"></div>
	<div class="row">
		<div id="website"></div>
	</div>
</div>

<?php require_once 'footer.php';?>

<script>
$("document").ready(function(){
	print_data();
});

function print_data(category_id=0){
	print_bread(category_id);
	print_category(category_id);
	print_website(category_id);
}

function print_bread(category_id=0){
	var out="";
	out+='<a href="#!" class="breadcrumb parent" data-parent_id="0">Home</a>';

	$.post("userapi/bread/bread_list.php",
	{
		category_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=arr["bread"].length-1;i>=0;i--){
				out+='<a href="#!" class="breadcrumb parent" data-parent_id="'+arr["bread"][i]["category_id"]+'">'+arr["bread"][i]["category_name"]+'</a>';
			}
		}else{
			
		}
		$("#bread").html(out);
	});
}

function print_category(category_id=0){
	var out="";
	$(".progress").show();
	$("#category").html(out);
	$.post("userapi/category/category_list.php",
	{
		parent_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=0;i<arr["category"].length;i++){
				out+='<a href="#" class="parent" data-parent_id="'+arr["category"][i]["category_id"]+'">';
					out+='<div class="col l2 m4 s6">';
						out+='<div class="card w3-blue-grey w3-center">';
							out+='<div class="card-content">';
								out+='<p>'+arr["category"][i]["category_name"]+'</p>';
							out+='</div>';
						out+='</div>';
					out+='</div>';
				out+='</a>';
			}
		}else{
			out+='<p class="w3-center w3-text-blue-grey">Sorry, No Category in this category</p>';
		}
		$(".progress").hide();
		$("#category").html(out);
	});
}

function print_website(category_id=0){
	var out="";
	$(".progress").show();
	$("#website").html(out);
	$.post("userapi/website/website_list.php",
	{
		category_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=0;i<arr["website"].length;i++){
				out+='<a href="'+arr["website"][i]["url"]+'" target="_blank">';
					out+='<div class="col l2 m4 s6">';
						out+='<div class="card w3-blue-grey w3-center">';
							out+='<div class="card-content">';
								out+='<p>'+arr["website"][i]["website_name"]+'</p>';
							out+='</div>';
						out+='</div>';
					out+='</div>';
				out+='</a>';
			}
		}else{
			out+='<p class="w3-center w3-text-blue-grey">Sorry, No website</p>';
		}
		$(".progress").hide();
		$("#website").html(out);
	});
}

$("body").on("click",".parent",function(){
	var category_id=$(this).data("parent_id");
	print_data(category_id);
});
</script>