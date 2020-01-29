<link href="<?=base_url()?>assets/css/form/css.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Start content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<h4 class="page-title float-left">Listar</h4>

					<ol class="breadcrumb float-right">
						<li class="breadcrumb-item"><a href="#">Adminox</a></li>
						<li class="breadcrumb-item"><a href="#">Gestor</a></li>
						<li class="breadcrumb-item active">Gestor de Tablas - AdminPRO</li>
					</ol>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-xs-12">
				<div class="card-box">
					<h4 class="header-title m-t-0 m-b-20">Configure your Tables</h4>
					<table id="datatable" class="table" cellspacing="0" >
						<thead class="thead-light">
							<tr>
								<th>Nombre</th>
								<th>Nro Documento</th>
								<th>Contrato Vencimiento</th>
								<th>Foquito</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
						<?php if ($personal): ?>
							<?php foreach ($personal as $empl): ?>
								<?php  $date_venc = new DateTime(date('Y-m-d',strtotime($empl->end_cont))); 
								$now = new DateTime(date("Y-m-d"));
								$interval = (int) $now->diff($date_venc)->format('%R%a');
								$opcion = ($interval < 0 ? "Vencido" : ($interval < 5 ? "Pronto" : "")) 
								 ?>
								<tr class="<?= $opcion ?>">
									<td class=""><?= $empl->nombres ?></td>
									<td class=""><?= $empl->nro_doc ?></td>
									<td class=""><?= $empl->end_cont ?></td>
									<td class=""><?= $opcion ?></td>
									<td class=""><a href="">Renovar Contrato</a></td>
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

<script src="<?= base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/buttons.colVis.min.js"></script>


<script src="<?= base_url()?>assets/js/backend/toast_alert.js?v=<?=$this->config->item("curr_ver");?>"></script>
<script>
	var table = $('#datatable').DataTable();
</script>