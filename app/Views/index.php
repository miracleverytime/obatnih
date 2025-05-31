<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;subset=devanagari,latin-ext" rel="stylesheet">
        
        <!-- title of site -->
        <title>ObatNih</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="<?= base_url('assets/gambar/logoweb1.png') ?>"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">

		<!--flat icon css-->
		<link rel="stylesheet" href="<?= base_url('assets/css/flaticon.css') ?>">

		<!--animate.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css') ?>">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="<?= base_url('assets/css/bootsnav.css') ?>" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    </head>
	
	<body>		
		<!-- top-area Start -->
		<header class="top-area">
			<div class="header-area">
				<!-- Start Navigation -->
			    <nav class="navbar navbar-default bootsnav navbar-fixed dark no-background" style="top: -10px;">

			        <div class="container" style="top: 10px;">

			            <!-- Start Header Navigation -->
			            <div class="navbar-header" style="padding-top: 10px;">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
								<i class="fa fa-bars"></i>
							</button>
							<a class="navbar-brand" href="index.php">
								<img src="<?= base_url('assets/gambar/logoweb1.png') ?>" alt="Logo" class="logo">
								<span>ObatNih</span>
							</a>
						</div>
						<!--/.navbar-header-->
			            <!-- End Header Navigation -->

			            <!-- Collect the nav links, forms, and other content for toggling -->
			            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
			                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
			                <li class=" smooth-menu active"></li>
			                    <li class="smooth-menu"><a href="login">Log in</a></li>
			                    <li class="smooth-menu"><a href="signup">Sign up</a></li>
			                </ul><!--/.nav -->
			            </div><!-- /.navbar-collapse -->
			        </div><!--/.container-->
			    </nav><!--/nav-->
			    <!-- End Navigation -->
			</div><!--/.header-area-->

		    <div class="clearfix"></div>

		</header><!-- /.top-area-->
		<!-- top-area End -->
	
		<!--welcome-hero start -->
		<section id="welcome-hero" class="welcome-hero">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="header-text">
							<h2>Welcome <br> to <br> ObatNih   </h2>
							<p>Aplikasi belanja obat terbaik di seluruh Indonesia</p>
							<a href="<?= base_url('login') ?>">Mulai!</a>
						</div><!--/.header-text-->
					</div><!--/.col-->
				</div><!-- /.row-->
			</div><!-- /.container-->

		</section><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!--about start -->
		<section id="about" class="about">
			<div class="section-heading text-center">
				<h2>about ObatNih</h2>
			</div>
			<div class="container">
				<div class="about-content">
					<div class="row">
						<div class="col-sm-6">
							<div class="single-about-txt">
								<h3>
									ObatNih adalah platform penjualan obat berbasis web yang dirancang untuk memudahkan masyarakat dalam mencari, memilih, dan membeli obat sesuai kebutuhan secara praktis dan aman. Melalui sistem ini, pengguna dapat dengan mudah menemukan berbagai jenis obat berdasarkan nama, gejala, atau kategori usia. Sistem ini dibangun untuk memberikan solusi digital yang efisien bagi apotek maupun pengguna akhir, dengan menyediakan fitur pencarian obat, detail informasi produk, manajemen stok, dan proses pemesanan yang cepat.
								</h3>
								<p style="padding-top: 13px;">
									
								</p>
								<div class="row">
									<div class="col-sm-4">
										<div class="single-about-add-info">
											<h3>phone</h3>
											<p>0888-166-9524</p>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="single-about-add-info">
											<h3>email</h3>
											<p>dongop@gmail.com</p>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="single-about-add-info">
											<h3>website</h3>
											<p>www.obatnih.com</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-offset-1 col-sm-5">
							<div class="single-about-img">
								<img src="<?= base_url('assets/gambar/logoweb.png') ?>">
							</div>

						</div>
					</div>
				</div>
			</div>
		</section><!--/.about-->
		<!--about end -->