Vue.component('menu-awal', {
    template: '#home',
    data: function() {
        return {
            menu: [

                {
                    judul: 'Menu Kedua',
                    ikon: 'fas fa-user bulat',
                    value : 'ke-menu-kedua'
                },

                {
                    judul: 'Menu Ketiga',
                    ikon: 'fas fa-angle-double-left bulat biru',
                    value : 'ke-menu-ketiga'
                },
            ],

            c_untuk_kolom_item: 'block',
            c_untuk_itemnya: 'circle',


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
  { path: '/ke-menu-kedua', component: 'menu-kedua' },
  { path: '/ke-menu-ketiga', component: 'menu-ketiga' }
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