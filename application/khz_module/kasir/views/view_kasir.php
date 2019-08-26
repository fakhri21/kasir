<div id="app">
    <div>
        <b-navbar toggleable="lg" type="dark" variant="dark" fixed="top">
        <b-container>
        <b-navbar-brand href="#">
        <img src="<?php echo base_url();?>assets/img/mudig-165x50.png" height="50px;" class="d-inline-block align-top" alt="Logo">
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

    <b-container fluid>
    <!-- meja -->
    <b-row>
	    <b-col md="3" sm="6" class="mb-3">
		    <!-- kontainer menu -->
		    	<b-button variant="warning" block><i class="fas fa-check-square"></i> Pilih Meja</b-button>
		    <!-- /kontainer menu -->
	    </b-col>

        <b-col md="3" sm="6" class="mb-3">
            <!-- kontainer menu -->
                <b-button variant="success" block><i class="fas fa-shopping-cart"></i> Tambah Pesanan</b-button>
            <!-- /kontainer menu -->
        </b-col>
    </b-row>
	
	
    <b-row>
    	<!-- Daftar produk -->
	    <b-col md="6" sm="12" xs="12" class="mb-2">
		    <!-- kontainer menu -->
		    <b-card>  
		    </b-card>
		    <!-- /kontainer menu -->
	    </b-col>
		<!-- Daftar pesanan -->
	    <b-col md="6" sm="12" xs="12">
		    <!-- kontainer menu -->
		    <b-card>  
		    </b-card>
		    <!-- /kontainer menu -->
	    </b-col>
    </b-row>
    </b-container>
    <!-- footer -->
    <b-container fluid>
    <b-row>
    <b-col v-bind:class="c">
    <p v-bind:class="center">Copyright &copy; 2019 <span v-bind:class="footer_khz">KHz Technology</span></p>
    </b-col>
    </b-row>
    </b-container>
    
    
</div>
<!-- template -->
<!-- template view untuk komponen "Home" -->
<script type="text/x-template" id="home">
<b-row>
<b-col md="4" sm="4" v-bind:class="c_untuk_kolom_item" v-for="menuitem in menu">
<router-link :to="menuitem.link" style="text-decoration: none;">

<div v-bind:class="c_kontainer_item">
    <div v-bind:class="c_untuk_itemnya">
        <i v-bind:class="menuitem.ikon"></i>
    </div>
    <p v-bind:class="text_hitam">{{menuitem.judul}}</p>
    
</div>

</router-link>
</b-col>
</b-row>
</script>
<script type="text/x-template" id="toko">
<b-row>
<b-col md="12" class="my-3">
<b-button @click="goBack">Kembali</b-button>
</b-col>
<b-col md="3" sm="4" v-bind:class="c_untuk_kolom_item" v-for="menuitem in menu">
<router-link :to="menuitem.link" style="text-decoration: none;">

<div v-bind:class="c_kontainer_item">
    <div v-bind:class="c_untuk_itemnya">
        <i v-bind:class="menuitem.ikon"></i>
    </div>
    <p v-bind:class="text_hitam">{{menuitem.judul}}</p>
    
</div>

</router-link>
</b-col>
</b-row>
</script>
<script type="text/x-template" id="laporan">
<b-row>
<b-col md="12" class="my-3">
<b-button @click="goBack">Kembali</b-button>
</b-col>
<b-col md="3" sm="4" v-bind:class="c_untuk_kolom_item" v-for="menuitem in menu">
<router-link :to="menuitem.link" style="text-decoration: none;">

<div v-bind:class="c_kontainer_item">
    <div v-bind:class="c_untuk_itemnya">
        <i v-bind:class="menuitem.ikon"></i>
    </div>
    <p v-bind:class="text_hitam">{{menuitem.judul}}</p>
    
</div>

</router-link>
</b-col>
</b-row>
</script>
<script type="text/x-template" id="kasir">
<b-row>
<b-col md="12">
<b-button @click="goBack" class="mb-3"><i class="fas fa-angle-left"></i> Kembali</b-button>
<div class="place my-2">
    <p class="status-timbangan">
        Status Buku saat ini : &nbsp;<a class="tampil-status">Terbuka</a>
    </p>
</div>
<b-button variant="success" class="mb-3"><i class="fas fa-door-open"></i> Buka Buku</b-button>
<b-button variant="danger" class="mb-3"><i class="fas fa-door-closed"></i> Tutup Buku</b-button>
</b-col>
<b-col md="4" sm="4" v-bind:class="c_untuk_kolom_item" v-for="menuitem in menu">
<router-link :to="menuitem.link" style="text-decoration: none;">

<div v-bind:class="c_kontainer_item">
    <div v-bind:class="c_untuk_itemnya">
        <i v-bind:class="menuitem.ikon"></i>
    </div>
    <p v-bind:class="text_hitam">{{menuitem.judul}}</p>
    
</div>

</router-link>
</b-col>
</b-row>
</script>

    
    
<script src="<?php echo base_url();?>assets/js/vue.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vue-router.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-vue.js"></script>
<script src="<?php echo base_url();?>assets/js/app-mudig.js"></script>