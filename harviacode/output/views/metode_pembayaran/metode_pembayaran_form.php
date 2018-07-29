<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Metode_pembayaran</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
            <label>nama_bank</label>
            <input type="text" name="nama_bank" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>no_rekening</label>
            <input type="text" name="no_rekening" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>id_admin</label>
            <input type="text" name="id_admin" class="form-control" placeholder="">
    </div>
	    <input type="hidden" name="id_metode_bayar" /> 
	
                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
