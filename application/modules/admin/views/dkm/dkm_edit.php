<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Dkm</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
                    <label>id_dkm</label>
                    <input type="text" name="id_dkm" class="form-control" placeholder="" value="<?php echo $dataedit->id_dkm?>" readonly>
            </div>
	  <div class="form-group">
            <label>username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $dataedit->username?>">
    </div>
	  <div class="form-group">
            <label>password</label>
            <input type="text" name="password" class="form-control" placeholder="masukan password baru">
    </div>
	  <div class="form-group">
            <label>no_ktp</label>
            <input type="text" name="no_ktp" class="form-control" value="<?php echo $dataedit->no_ktp?>">
    </div>
	  <div class="form-group">
            <label>nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $dataedit->nama?>">
    </div>
	  <div class="form-group">
            <label>tanggal_lahir</label>
            <input type="text" name="tanggal_lahir" class="form-control" value="<?php echo $dataedit->tanggal_lahir?>">
    </div>
	  <div class="form-group">
            <label>kontak</label>
            <input type="text" name="kontak" class="form-control" value="<?php echo $dataedit->kontak?>">
    </div>
	  <div class="form-group">
            <label>email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $dataedit->email?>">
    </div>
	  <div class="form-group">
            <label>url_foto</label>
            <input type="text" name="url_foto" class="form-control" value="<?php echo $dataedit->url_foto?>">
    </div>
	  <div class="form-group">
            <label>bank</label>
            <input type="text" name="bank" class="form-control" value="<?php echo $dataedit->bank?>">
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
