<template>
    <div class="header-bonus">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="bonus-login pull-left">
                        <a data-toggle="modal" data-target="#so_sociallogin" href="#">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{$t('login')}}
                            {{$t('or')}}
                            {{$t('registration')}}
                        </a>
                    </div>
                    <div class="bonus-language pull-left">
                        <div class="btn-group">
                            <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                {{$t('lang')}}
                                <span class="hidden-xs hidden-sm hidden-md"></span> <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="btn-block language-select" type="button" name="ar-ar">
                                        <img src="image/catalog/flags/ar.png" alt="Ar" title="Ar" />
                                        {{$t('arabic')}}
                                    </button>
                                </li>
                                <li>
                                    <button class="btn-block language-select" type="button" name="en-gb">
                                        <img src="image/catalog/flags/gb.png" alt="En" title="En" />
                                        {{$t('english')}}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="bonus-social pull-right">
                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    </ul>
                    <div class="bonus-mail pull-right">
                        <a href="mailto:info@hoteelsegypt.com">info@hoteelsegypt.com</a>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade in" id="so_sociallogin" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog block-popup-login">
                <a href="javascript:void(0)" title="Close" class="close close-login fa fa-times-circle" data-dismiss="modal"></a>
                <div class="tt_popup_login"><strong>Sign in Or Register</strong></div>
                <div class="block-content">
                    <div class=" col-reg registered-account">
                        <div class="block-content">
                            <form class="form form-login" action="#" method="post" id="login-form">
                                <fieldset class="fieldset login" data-hasrequired="* Required Fields">
                                    <div class="field email required email-input">
                                        <div class="control">
                                            <input name="email" value="" autocomplete="off" id="email" type="email" class="input-text" title="Email" placeholder="E-Mail Address">
                                        </div>
                                    </div>
                                    <div class="field password required pass-input">
                                        <div class="control">
                                            <input name="password" type="password" autocomplete="off" class="input-text" id="pass" title="Password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label class="control-label">Login with your social account</label>
                                        <div>
                                            <a href="#" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-linkdin"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="secondary ft-link-p"><a class="action remind" href="#"><span>Forgot Your Password?</span></a></div>
                                    <div class="actions-toolbar">
                                        <div class="primary">
                                            <button type="submit" class="action login primary" name="send" id="send2"><span>Login</span></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="col-reg login-customer">
                        <h2>NEW HERE?</h2>
                        <p class="note-reg">Registration is free and easy!</p>
                        <ul class="list-log">
                            <li>Faster checkout</li>
                            <li>Save multiple shipping addresses</li>
                            <li>View and track orders and more</li>
                        </ul>
                        <a class="btn-reg-popup" title="Register" href="#">Create an account</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
name: 'Topnav',

    data() {
        return {
        }
    }
}
</script>
