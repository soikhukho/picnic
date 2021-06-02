<style type="text/css">

    .overlay {
        background-color: rgba(0,0,0,.25);
        bottom: 0;
        display: flex;
        justify-content: center;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .overlay .login-wrapper {
        align-self: center;
        background-color: rgba(0,0,0,.25);
        border-radius: 2px;
        padding: 6px;
        width: 400px;
    }
      
    .overlay .login-wrapper .login-content {
        border-radius: 2px;
        padding: 25px;
        padding-top: 5px;
        position: relative;
    }

    form label {
        color: rgb(0,0,0);
        display: block;
        font-family: 'Varela Round', sans-serif;
        font-size: 15px;
        margin: 15px 0;
    }

    form input[type="text"],

    form input[type="email"],

    form input[type="number"],

    form input[type="search"],

    form input[type="password"],

    form textarea {

        background-color: rgb(255,255,255);

        border: 1px solid rgb( 186, 186, 186 );

        border-radius: 1px;

        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.08);

        display: block;
        font-family: sans-serif;
        font-weight: normal;
        font-size: 15px;

        margin: 6px 0 12px 0;

        padding: .8em .55em;   

        text-shadow: 0 1px 1px rgba(255, 255, 255, 1);

        transition: all 400ms ease;

        width: 90%;

    }


    form button:hover {

        background-color: #1bc5b3;

        cursor: pointer;

    }
</style>

<div class="overlay" id="popup_login" <?= ($alert_login!='')?'':'style="display: none;"' ?>>

    <div class="login-wrapper">

        <div class="login-content bg-info">
            <button class="btn btn-primary close" style="font-size: 20px;padding: 10px;">X</button>
            <center><h1>Log in</h1></center>
            <form method="post" style="margin-top: 25px;">
                <span id="alert" style="color: red"><?= $alert_login ?></span>
                <label for="email">
                    Email:
                    <input type="text" name="email" id="email" required="required" value="<?= (isset($email))?$email:'' ?>">
                </label>

                <label for="password">
                    Password:
                    <input type="password" required="true" name="pwd" id="pwd" >
                </label>

                <center><button class="btn btn-primary" type="submit">Log in</button></center>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

        $("#loginLink").click(function( event ){

            event.preventDefault();

            $(".overlay").fadeToggle("fast");

        });     

        $(".overlayLink").click(function(event){

            event.preventDefault();

            var action = $(this).attr('data-action');         

            $.get( "ajax/" + action, function( data ) {

                $( ".login-content" ).html( data );

            });         

            $(".overlay").fadeToggle("fast");
        });     

        $(".close").click(function(){
            $(".overlay").fadeToggle("fast");
            $('#email').val('')
            $('#alert').html('')
        });     

        $(document).keyup(function(e) {
            if(e.keyCode == 27 && $(".overlay").css("display") != "none" ) {
                event.preventDefault();

                $(".overlay").fadeToggle("fast");
           }
        });

    });
</script>