  <style>
    .page-body-wrapper.full-page-wrapper {
        width: 100%;
        min-height: 100vh;
    }

    .auth.lock-full-bg {
        position: relative;
        background: url(assets/images/shutterstock_1814418314-2048x788.jpg);
        background-size: cover;
        color: #fff;
    }

    .auth.lock-full-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: inherit;
        filter: blur(5px);
        opacity: 0.8;
    }

    .auth-form-transparent {
        position: relative;
        z-index: 1;
        padding: 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-form {
        max-width: 400px;
        margin: 0 auto;
    }

    legend {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    label {
        font-weight: bold;
    }

    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-group-text {
        background-color: transparent;
        border: none;
    }

    .form-control-lg {
        border-radius: 5px;
    }

    .fa-lg {
        font-size: 2.333333em;
    }

    @media (max-width: 768px) {
        .auth.lock-full-bg {
            background-position: center;
        }

        .login-form {
            max-width: 100%;
        }

        #btnLogin{
            margin: 0px -45px;
        }

        .auth-form-transparent {
            padding: 15px;
        }
    }
</style>

    </style>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-transparent text-left p-5 text-center">
                            <form action="" method="post" id="frmLogin" class="login-form">
                                <fieldset>
                                    <legend align="middle">LOGIN</legend>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="fa fa-user-circle fa-lg"></i><h4 style="color:#000; text-align:center; ">Username:</h4>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg border-left-0 w-100 " name="UserName" onkeyup="this.value = this.value.toUpperCase();">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend bg-transparent">
                                                <span class="input-group-text bg-transparent border-right-0">
                                                    <i class="fa fa-lock fa-lg"></i></i><h4 style="color:#000; text-align:center; ">Password:</h4>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control form-control-lg border-left-0 w-100" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                    </div>
                                    <center>
                                    <div class="btn">
                                        <input class="btn btn-gradient-dark btn-login" id="btnLogin" type="submit" value="LOGIN">
                                    </div>
                                </center>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

