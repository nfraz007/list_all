<!-- <footer class="page-footer w3-white">
    <div class="footer-copyright w3-blue-grey">
      <div class="container">
        Created by <a href="http://nfraz.co.nf" class="w3-text-white" target="_blank">Nazish Fraz</a>
      </div>
    </div>
</footer> -->


  <!--  Scripts-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="../assets/js/materialize.js"></script>
  <script src="../assets/js/init.js"></script>
  <script src="../assets/pagination/pagination.js" type="text/javascript"></script>

  </body>
</html>

<script>

$("#document").ready(function(){
  $('.modal').modal();
  $('select').material_select();
});

//**************************************************login modal function*************************************
$('#login_btn').click(function(){
    $.post("../userapi/user/login.php",
    {
      email:$("#login_email").val(),
      password:$("#login_password").val()
    },function(data){
      var arr=JSON.parse(data);
      if(arr["status"]=="success"){
        //successfully created the account
        $("#login_email").val("");
        $("#login_password").val("");
        Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
        location.reload();
      }else{
        Materialize.toast(arr["remark"], 4000, "w3-pink");
      }
    });
});
$('#login_email').keypress(function(e){
    if(e.which == 13){//Enter key pressed
        $('#login_btn').click();//Trigger search button click event
    }
});
$('#login_password').keypress(function(e){
    if(e.which == 13){//Enter key pressed
        $('#login_btn').click();//Trigger search button click event
    }
});

$(".logout_btn").click(function(){
  $.post("../userapi/user/logout.php","",
    function(data){
      console.log(data);
      var arr=JSON.parse(data);
      if(arr["status"]=="success"){
        Materialize.toast(arr["remark"], 4000, "w3-blue-grey");
        location.replace("index.php");
      }else{
        Materialize.toast(arr["remark"], 4000, "w3-pink");
      }
  })
});

function set_page_name(name){
  $("#page_name").html(' / '+name);
}

</script>