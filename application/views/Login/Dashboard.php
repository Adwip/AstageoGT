<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>Dashboard BMKG | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <script src="<?php echo base_url() ?>asset/event/Umum.js"></script>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="title_left">
                <h1>Selamat datang </h1>
              </div>
            </div>
            <div class="row top_tiles" style="color: black;">
              <?php echo $cuaca['small'] ?>
            </div>
            <div class="row top_tiles" style="color: black;">
              <div class="animated flipInY col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="tile-stats"  style="height: 350px;">
                  <?php echo $cuaca['main'] ?>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height:170px;">
                  <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                  <div class="count"><?php echo $informasi['berita_now'] ?></div>
                  <h3> Berita bulan ini</h3><br>
                  <p><?php echo $informasi['berita'] ?> Berita keseluruhan</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height:170px;">
                  <div class="icon"><i class="fa fa-file-pdf-o"></i></div>
                  <div class="count"><?php echo $informasi['artikel_now'] ?></div>
                  <h3>Artikel bulan ini</h3><br>
                  <p><?php echo $informasi['artikel_now'] ?> Artikel keseluruhan</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="tile-stats"  style="height: 560px;"><br>
                  <span style="font-size: 170%; margin: 10px;">Kimia air hujan bulan ini</span><hr>
                  <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div id = "kah" style = "width: 100%; height: 450px; margin: 0 auto"></div>
                  </div>
                </div>
              </div>
              <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="tile-stats"  style="height: 560px;"><br>
                  <span style="font-size: 170%; margin: 10px;">Indeks SPM bulan ini</span><hr>
                  <div class=" col-md-12 col-lg-12 col-sm-12 col-xs-12">
                  <div id = "spm" style = "width: 100%; height: 450px; margin: 0 auto"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">Dashboard design By Gentelella & Colorlib, system by KP Teknik Informatika UII 2015
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>asset/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>asset/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php base_url() ?>asset/event/Umum.js"></script>
    <!--Highchart-->
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="<?php echo base_url(); ?>asset/Highchart.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).ready(function(){
        grafikKAH ('#kah', JSON.parse('<?php echo  json_encode($kah) ?>'), '<?php echo  date('Y') ?>','<?php echo date('d-m-Y') ?>')
        grafikSPM ('#spm', JSON.parse('<?php echo  json_encode($spm) ?>'), '<?php echo  date('Y') ?>','<?php echo date('d-m-Y') ?>')
      })
      $('.tes').click(function(){
        
        alert(document.referrer+' pathname = '+window.location.pathname)
        //location.href="<?php echo site_url('Login/keluar') ?>"
        /*var test = swal({
            title: "Lanjutkan keluar ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })*/

      })
      function keluar(link){
        mscConfirm("Lanjutkan keluar ?",function(){
          window.location.replace(link)
        })
      }
    </script>
  </body>
</html>