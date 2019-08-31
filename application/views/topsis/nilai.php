  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Nilai</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a href="#myModaltambah" class="btn btn-default" id="custId" data-toggle="modal" ><i class="fa fa-plus-circle"></i> Tambah Nilai</a></li>
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
                    <th>Kriteria</th>
                    <th>Nilai</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=0;
                  foreach ($gnilai->result_array() as $i) :
                   $no++;
                   ?>
                   <tr>
                    <td><?php echo $i['kriteria_nama']; ?></td>
                    <td><?php echo $i['nilai_nilai']; ?></td>
                    <td  class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a data-toggle="modal" data-target="#ModalEdit<?php echo $i['nilai_id'];?>">Edit</a>
                          </li>
                          <li>
                            <a data-toggle="modal" data-target="#ModalHapus<?php echo $i['nilai_id'];?>">Hapus</a>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Nilai</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data">
          <form class="form-horizontal form-label-left" action="<?php echo base_url()?>padmin/save_nilai" method="POST" enctype="multipart/form-data">

           <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="hidden" name="user_nip" value="<?php echo $_SESSION['user_nip']; ?>" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="kriteria" class="form-control">
                <?php 
                foreach($gkriteria->result_array() as $k):
                  ?>                

                  <option value="<?php echo $k['kriteria_id']; ?>"><?php echo $k['kriteria_nama']; ?></option>

                <?php endforeach;?>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" name="nilai" class="form-control">
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


<?php foreach ($gnilai->result_array() as $i) :  ?>

  <div class="modal fade" id="ModalEdit<?php echo $i['nilai_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Nilai</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/update_nilai'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
            <input type="hidden" name="kode" value="<?php echo $i['nilai_id'];?>"/> 



            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="kriteria" class="form-control">
                  <?php foreach($gkriteria->result_array() as $k):?>                
                    <option value="<?php echo $k['kriteria_id']; ?>" <?php if($k['kriteria_id']==$i['kriteria_id']) {echo "selected";} else {} ?>><?php echo $k['kriteria_nama']; ?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" name="nilai" value="<?php echo $i['nilai_nilai']; ?>" class="form-control">
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


<?php foreach ($gnilai->result_array() as $i) :
  ?>
  <div class="modal fade" id="ModalHapus<?php echo $i['nilai_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Hapus Nilai</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/delete_nilai'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
           <input type="hidden" name="kode" value="<?php echo $i['nilai_id'];?>"/> 
           <p>Apakah Anda yakin mau menghapus Nilai ini ?</p>

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
