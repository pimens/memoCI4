<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="<?php echo base_url(); ?>/assets/images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        BPRS Dinar Asri
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <a href="/auth/logout">
            <i class="zmdi zmdi-power"></i> Logout</a>
        <h5 class="name">
            <a href="/user">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo session()->get('username') ?></a>
        </h5>
    </div>
</nav>
<br><br>