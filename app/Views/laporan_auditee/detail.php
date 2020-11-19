<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>

<div class="row-fluid">
    <div class="span12">

        <div class="alert alert-block alert-info fade in no-margin">
            <h4 class="alert-heading">
                <?= $data->no_laporan; ?>
            </h4>
            <br>
            <p>
                <?= $data->nama_laporan; ?>
            </p>
        </div>
        <br>
        <div class="widget no-margin">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe0f7;"></span> Temuan
                </div>
            </div>
            <div class="widget-body">
                <ul class="imp-messages">
                    <?php $i = 1; ?>
                    <?php foreach ($data->temuan as $r) : ?>
                        <li>
                            <div class="message-wrapper">
                                <h4 class="message-heading"><?= $i++ . '. ' . $r->memo_temuan; ?></h4>
                                <ul>
                                    <h5 class="message-heading">Rekomendasi</h5>
                                    <li>
                                        <?php foreach ($r->rekomendasi as $d) : ?>
                                            <blockquote class="message">
                                                <?= $d->memo_rekomendasi; ?>
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon="&#xe132;"></span>
                                                    <a href="<?= base_url('laporanauditee/tindaklanjut/' . $d->id) ?>">Riwayat Tindak Lanjut</a>
                                                </p>
                                            </blockquote>
                                            <br>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                                <ul>
                                    <h5 class="message-heading">Sebab</h5>
                                    <li>
                                        <?php foreach ($r->sebab as $d) : ?>
                                            <blockquote class="message">
                                                <?= $d->memo_sebab; ?>
                                            </blockquote>
                                            <br>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>