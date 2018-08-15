<?php require_once 'header.php';?>

<div class="container">
	<div class="w3-padding-8"></div>
	<div class="row">
		<div class="col s12">
			<ul class="collapsible" data-collapsible="accordion">
			    <li>
			      <div class="collapsible-header w3-center">Filter</div>
			      <div class="collapsible-body row">
			      	<div class="col l6 m6 s12">
			      		<nav>
						    <div class="nav-wrapper w3-blue-grey">
						      <form>
						        <div class="input-field">
						          <input type="search" id="search" placeholder="Search" required>
						          <label class="label-icon" for="search"><i class="fa fa-search"></i></label>
						          <i class="fa fa-close"></i>
						        </div>
						      </form>
						    </div>
						</nav>
			      	</div>
			      	<div class="col l6 m6 s12">
			      		<div class="input-field">
							<select id="limit">
							  <option value="" disabled selected>Choose your option</option>
							  <option value="10" selected>10</option>
							  <option value="20">20</option>
							  <option value="50">50</option>
							</select>
							<label>Limit</label>
						</div>
			      	</div>
			      	<div class="col l12 m12 s12">
			      		<p class="col l4 m4 s12">
					      <input name="radio_filter" class="radio_filter" type="radio" value="" id="all" checked />
					      <label for="all">All</label>
					    </p>
					    <p class="col l4 m4 s12">
					      <input name="radio_filter" class="radio_filter" type="radio" value="1" id="active" />
					      <label for="active">Active</label>
					    </p>
					    <p class="col l4 m4 s12">
					      <input name="radio_filter" class="radio_filter" type="radio" value="0" id="inactive" />
					      <label for="inactive">Inactive</label>
					    </p>
			      	</div>
			      </div>
			    </li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div id="content"></div>
	</div>
</div>

<?php require_once 'footer.php';?>

<script>
$("document").ready(function(){
	set_page_name("Category");
	print_data();
});

function print_data(){
	out="";
	$("#content").html(out);
	var search=$("#search").val();
	var limit=$("#limit").val();
	var status=$('input:radio[name=radio_filter]:checked').val();
	$.post("../userapi/category/category_list.php",
	{
		search:search,
		status:status,
		limit:limit,
		page:1
	},function(data){
		console.log(data);
		var arr=JSON.parse(data);
		if(arr["status"]=="success"){
			for(i=0;i<arr["category"].length;i++){
				out+='<div class="col l2 m4 s6">';
					out+='<div class="card w3-center w3-blue-grey">';
						out+='<div class="card-content">';
							out+='<p>'+arr["category"][i]["category_name"]+'</p>';
						out+='</div>';
					out+='</div>';
				out+='</div>';
			}
		}else{
			out+='<p class="w3-center">'+arr["remark"]+'</p>';
		}
		$("#content").html(out);
	});
}

$("#search").keyup(function(){
	print_data();
});

$(".radio_filter").change(function(){
	print_data();
});

$("#limit").change(function(){
	print_data();
});
</script>