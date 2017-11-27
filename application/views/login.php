<!DOCTYPE html>
<html>

    <head>
        <?php $this->load->view('include/head_includes'); ?>
        <title>Sign In | Admin Panel</title>
        <style>
            html,body{
                width: 100%;
                height: 100%;
                background-color: #00BCD4;
                margin: 0;
            }
        </style>
    </head>

    <body class="login-page">
        <div class="login-box">
            <br><br><br>
            <div class="card">
                <div class="body">
                    <form id="sign_in" method="POST">
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <?php echo $error == NULL ? "" : '<p class="error-message" style="color: red; font-size: small;" >' . $error . '<br></p>'; ?>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>