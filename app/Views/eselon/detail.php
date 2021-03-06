<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>

<div class="row-fluid">
    <div class="span6">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe023;"></span><?= $title; ?>
                </div>
            </div>
            <div class="widget-body">
                <?php if (session()->getFlashData('messages')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashData('messages') ?>
                    </div>
                <?php endif; ?>
                <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal no-margin">

                    <?= csrf_field(); ?>

                    <?= input_text($field_name = 'nama', $label = 'Nama', $value = $data->nama, $required = true, $readonly = true, $disabled = false); ?>
                    <?= input_text($field_name = 'level_eselon', $label = 'Level Eselon', $value = $data->level_eselon, $required = true, $readonly = true, $disabled = false); ?>
                    <?= input_text($field_name = 'id_parent', $label = 'ID Parent', $value = $data->id_parent, $required = true, $readonly = true, $disabled = false); ?>

                    <div class="form-actions no-margin">
                        <button type="button" class="btn" onclick="window.history.back();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>