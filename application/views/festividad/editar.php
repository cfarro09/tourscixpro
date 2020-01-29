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
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Editar Festividad</h4>
                    <form id="editar_lugar" data-action="festividad/editar_festividad">
                        <?php if ($this->session->userdata('tipo_usu') == "SA" || $this->session->userdata('tipo_usu') == "AD") : ?>
                            <div class="form-group row text-center">
                                <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                    <input type="radio" id="customRadio1" name="estado" class="custom-control-input" value="H" required <?= $festividad->estado == "H" ? "checked" : "" ?>>
                                    <label class="custom-control-label" for="customRadio1">HABILITADO</label>
                                </div>
                                <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                    <input type="radio" id="customRadio2" name="estado" class="custom-control-input" value="I" required <?= $festividad->estado == "I" ? "checked" : "" ?>>
                                    <label class="custom-control-label" for="customRadio2">INACTIVO</label>
                                </div>
                            </div>
                        <?php endif ?>
                        <input type="hidden" name="cod_fest" value="<?= $cod_fest ?>">
                        <div class="form-group row">
                            <div class="col-md-8 col-xs-12">
                                <label for="nombre">Nombre de la Festividad:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre_fest" placeholder="Nombre de la festividad" required value="<?= $festividad->nombre_fest ?>">
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label for="nombre">Concurrencia</label>
                                <select name="concurrencia" id="concurrencia" class="custom-select" required>
                                    <option <?= $festividad->concurrencia == "Anual" ? "selected" : "" ?> value="Anual">Anual</option>
                                    <option <?= $festividad->concurrencia == "Mensual" ? "selected" : "" ?> value="Mensual">Mensual</option>
                                    <option <?= $festividad->concurrencia == "Unico" ? "selected" : "" ?> value="Unico">Unico</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Latitud:</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="lat_fest" placeholder="Latitud" required value="<?= $festividad->lat_fest ?>">
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label for="longitud">Longitud:</label>
                                <input type="number" step="any" class="form-control" id="longitud" name="lon_fest" placeholder="Longitud" required value="<?= $festividad->lon_fest ?>">
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
                                    <input required ${name_input} type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" data-date-format="yyyy-mm-dd" name="fecha_fest" value="<?= $festividad->fecha_fest ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Duración en días:</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="duracion_fest" placeholder="¿Cuantos días dura la festividad?" required value="<?= $festividad->duracion_fest ?>">
                            </div>
                            <div class="form-group col-md-4 col-xs-12">
                                <label for="latitud">Ciudad:</label>
                                <input type="text" step="any" class="form-control" id="latitud" name="ciudad_fest" placeholder="¿En que ciudad se celebra?" required value="<?= $festividad->ciudad_fest ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="descripcion_festividadES">Descripción:</label>
                                <textarea rows="6" class="form-control" id="descripcion_festividadES" name="desc_es_fest" placeholder="Descripción del festividad" required><?= $festividad->desc_es_fest ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="descripcion_festividadEN">Descripcion en Inglés:</label>
                                <textarea rows="6" class="form-control" id="descripcion_festividadEN" name="desc_en_fest" placeholder="Descripcion del festividad en Inglés" required><?= $festividad->desc_en_fest ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="transporte">Transporte:</label>
                                <textarea rows="6" class="form-control" id="transporte" name="transporte_fest" placeholder="¿Cómo llegar?" required><?= $festividad->transporte_fest ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label for="transporte_en">Transporte en Inglés:</label>
                                <textarea rows="6" class="form-control" id="transporte_en" name="transporte_en_fest" placeholder="¿Cómo llegar en inglés?" required><?= $festividad->transporte_en_fest ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="listImages" id="listImages" value="">
                            <label for="">Selecionar foto principal</label>
                            <?php if ($list_fotos) : ?>
                                <div class="row">
                                    <?php foreach ($list_fotos as $foto) : ?>
                                        <div class="col-md-4 my-2">
                                            <input type="radio" required name="ruta_foto" <?= ($festividad->ruta_foto == $foto->ruta_foto) ? 'checked' : '' ?> value="<?= $foto->ruta_foto ?>">
                                            <a href="<?= $foto->ruta_foto ?>" data-lightbox="gallery-set">
                                                <img width="150px" height="100px" src="<?= $foto->ruta_foto ?>" alt="" class="" />
                                            </a>
                                            <input type="checkbox" <?= strpos($festividad->listImages, $foto->name_foto) ? "checked" : "" ?> data-nameimage="<?= $foto->name_foto ?>" onclick="validateImages(this)" class="checkImages">
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
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

<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/lugar_turistico/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbtPcXokv3hpU-iNX1WcS_qdgBTrknimg&callback=initMap" async defer></script>
<script>
    let countCheck = 0;
    function validateImages(e){
        if(e.checked){
            if(countCheck < 3){
                countCheck++;
            }else{
                e.checked = false;
            }
        }else{
            countCheck--;
        }
    }
    $('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $(".select2").select2();
</script>