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
                    <h4 class="page-title float-left">Foto de Festividades</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminpro</a></li>
                        <li class="breadcrumb-item"><a href="#">Foto del Festividadess</a></li>
                        <li class="breadcrumb-item active">Registrar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Registrar Foto de Festividades</h4>
                    <form id="register_foto_lugar" data-action="foto_fest/insert_foto_fest">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="cod_fest">Festividades:</label>
                                <select name="cod_fest" id="cod_fest" class="select2 form-control">
                                    <option value="" selected disabled>Select</option>
                                    <?php if ($festividades) : ?>
                                        <?php foreach ($festividades as $fest) : ?>
                                            <option value="<?= $fest->cod_fest ?>"><?= $fest->nombre_fest ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0">Arraste las Fotos</h4>
                                    <div class="p-20 p-b-0">
                                        <div class="form-group clearfix">
                                            <div class="col-sm-12 padding-left-0 padding-right-0">
                                                <input type="file"  accept="image/*" required name="files[]" id="filer_input1" multiple="multiple">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="submit" class="btn btn-primary btn-block font-weight-bold mx-auto" value="REGISTRAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery filer js -->
<script src="<?= base_url() ?>assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
<!-- Bootstrap fileupload js -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!-- page specific js -->
<script src="<?= base_url() ?>assets/pages/jquery.fileuploads.init.js"></script>
<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/foto_lugar/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>