<link href="<?= base_url() ?>assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet" />
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Lugar Turistico</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Adminpro</a></li>
                        <li class="breadcrumb-item"><a href="#">Lugar Turisticos</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Editar Lugar Turistico</h4>
                    <form id="editar_lugar" data-action="lugar_turistico/editar_lugar">
                        <?php if ($this->session->userdata('tipo_usu') == "SA" || $this->session->userdata('tipo_usu') == "AD") : ?>
                        <div class="form-group row text-center">
                            <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                <input type="radio" id="customRadio1" name="estado" class="custom-control-input" value="H" required <?= $lugar->estado == "H" ? "checked" : "" ?>>
                                <label class="custom-control-label" for="customRadio1">HABILITADO</label>
                            </div>
                            <div class="col-md-6 col-xs-6 custom-control custom-radio ">
                                <input type="radio" id="customRadio2" name="estado" class="custom-control-input" value="I" required <?= $lugar->estado == "I" ? "checked" : "" ?>>
                                <label class="custom-control-label" for="customRadio2">INACTIVO</label>
                            </div>
                        </div>
                    <?php endif ?>
                    <input type="hidden" name="cod_lugar" value="<?= $cod_lugar ?>">

                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="nombre">Nombre del Lugar:</label>
                            <input type="text" class="form-control" id="nombre" name="name_lugar" placeholder="Nombre del lugar" required value="<?= $lugar->name_lugar ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="direccion_lugar">Dirección del Lugar:</label>
                            <input type="text" class="form-control" id="direccion_lugar" name="direccion" placeholder="Dirección del lugar" value="<?= $lugar->direccion ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label for="latitud">Latitud:</label>
                            <input type="number" step="any" class="form-control" id="latitud" name="latitud" placeholder="Latitud" required value="<?= $lugar->latitud ?>">
                        </div>

                        <div class="form-group col-md-4 col-xs-12">
                            <label for="longitud">Longitud:</label>
                            <input type="number" step="any" class="form-control" id="longitud" name="longitud" placeholder="Longitud" required value="<?= $lugar->longitud ?>">
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
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="tipo_lugar">Tipo del Lugar</label>
                                <select name="tipo_lugar" id="tipo_lugar" class="custom-select" required>
                                    <option value="" selected disabled>- Seleccione -</option>
                                    <option value="Parque" <?= $lugar->tipo_lugar == "Parque" ? "selected" : "" ?>>Parque</option>
                                    <option value="Monumento" <?= $lugar->tipo_lugar == "Monumento" ? "selected" : "" ?>>Monumento</option>
                                    <option value="Iglesia" <?= $lugar->tipo_lugar == "Iglesia" ? "selected" : "" ?>>Iglesia</option>
                                    <option value="Convento" <?= $lugar->tipo_lugar == "Convento" ? "selected" : "" ?>>Convento</option>
                                    <option value="Cerro" <?= $lugar->tipo_lugar == "Cerro" ? "selected" : "" ?>>Cerro</option>
                                    <option value="Casonas" <?= $lugar->tipo_lugar == "Casonas" ? "selected" : "" ?>>Casonas</option>
                                    <option value="Laguna" <?= $lugar->tipo_lugar == "Laguna" ? "selected" : "" ?>>Laguna</option>
                                    <option value="Rio" <?= $lugar->tipo_lugar == "Rio" ? "selected" : "" ?>>Rio</option>
                                    <option value="Playa" <?= $lugar->tipo_lugar == "Playa" ? "selected" : "" ?>>Playa</option>
                                    <option value="Museo" <?= $lugar->tipo_lugar == "Museo" ? "selected" : "" ?>>Museo</option>
                                    <option value="Oasis" <?= $lugar->tipo_lugar == "Oasis" ? "selected" : "" ?>>Oasis</option>
                                    <option value="Catarata" <?= $lugar->tipo_lugar == "Catarata" ? "selected" : "" ?>>Catarata</option>
                                    <option value="Reserva Ecologica" <?= $lugar->tipo_lugar == "Reserva Ecologica" ? "selected" : "" ?>>Reserva Ecologica</option>
                                    <option value="Complejo Arqueologico" <?= $lugar->tipo_lugar == "Complejo Arqueologico" ? "selected" : "" ?>>Complejo Arqueologico</option>
                                    <option value="Otro" <?= $lugar->tipo_lugar == "Otro" ? "selected" : "" ?>>Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono del lugar" value="<?= $lugar->telefono ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="tarifa">Tarifa(soles):</label>
                                <input type="text" class="form-control" id="tarifa" name="tarifa" placeholder="Tarifa del lugar" value="<?= $lugar->tarifa ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="horario">Horario de Atención</label>
                                <input type="text" class="form-control" id="horario" name="Hratencion" placeholder="Horario si es que tuviera" value="<?= $lugar->Hratencion ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="departamento">Departamento:</label>
                                <select id="departamento" name="departamento" class="custom-select seleccionar" data-provincia="<?= $lugar->provincia ?>" required>
                                    <option value="" disabled selected>- Seleccione -</option>
                                    <option value="Lambayeque" <?= $lugar->departamento == "Lambayeque" ? "selected" : "" ?>>Lambayeque</option>
                                    <option value="Amazonas" <?= $lugar->departamento == "Amazonas" ? "selected" : "" ?>>Amazonas</option>
                                    <option value="Piura" <?= $lugar->departamento == "Piura" ? "selected" : "" ?>>Piura</option>
                                    <option value="Ancash" <?= $lugar->departamento == "Ancash" ? "selected" : "" ?>>Ancash</option>
                                    <option value="Apurimac" <?= $lugar->departamento == "Apurimac" ? "selected" : "" ?>>Apurimac</option>
                                    <option value="Arequipa" <?= $lugar->departamento == "Arequipa" ? "selected" : "" ?>>Arequipa</option>
                                    <option value="Ayacucho" <?= $lugar->departamento == "Ayacucho" ? "selected" : "" ?>>Ayacucho</option>
                                    <option value="Cajamarca" <?= $lugar->departamento == "Cajamarca" ? "selected" : "" ?>>Cajamarca</option>
                                    <option value="Cuzco" <?= $lugar->departamento == "Cuzco" ? "selected" : "" ?>>Cuzco</option>
                                    <option value="Huancavelica" <?= $lugar->departamento == "Huancavelica" ? "selected" : "" ?>>Huancavelica</option>
                                    <option value="Huanuco" <?= $lugar->departamento == "Huanuco" ? "selected" : "" ?>>Huanuco</option>
                                    <option value="Ica" <?= $lugar->departamento == "Ica" ? "selected" : "" ?>>Ica</option>
                                    <option value="Callao" <?= $lugar->departamento == "Callao" ? "selected" : "" ?>>Callao</option>
                                    <option value="Junin" <?= $lugar->departamento == "Junin" ? "selected" : "" ?>>Junin</option>
                                    <option value="La" <?= $lugar->departamento == "La" ? "selected" : "" ?>>La Libertad</option>
                                    <option value="Lima" <?= $lugar->departamento == "Lima" ? "selected" : "" ?>>Lima</option>
                                    <option value="Loreto" <?= $lugar->departamento == "Loreto" ? "selected" : "" ?>>Loreto</option>
                                    <option value="Madre" <?= $lugar->departamento == "Madre" ? "selected" : "" ?>>Madre de Dios</option>
                                    <option value="Moquegua" <?= $lugar->departamento == "Moquegua" ? "selected" : "" ?>>Moquegua</option>
                                    <option value="Pasco" <?= $lugar->departamento == "Pasco" ? "selected" : "" ?>>Pasco</option>
                                    <option value="Puno" <?= $lugar->departamento == "Puno" ? "selected" : "" ?>>Puno</option>
                                    <option value="San" <?= $lugar->departamento == "San" ? "selected" : "" ?>>San Martin</option>
                                    <option value="Tacna" <?= $lugar->departamento == "Tacna" ? "selected" : "" ?>>Tacna</option>
                                    <option value="Tumbes" <?= $lugar->departamento == "Tumbes" ? "selected" : "" ?>>Tumbes</option>
                                    <option value="Ucayali" <?= $lugar->departamento == "Ucayali" ? "selected" : "" ?>>Ucayali</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="provincia">Provincia:</label>
                                <select name="provincia" id="provincia" class="custom-select seleccionar" required>
                                    <option value="">- Seleccione -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-12">
                            <label for="tarifa">Temporada:</label>
                            <input type="text" class="form-control" id="temporada" name="temporada" placeholder="Temporada" value="<?= $lugar->temporada ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="transporte">Transporte:</label>
                            <textarea rows="6" class="form-control" id="transporte" name="transporte" placeholder="¿Cómo llegar?" required><?= $lugar->transporte ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="transporte_en">Transporte en Inglés:</label>
                            <textarea rows="6" class="form-control" id="transporte_en" name="transporte_en" placeholder="¿Cómo llegar en inglés?" required><?= $lugar->transporte_en ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="descripcion_lugarES">Descripción:</label>
                            <textarea rows="6" class="form-control" id="descripcion_lugarES" name="descripcion_lugarES" placeholder="Descripción del lugar" required><?= $lugar->descripcion_lugarES ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="descripcion_lugarEN">Descripcion en Inglés:</label>
                            <textarea rows="6" class="form-control" id="descripcion_lugarEN" name="descripcion_lugarEN" placeholder="Descripcion del lugar en Inglés" required><?= $lugar->descripcion_lugarEN ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="listImages" id="listImages" value="">
                        <label for="">Selecionar foto principal</label>
                        <?php if ($list_fotos) : ?>
                            <div class="row">
                                <?php foreach ($list_fotos as $foto) : ?>
                                    <div class="col-md-4 my-2">
                                        <input type="radio" required name="ruta_foto" <?= ($lugar->ruta_foto == $foto->ruta_foto) ? 'checked' : '' ?> value="<?= $foto->ruta_foto ?>">
                                        <a href="<?= $foto->ruta_foto ?>" data-lightbox="gallery-set">
                                            <img width="150px" height="100px" src="<?= $foto->ruta_foto ?>" alt="" class="" />
                                        </a>
                                        <input type="checkbox" <?= strpos($lugar->listImages, $foto->name_foto) ? "checked" : "" ?> data-nameimage="<?= $foto->name_foto ?>" onclick="validateImages(this)" class="checkImages">
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
<script type="text/javascript">
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
</script>
<script src="<?= base_url() ?>assets/plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/backend/toast_alert.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="<?= base_url() ?>assets/js/backend/lugar_turistico/index.js?v=<?= $this->config->item("curr_ver"); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbtPcXokv3hpU-iNX1WcS_qdgBTrknimg&callback=initMap" async defer></script>