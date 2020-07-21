<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="#">
                    <img height='50' width='50' src="<?php echo base_url(); ?>/assets/images/logo.jpg" alt="John Doe" />
                </a>
            </div>
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="<?php echo base_url(); ?>/assets/images/logo.jpg" alt="John Doe" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#"> <?php echo session()->get('username') ?></a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>/assets/images/logo.jpg" alt="John Doe" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="/user"><?php echo session()->get('username') ?></a>
                                    </h5>
                                    <span class="email"><?php echo session()->get('email') ?></span>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="/auth/logout">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->

<!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img height='50' width='50' src="<?php echo base_url(); ?>/assets/images/logo.jpg" alt="John Doe" />

                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="header-button-item has-noti js-item-menu">
            <i class="zmdi zmdi-notifications"></i>
        </div>
        <div class="header-button-item js-item-menu">
            <i class="zmdi zmdi-settings"></i>
        </div>
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img src="<?php echo base_url(); ?>/assets/images/icon/avatar-01.jpg" alt="John Doe" />

                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#"><?php echo session()->get('username') ?></a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>/assets/images/icon/avatar-01.jpg" alt="John Doe" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="/user"><?php echo session()->get('username') ?></a>
                            </h5>
                            <span class="email"><?php echo session()->get('email') ?></span>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="/auth/logout">
                            <i class="zmdi zmdi-power"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!-- END HEADER MOBILE -->