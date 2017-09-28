<div style="background-color: #f8f9fa;padding:50px 0;margin:-50px 0 50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 align-self-start"></div>
            <div class="col-md-6">
                <div class="">
					<?= app::$msg ?>
                    <form action="/login" method="post">
                        <div class="form-group">
                            <label for="login-email">Email address</label>
                            <input type="email" name="email" class="form-control" id="login-email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input type="password" name="password" class="form-control" id="login-password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">LOGIN</button>
                    </form>
                    <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        register new user
                    </a>
                </div>
            </div>
            <div class="col-lg-3 align-self-end"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row align-items-center ">
        <div class="col-lg-3 align-self-start"></div>
        <div class="col-md-6 align-self-center">
            <div class="collapse" id="collapseExample">
                <form action="/register" method="post">
                    <div class="form-group">
                        <label for="register-firstname">First name</label>
                        <input type="text" class="form-control" name="firstname" id="register-firstname" placeholder="Your first name">
                    </div>
                    <div class="form-group">
                        <label for="register-lastname">Last name</label>
                        <input type="text" class="form-control" name="lastname" id="register-lastname" placeholder="Your last name">
                    </div>
                    <div class="form-group">
                        <label for="register-nickname">Nickname</label>
                        <input type="text" class="form-control" name="nickname" id="register-nickname" placeholder="Nickname">
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email address</label>
                        <input type="email" class="form-control" name="email" id="register-email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input type="password" class="form-control" name="password" id="register-password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">REGISTER</button>
                </form>
            </div>
        </div>
        <div class="col-lg-3 align-self-end"></div>
    </div>
</div>