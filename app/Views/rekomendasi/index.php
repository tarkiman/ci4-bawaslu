<?= $this->extend('layout/backend_template'); ?>

<?= $this->section('backend_content'); ?>

<link rel="stylesheet" type="text/css" href="<?= '/assets/datatables/css/jquery.dataTables.min.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= '/assets/datatables/css/buttons.dataTables.min.css' ?>">
<link rel="stylesheet" type="text/css" href="<?= '/assets/datatables/css/responsive.dataTables.min.css' ?>">
<style>
    table.dataTable>tbody>tr.child span.dtr-title {
        min-width: 170px;
    }
</style>

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

                        <?php if (session()->getFlashData('messages')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashData('messages') ?>
                            </div>
                        <?php endif; ?>
                        <table id="datatables" class="table table-condensed table-bordered no-margin">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Rekomendasi</th>
                                    <th>Jenis Rekomendasi</th>
                                    <th>Memo Rekomendasi</th>
                                    <th>Nilai Rekomendasi</th>
                                    <th>Nama Penangung Jawab</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= '/assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
<script type="text/javascript" src="<?= '/assets/datatables/js/dataTables.buttons.min.js' ?>"></script>
<script type="text/javascript" src="<?= '/assets/datatables/js/dataTables.responsive.min.js' ?>"></script>
<script type="text/javascript" src="<?= '/assets/datatables/js/responsive.bootstrap.min.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#datatables').DataTable({
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                <?php if (in_array('rekomendasi/create', session()->get('user_permissions')) && session()->get('ketua_tim') == session()->get('id_pegawai')) : ?> {
                        text: 'Create New',
                        action: function(e, dt, node, config) {
                            window.location.href = "<?= base_url('/rekomendasi/create/' . $id_sebab); ?>";
                        }
                    }
                <?php endif; ?>
            ],
            processing: true,
            serverSide: true,
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 7
                },
                {
                    width: '70px',
                    targets: 1
                },
                {
                    width: '200px',
                    targets: 7
                }
            ],
            order: [
                [1, "asc"]
            ],
            search: {
                "caseInsensitive": false
            },
            ajax: "<?= base_url('rekomendasi/datatables/' . $id_sebab); ?>",
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var info = table.page.info();
                var page = info.page;
                var length = info.length;
                var index = (page * length + (iDisplayIndex + 1));
                $('td:first', nRow).html(index);
                $('th').css("text-align", "center");
                $('td:eq(0)', nRow).css("text-align", "center");
                $('td:eq(4)', nRow).css("text-align", "right");
                $('td:eq(7)', nRow).css("text-align", "center");
                return nRow;
            },
        });

    });
</script>

<?= $this->endSection(); ?>