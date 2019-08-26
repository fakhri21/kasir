<!doctype html>
<html>
    <head>
        <title>Dashboard Menu Digital</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-vue.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/lib/fontawesome/css/all.min.css">
        <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard-style.css">
    </head>
    <body>

        <div>
        <b-navbar toggleable="lg" type="dark" variant="dark" fixed="top">
        <b-container>
        <b-navbar-brand href="#">
        <img src="assets/img/mudig-165x50.png" height="50px;" class="d-inline-block align-top" alt="Logo">
        </b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
        <b-nav-item href="#">Dashboard</b-nav-item>
        <b-nav-item-dropdown right>
        <!-- Using 'button-content' slot -->
        <template slot="button-content"><i class="fas fa-user-circle"></i> <em>Nama User </em> </template>
        <b-dropdown-item href="#">Profile</b-dropdown-item>
        <b-dropdown-item href="#">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
        </b-navbar-nav>
        </b-collapse>
        </b-container>
        </b-navbar>
    </div>
        <?php echo $contents ?>
        
    <script src="<?php echo base_url();?>assets/js/vue.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vue-router.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-vue.js"></script>
    <script src="<?php echo base_url();?>assets/js/app-mudig.js"></script>
</body>
</html>