<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>
<link href="<?= '/assets/css/select2.css'; ?>" rel="stylesheet">
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe14a;"></span> <?= $title; ?>
                </div>
            </div>
            <div class="widget-body">
                <div id="wizard" class="bwizard clearfix">
                    <ol class="bwizard-steps clearfix clickable" role="tablist">
                        <li role="tab" aria-selected="true" class="active" style="z-index: 7;"><span class="label badge-inverse">1</span><a href="<?= base_url('laporan') ?>" class="hidden-phone">Satuan Kerja</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 6;"><span class="label badge-inverse">2</span><a href="<?= base_url('laporan/list/' . session()->get('id_wilayah')) ?>" class="hidden-phone">Laporan</a></li>
                        <li role="tab" aria-selected="false" style="z-index: 5;" class=""><span class="label">3</span>Temuan</li>
                        <li role="tab" aria-selected="false" style="z-index: 4;" class=""><span class="label">4</span>Sebab</li>
                        <li role="tab" aria-selected="false" style="z-index: 3;" class=""><span class="label">5</span>Rekomendasi</li>
                        <li role="tab" aria-selected="false" style="z-index: 2;" class=""><span class="label">6</span>Tindak Lanjut</li>
                        <li role="tab" aria-selected="false" style="z-index: 1;" class=""><span class="label">7</span>Bukti</li>
                    </ol>

                    <div class="well">
                        <div class="widget-body">

                            <?php if (session()->getFlashData('messages')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashData('messages') ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('laporan/save'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal no-margin">

                                <?= csrf_field(); ?>
                                <?= input_text($field_name = 'no_laporan', $label = 'No. Laporan', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_date($field_name = 'tanggal_laporan', $label = 'Tanggal Laporan', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'nama_laporan', $label = 'Nama Laporan', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'no_surat_tugas', $label = 'No. Surat Tugas', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_date($field_name = 'tanggal_surat_tugas', $label = 'Tanggal Surat Tugas', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?php
                                $optionsUnitPelaksana = [
                                    'BPK' => 'BPK',
                                    'BPKP' => 'BPKP',
                                    'IRWIL1' => 'IRWIL1',
                                    'IRWIL2' => 'IRWIL2',
                                    'IRWIL3' => 'IRWIL3'
                                ];
                                ?>
                                <?= input_select($field_name = 'unit_pelaksana', $label = 'Unit Pelaksana', $optionsUnitPelaksana, $selected = '', $required = true, $disabled = ''); ?>
                                <?= input_text($field_name = 'nip_pimpinan', $label = 'NIP Pimpinan Satker', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'pimpinan_satuan_kerja', $label = 'Pimpinan Satuan Kerja', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'nama_satuan_kerja', $label = 'Nama Satuan Kerja', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'tahun_anggaran', $label = 'Tahun Anggaran', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_anggaran', $label = 'Nilai Anggaran', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'realisasi_anggaran', $label = 'Realisasi Anggaran', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'audit_anggaran', $label = 'Anggaran yang diaudit', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_text($field_name = 'jenis_anggaran', $label = 'Jenis Anggaran', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_select($field_name = 'ketua_tim', $label = 'Ketua TIM', $options, $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_multiselect('anggota_tim[]', 'Anggota TIM', $options, $selected = array(), $required = true, $readonly = false); ?>
                                <div class="form-actions no-margin">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= base_url('laporan/list/' . session()->get('id_satuan_kerja')) ?>" class="btn" onclick="window.history.back();">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= '/assets/js/select2.js'; ?>"></script>
<script type="text/javascript">
    $(".select2-container").select2();

    $(document).ready(function() {
        $("#nip_pimpinan").keypress(function(e) {
            if (
                e.which != 8 &&
                e.which != 0 &&
                (e.which < 48 || e.which > 57) &&
                e.which != 46
            ) {
                return false;
            }
        });
    });
</script>

<?= $this->endSection(); ?>