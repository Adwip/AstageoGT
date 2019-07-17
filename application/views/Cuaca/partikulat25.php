<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Informasi Partikulat </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.min.css" rel="stylesheet">
     <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" style="height: 1600px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Informasi Partikulat PM 2.5 di DIY</h3>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Partikulat PM 2.5 di DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <form method="GET" action="<?php echo site_url('Cuaca/Informasi_partikular') ?>">
                        <div class='col-sm-4'>
                          <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input  type='text' class="form-control tgal" readonly="readonly" name="tanggal" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                        </div>
                      </div>
                      </form>
                    <br />
                    <form method="POST" action="<?php echo site_url('Cuaca/del_partikulat') ?>">
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Wilayah </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Jam </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $partikulat ?>
                        </tbody>
                      </table>
                    </div>
                    <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                  </form>
                  </div>
                </div>
                <br>
                <br>
                <br>
              </div>
<!--Golongan Kepangkatan PNS-->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Input Data Kimia Air Hujan</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content" >
                    <br/>
                    <div id = "container2" style = "width: 1000px; height: 400px; margin: 0 auto"></div>                    
                  </div>
                </div>
              </div>
              <br>
<!--Batas golongan kepangkatan pns-->
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
    <!--<script src="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.js"></script>-->
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>asset/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- FastClick -->
    <!--<script src="<?php echo base_url(); ?>asset/vendors/fastclick/lib/fastclick.js"></script>-->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>
    <script src="<?php echo base_url() ?>asset/Informasi.js"></script>
        <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!--Highchart-->
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>asset/Highchart.js"></script>

    <script>
      
      $(document).ready(function(){
        var yog = [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2,
                     26.5, 23.3, 18.3, 13.9, 9.6];
        var sle = [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8,
                     24.1, 20.1, 14.1, 8.6, 2.5];
        var ban = [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 
                     16.6, 14.2, 10.3, 6.6, 4.8];
        var kul = [3.9, 4.2, 5.7, 8.5, 3.9, 15.2, 15.0, 
                     14.6, 14.2, 15.3, 6.6, 4.8];
        var gun = [3.9, 8.2, 6.7, 8.5, 10.9, 15.2, 17.0, 
                     16.6, 6.2, 10.3, 2.6, 4.8]        

        partikulat10 ('#container', yog, sle, ban, kul, gun);
        partikulat25 ('#container2', yog, sle, ban, kul, gun);
      })

      $('.kirim').click(function(){
          //alert($('.tgal').val());
      })

      $('.grafik').click(function(e){
          e.preventDefault();

          var val =$(this).attr('href');

          val = JSON.parse("[" + val + "]");
          kah(val, "mybarChart2");
          
      })

      $('.hapus').click(function(){
        var cek = document.querySelectorAll('input[data-nama=hapus]:checked').length
        if (cek==0) {
          return false;
        }
      })

      $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY'
        //allowInputToggle: true
        });
    </script>

  </body>
</html>