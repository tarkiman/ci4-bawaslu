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
                        <li role="tab" aria-selected="true" class="active" style="z-index: 4;"><span class="label badge-inverse">1</span><a href="<?= base_url('laporan') ?>" class="hidden-phone">Laporan</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 3;"><span class="label badge-inverse">2</span><a href="<?= base_url('temuan/index/') ?>" class="hidden-phone">Temuan</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 2;"><span class="label badge-inverse">3</span><a href="<?= base_url('tindaklanjut/index/') ?>" class="hidden-phone">Rekomendasi</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 1;"><span class="label badge-inverse">4</span><a href="<?= base_url('tindaklanjut/index/') ?>" class="hidden-phone">Tindak Lanjut</a></li>
                    </ol>

                    <div class="well">
                        <div class="widget-body">

                            <?php if (session()->getFlashData('messages')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashData('messages') ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('tindaklanjut/save'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal no-margin">

                                <?= csrf_field(); ?>
                                <?= input_number($field_name = 'nilai_rekomendasi', $label = 'Nilai Rekomendasi', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_akhir_rekomendasi', $label = 'Nilai Akhir Rekomendasi', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_sisa_rekomendasi', $label = 'Nilai Sisa Rekomendasi', $value = '', $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_hidden($field_name = 'id_rekomendasi', $value = $id_rekomendasi); ?>
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