<div class="tab-content">
    <!-- Tab Pasien Lama -->
    <div class="tab-pane fade <?php echo (isset($is_search) && $is_search) ? 'show active' : ''; ?>" id="tab_pas_lama">
        <?php $this->load->view('inner_pasien_lama_list', $data); ?>
    </div>
    
    <!-- Tab Pasien APS -->
    <div class="tab-pane fade" id="tab_pas_aps">
        <!-- Konten tab APS -->
    </div>
</div>

<script>
$(document).ready(function(){
    // Aktifkan tab pasien lama jika ada pencarian
    <?php if(isset($is_search) && $is_search): ?>
        $("#id_pas_lama").addClass("active show");
        $("#tab_pas_lama").addClass("active show");
        $("#id_pas_aps").removeClass("active show");
        $("#tab_pas_aps").removeClass("active show");
    <?php endif; ?>
});
</script>