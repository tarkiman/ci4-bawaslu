<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>

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
                        <li role="tab" aria-selected="true" class="active" style="z-index: 6;"><span class="label badge-inverse">1</span><a href="<?= base_url('laporan') ?>" class="hidden-phone">Satuan Kerja</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 5;"><span class="label badge-inverse">2</span><a href="<?= base_url('laporan/list/' . session()->get('id_wilayah')) ?>" class="hidden-phone">Laporan</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">3</span><a href="<?= base_url('temuan/index/' . session()->get('id_laporan')) ?>" class="hidden-phone">Temuan</a></li>
                        <li role="tab" aria-selected="false" class="active" style="z-index: 3;"><span class="label badge-inverse">4</span><a href="<?= base_url('rekomendasi/index/' . session()->get('id_temuan')) ?>" class="hidden-phone">Rekomendasi</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 2;"><span class="label badge-inverse">5</span><a href="<?= base_url('tindaklanjut/index/' . session()->get('id_rekomendasi')) ?>" class="hidden-phone">Tindak Lanjut</a></li>
                        <li role="tab" aria-selected="false" style="z-index: 1;" class=""><span class="label">6</span>Bukti</li>
                    </ol>

                    <div class="well">
                        <div class="widget-body">

                            <?php if (session()->getFlashData('messages')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashData('messages') ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('tindaklanjut/update/' . $data->id); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal no-margin">

                                <?= csrf_field(); ?>
                                <?= input_number($field_name = 'nilai_rekomendasi', $label = 'Nilai Rekomendasi', $value = $data->nilai_rekomendasi, $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_akhir_rekomendasi', $label = 'Nilai Akhir Rekomendasi', $value = $data->nilai_akhir_rekomendasi, $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_sisa_rekomendasi', $label = 'Nilai Sisa Rekomendasi', $value = $data->nilai_sisa_rekomendasi, $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_hidden($field_name = 'id_rekomendasi', $value = $data->id_rekomendasi); ?>
                                <div class="form-actions no-margin">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn" onclick="window.history.back();">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>