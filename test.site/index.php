<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/ajax.js"></script>
</head>
<body >

<div class="container">
	<div class="row justify-content-center">
		<div class="col-8">
			
			<form name="authForm" method="GET" action="">
                       
            <p>Enter user name:</p>
            <input type="text" name="username" id="username">
            <span id="ajax_button" >Submit</span>
            </form>
            
            <p id="output"></p>
		</div>
	</div>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-8" style="margin-bottom: 5%;">
			<p>Info about repo:</p>
			
		</div>
		<div class="col-8 repo-inf row" id="repo-information">
			<div class="col-1"></div>
			<div class="col-2" ><img src="" alt="" id="profile_img"></div>
			<div class="col-2"></div>
			<div class="col-5"><p id="userlogin"></p></div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-8" style="margin-bottom: 5%;">
			<p>Info about user:</p>

		</div>
		<div class="col-8 repo-inf" id="user-information">
			
			
		</div>
	</div>
</div>

<script type="text/javascript">
	


$(function(){
  $('#ajax_button').on('click', function(e){
    e.preventDefault();
    $('#output').html('<div id="loader"><img src="css/loader.gif" alt="loading..."></div>');
    
    var username = $('#username').val();
    var requri   = 'https://api.github.com/users/'+username;
    var repouri  = 'https://api.github.com/users/'+username+'/repos';
    
    requestJSON(requri, function(json) {
      if(json.message == "Not Found" || username == '') {
        $('#output').html("<h2>No User Info Found</h2>");
      }
      
      else {
        // else we have a user and we display their info
        var fullname   = json.name;
        var username   = json.login;
        var aviurl     = json.avatar_url;
        var profileurl = json.html_url;
        var location   = json.location;
        var followersnum = json.followers;
        var followingnum = json.following;
        var reposnum     = json.public_repos;
        var organization = json.organizations_url;
        
        if(fullname == undefined) { fullname = username; }
        
        var outhtml = '<h2>'+fullname+' <span class="smallname">(@<a href="'+profileurl+'" target="_blank">'+username+'</a>)</span></h2>';
        outhtml = outhtml + '<div class="ghcontent"><div class="avi"><a href="'+profileurl+'" target="_blank"><img src="'+aviurl+'" width="80" height="80" alt="'+username+'"></a></div>';
        outhtml = outhtml + '<p>Followers: '+followersnum+' - Following: '+followingnum+'<br>Repos: '+reposnum+'</p></div>';
        outhtml = outhtml + '<div class="repolist clearfix">';
        
        var repositories;
        $.getJSON(repouri, function(json){
          repositories = json;   
          outputPageContent();                
        });          
        
        function outputPageContent() {
          if(repositories.length == 0) { outhtml = outhtml + '<p>No repos!</p></div>'; }
          else {
            outhtml = outhtml + '<p><strong>Repos List:</strong></p> <ul>';
            $.each(repositories, function(index) {
              outhtml = outhtml + '<li><a href="'+repositories[index].html_url+'" target="_blank">'+repositories[index].name + '</a></li>';
            });
            outhtml = outhtml + '</ul></div>'; 
          }
          $('#output').html(outhtml);
        } // end outputPageContent()
      } // end else statement
    }); // end requestJSON Ajax call
  }); // end click event handler
  
  function requestJSON(url, callback) {
    $.ajax({
      url: url,
      complete: function(xhr) {
        callback.call(null, xhr.responseJSON);
      }
    });
  }
});
</script>
</body>
</html>