Vue.component('menu-awal', {
    template: '#home',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Pemesanan',
                    ikon: 'fas fa-clipboard-list bulat bg-dark',
                    link : 'waitress_pesanan'
                },

                {
                    judul: 'Kasir',
                    ikon: 'fas fa-cash-register bulat bg-dark',
                    link : 'ke-menu-kasir'
                },

                {
                    judul: 'Akuntansi',
                    ikon: 'fas fa-calculator bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Manajemen Toko',
                    ikon: 'fas fa-warehouse bulat bg-dark',
                    link : 'ke-menu-toko'
                },

                {
                    judul: 'Dapur',
                    ikon: 'fas fa-mortar-pestle bulat bg-dark',
                    link : '#'
                },


                {
                    judul: 'Konfigurasi',
                    ikon: 'fas fa-tools bulat bg-dark',
                    link : '#'
                },
            ],

            c_untuk_kolom_item: 'block',
            c_kontainer_item: 'card bg-warning my-2',
            c_untuk_itemnya: 'card-body',
            text_hitam: 'text-dark judul-menu',


        }
    }

})

Vue.component('menu-toko', {
    template: '#toko',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Data Produk',
                    ikon: ' fas fa-cubes bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Data Kategori',
                    ikon: 'fas fa-list-ul bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Data Jenis',
                    ikon: 'fas fa-list-alt bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Data Meja',
                    ikon: 'fas fa-clone bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Metode Pembayaran',
                    ikon: 'fas fa-coins bulat bg-dark',
                    link : '#'
                },


                {
                    judul: 'Tipe Pembayaran',
                    ikon: 'fas fa-wallet bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Laporan',
                    ikon: 'fas fa-file bulat bg-dark',
                    link : 'ke-menu-laporan'
                },

            ],

            c_untuk_kolom_item: 'block',
            c_kontainer_item: 'card bg-warning my-2',
            c_untuk_itemnya: 'card-body',
            text_hitam: 'text-dark judul-menu',


        }
    },

    methods: {
    goBack () {
      window.history.length > 1
        ? this.$router.go(-1)
        : this.$router.push('/')
    }
  }

})


Vue.component('menu-laporan', {
    template: '#laporan',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Daftar Struk',
                    ikon: 'fas fa-file-alt bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Laporan',
                    ikon: 'fas fa-file-invoice bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Analisa',
                    ikon: 'fas fa-file-invoice-dollar bulat bg-dark',
                    link : '#'
                }

            ],

            c_untuk_kolom_item: 'block',
            c_kontainer_item: 'card bg-warning my-2',
            c_untuk_itemnya: 'card-body',
            text_hitam: 'text-dark judul-menu',


        }
    },

    methods: {
    goBack () {
      window.history.length > 1
        ? this.$router.go(-1)
        : this.$router.push('/')
    }
  }

})


Vue.component('menu-kasir', {
    template: '#kasir',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Kasir',
                    ikon: 'fas fa-cash-register bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Menu Poin',
                    ikon: 'fas fa-coins bulat bg-dark',
                    link : '#'
                },

                {
                    judul: 'Daftar Struk',
                    ikon: 'fas fa-receipt bulat bg-dark',
                    link : '#'
                }

            ],

            c_untuk_kolom_item: 'block',
            c_kontainer_item: 'card bg-warning my-2',
            c_untuk_itemnya: 'card-body',
            text_hitam: 'text-dark judul-menu',


        }
    },

    methods: {
    goBack () {
      window.history.length > 1
        ? this.$router.go(-1)
        : this.$router.push('/')
    }
  }

})


Vue.component('menu-kedua', {
    template: '#kedua',
    data: function() {
        return {
            menu: [{
                    judul: 'satu',
                    ikon: 'fas fa-user bulat biru'
                }, {
                    judul: 'dua',
                    ikon: 'fas fa-angle-double-left bulat biru'
                }, {
                    judul: 'tiga',
                    ikon: 'fas fa-biking bulat biru'
                }, {
                    judul: 'empat',
                    ikon: 'fas fa-blind bulat biru'
                }, {
                    judul: 'lima',
                    ikon: 'fas fa-cat bulat biru'
                }, {
                    judul: 'enam',
                    ikon: 'fas fa-chess bulat biru'
                }

            ],
            c_untuk_kolom_item: 'block',
            c_untuk_itemnya: 'circle',


        }
    },

    methods: {
    goBack () {
      window.history.length > 1
        ? this.$router.go(-1)
        : this.$router.push('/')
    }
  }

})

Vue.component('menu-ketiga', {
    template: '#ketiga',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Satu',
                    ikon: 'fas fa-user bulat merah'
                },

                {
                    judul: 'dua',
                    ikon: 'fas fa-angle-double-left bulat merah'
                },
            ],

            c_untuk_kolom_item: 'block',
            c_untuk_itemnya: 'circle',


        }
    },

    methods: {
    goBack () {
      window.history.length > 1
        ? this.$router.go(-1)
        : this.$router.push('/')
    }
  }

})


// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/', component: 'menu-awal' },
  { path: '/ke-menu-toko', component: 'menu-toko' },
  { path: '/ke-menu-kasir', component: 'menu-kasir' },
  { path: '/ke-menu-laporan', component: 'menu-laporan' }
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

var app = new Vue({
    router,
    el: '#app',
    data: {
        x:1,
        b: 'border',
        c: 'border fixed-bottom footer',
        m5: 'my-5',
        center: 'text-center my-3',
        k_item: 'card my-2',
        footer_khz: 'footer-khz',

        icon: 'fas fa-user',
        nama: 'Admin',
    }

});