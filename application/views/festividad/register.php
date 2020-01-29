<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Festividad</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminpro</a></li>
                        <li class="breadcrumb-item"><a href="#">Festividads</a></li>
                        <li class="breadcrumb-item active">Registrar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Registrar Festividad</h4>
                    <form id="register_lugar" data-action="festividad/insert_lugar">
                        <?php if ($this->session->userdata('tipo_usu') == "SA" || $this->session->userdata('tipo_usu') == "AD") : ?>
                            <div class="form-group row text-center">
                                <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                    <input type="radio" id="customRadio1" name="estado" class="custom-control-input" value="H" required>
                                    <label class="custom-control-label" for="customRadio1">HABILITADO</label>
                                </div>
                                <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                    <input type="radio" id="customRadio2" name="estado" class="custom-control-input" value="I" required>
                                    <label class="custom-control-label" for="customRadio2">INACTIVO</label>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="form-group row">
                            <div class="col-md-8 col-xs-12">
                                <label for="nombre">Nombre de la Festividad:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre_fest" placeholder="Nombre de la festividad" required>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label for="nombre">Concurrencia</label>
                                <select name="concurrencia" id="concurrencia" class="custom-select" required>
                                    <option selected value="Unico">Unico</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Anual">Anual</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Latitud:</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="lat_fest" placeholder="Latitud" required>
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label for="longitud">Longitud:</label>
                                <input type="number" step="any" class="form-control" id="longitud" name="lon_fest" placeholder="Longitud" required>
                            </div>
                            <div class="col-md-4 col-xs-12 row">
                                <div class="align-self-center mx-auto">
                                    <input type="button" id="btn_map" value="VER MAPA" class="btn btn-dark px-4 font-weight-bold">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="mapa" style="display: none; height: 320px;"></div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-4 col-xs-12">
                                <label>Fecha de Inicio</label>
                                <div class="input-group">
                                    <input required ${name_input} type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" data-date-format="yyyy-mm-dd" name="fecha_fest">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Duración en días:</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="duracion_fest" placeholder="¿Cuantos días dura la festividad?" required>
                            </div>
                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Ciudad:</label>
                                <input type="text" step="any" class="form-control" id="latitud" name="ciudad_fest" placeholder="¿En que ciudad se celebra?" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="transporte">Transporte:</label>
                                <textarea rows="6" class="form-control" id="transporte" name="transporte_fest" placeholder="¿Cómo llegar?" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="transporte_en">Transporte en Inglés:</label>
                                <textarea rows="6" class="form-control" id="transporte_en" name="transporte_en_fest" placeholder="¿Cómo llegar en inglés?" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="descripcion_lugarES">Descripción:</label>
                                <textarea rows="6" class="form-control" id="descripcion_lugarES" name="desc_es_fest" placeholder="Descripción del lugar" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="descripcion_lugarEN">Descripcion en Inglés:</label>
                                <textarea rows="6" class="form-control" id="descripcion_lugarEN" name="desc_en_fest" placeholder="Descripcion del lugar en Inglés" required></textarea>
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

<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/lugar_turistico/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbtPcXokv3hpU-iNX1WcS_qdgBTrknimg&callback=initMap" async defer></script>
<script>
    $('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $(".select2").select2();
</script>