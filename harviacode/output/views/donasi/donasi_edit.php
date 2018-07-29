<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Donasi</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
                    <label>id_donasi</label>
                    <input type="text" name="id_donasi" class="form-control" placeholder="" value="<?php echo $dataedit->id_donasi?>" readonly>
            </div>
	  <div class="form-group">
            <label>id_dkm</label>
            <input type="text" name="id_dkm" class="form-control" value="<?php echo $dataedit->id_dkm?>">
    </div>
	  <div class="form-group">
            <label>id_metode_bayar</label>
            <input type="text" name="id_metode_bayar" class="form-control" value="<?php echo $dataedit->id_metode_bayar?>">
    </div>
	  <div class="form-group">
            <label>id_donatur</label>
            <input type="text" name="id_donatur" class="form-control" value="<?php echo $dataedit->id_donatur?>">
    </div>
	  <div class="form-group">
            <label>total_bayar</label>
            <input type="text" name="total_bayar" class="form-control" value="<?php echo $dataedit->total_bayar?>">
    </div>
	  <div class="form-group">
            <label>tanggal_bayar</label>
            <input type="text" name="tanggal_bayar" class="form-control" value="<?php echo $dataedit->tanggal_bayar?>">
    </div>
	  <div class="form-group">
            <label>pesan</label>
            <input type="text" name="pesan" class="form-control" value="<?php echo $dataedit->pesan?>">
    </div>
	
                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
