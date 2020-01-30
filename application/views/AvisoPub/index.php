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
                    <table id="maintable" class="display" width="100%"></table>
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
            <form id="foperacion">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group ">
                                <label for="titulo">Titulo:</label>
                                <input type="text" class="form-control" autocomplete="off" id="titulo" oninput="changeinputs(this)" name="titulo" placeholder="Titulo">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group ">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" autocomplete="off" id="descripcion" oninput="changeinputs(this)" name="descripcion" placeholder="Descripcion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group ">
                                <label for="titulocolor">Color Titulo:</label>
                                <input type="color" class="form-control" autocomplete="off" id="titulocolor" oninput="changeinputs(this)" name="titulocolor" placeholder="titulocolor">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group ">
                                <label for="descripcioncolor">Color Descripción:</label>
                                <input type="color" class="form-control" autocomplete="off" id="descripcioncolor" oninput="changeinputs(this)" name="descripcioncolor" placeholder="Descripcioncolor">
                            </div>
                        </div>
                    </div>
                    <div class="text-center py-2">
                        <label class="custom-file-upload pointer mb-0" style="font-size: 20px; bottom: 0px">
                            <input type="file" name="upload_image" id="upload_image" class="upload_image" data-tag="rutafoto" accept="image/*">
                            <span><i class="fa fa-camera pointer" style="font-size: 20px;"></i></span>
                            <span class="" style="color: #c3c3c3; font-size: 16px">Subir Foto</span>
                        </label>
                    </div>
                    <div class="">
                        <div class="position-relative mx-auto" style="width: 400px; height: 400px; border: 1px solid #9c9c9c">
                            <div class="position-absolute" style="top: 10px; text-align: center; width: 400px;">
                                <h2 id="titulotest" style="color: black" class="font-weight-bold">
                                    </h3>
                            </div>
                            <img id="imagen" width="400px" alt="">
                            <div class="position-absolute" style="bottom: 10px; text-align: center; width: 400px;">
                                <p style="font-size: 20px;color: black; font-weight: bold" id="descripciontest"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
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
    const fetch_post_json = async (url, data) => {
        var form_data = new FormData();

        for (var key in data) {
            form_data.append(key, data[key]);
        }

        $("#loading-circle-overlay").show();
        const response = await fetch(url, {
            method: 'POST',
            body: form_data,
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
    const changeinputs = e => {
        if (e.id.includes("color")) {
            document.querySelector(`#${e.id.split("color")[0]}test`).style.color = e.value;
        } else
            document.querySelector(`#${e.id}test`).textContent = e.value;
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
            fetch_post('AvisoPub/loadimage', formData)
                .then(res => {
                    if (res) {
                        $('#uploadimageModal').modal('hide');
                        $("#loading-circle-overlay").hide();
                        $image_crop.croppie('destroy');
                        imagen.src = res.rutafoto
                    }
                });
        })
    }
    const guardar = e => {
        e.preventDefault();
        console.log("guardar");
        if (!imagen.src) {
            toast_error('¡Oh, hubo un error!', 'Debes seleccionar una imagen.');
            return
        }
        const ima = imagen.src;
        const des = `${descripcion.value}&&&${descripcioncolor.value}`;
        const tit = `${titulo.value}&&&${titulocolor.value}`;
        const data = {
            descripcion: des,
            titulo: tit,
            imagen: ima
        }
        fetch_post_json('AvisoPub/guardar', data)
            .then(res => {
                if (res) {
                    $('#moperacion').modal('hide');
                    $("#loading-circle-overlay").hide();
                    inittable();
                }
            });
    }

    const inittable = async () => {
            const data = await fetch_post_json('AvisoPub/getlist', null).then(r => r);
            if (!Array.isArray(data))
                return

            const table = $('#maintable').DataTable({
                // lengthChange: false,
                // buttons: ['excel', 'pdf', 'colvis'],
                // scrollX: true,
                // dom: "<'row'<'col-sm-3'f><'col-sm-3'l><'col-sm-6'p>>" +
                //     "<'row'<'col-sm-12'tr>>" +
                //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                data: data,
                destroy: true,
                columns: [{
                        title: 'Titulo',
                        data: 'titulo'
                    },
                    {
                        title: 'Descripcion',
                        data: 'descripcion'
                    },
                    {
                        title: 'Imagen',
                        data: 'imagen'
                    },
                ]
            });
            // table.buttons().container()
            //     .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        }
        (function() {
            inittable();
            upload_image.addEventListener("change", changeupload);
            crop_image.addEventListener("click", clickimagecropper);
            foperacion.addEventListener("submit", guardar);
        })();
</script>