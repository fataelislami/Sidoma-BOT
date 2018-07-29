<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Metode_pembayaran</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
                    <label>id_metode_bayar</label>
                    <input type="text" name="id_metode_bayar" class="form-control" placeholder="" value="<?php echo $dataedit->id_metode_bayar?>" readonly>
            </div>
	  <div class="form-group">
            <label>nama_bank</label>
            <input type="text" name="nama_bank" class="form-control" value="<?php echo $dataedit->nama_bank?>">
    </div>
	  <div class="form-group">
            <label>no_rekening</label>
            <input type="text" name="no_rekening" class="form-control" value="<?php echo $dataedit->no_rekening?>">
    </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
