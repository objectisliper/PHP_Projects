<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style>
            .container{
                background: none repeat scroll 0 0 #CCCCCC;
                border: 1px solid #5E822E;
                margin: 10% auto auto;
                padding: 25px 26px;
                width: 310px;
            }
            select {
                border: 2px double #0082FF;
                color: #008080;
                font-family: Georgia;
                font-weight: bolder;
                height: 39px;
                padding: 7px 8px;
                width: 300px;
            }
        </style>
        <script src="jQuery.js" type="text/javascript"></script>
        <script type="text/javascript">
            
            // Change Your home URL..
            home_url = 'http://instagram.api';
            
            /* *
             *     fileName - ajax file name to be called by ajax method.
             *     data - pass the infromation(like location-id , location-type) via data variable.
             *     loadDataToDiv - id of the div to which the ajax responce is to be loaded.
             * */
            function ajax_call(fileName,data, loadDataToDiv) {
                jQuery("#"+loadDataToDiv).html('<option selected="selected">-- -- -- Loding Data -- -- --</option>');

                //  If you are changing counrty, make the state and city fields blank
                if(loadDataToDiv=='state'){
                    jQuery('#city').html('');
                    jQuery('#state').html('');                    
                }
                //  If you are changing state, make the city fields blank
                if(loadDataToDiv=='city'){
                    jQuery('#city').html('');
                }
                
                jQuery.post(home_url + '/' + fileName + '.php', data, function(result) {
                    jQuery('#' + loadDataToDiv).html(result);
                });
            }
        </script>
    </head>
    <body>
        <?php
        // Database connection...
        $hostCon = mysqli_connect('localhost', 'counrydb', '123456gg', 'counrydb'); // Update your hosting details.
        $dbCon = mysqli_select_db($hostCon , 'countrylist'); // Update your database name.
        // Lets select all countries from our table...
        $sqlAllCountries = "SELECT * FROM `location` WHERE `location_type` =0";
        $sqlAllCountriesResult = mysqli_query($hostCon,$sqlAllCountries);
        if ($sqlAllCountriesResult) {
            while ($row = mysqli_fetch_object($sqlAllCountriesResult)) {
                $objAllCountries[] = $row;
            }
        }
        ?>
        <div class="container" id="container">
            <!--  Lets display all countries in an drop down list           -->
            <select name="country" id="select-country" onchange="ajax_call('ajaxCall',{location_id:this.value,location_type:1}, 'state')">
                <option value="">Select Country</option>
                <?php
                foreach ($objAllCountries AS $CountryDetails) {
                    echo '<option value="' . $CountryDetails->location_id . '">' . $CountryDetails->name . '</option>';
                }
                ?>
            </select>
            <br/><br/>
            <select name="state" id="state" onchange="ajax_call('ajaxCall',{location_id:this.value,location_type:2}, 'city')">
            </select>
            <br/><br/>
            <select name="city" id="city" style="width: 300px;">
            </select>
            <button id="SendCity">Click</button>
        </div>
		<script type="text/javascript">
			
			  
			$('#SendCity').on('click',function(){
				if ($('#city option:selected').text() == "" || $('#city option:selected').text() == "Select City"){
					alert("Select the city");
				}
				else{
				var GoogleUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address='+$('#city option:selected').text()+'&key=AIzaSyC2E2lR1GraJu4-71JbdMA3nkmS5P11K7E';
				requestJSON(GoogleUrl, function(json) {
					$('#container').append('<div>'+json.results[0].address_components[0].long_name+'</div>');
					$('#container').append('<div>'+json.results[0].geometry.location+'</div>');
				
				var InstaUrl = 'https://api.instagram.com/v1/locations/search?lat='+json.results[0].geometry.location.lat+'&lng='+json.results[0].geometry.location.lng+'&access_token=3919852181.4793810.f3ac95b1018e42a29474dada1cad7d1d';
				requestJSON(InstaUrl, function(inst) {
					console.log(inst.data[0]);
					console.log(inst.data.length);
					for (var i = inst.data.length - 1; i >= 0; i--) {
						var usersUrl = "https://www.instagram.com/explore/locations/"+inst.data[i].id+"/?__a=1";
						requestJSON(usersUrl, function(Users) {
							for (var i = Users.graphql.location.edge_location_to_media.edges.length - 1; i >= 0; i--) {
								
								var userid = Users.graphql.location.edge_location_to_media.edges[i].node.owner.id;
								
								$.post('accountPars.php',{userid: userid}).done(function(data) {
			                        $('#container').append('<div>'+data+'</div>');
			                        
			                        
	
			                        
			                    });
		                	};
						});
						
					}
				});
				});
				};
			});

			function requestJSON(url, callback) {
			    $.ajax({
			      url: url,
			      complete: function(xhr) {
			        callback.call(null, xhr.responseJSON);
			      }
			    });
			  };
		</script>
        <div id="loading"></div>
    </body>
</html>

