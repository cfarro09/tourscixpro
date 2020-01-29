<link href="<?= base_url() ?>assets/css/form/css.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Start content -->
<style>
    .bg-red{
        background: #f7c5c5;
    }
    .bg-yellow{
        background: #fff7ce;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Listar Festividad</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="#">Festividad</a></li>
                        <li class="breadcrumb-item active">Listar</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Mantenimiento de Festividad</h4>
                    <table id="datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>DESCRIPCION</th>
                                <th>CIUDAD</th>
                                <th>F.INICIO</th>
                                <th>DUR</th>
                                <th>TRANSP</th>
                                <th>ESTADO</th>
                                <th>FREC</th>
                                <th class="text-center"><i class="fa fa-eye"></i></th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($lugares) && $lugares) : ?>
                                <?php foreach ($lugares as $row) : ?>
                                    <tr>
                                        <td><?= $row->nombre_fest ?></td>
                                        <td><?= substr($row->desc_es_fest, 0, 200) ?>...</td>
                                        <td><?= $row->ciudad_fest ?></td>
                                        <td><?= $row->fecha_fest ?></td>
                                        <td><?= $row->duracion_fest ?></td>
                                        <td><?= substr($row->transporte_fest, 0, 200) ?>...</td>
                                        <td><?= $row->estado == "I" ? "Oculto" : "Activo" ?></td>
                                        <td><?= $row->concurrencia ?></td>
                                        <td><?= $row->views ?> </td>
                                        <td class="text-center">
                                            <a href="<?= site_url()?>festividad/editar/<?= $row->cod_fest ?>"><i class="action fa fa-edit edit_list"></i></a>
                                            <a href="#" data-action="festividad/delete_listar" data-tosend="cod_fest=<?= $row->cod_fest ?>" class="fa fa-trash pl-2 remove_list action"></i></a>
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


<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/lugar_turistico/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf', 'colvis'],
            scrollX: true,
            dom: "<'row'<'col-sm-3'f><'col-sm-3'l><'col-sm-6'p>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            createdRow: function( row, data, dataIndex){
                if(data[7] == "Mensual" || data[7] == 'Anual'){
                    
                    const diffTime = Math.abs( new Date() - new Date(data[3]));
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                    if(diffDays < 10){
                        $(row).addClass('bg-yellow');
                    }
                }
            }
        });
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>