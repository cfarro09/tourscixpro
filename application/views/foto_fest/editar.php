<link href="<?= base_url() ?>assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet" />

<!-- Jquery filer css -->
<link href="<?= site_url() ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />

<link href="<?= site_url() ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
<!-- Bootstrap fileupload css -->
<link href="<?= site_url() ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Foto del Festividad</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminpro</a></li>
                        <li class="breadcrumb-item"><a href="#">Foto del Festividads</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Editar Foto del Festividad</h4>
                    <form id="editar_foto_lugar" data-action="foto_fest/editar_foto_fest">
                        <input type="hidden" name="name_foto" value="<?= $foto_fest->name_foto ?>">
                        <input type="hidden" name="cod_foto" value="<?= $foto_fest->cod_foto ?>">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="cod_fest">Festividad:</label>
                                <select name="cod_fest" id="cod_fest" class="select2 form-control">
                                    <option value="" selected disabled>Select</option>
                                    <?php if ($festividades) : ?>
                                        <?php foreach ($festividades as $fest) : ?>
                                            <option <?= (isset($foto_fest->cod_fest) && $foto_fest->cod_fest == $fest->cod_fest) ? "selected" : true ?> value="<?= $fest->cod_fest ?>"><?= $fest->nombre_fest ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="cod_fest">Imagen Actual:</label>
                                <div class="row">
                                    <a href="<?= base_url() . "../imagenes/" . $foto_fest->name_foto ?>" data-lightbox="gallery-set">
                                        <img width="150px" height="100px" src="<?= base_url() . "../imagenes/thumbs/" . str_replace(" ", "-", $foto_fest->name_foto) ?>" alt="" class="" />
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                                <input accept="image/*" type="file" name="file">
                            </div>
                        <div class="form-group row">
                            <input type="submit" class="btn btn-primary btn-block font-weight-bold mx-auto" value="EDITAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>

<!-- Jquery filer js -->
<script src="<?= base_url() ?>assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
<!-- Bootstrap fileupload js -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!-- page specific js -->
<script src="<?= base_url() ?>assets/pages/jquery.fileuploads.init.js"></script>
<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/foto_lugar/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>