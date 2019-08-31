  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>User</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a href="#myModaltambah" class="btn btn-default" id="custId" data-toggle="modal" ><i class="fa fa-plus-circle"></i> Tambah User</a></li>
              </ul>
              <div class="clearfix"></div>
              <div>
               <p><?php echo $this->session->flashdata('msg');?></p>
             </div>
           </div>
           <div class="x_content">
            <div class="table table-responsive">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">Foto</th>
                    <th>NIP </th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=0;
                  foreach ($data->result_array() as $i) :
                   $no++;
                   ?>
                   <tr>
                    <td  class="text-center"><img src="<?php echo base_url().'assets/images/'.$i['user_foto'];?>" width="50px"></td>
                    <td><?php echo $i['user_nip']; ?></td>
                    <td><?php echo $i['user_nama']; ?></td>
                    <td><?php echo $i['user_role']; ?></td>
                    <td  class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a data-toggle="modal" data-target="#ModalEdit<?php echo $i['user_nip'];?>">Edit</a>
                          </li>
                          <li>
                            <a data-toggle="modal" data-target="#ModalHapus<?php echo $i['user_nip'];?>">Hapus</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach;?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade bs-example-modal-lg" id="myModaltambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data">
          <form class="form-horizontal form-label-left" action="<?php echo base_url()?>padmin/save_user" method="POST" enctype="multipart/form-data">


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="user_nip" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="password" name="password" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Re-Password</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="password" name="repassword" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text"  name="user_nama" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="user_role" class="form-control">
                  <option value="admin">Admin</option>
                  <option value="dosen">Dosen</option>
                  <option value="pimpinan">Pimpinan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" name="filefoto" class="form-control">
              </div>
            </div>


            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Submit</button>
             </div>
           </div>
         </form>
       </div>
     </div>

   </div>
 </div>
</div>

<?php foreach ($data->result_array() as $i) :  ?>

  <div class="modal fade" id="ModalEdit<?php echo $i['user_nip'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Edit User</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/update_user'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="kode" value="<?php echo $i['user_nip'];?>" readonly="readonly" class="form-control"> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text"  name="user_nama" value="<?php echo $i['user_nama'];?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="user_role" class="form-control">
                  <option value="admin" <?php if($i['user_role']=='admin'){echo "selected";} else {}?>>Admin</option>
                  <option value="dosen" <?php if($i['user_role']=='dosen'){echo "selected";} else {}?>>Dosen</option>
                  <option value="pimpinan" <?php if($i['user_role']=='pimpinan'){echo "selected";} else {}?>>Pimpinan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" name="filefoto" class="form-control">
                <span>*Kosongkan jika tidak ingin mengganti foto</span>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach;?>


<?php foreach ($data->result_array() as $i) :
  ?>
  <div class="modal fade" id="ModalHapus<?php echo $i['user_nip'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Hapus User</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/delete_user'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
           <input type="hidden" name="kode" value="<?php echo $i['user_nip'];?>"/> 
           <p>Apakah Anda yakin mau menghapus User ini ?</p>

         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;?>
