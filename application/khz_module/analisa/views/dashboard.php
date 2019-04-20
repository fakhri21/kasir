<div class="container-fluid">
 <h2>Analisa</h2>

 <div class="row" id="toprank"></div>
 <div class="row" id="analisa_sales"></div>
 
</div>

<script>
    $(document).ready(function() {
        $("#toprank").load("<?php echo base_url('analisa/toprank') ?>")
        $("#analisa_sales").load("<?php echo base_url('analisa/statistik_penjualan') ?>")
    })
</script>