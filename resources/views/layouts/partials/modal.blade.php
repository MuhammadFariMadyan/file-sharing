<div class="modal about-modal w3-agileits fade" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body login-page ">
                <!-- login-page -->
                <div class="login-top sign-top">
                    <div class="agileits-login">
                        <h5>Login</h5>
                        <form action="{{ route('login') }}" method="post" role="form">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <input type="email" class="email" name="email" placeholder="Email" required=""/>
                            <input type="password" class="password" name="password" placeholder="Password" required=""/>
                            <div class="wthree-text">
                                <ul>
                                    <li>
                                        <label class="anim">
                                        <input name="remember" value="1" type="checkbox" class="checkbox">
                                        <span> Remember me ?</span>
                                        </label>
                                    </li>
                                    <li> <a href="#">Forgot password?</a> </li>
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="w3ls-submit">
                                <input type="submit" value="LOGIN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- //login-page -->
    </div>
</div>

<div class="modal about-modal w3-agileits fade" id="myModal3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body login-page ">
                <!-- login-page -->
                <div class="login-top sign-top">
                    <div class="agileits-login">
                        <h5>Register</h5>
                        <form action="{{ url('register') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <input type="text" name="name" placeholder="Full Name" required=""/>
                            <input type="email"  name="email" placeholder="Email" required=""/>
                            <input type="password" name="password" placeholder="Password" required=""/>
                            <div class="wthree-text">
                                <ul>
                                    <li>
                                        <label class="anim">
                                        <input type="checkbox" class="checkbox">
                                        <span> I accept <a href="{{ route('page.rule') }}" class="bg-primary">the terms of use</a></span>
                                        </label>
                                    </li>
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="w3ls-submit">
                                <input type="submit" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- //login-page -->
    </div>
</div>
