<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
                        <li role="tab" aria-selected="true" class="active" style="z-index: 6;"><span class="label badge-inverse">2</span><a href="<?= base_url('laporan/list/' . session()->get('id_satuan_kerja')) ?>" class="hidden-phone">Laporan</a></li>
                        <li role="tab" aria-selected="true" class="active" style="z-index: 5;"><span class="label badge-inverse">3</span><a href="<?= base_url('temuan/index/' . session()->get('id_laporan')) ?>" class="hidden-phone">Temuan</a></li>
                        <li role="tab" aria-selected="false" class="active" style="z-index: 4;"><span class="label badge-inverse">4</span><a href="<?= base_url('sebab/index/' . session()->get('id_temuan')) ?>" class="hidden-phone">Sebab</a></li>
                        <li role="tab" aria-selected="false" class="active" style="z-index: 3;"><span class="label badge-inverse">5</span><a href="<?= base_url('rekomendasi/index/' . session()->get('id_sebab')) ?>" class="hidden-phone">Rekomendasi</a></li>
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
                            <form action="<?= base_url('rekomendasi/update/' . $data->id); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal no-margin">

                                <?= csrf_field(); ?>
                                <?= input_text($field_name = 'no_rekomendasi', $label = 'No. Rekomendasi', $value = $data->no_rekomendasi, $required = true, $readonly = true, $disabled = false); ?>
                                <?= input_select($field_name = 'id_jenis_rekomendasi', $label = 'Jenis Rekomendasi', $jenis_rekomendasi_options, $selected = $data->id_jenis_rekomendasi, $required = true, $disabled = ''); ?>
                                <?= input_textarea($field_name = 'memo_rekomendasi', $label = 'Memo Rekomendasi', $value = $data->memo_rekomendasi, $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_number($field_name = 'nilai_rekomendasi', $label = 'Nilai Rekomendasi', $value = $data->nilai_rekomendasi, $required = true, $readonly = false, $disabled = false); ?>
                                <?= input_multiselect('nama_penanggung_jawab[]', 'Nama Penanggung Jawab', $options_tags, $options_selected, $required = true, $readonly = false); ?>
                                <?= input_hidden($field_name = 'id_sebab', $value = $data->id_sebab); ?>
                                <div class="form-actions no-margin">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn" onclick="window.history.back();">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <!-- tidak dapat di tindak lanjuti upload -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(".select2-container").select2({
        tags: true,
        tokenSeparators: [',']
    });
</script>

<?= $this->endSection(); ?>