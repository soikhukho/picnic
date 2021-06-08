<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  	$updateID= getPost('updateID');

  	$user= executeResult("select * from users where id = $updateID",true);
  	$email = $user['email'];

    if($updateID!=''){
      echo '<div style=" width:600px;">
			    <div class="panel panel-primary">
			      <div class="panel-heading">
			      	<div style="text-align:right;">
			      		<button id="close" class="btn btn-primary " style="font-size: 20px;padding: 10px;">X</button>
			      	</div>
			        <h3 class="text-center" style="margin-top:-30px;">Update Password for that users</h3>
			      </div>
			      <div class="panel-body">
			        <form id="update_pwd" method="post">
			          <span style="color: red"><?= $alert ?></span>
			          
			          <div class="form-group">
			            <label for="email">User Email:</label>
			            <input required="true" type="email" class="form-control" id="email" name="email" value="'.$email.'" readonly="true">
			          </div>

			          <div class="form-group">
			            <label for="updateID">UserID</label>
			            <input required="true" type="number" class="form-control" id="updateID" name="updateID" value="'.$updateID.'" readonly="true">
			          </div>

			          <div class="form-group">
			            <label for="pwd">Password:</label>
			            <input required="true" type="password" class="form-control" id="pwd" name="pwd">
			          </div>

			          <div class="form-group">
			            <label for="cf_pwd">Confirm Password:</label>
			            <input required="true" type="password" class="form-control" id="cf_pwd" name="cf_pwd">
			          </div>
			          
			          <center><button class="btn btn-warning" style="font-size: 20px;">Update</button></center>
			        </form>
			      </div>
			    </div>
			  </div>

			  <script type="text/javascript">
				      $("#close").click(function(){
				        $("#update_pwd").empty()
				      })
				</script>
			  ';
    }
    