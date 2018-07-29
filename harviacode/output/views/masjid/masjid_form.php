<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Masjid</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
            <label>nama</label>
            <input type="text" name="nama" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>latitude</label>
            <input type="text" name="latitude" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>longitude</label>
            <input type="text" name="longitude" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>url_foto</label>
            <input type="text" name="url_foto" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>id_dkm</label>
            <input type="text" name="id_dkm" class="form-control" placeholder="">
    </div>
	    <input type="hidden" name="id_masjid" /> 
	
                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
