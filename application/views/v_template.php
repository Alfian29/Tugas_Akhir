<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Fruitypedia - <?php echo $this->uri->segment(1);?> </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>assets/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                <img src="<?php echo base_url() ?>assets/images/Fruitypedia.png" alt="">

                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                <?php if($this->session->userdata('level')=='Konsumen'){?>
                        <li class="nav-item <?php if($this->uri->segment(1)=="Home"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Home/index">Home</a></li>
                        <li class="nav-item <?php if($this->uri->segment(2)=="activity"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/activity">Activity</a></li>
                        <li class="nav-item <?php if($this->uri->segment(2)=="history_pembeli"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/history_pembeli">History</a></li>
                        <li class="nav-item <?php if($this->uri->segment(1)=="Shop" && $this->uri->segment(2)=="index"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url() ?>index.php/Shop/index">Shop</a></li>
                        <li class="nav-item <?php if($this->uri->segment(2)=="cart"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/cart">My Cart</a> </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i> <?php echo $this->session->userdata('nama_user');;?></a>
                            <ul class="dropdown-menu">
								<li><a href="<?php echo base_url('index.php/Login/logout');?>">Logout</a></li>
                            </ul>
                        </li>
                <?php }elseif($this->session->userdata('level')=='Owner'){ ?>
                    <li class="nav-item <?php if($this->uri->segment(1)=="Home"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Home/index">Home</a></li>
                    <li class="nav-item <?php if($this->uri->segment(1)=="Produk"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Produk/index">Produk Anda</a></li>
                    <li class="nav-item <?php if($this->uri->segment(2)=="pesanan_penjual"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/pesanan_penjual">Pesanan</a></li>
                    <li class="nav-item <?php if($this->uri->segment(2)=="history_penjual"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/history_penjual">History</a></li>
                    <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i> <?php echo $this->session->userdata('nama_user');;?></a>
                            <ul class="dropdown-menu">
								<li><a href="<?php echo base_url('index.php/Login/logout');?>">Logout</a></li>
                            </ul>
                        </li>
                <?php } else{ ?>
                    <li class="nav-item <?php if($this->uri->segment(1)=="Home"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Home/index">Home</a></li>
                    <li class="nav-item <?php if($this->uri->segment(2)=="transaksi_admin_page"){echo "active";}?>"><a class="nav-link" href="<?php echo base_url()?>index.php/Shop/transaksi_admin_page">Transaksi</a></li>
                    <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i> <?php echo $this->session->userdata('nama_user');;?></a>
                            <ul class="dropdown-menu">
								<li><a href="<?php echo base_url('index.php/Login/logout');?>">Logout</a></li>
                            </ul>
                        </li>
                <?php }?>
                </ul>
                </div>
                <!-- /.navbar-collapse -->

     
            </div>
            <!-- Start Side Menu -->
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
    
    <?php $this->load->view($content);?>

    <!-- Start copyright  -->

    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    
    <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="<?php echo base_url() ?>assets/js/jquery.superslides.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url() ?>assets/js/inewsticker.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootsnav.js."></script>
    <script src="<?php echo base_url() ?>assets/js/images-loded.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/isotope.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/baguetteBox.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/form-validator.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/contact-form-script.js"></script>
    <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
</body>

</html>