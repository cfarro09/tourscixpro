<?php
// var_dump($lugares);

?>
<link href="<?= base_url() ?>assets/css/form/css.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/croppie.css" />
<link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<style>
    .custom-file-upload {
        display: block;
        cursor: pointer;
    }

    input[type="file"] {
        display: none;
    }

    .borderfile {
        border: 1px solid #c0bbbb;
        border-radius: 15px;
        margin-bottom: 5px;
        padding: 0px;
    }

    .imagex {
        border-radius: 15px 15px 0 0;
    }

    .modal {
        overflow-y: auto;
    }
</style>
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Listar Avisos Publicitarios</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                        <li class="breadcrumb-item"><a href="#">Avisos Publicitarios</a></li>
                        <li class="breadcrumb-item active">Listar</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Mantenimiento de Avisos Publicitarios</h4>

                    <div class="row mb-2">
                        <div class="col-md-12 col-xs-12 text-right">
                            <button type="button" class="mr-3 btn btn-outline-primary" data-toggle="modal" data-target="#moperacion">Agregar Aviso</button>
                        </div>
                    </div>

                    <table id="datatable-buttons" class="table table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>TITULO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>IMAGEN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($pub) && $pub) : ?>
                                <?php foreach ($pub as $row) : ?>
                                    <tr>

                                        <td><?= $row->titulo ?></td>
                                        <td><?= $row->descripcion ?></td>
                                        <td><?= $row->imagen ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url() ?>lugar_turistico/editar/<?= $row->cod_lugar ?>"><i class="action fa fa-edit edit_list"></i></a>
                                            <a href="#" data-action="lugar_turistico/delete_listar" data-tosend="cod_lugar=<?= $row->cod_lugar ?>" class="fa fa-trash pl-2 remove_list action"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="moperacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group ">
                            <label for="titulo">Titulo:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group ">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                        </div>
                    </div>
                </div>
                <div class="text-center py-2">
                    <label class="custom-file-upload pointer mb-0" style="font-size: 20px; bottom: 0px">
                        <input type="file" name="upload_image" id="upload_image" class="upload_image" data-tag="rutafoto" accept="image/*">
                        <span><i class="fa fa-camera pointer" style="font-size: 20px;"></i></span>
                        <span class="" style="color: #c3c3c3; font-size: 16px">Subir Foto (210 x 280)</span>
                    </label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Recortar Imagen</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-3" style="padding-top:30px;">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="crop_image" data-tag="">Cortar y Subir</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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

<script src="<?= base_url() ?>assets/js/croppie.js"></script>
<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>

<script>
    let $image_crop = "";
    const crear_crop = (w, h, id) => {
        $image_crop = $(id).croppie({
            enableExif: true,
            viewport: {
                width: w,
                height: h,
                type: 'square' //circle
            },
            boundary: {
                width: 500,
                height: 500
            }
        });
        return $image_crop;
    }
    const changeupload = (e) => {
        var w, h;

        var reader = new FileReader();
        var cropper = crear_crop(400, 400, "#image_demo");
        reader.onload = function(event) {
            cropper.croppie('bind', {
                url: event.target.result,
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(e.target.files[0]);
        $('#uploadimageModal').modal('show');
    }
    const fetch_post = async (url, data) => {
        $("#loading-circle-overlay").show();
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        $("#loading-circle-overlay").hide();
        if (response.ok) {
            try {
                return await response.json();
            } catch (e) {
                toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
            }
        } else {
            toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
        }
    }
    const clickimagecropper = () => {
        var selector;
        var selector_img;
        $("#loading-circle-overlay").show();
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            let formData = new FormData();
            formData.append('image', response);
            fetch_post('publicidad/loadimage', formData)
                .then(res => {
                    if (res) {
                        $('#uploadimageModal').modal('hide');
                        $("#loading-circle-overlay").hide();
                        $image_crop.croppie('destroy');
                        selector_img = selector.closest('div');
                        selector_img = selector.closest(".divparent").children('.imagex');

                        selector_img.attr('src', res.rutafoto);
                    }
                });
        })
    }

    (function() {
        const table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf', 'colvis'],
            scrollX: true,
            dom: "<'row'<'col-sm-3'f><'col-sm-3'l><'col-sm-6'p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        });
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        upload_image.addEventListener("change", changeupload)
        crop_image.addEventListener("click", clickimagecropper)
    })();
</script>