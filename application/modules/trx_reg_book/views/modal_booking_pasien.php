<div class="modal-body">

    <h5 class="mb-3" style="font-weight:600;">Pilih Pasien untuk Booking Slot</h5>

    <input type="hidden" id="m_dokter"  value="<?= $id_dokter ?>">
    <input type="hidden" id="m_tanggal" value="<?= $tanggal ?>">
    <input type="hidden" id="m_jam"     value="<?= $jam ?>">

    <label><b>Cari Pasien</b></label>
    <select id="pasien_select2" class="form-control" style="width:100%;"></select>

    <br>

    <label><b>Asuransi / Company</b></label>
    <select id="id_asuransi" class="form-control">
        <option value="">-- Pilih Asuransi --</option>
        <?php foreach($company as $c): ?>
            <option value="<?= $c->id_company ?>"><?= $c->name ?></option>
        <?php endforeach; ?>
    </select>

    <br>

    <button class="btn btn-success btn-block" id="btnBookingNow">
        <i class="fa fa-save"></i> Simpan Booking
    </button>

</div>

<script>
/* SELECT2 PASIEN */
$('#pasien_select2').select2({
    ajax: {
        url: "<?= site_url('trx_reg_book/ajax_pasien_select2'); ?>",
        dataType: 'json',
        delay: 200,
        data: params => ({ q: params.term }),
        processResults: data => ({ results: data }),
    },
    placeholder: 'Ketik nama / no RM / tgl lahir...',
    minimumInputLength: 1,
    width: '100%'
});

/* SIMPAN BOOKING */
$("#btnBookingNow").click(function(){

    let id_pasien  = $("#pasien_select2").val();
    let id_asuransi = $("#id_asuransi").val();
    let dokter     = $("#m_dokter").val();
    let tanggal    = $("#m_tanggal").val();
    let jam        = $("#m_jam").val();

    if (!id_pasien) {
        alert("Silakan pilih pasien terlebih dahulu.");
        return;
    }

    $.post("<?= site_url('trx_reg_book/save'); ?>", {
        id_dokter: dokter,
        tanggal: tanggal,
        jam_slot: jam,
        id_pasien: id_pasien,
        id_asuransi: id_asuransi
    }, function(res){
        location.reload();
    });

});

</script>
