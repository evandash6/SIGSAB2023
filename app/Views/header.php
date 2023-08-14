<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>SIPSA 2023</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="/assets/css/apple/app.min.css" rel="stylesheet" />
	<link href="/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url()?>assets/js/app.js"></script>
	<script src="<?=base_url()?>assets/js/theme/apple.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=base_url()?>assets/plugins/d3/d3.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/nvd3/build/nv.d3.min.js"></script>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="<?=base_url()?>" class="navbar-brand"><span class="navbar-logo"><i class="fa fa-tree"></i></span> <b class="mr-1">SIPSA</b> 2023</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle icon">
						<i class="ion-ios-notifications"></i>
						<span class="label">1</span>
					</a>
					<div class="dropdown-menu media-list dropdown-menu-right">
						<div class="dropdown-header">Notificaciones (0)</div>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fa fa-flag-checkered media-object bg-silver-darker"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">Semana de Cierre de Dictamen Preliminar</h6>
								<div class="text-muted">21 Jun 2023</div>
							</div>
						</a>
						<!-- <a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<img src="<?=base_url()?>assets/img/user/user-1.jpg" class="media-object" alt="" />
								<i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">John Smith</h6>
								<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
								<div class="text-muted">25 minutes ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<img src="<?=base_url()?>assets/img/user/user-2.jpg" class="media-object" alt="" />
								<i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">Olivia</h6>
								<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
								<div class="text-muted">35 minutes ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fa fa-plus media-object bg-silver-darker"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading"> New User Registered</h6>
								<div class="text-muted">1 hour ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fa fa-envelope media-object bg-silver-darker"></i>
								<i class="fab fa-google text-warning media-object-icon f-s-14"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading"> New Email From John</h6>
								<div class="text-muted">2 hour ago</div>
							</div>
						</a> -->
						<div class="dropdown-footer text-center">
							<a href="javascript:;">Ver más</a>
						</div>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="<?=base_url()?>assets/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>NOMBRE USUARIO
								<small>PUESTO USUARIO</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Perfil</a></li>
							<li><a href="javascript:;"><i class="fa fa-power-off"></i> Salir</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
                    <li class="nav-search">
						<input type="text" class="form-control" placeholder="Buscar en menu.." data-sidebar-search="true">
					</li>
                    <li class="nav-header">Administración</li>
                    <li class="has-sub <?=(isset($m_usuarios))?$m_usuarios:''?>">
						<a href="<?=base_url()?>/administracion/usuarios">
							<i class="fa fa-users bg-pink"></i>
							<span>Usuarios</span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<i class="fa fa-cloud-download-alt bg-info"></i>
							<span>Importación Datos</span>
						</a>
					</li>
                    
                    <li class="nav-header">Menu</li>
					<li class="has-sub <?=(isset($m_inicio))?$m_inicio:''?>">
						<a href="javascript:;">
							<i class="ion-ios-home bg-green"></i>
							<span>Inicio</span>
						</a>
						<!-- <ul class="sub-menu">
							<li><a href="<?=base_url()?>">INicio v1</a></li>
							<li class="active"><a href="index_v2.html">Dashboard v2</a></li>
							<li><a href="index_v3.html">Dashboard v3</a></li>
						</ul> -->
					</li>
                    
					<li>
						<a href="#">
                            <i class="ion-ios-color-filter bg-indigo"></i>
							<span>Seguimiento</span> 
						</a>
					</li>
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Minimizar</span></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
                <?=$links?>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?=$titulo?> <br><small><?=$descripcion?></small></h1>
			<!-- end page-header -->