<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Pejabat </title>

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pejabat di BMKG DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar pejabat bmkg saat ini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>

                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" action="<?php echo site_url('Informasi/del_pejabat')?>" id="del" >
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Nama </th>
                            <th class="column-title">Jabatan</th>
                            <th class="column-title">Eselon</th>
                            <th class="column-title">Foto</th>
                            <th class="column-title">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $pejabat ?>
                        </tbody>
                      </table>
                    </div>
                    <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button></form>
                  </div>
                </div>  
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div  class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan data pejabat baru di sini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content" style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/set_pejabat') ?>" class="form-horizontal form-label-left " id="kirim-data">

                      <div class="form-group">
                        <label class="control-label left col-md-2" for="first-name">Nama</label>
                        <div class="col-md-3">
                          <input autocomplete="off" type="text" required="required" class="form-control col-md-7 col-xs-12" name="nama">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label left col-md-2" for="first-name">Jabatan</label>
                        <div class="col-md-3">
                          <input autocomplete="off" type="text" required="required" class="form-control col-md-7 col-xs-12" name="jabatan">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label left col-md-2" for="first-name">Kategori</label>
                        <div class="col-md-3">
                          <select class="form-control has-feedback-left" name="kategori">
                          <option value="I">Eselon I</option>
                          <option value="II">Eselon II</option>
                          <option value="III">Eselon III</option>
                          <option value="IV">Eselon IV</option>
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label left col-md-2" for="first-name">Foto</label>
                        <div class="col-md-3">
                          <input required type="file" name="foto" >
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div  class="x_panel">
                  <div class="x_title">
                    <h5>Edit data pejabat</h5>
                  </div>
                  <div class="x_content form-edit" style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/edit_pejabat') ?>" class="form-horizontal form-label-left input_mask" id="kirim-data" >

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control has-feedback-left form-nama" placeholder="Nama" required="required">
                        <input type="hidden" id="id-form" name="id">
                        <input type="hidden" id="ft-form" name="foto_form">
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control has-feedback-left form-jabatan" placeholder="Jabatan" required="required">
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Kategori</label>
                        <select class="form-control has-feedback-left" name="kategori">
                          <option value="I">Eselon I</option>
                          <option value="II">Eselon II</option>
                          <option value="III">Eselon III</option>
                          <option value="IV">Eselon IV</option>
                        </select>
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <span id="foto-edit"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Tambah foto jika mengganti foto</label>
                        <input type="file" name="foto" >
                        </div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button type="button" class="btn btn-danger batal">Batal</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- /page content  -->
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
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.min.js"></script>
    <!--fungsi js-->
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
  </body>

</html>