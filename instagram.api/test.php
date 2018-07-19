<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="jQuery.js" type="text/javascript"></script>
</head>
<body>
<div class="container" id="container">
	
</div>
<script type="text/javascript">
	var userid = '2208471949';
								console.log("User ID: "+userid);
								$.post('accountPars.php',{userid: userid}).done(function(data) {
			                        $('#container').append('<div>'+data+'</div>');
			                        
			                        
	
			                        
			                    });
</script>
</body>
</html>