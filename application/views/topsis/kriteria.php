  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Kriteria</h2>

              <ul class="nav navbar-right panel_toolbox">
                <li><a href="#myModaltambah" class="btn btn-default" id="custId" data-toggle="modal" ><i class="fa fa-plus-circle"></i> Tambah Kriteria</a></li>
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
                  <th>Nama Kriteria</th>
                  <th>Bobot</th>
                  <th>Attribute</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=0;
                foreach ($gkriteria->result_array() as $i) :
                 $no++;
                 ?>
                 <tr>
                  <td><?php echo $i['kriteria_nama']; ?></td>
                  <td><?php echo $i['kriteria_bobot']; ?></td>
                  <td><?php echo $i['kriteria_attribute']; ?></td>
                  <td  class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary">Action</button>
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <a data-toggle="modal" data-target="#ModalEdit<?php echo $i['kriteria_id'];?>">Edit</a>
                        </li>
                        <li>
                          <a  data-toggle="modal" data-target="#ModalHapus<?php echo $i['kriteria_id'];?>">Hapus</a>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data">
          <form class="form-horizontal form-label-left" action="<?php echo base_url()?>padmin/save_kriteria" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kriteria</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="nama" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" min="1" max="5" name="bobot" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Attribute</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="attribute" class="form-control">
                  <option value="cost">Cost</option>
                  <option value="benefit">Benefit</option>
                </select>
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

<?php foreach ($gkriteria->result_array() as $i) :  ?>

  <div class="modal fade" id="ModalEdit<?php echo $i['kriteria_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Kriteria</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/update_kriteria'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
            <input type="hidden" name="kode" value="<?php echo $i['kriteria_id'];?>"/> 

            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kriteria</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="nama" value="<?php echo $i['kriteria_nama']; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" min="1" max="5" name="bobot"  value="<?php echo $i['kriteria_bobot']; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Attribute</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="attribute" class="form-control">
                  <option value="cost" <?php if($i['kriteria_attribute']=='cost'){echo "selected";} else {} ?>>Cost</option>
                  <option value="benefit" <?php if($i['kriteria_attribute']=='benefit'){echo "selected";} else {} ?>>Benefit</option>
                </select>
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


<?php foreach ($gkriteria->result_array() as $i) :
  ?>
  <div class="modal fade" id="ModalHapus<?php echo $i['kriteria_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Hapus Kriteria</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'padmin/delete_kriteria'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">       
           <input type="hidden" name="kode" value="<?php echo $i['kriteria_id'];?>"/> 
           <p>Apakah Anda yakin mau menghapus Kriteria <b><?php echo $i['kriteria_nama'];?></b> ?</p>

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


<script src="js/jquery-3.1.1.min.js"></script>
