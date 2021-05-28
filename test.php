<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
	<link rel="stylesheet" type="text/css" href="style/toogle_switch.css">
</head>
<style type="text/css">
	#btn{
		background:grey;
	}
	#btn:hover{
		background: red;
	}
</style>
<body>
<div style="margin-top: 100px;margin-left: 300px;">
	<ul>
		<li>
			<button id="btn" class="btn" style="text-align: left;min-width: 80px; height: 36px; border-radius: 20px;padding: 2px;padding-right: 5px;">
				<img src="https://scontent.fhph1-2.fna.fbcdn.net/v/t1.6435-9/52531028_2107100389579878_2239570358166355968_n.jpg?_nc_cat=101&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=ZgivoX-36KoAX_dubfI&_nc_ht=scontent.fhph1-2.fna&oh=2eeae4a8a145bf6cb6be02d48d43bb48&oe=60D57858" 
						style="border-radius: 50%;max-height: 30px;">
				<span></span>
			</button>
		</li>
	</ul>

<button style="position: relative;background: green;">
	<img src="pictures/cart.jpg" style="border-radius: 50%;height: 50px; " >
	<input type="text" name="" style="height: 20px;width: 20px;border-radius: 50%;background:orange;border: none;outline: none;text-align: center;font-size: 12px;color: white;font-weight: bold; position: absolute;top:0px;left: 32px;" value="20">
</button>
	

	<button id="test" class="btn btn-danger">test</button>


<div class="dropdown">
	<button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">Admintrations
	  <span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
	    <li><a href="#">HTML</a></li>
	    <li><a href="#">CSS</a></li>
	    <li><a href="#">JavaScript</a></li>
	</ul>
</div>


						<label class="switch">
                            <input id="active" type="checkbox" checked>
                            <span class="slider round"></span>
                          </label>
<script type="text/javascript">
	$('#active').change(function () {
		if($('#active').checked()){alert('ok')}
		
		
	})
</script>
</div>
</body>
</html>