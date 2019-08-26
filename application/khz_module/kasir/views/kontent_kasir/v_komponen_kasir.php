<script type="text/x-template" id="k_meja">
  <div>
	<b-card class="my-2">
    <b-button variant="warning"><i class="fas fa-check-square"></i> &nbsp;Pilih Meja</b-button>
    <b-button variant="success"><i class="fas fa-plus"></i> &nbsp;Tambah Pesanan</b-button>
	</b-card>
</div>
</script>

<script>
Vue.component('k_meja', {
	template:'#k_meja',
	data: function () {
	return {
		meja : 'lorem',
	}
	},
	methods : {},
})
</script>

<script type="text/x-template" id="k_pesanan">
  <b-card class="my-2">
      <h3>Daftar Meja</h3>
      <hr>
      <b-row>
        <b-col md="6" sm="6">

          <b-card header="Meja : T-7">
              <b-card-text>
                <b-badge variant="primary" variant="primary">No Bill : 93482304</b-badge>
                  <p><i class="fas fa-calendar-alt"></i> 2019/8/2 | <i class="fas fa-clock"></i> 18:25</p>
                  
                  <b-button size="sm" variant="warning"><i class="fas fa-check-square"></i> Pilih Meja</b-button>
                  <b-button size="sm" variant="warning"><i class="fas fa-receipt"></i> Detail Pesanan</b-button>
              </b-card-text>
          </b-card>

        </b-col>
      </b-row>
  </b-card>
</script>
<script>
Vue.component('k_pesanan', {
  template:'#k_pesanan',
  data: function () {
  return {
    meja : [],
  }
  },
  methods : {},
})
</script>

<script type="text/x-template" id="k_t_pesanan">
  <div>
    <b-card class="my-2">
      <h3>Daftar Pesanan</h3>
      <hr>
    <b-form-input v-model="filter" placeholder="Ketik untuk mencari"></b-form-input>
    <hr>
      <b-table
        class="table table-striped table-inverse table-responsive"
        id="my-table"
        show-empty
        :items="items"
        :filter='keyword'
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        @filtered="onFiltered"
        
        >
        
      </b-table>

    <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        class="my-0"
        aria-controls="my-table"
        >
    </b-pagination>
    <hr>          
      <b-button variant="warning" v-on:click="masukpesanan()"> <i class="fa fa-check-square"></i> Simpan Pesanan </b-button>
</b-card>
</div>
</script>

<script>
var items_cart=[]
Vue.component('k_t_pesanan', {
  template:'#k_t_pesanan',

  data() {
    return {
            currentPage: 1,
            perPage: 5,
            pageOptions: [5, 10, 15],
            keyword: "",
            filter:null,
            rows:0,
      items: items_cart,
      fields: [
        { key: "nama_product", label: "Nama", sortable: true },
        { key: "quantity", label: "Quantity", sortable: true },
        { key: "harga", label: "Harga", sortable: true },
        { key: "keterangan", label: "Harga", sortable: true },
        { key: "actions", label: "action", sortable: true }
      ]
    };
  },
    created: function () {
        var _this = this;
       
    },
    methods: {
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.rows = filteredItems.length
        this.currentPage = 1
      },
      refreshitem() {
        var _this = this;
        $.getJSON("<?php echo base_url('waitress_pesanan/cart') ?>", function (json) {
            _this.items = json.data;
             _this.rows=_this.items.length
        });
      },
      updateitem(rowid,quantity,keterangan){
        var _this = this;
        var data={
          "quantity":quantity,
          "keterangan":keterangan,
          "rowid":rowid
        };
        $.post("waitress_pesanan/updateitemcart/",data,function (pesan) {
          alertify.success(pesan)
          _this.refreshitem()
        })

      },
      deleteitem(rowid){
        var _this = this;
        $.post("waitress_pesanan/hapusitemcart/"+rowid+"",function (pesan) {
          alertify.success(pesan)
          _this.refreshitem()
        })
      },
      masukpesanan(){
        var _this = this;
        $.post("waitress_pesanan/masukpesanan",function (pesan) {
          alertify.success(pesan)
          _this.refreshitem()
        })
      }
    },
  computed: {
    
  }

})
</script>


		<!-- eksekusi vue -->
		<script type="text/javascript">
		var aplikasi=new Vue({
		el: '#apps',
		// define data - initial display text
		data: {
		},
		methods: {}
		})
		</script>