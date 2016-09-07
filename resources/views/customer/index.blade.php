@extends('layouts.app')
@section('content')
<div class="container" id="customers">
	<h2>Data Pelanggan </h2>
	<span class="pull-right" style="margin:0 5px 5px 0;">
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">New</button></span>
	 
	<table class="table table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Nama</th>
		<th>Telp</th>
		<th>BBM</th>
		<th>Alamat</th>
		<th>Kota</th>
		<th>Provinsi</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Operation</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="customer in customers">
			<td>@{{customer.id}}</td>
			<td>@{{customer.name}}</td>
			<td>@{{customer.phone}}</td>
			<td>@{{customer.bbm}}</td>
			<td>@{{customer.address}}</td>
			<td>@{{customer.city.name}}</td>
			<td>@{{customer.province.name}}</td>
			<td>@{{customer.created_at}}</td>
			<td>@{{customer.updated_at}}</td>
			<td>
				<button class="btn btn-default btn-sm" @click="editCustomer(customer.id)" data-toggle="modal" data-target="#inputModal"><i class="glyphicon glyphicon-edit"></i></button>
				<button class="btn btn-danger btn-sm" @click="removeCustomer(customer.id)"><i class="glyphicon glyphicon-trash"></i></button>
			</td>
		</tr>
	</tbody>
</table>
<!-- Modal -->

	<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="inputModalLabel">Input Pelanggan</h4>
	      </div>
	      <div class="modal-body">
	        <form action="" method="POST" class="form-horizontal" role="form" @submit.prevent="saveCustomer"> 
	        	<div class="form-group">
	        		<label for="name" class="control-label col-sm-2">Nama</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="name" id="name" class="form-control" placeholder="Nama Supplier" autocomplete=off v-model="newCustomer.name">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="phone" class="control-label col-sm-2">Phone</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon" autocomplete=off v-model="newCustomer.phone">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="bbm" class="control-label col-sm-2">pin BBM</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="bbm" id="bbm" class="form-control" placeholder="PIN BBM" autocomplete=off v-model="newCustomer.bbm">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="address" class="control-label col-sm-2">Alamat</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="address" id="address" class="form-control" placeholder="Alamat" autocomplete=off v-model="newCustomer.address">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="provinces" class="control-label col-sm-2">Provinsi</label>
	        		<div class="col-sm-10">
	        			<select name="province_id" id="provinces" class="form-control" v-model="newCustomer.province_id" @change="getCity(newCustomer.province_id)">
	        				@foreach ($provinces as $province)
	        					<option value="{{$province->id}}">{{$province->name}}</option>
	        				@endforeach
	        			</select>
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="cities" class="control-label col-sm-2">Kota / Kabupaten</label>
	        		<div class="col-sm-10">
	        			<select name="city_id" id="cities" class="form-control" v-model="newCustomer.city_id" >
		        			<option v-if="!cities" value="" disabled selected>Pilih Provinsi Dulu</option>
	        				<option v-if="cities" v-for="city in cities" value="@{{ city.id }}">@{{ city.name }}</option> 

	        			</select>
	        		</div>
	        	</div>

	       <div class="alert alert-success" transition="success" v-if="success"> Data customer berhasil disimpan</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button v-if="!edit" @click="saveCustomer()" type="submit" class="btn btn-primary">Add</button>
	        <button v-if="edit" @click="updateSupplier(newCustomer.id)" class="btn btn-primary">Update</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>
</div>
@endsection
@push('javascript')
<script>
var vue = new Vue({
	el:'#customers',
	data:{
		newCustomer:{
			id:'',name:'',phone:'',bbm:'',address:'',city_id:'',province_id:''
		},
		success: false,
		edit: false,
		cities:''
	},
	methods:{
		fetchSupplier: function(){
			this.$http.get('/api/customers').then((response) => {
				this.$set('customers',response.body)
			});
		},
		saveCustomer: function(){
			var customer = this.newCustomer

			this.newCustomer={name:'',phone:'',bbm:'',address:'',city_id:'',province_id:''}

			this.$http.post('/api/customer',customer)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchSupplier();
		},
		editCustomer: function(id){
			this.edit=true
			this.$http.get('/api/customer/'+id).then((response) => {
				this.newCustomer.id = response.body.id;
				this.newCustomer.name = response.body.name;
				this.newCustomer.address = response.body.address;
				this.newCustomer.province_id = response.body.province_id;
				this.getCity(response.body.province_id);
				this.newCustomer.city_id = response.body.city_id;
				this.newCustomer.phone = response.body.phone;
				this.newCustomer.bbm = response.body.bbm;
			})
		},
		updateSupplier: function(id){
			var customer = this.newCustomer

			this.newCustomer={name:'',phone:'',bbm:'',address:'',city_id:'',province_id:''}
			this.$http.put('/api/customer/'+id,customer)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchSupplier();
		},
		removeCustomer: function(id){
			var ConfirmBox = confirm("Hapus barang ini?")
			if (ConfirmBox) this.$http.delete('/api/customer/'+id);
			this.fetchSupplier()
		},
		getCity: function(id){
			this.$http.get('/api/cities/'+id).then((response) => {
				this.cities= response.body;
			})		
		}
	},
	
	ready: function(){
		this.fetchSupplier();
	}
});
</script>

@endpush