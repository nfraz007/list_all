<?php require_once 'header.php';?>

<div class="container">
	<div class="w3-padding-8"></div>
	<div class="row">
		<div class="col s12">
			<input type="hidden" class="col s4" id="parent_id" value="0">
			<input type="hidden" class="col s4" id="category_id" value="">
			<input type="hidden" class="col s4" id="website_id" value="">
			<div class="row">
				<div class="col l4 m6 s12">
					<div class="input-field">
				        <input id="category_name" type="text">
				        <label for="category_name">Category Name</label>
				    </div>
				    <button class="waves-effect waves-light btn-floating w3-blue-grey" id="category_add"><i class="fa fa-plus w3-small"></i></button>
				    <button class="waves-effect waves-light btn-floating w3-blue-grey" id="category_update" disabled><i class="fa fa-pencil w3-small"></i></button>
				    <button class="waves-effect waves-light btn-floating w3-blue-grey" id="category_delete" disabled><i class="fa fa-trash w3-small"></i></button>
				</div>
				<div class="col l8 m6 s12">
					<div class="input-field col l6 m12 s12">
				        <input id="website_name" type="text">
				        <label for="website_name">Website Name</label>
				    </div>
				    <div class="input-field col l6 m12 s12">
				        <input id="website_url" type="text">
				        <label for="website_url">Website URL</label>
				    </div>
					<button class="waves-effect waves-light btn-floating w3-blue-grey" id="website_add"><i class="fa fa-plus w3-small"></i></button>
				    <button class="waves-effect waves-light btn-floating w3-blue-grey" id="website_update" disabled><i class="fa fa-pencil w3-small"></i></button>
				    <button class="waves-effect waves-light btn-floating w3-blue-grey" id="website_delete" disabled><i class="fa fa-trash w3-small"></i></button>
				</div>
			</div>
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
	set_page_name("Home");
	print_data();
});

function print_data(category_id=0){
	print_bread(category_id);
	print_category(category_id);
	print_website(category_id);
}

function print_bread(category_id=0){
	var out="";
	$("#parent_id").val(0);

	out+='<a href="#!" class="breadcrumb parent" data-parent_id="0">Home</a>';

	$.post("../userapi/bread/bread_list.php",
	{
		category_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=arr["bread"].length-1;i>=0;i--){
				out+='<a href="#!" class="breadcrumb parent" data-parent_id="'+arr["bread"][i]["category_id"]+'">'+arr["bread"][i]["category_name"]+'</a>';
			}
			$("#parent_id").val(arr["bread"][0]["category_id"]);
		}else{
			
		}
		$("#bread").html(out);
	});
}

function print_category(category_id=0){
	var out="";
	$(".progress").show();
	$("#category").html(out);
	$.post("../userapi/category/category_list.php",
	{
		parent_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=0;i<arr["category"].length;i++){
				out+='<div class="col l2 m4 s6">';
					out+='<div class="card w3-blue-grey w3-center w3-display-container">';
						out+='<div class="card-content">';
							out+='<a href="#" class="parent w3-text-white w3-hover-text-black" data-parent_id="'+arr["category"][i]["category_id"]+'">';
								out+='<p>'+arr["category"][i]["category_name"]+'</p>';
							out+='</a>';
						out+='</div>';
						out+='<div class="w3-display-hover">';
							out+='<a class="waves-effect waves-light btn-floating w3-black parent" data-parent_id="'+arr["category"][i]["category_id"]+'"><i class="fa fa-sign-in w3-small"></i></a>';
							out+='<a class="waves-effect waves-light btn-floating w3-black" id="category_btn" data-category_id="'+arr["category"][i]["category_id"]+'" data-category_name="'+arr["category"][i]["category_name"]+'"><i class="fa fa-bars w3-small"></i></a>';
						out+='</div>';
					out+='</div>';
				out+='</div>';
				
			}
		}else{
			//out+='<p class="w3-center w3-text-blue-grey">Sorry, No Category in this category</p>';
		}
		$(".progress").hide();
		$("#category").html(out);
	});
}

function print_website(category_id=0){
	var out="";
	$(".progress").show();
	$("#website").html(out);
	$.post("../userapi/website/website_list.php",
	{
		category_id:category_id
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=0;i<arr["website"].length;i++){
				out+='<div class="col l2 m4 s6">';
					out+='<div class="card w3-blue-grey w3-center w3-display-container">';
						out+='<div class="card-content">';
							out+='<a class="w3-text-white w3-hover-text-black" href="'+arr["website"][i]["url"]+'" target="_blank">';
								out+='<p>'+arr["website"][i]["website_name"]+'</p>';
							out+='</a>';
						out+='</div>';
						out+='<div class="w3-display-hover">';
							out+='<a class="waves-effect waves-light btn-floating w3-black" href="'+arr["website"][i]["url"]+'" target="_blank"><i class="fa fa-sign-in w3-small"></i></a>';
							out+='<a class="waves-effect waves-light btn-floating w3-black" id="website_btn" data-website_id="'+arr["website"][i]["website_id"]+'" data-website_name="'+arr["website"][i]["website_name"]+'" data-website_url="'+arr["website"][i]["url"]+'"><i class="fa fa-bars w3-small"></i></a>';
						out+='</div>';
					out+='</div>';
				out+='</div>';
			}
		}else{
			//out+='<p class="w3-center w3-text-blue-grey">Sorry, No website in this category</p>';
		}
		$(".progress").hide();
		$("#website").html(out);
	});
}

$("body").on("click",".parent",function(){
	var category_id=$(this).data("parent_id");
	print_data(category_id);
});

//*****************************************************category add******************************
$("#category_add").click(function(){
	var category_id=$("#parent_id").val();
	var category_name=$("#category_name").val();
	console.log(category_id);
	$.post("../userapi/category/category_add.php",
	{
		category_id:category_id,
		category_name:category_name
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			$("#category_name").val("");
			Materialize.updateTextFields();
			print_data(category_id);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
		}else{
			Materialize.toast(arr["remark"], 4000, "w3-pink");
		}
	});
});

$("body").on("click","#category_btn",function(){
	$("#category_add").prop("disabled",true);
	$("#category_update").prop("disabled",false);
	$("#category_delete").prop("disabled",false);

	var category_id=$(this).data("category_id");
	var category_name=$(this).data("category_name");
	$("#category_id").val(category_id);
	$("#category_name").val(category_name);
	Materialize.updateTextFields();
});

$("#category_update").click(function(){
	var category_id=$("#category_id").val();
	var parent_id=$("#parent_id").val();
	var category_name=$("#category_name").val();

	$.post("../userapi/category/category_update.php",
	{
		category_id:category_id,
		parent_id:parent_id,
		category_name:category_name
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			$("#category_id").val("");
			$("#category_name").val("");
			Materialize.updateTextFields();
			print_data(parent_id);
			$("#category_add").prop("disabled",false);
			$("#category_update").prop("disabled",true);
			$("#category_delete").prop("disabled",true);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
		}else{
			Materialize.toast(arr["remark"], 4000, "w3-pink");
		}
	});
});

$("#category_delete").click(function(){
	var category_id=$("#category_id").val();
	var parent_id=$("#parent_id").val();
	swal({
	  title: "Are you sure ?",
	  text: "It will delete all your sub category & website",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, delete it!",
	  closeOnConfirm: true
	},
	function(){
	  $.post("../userapi/category/category_delete.php",
	  {
	  	category_id:category_id
	  },function(data){
	  	console.log(data);
	  	var arr=JSON.parse(data);
	  	if(arr["status"]=="success"){
	  		$("#category_id").val("");
			$("#category_name").val("");
			Materialize.updateTextFields();
			print_data(parent_id);
			$("#category_add").prop("disabled",false);
			$("#category_update").prop("disabled",true);
			$("#category_delete").prop("disabled",true);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
	  	}else{
	  		Materialize.toast(arr["remark"], 4000, "w3-pink");
	  	}
	  });
	});
});

//***************************************************website add***********************************
$("#website_add").click(function(){
	var category_id=$("#parent_id").val();
	var website_name=$("#website_name").val();
	var website_url=$("#website_url").val();
	console.log(category_id);
	$.post("../userapi/website/website_add.php",
	{
		category_id:category_id,
		website_name:website_name,
		website_url:website_url
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			$("#website_name").val("");
			$("#website_url").val("");
			Materialize.updateTextFields();
			print_data(category_id);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
		}else{
			Materialize.toast(arr["remark"], 4000, "w3-pink");
		}
	});
});

$("body").on("click","#website_btn",function(){
	$("#website_add").prop("disabled",true);
	$("#website_update").prop("disabled",false);
	$("#website_delete").prop("disabled",false);

	var website_id=$(this).data("website_id");
	var website_name=$(this).data("website_name");
	var website_url=$(this).data("website_url");
	$("#website_id").val(website_id);
	$("#website_name").val(website_name);
	$("#website_url").val(website_url);
	Materialize.updateTextFields();
});

$("#website_update").click(function(){
	var category_id=$("#parent_id").val();
	var website_id=$("#website_id").val();
	var website_name=$("#website_name").val();
	var website_url=$("#website_url").val();

	$.post("../userapi/website/website_update.php",
	{
		category_id:category_id,
		website_id:website_id,
		website_name:website_name,
		website_url:website_url
	},function(data){
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			$("#website_id").val("");
			$("#website_name").val("");
			$("#website_url").val("");
			Materialize.updateTextFields();
			print_data(category_id);
			$("#website_add").prop("disabled",false);
			$("#website_update").prop("disabled",true);
			$("#website_delete").prop("disabled",true);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
		}else{
			Materialize.toast(arr["remark"], 4000, "w3-pink");
		}
	});
});

$("#website_delete").click(function(){
	var category_id=$("#parent_id").val();
	var website_id=$("#website_id").val();
	swal({
	  title: "Are you sure ?",
	  text: "It will delete this website",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, delete it!",
	  closeOnConfirm: true
	},
	function(){
	  $.post("../userapi/website/website_delete.php",
	  {
	  	website_id:website_id
	  },function(data){
	  	console.log(data);
	  	var arr=JSON.parse(data);
	  	if(arr["status"]=="success"){
	  		$("#website_id").val("");
			$("#website_name").val("");
			$("#website_url").val("");
			Materialize.updateTextFields();
			print_data(category_id);
			$("#website_add").prop("disabled",false);
			$("#website_update").prop("disabled",true);
			$("#website_delete").prop("disabled",true);
			Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
	  	}else{
	  		Materialize.toast(arr["remark"], 4000, "w3-pink");
	  	}
	  });
	});
});

</script>