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

                    <?= input_hidden($field_name = 'old_image', $value = $data->image); ?>

                    <?= input_text($field_name = 'name', $label = 'Name', $value = $data->name, $required = true, $readonly = true, $disabled = false); ?>

                    <?= input_text($field_name = 'username', $label = 'Username', $value = $data->username, $required = true, $readonly = true, $disabled = false); ?>

                    <?= input_password($field_name = 'password', $label = 'Password', $value = '', $required = true, $readonly = true, $disabled = false); ?>

                    <?= input_password($field_name = 'repeat_password', $label = 'Repeat Password', $value = '', $required = true, $readonly = true, $disabled = false); ?>

                    <?= input_text($field_name = 'email', $label = 'Email', $value = $data->email, $required = true, $readonly = true, $disabled = false); ?>

                    <?= input_image($field_name = 'image', $label = 'Image Profile', $file_name = $data->image, $required = false, $readonly = true); ?>

                    <?= input_select($field_name = 'groups[]', $label = 'Groups', $groups_options, $selected = $data->id_group, $required = true, $disabled = true); ?>

                    <div class="form-actions no-margin">
                        <button type="button" class="btn" onclick="window.history.back();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>