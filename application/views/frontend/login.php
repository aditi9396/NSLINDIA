<!DOCTYPE html>
<html>
<head>
    <style>
        .login-container {
            text-align: center;
            width: 100%;
            max-width: 500px;
            margin: auto;
            border-radius: 5px;
            border: 1px solid darkgray;
            padding: 20px;
            background-color: #000;
            color: #FFFFFF;
            box-sizing: border-box;
        }
        a:hover {
    color: #ed6200;
}

        .logo {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .login-form {
            color: #fff;
            margin: 0 auto;
        }

        .form-table {
            width: 100%;
        }

        .form-table td {
            padding: 10px;
        }

        .form-table input[type="text"],
        .form-table input[type="password"] {
            width: 100%;
            padding: 8px;
            border: none;
            color: #000;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-login {
            background-color: #ed6200;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #ff8100;
        }

        .reset-link {
            color: #ed6200;
            text-decoration: none;
        }
    </style>
<?php?>
    <div class="login-container">
        <div class="logo">
            <img src="assets_old/frontend/image/northen_star_logo.png" height="150px">
        </div>
        <form action="" method="post" id="frmLogin" class="login-form">
            <fieldset>
                <legend align="middle">Log In</legend>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <td>UserName</td>
                            <td>:</td>
                            <td><input type="text" name="UserName" onkeyup="this.value = this.value.toUpperCase();"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input class="btn-login" id="btnLogin" type="submit" value="Submit">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <a href="filemanager/public_html/resetpassword.php" class="reset-link">Reset Password</a>
            </fieldset>
        </form>
    </div>
<?php?>
