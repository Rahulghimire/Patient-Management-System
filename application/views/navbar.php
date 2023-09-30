<nav class="navbar justify-content-between">
        <a class="navbar-brand text-white fw-bold text-uppercase" href="<?php echo base_url().'index.php/Patient/'?>">Patient Administration</a>
        <form class="form-inline">
            <li><a href="<?php echo base_url().'index.php/Patient/billing'?>"><i class="fas fa-file-invoice px-2"></i><span class="caret mr-3 font-weight-bold text-uppercase">Billing </span></a></li>
            <li><a href="#"><i class="fa fa-user-circle"></i> <span class="caret mr-2"><span class="mr-1">Welcome!</span><?php echo $this->session->userdata('auth_user')['name']; ?></span></a></li>
            <li><a href="<?php echo base_url().'index.php/Login/logout'?>"><i class="fa fa-sign-out"></i> Logout</a></li>
        </form>
    </nav>