<?php
// EXPECT: $slots = array of object:
//  ->jam_slot
//  ->id_pasien (null / '' jika kosong)
//  ->nama_pasien
//  ->asuransi
//  ->birthdate (Y-m-d)
//  ->status (optional, misal: 'Menunggu' / 'Selesai')

if (!isset($slots)) {
    $slots = array();
}
?>

<div class="table-responsive">
<table class="table table-bordered">
    <thead class="thead-booking">
    <tr>
        <th style="width:40px;">#</th>
        <th style="width:90px;">Jam Slot</th>
        <th style="width:110px;">Status</th>
        <th>Pasien</th>
        <th style="width:100px;">No RM</th>
        <th style="width:120px;">Tgl Lahir</th>
        <th style="width:130px;">Asuransi</th>
        <th style="width:80px;">Aksi</th>   <!-- ⭐ kolom baru -->
    </tr>
    </thead>


    <tbody>
    <?php if (!empty($slots)): ?>
        <?php $no=1; foreach($slots as $s): ?>
            <?php
                $filled = isset($s->id_pasien) && $s->id_pasien != '';
                $rowClass = $filled ? 'slot-row-filled' : 'slot-row-free slot-free-click';

                $nama_pasien = $filled && isset($s->nama_pasien) ? $s->nama_pasien : '-';
                $no_rm       = $filled ? $s->id_pasien : '-';
                $asuransi    = $filled && isset($s->asuransi) && $s->asuransi != '' ? $s->asuransi : '-';
                $tgl_lahir   = '-';
                if ($filled && isset($s->birthdate) && $s->birthdate != '') {
                    $tgl_lahir = date('d-m-Y', strtotime($s->birthdate));
                }

                $status_text = 'Kosong';
                if ($filled) {
                    if (isset($s->status) && $s->status != '') {
                        $status_text = $s->status;
                    } else {
                        $status_text = 'Booked';
                    }
                }
            ?>
            <tr class="<?php echo $rowClass; ?>"
                <?php if (!$filled): ?>
                    data-jam="<?php echo $s->jam_slot; ?>"
                <?php endif; ?>
            >
                <td><?php echo $no++; ?></td>
                <td><b><?php echo $s->jam_slot; ?></b></td>
            
                <td>
                    <?php if ($filled): ?>
                        <span class="badge-status badge-menunggu"><?php echo $status_text; ?></span>
                    <?php else: ?>
                        <span class="badge-status badge-selesai"><?php echo $status_text; ?></span>
                    <?php endif; ?>
                </td>
            
                <td><?php echo $nama_pasien; ?></td>
                <td><?php echo $no_rm; ?></td>
            
                <!-- POSISI BARU -->
                <td><?php echo $tgl_lahir; ?></td>
                <td><?php echo $asuransi; ?></td>
                <td class="text-center">
                    <?php if ($filled): ?>
                        <button class="btn btn-danger btn-sm"
                                onclick="hapusBooking('<?= $s->id_booking ?>')">
                            <i class="fa fa-trash"></i>
                        </button>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

            </tr>

        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">
                <i>Tidak ada slot yang terdata untuk tanggal ini.</i>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<script>
// Klik slot kosong = buka form booking (modal)
$('.slot-free-click').css('cursor','pointer');

$('.slot-free-click').on('click', function(){
    var jam = $(this).data('jam');
    var tanggal = $('#tagTanggal').text();
    var dokter  = $('#filterDokter').val();
              

    var url = "<?= site_url('trx_reg_book/modal_booking_pasien'); ?>" +
          "?dokter=" + encodeURIComponent(dokter) +
          "&tanggal=" + encodeURIComponent(tanggal) +
          "&jam=" + encodeURIComponent(jam);

        loadModal(url, "md");


    // buka form booking dalam modal
    if (typeof loadModal === 'function') {
        loadModal(url, 'lg');
    } else {
        window.location.href = url;
    }
});
</script>

<script>
function hapusBooking(id) {
    if (!confirm("Hapus booking ini?")) return;

    $.post("<?= site_url('trx_reg_book/delete_booking'); ?>",
    { id: id },
    function(res){
        try {
            var r = JSON.parse(res);
            if (r.status === 'ok') {
                alert("Booking berhasil dihapus.");
                let tgl = $('#tagTanggal').text();
                loadBookingTanggal(tgl); // refresh slot
            } else {
                alert(r.msg);
            }
        } catch(e) {
            alert("Gagal menghapus booking.");
        }
    });
}
</script>

