<?php
// var_dump($lugares);

?>
<link href="<?= base_url() ?>assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/css/form/css.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Listar Fotos de Festividad</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="#">Fotos de Festividad</a></li>
                        <li class="breadcrumb-item active">Listar</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Mantenimiento de Fotos de Festividad</h4>
                    <table id="datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre Archivo</th>
                                <th>LUGAR TURISTICO</th>
                                <th>IMAGEN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($fotos_lugares) && $fotos_lugares) : ?>
                                <?php foreach ($fotos_lugares as $row) : ?>
                                    <tr>
                                        <td><?= $row->name_foto ?></td>
                                        <td><?= $row->nombre_fest ?></td>
                                        <td text-center>
                                            <a href="<?= base_url()."../imagenes/". $row->name_foto ?>" data-lightbox="gallery-set">
                                                <img width="150px" height="100px" src="<?= base_url()."../imagenes/thumbs/". str_replace(" ", "-", $row->name_foto) ?>" alt="" class="" />
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= site_url() ?>foto_fest/editar/<?= $row->cod_foto ?>"><i class="action fa fa-edit edit_list"></i></a>
                                            <a href="#" data-cod_foto="<?= $row->cod_foto ?>" data-name_foto="<?= $row->name_foto ?>" data-action="foto_fest/delete_foto_fest" class="fa fa-trash pl-2 remove_foto action"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/buttons.colVis.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/foto_lugar/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf', 'colvis'],
            "scrollX": true
        });
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>