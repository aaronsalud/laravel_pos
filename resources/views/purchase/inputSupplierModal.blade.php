<div class="modal fade" id="inputSupplierModal" tabindex="-1" role="dialog" aria-labelledby="inputSupplierModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="inputSupplierModalLabel">Input Supplier</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="form-horizontal" role="form" @submit.prevent="saveSupplier"> 
        	<div class="form-group">
        		<label for="name" class="control-label col-sm-2">Nama</label>
        		<div class="col-sm-10">
        			<input type="text" name="name" id="name" class="form-control" placeholder="Nama Supplier" autocomplete=off v-model="newSupplier.name">
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="phone" class="control-label col-sm-2">Phone</label>
        		<div class="col-sm-10">
        			<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" autocomplete=off v-model="newSupplier.phone">
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="bbm" class="control-label col-sm-2">pin BBM</label>
        		<div class="col-sm-10">
        			<input type="text" name="bbm" id="bbm" class="form-control" placeholder="PIN BBM" autocomplete=off v-model="newSupplier.bbm">
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="address" class="control-label col-sm-2">Alamat</label>
        		<div class="col-sm-10">
        			<input type="text" name="address" id="address" class="form-control" placeholder="Alamat" autocomplete=off v-model="newSupplier.address">
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="provinces" class="control-label col-sm-2">Provinsi</label>
        		<div class="col-sm-10">
        			<select name="province_id" id="provinces" class="form-control" v-model="newSupplier.province_id" @change="getCity(newSupplier.province_id)">
        				<option v-if="provinces" v-for="province in provinces" value="@{{ province.id }}">@{{ province.name }}</option> 
        			</select>
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="cities" class="control-label col-sm-2">Kota / Kabupaten</label>
        		<div class="col-sm-10">
        			<select name="city_id" id="cities" class="form-control" v-model="newSupplier.city_id" >
	        			<option v-if="!cities" value="" disabled selected>Pilih Provinsi Dulu</option>
        				<option v-if="cities" v-for="city in cities" value="@{{ city.id }}">@{{ city.name }}</option> 

        			</select>
        		</div>
        	</div>

       <div class="alert alert-success" transition="success" v-if="success"> Data supplier berhasil disimpan</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button v-if="!edit" @click="saveSupplier()" type="submit" class="btn btn-primary">Add</button>
        <button v-if="edit" @click="updateSupplier(newSupplier.id)" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
  </form>
</div>