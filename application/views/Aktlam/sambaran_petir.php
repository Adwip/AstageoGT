<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Peta sambaran petir </title>

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
    <link href="<?php echo base_url(); ?>asset/style_tabel/style.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Peta sambaran petir</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar Peta sambaran petir</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="GET" action="<?php echo site_url('Aktlam/peta_sambaran_petir') ?>">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <button type="submit" class="btn btn-primary">Tampilkan</button>
                      </form>
                      <form class="form-horizontal form-label-left input_mask" method="POST" id="del" action="<?php echo site_url('Aktlam/del_petir') ?>">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Bulan</th>
                            <th class="column-title">Judul</th>
                            <th class="column-title">Sambaran</th>
                            <th class="column-title">Kerapatan</th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Tanggal input</th>
                            <th class="column-title">Aksi
                            </th>
                          </tr>
                        </thead>
                        <tbody>                         
                          <?php echo $sambaran ?>
                        </tbody>
                      </table>
                    </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button type="submit" class="btn btn-round btn-danger btn-xs hapus">Hapus</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
                <br>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan data petir baru</h5>
                  </div>
                  <div class="x_content form-tambah"  style="display:none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Aktlam/set_petir') ?>" id="kirim-data">
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Bulan</label>
                          <input required type="text" class="form-control" id="bulan_form" readonly autocomplete="off" name="bulan">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Tahun</label>
                          <input required type="text" class="form-control" readonly id="tahun_form" autocomplete="off" name="tahun">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Judul</label>
                          <input required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Keterangan</label>
                          <textarea required rows="6"  name="keterangan" class="form-control" cols="20" style="resize: vertical;"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Kerapatan petir</label>
                          <input type="file" name="rapat">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Sambaran petir</label>
                          <input type="file" name="sambar">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success kirim">Kirim</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Batal</button>
                      </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Baca artikel</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content cek-data" style="display: none;">
                    <br />
                      

                      <span id="dokumen"></span>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Selesai</button>
                      </div>
                      </div>
                  </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit data petir</h5>
                  </div>
                  <div class="x_content form-edit"  style="display:none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Aktlam/edit_petir') ?>"  id="kirim-data">
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Bulan</label>
                          <input required type="text" class="form-control" id="bulan_edit" readonly autocomplete="off" name="bulan">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Tahun</label>
                          <input required type="text" class="form-control" readonly id="tahun_edit" autocomplete="off" name="tahun">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Judul</label>
                          <input required type="text" id="judul_edit" class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Keterangan</label>
                          <textarea required rows="6"  name="keterangan" id="ket_edit" class="form-control" cols="20" style="resize: vertical;"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Kerapatan petir</label>
                          <input type="file" name="rapat">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Sambaran petir</label>
                          <input type="file" name="sambar">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success kirim">Kirim</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Batal</button>
                      </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
            <br>
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
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/aktlam.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
  </body>
  <script>
    $(document).ready(function(){
      edit_spt('<?php echo site_url('Aktlam/get_spt_edit') ?>')
      read_spt('<?php echo site_url('Aktlam/get_spt_id') ?>')
      req_ptr_id('<?php echo site_url('Aktlam/get_ptr_edit') ?>')
    })
  </script>
</html>