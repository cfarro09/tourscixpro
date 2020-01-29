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
                        <li class="breadcrumb-item active">Registrar</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-20">Registrar Lugar Turistico</h4>
                    <form id="register_lugar" data-action="lugar_turistico/insert_lugar">
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
                        <div class="col-md-12 col-xs-12">
                            <label for="nombre">Nombre del Lugar:</label>
                            <input type="text" class="form-control" id="nombre" name="name_lugar" placeholder="Nombre del lugar" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="direccion_lugar">Dirección del Lugar:</label>
                            <input type="text" class="form-control" id="direccion_lugar" name="direccion" placeholder="Dirección del lugar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label for="latitud">Latitud:</label>
                            <input type="number" step="any" class="form-control" id="latitud" name="latitud" placeholder="Latitud" required>
                        </div>

                        <div class="form-group col-md-4 col-xs-12">
                            <label for="longitud">Longitud:</label>
                            <input type="number" step="any" class="form-control" id="longitud" name="longitud" placeholder="Longitud" required>
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
                                    <option value="">- Seleccione -</option>
                                    <option value="Parque">Parque</option>
                                    <option value="Monumento">Monumento</option>
                                    <option value="Iglesia">Iglesia</option>
                                    <option value="Convento">Convento</option>
                                    <option value="Cerro">Cerro</option>
                                    <option value="Casonas">Casonas</option>
                                    <option value="Laguna">Laguna</option>
                                    <option value="Rio">Rio</option>
                                    <option value="Playa">Playa</option>
                                    <option value="Museo">Museo</option>
                                    <option value="Oasis">Oasis</option>
                                    <option value="Catarata">Catarata</option>
                                    <option value="Reserva Ecologica">Reserva Ecologica</option>
                                    <option value="Complejo Arqueologico">Complejo Arqueologico</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono del lugar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="tarifa">Tarifa(soles):</label>
                                <input type="text" class="form-control" id="tarifa" name="tarifa" placeholder="Tarifa del lugar">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="horario">Horario de Atención</label>
                                <input type="text" class="form-control" id="horario" name="Hratencion" placeholder="Horario si es que tuviera">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="departamento">Departamento:</label>
                                <select id="departamento" name="departamento" class="custom-select seleccionar" required>
                                    <option value="" disabled selected>- Seleccione -</option>
                                    <option value="Lambayeque">Lambayeque</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Piura">Piura</option>
                                    <option value="Ancash">Ancash</option>
                                    <option value="Apurimac">Apurimac</option>
                                    <option value="Arequipa">Arequipa</option>
                                    <option value="Ayacucho">Ayacucho</option>
                                    <option value="Cajamarca">Cajamarca</option>
                                    <option value="Cuzco">Cuzco</option>
                                    <option value="Huancavelica">Huancavelica</option>
                                    <option value="Huanuco">Huanuco</option>
                                    <option value="Ica">Ica</option>
                                    <option value="Callao">Callao</option>
                                    <option value="Junin">Junin</option>
                                    <option value="La">La Libertad</option>
                                    <option value="Lima">Lima</option>
                                    <option value="Loreto">Loreto</option>
                                    <option value="Madre">Madre de Dios</option>
                                    <option value="Moquegua">Moquegua</option>
                                    <option value="Pasco">Pasco</option>
                                    <option value="Puno">Puno</option>
                                    <option value="San">San Martin</option>
                                    <option value="Tacna">Tacna</option>
                                    <option value="Tumbes">Tumbes</option>
                                    <option value="Ucayali">Ucayali</option>
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
                            <input type="text" class="form-control" id="temporada" name="temporada" placeholder="Temporada">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="transporte">Transporte:</label>
                            <textarea rows="6" class="form-control" id="transporte" name="transporte" placeholder="¿Cómo llegar?" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="transporte_en">Transporte en Inglés:</label>
                            <textarea rows="6" class="form-control" id="transporte_en" name="transporte_en" placeholder="¿Cómo llegar en inglés?" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="descripcion_lugarES">Descripción:</label>
                            <textarea rows="6" class="form-control" id="descripcion_lugarES" name="descripcion_lugarES" placeholder="Descripción del lugar" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label for="descripcion_lugarEN">Descripcion en Inglés:</label>
                            <textarea rows="6" class="form-control" id="descripcion_lugarEN" name="descripcion_lugarEN" placeholder="Descripcion del lugar en Inglés" required></textarea>
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