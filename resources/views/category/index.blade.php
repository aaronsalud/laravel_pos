@extends('layouts.app')
@section('content')
<div id="categories">
	<h2>List Categories </h2>
	<span class="pull-right" style="margin:0 5px 5px 0;">
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">New</button></span>
	 
	<table class="table table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Keterangan</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Operation</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="category in categories">
			<td>@{{category.id}}</td>
			<td>@{{category.code}}</td>
			<td>@{{category.name}}</td>
			<td>@{{category.description}}</td>
			<td>@{{category.created_at}}</td>
			<td>@{{category.updated_at}}</td>
			<td>
				<button class="btn btn-default btn-sm" @click="editCategory(category.id)" data-toggle="modal" data-target="#inputModal"><i class="glyphicon glyphicon-edit"></i></button>
				<button class="btn btn-danger btn-sm" @click="removeCategory(category.id)"><i class="glyphicon glyphicon-trash"></i></button>
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
	        <h4 class="modal-title" id="inputModalLabel">Input Categories</h4>
	      </div>
	      <div class="modal-body">
	        <form action="" method="POST" class="form-horizontal" role="form" @submit.prevent="saveCategory"> 
	        	<div class="form-group">
	        		<label for="code" class="control-label col-sm-2">Kode</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="code" id="code" class="form-control" placeholder="Kode Kategori" autocomplete=off v-model="newCategory.code">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="name" class="control-label col-sm-2">Nama</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="name" id="name" class="form-control" placeholder="Nama Kategori" autocomplete=off v-model="newCategory.name">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="description" class="control-label col-sm-2">Keterangan</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="description" id="description" class="form-control" placeholder="Keterangan" autocomplete=off v-model="newCategory.description">
	        		</div>
	        	</div>
	       <div class="alert alert-success" transition="success" v-if="success"> Kategori berhasil disimpan</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button v-if="!edit" @click="saveCategory()" type="submit" class="btn btn-primary">Add</button>
	        <button v-if="edit" @click="updateCategory(newCategory.id)" class="btn btn-primary">Update</button>
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
	el:'#wrapper',
	data:{
		newCategory:{
			id:'',code:'',name:'',description:''
		},
		success: false,
		edit: false,
		activecategory: 'active'
	},
	methods:{
		fetchCategories: function(){
			this.$http.get('/api/categories').then((response) => {
				this.$set('categories',response.body)
			});
		},
		saveCategory: function(){
			var category = this.newCategory

			this.newCategory={code:'',name:'',description:''}

			this.$http.post('/api/category',category)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchCategories();
		},
		editCategory: function(id){
			this.edit=true
			this.$http.get('/api/category/').then((response) => {
				this.newCategory.id = response.body.id;
				this.newCategory.name = response.body.name;
				this.newCategory.code = response.body.code;
				this.newCategory.description = response.body.description;
			})
		},
		updateCategory: function(id){
			var category = this.newCategory

			this.newCategory={code:'',name:'',description:''}

			this.$http.put('/api/category/'+id,category)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchCategories();
		},
		removeCategory: function(id){
			var ConfirmBox = confirm("Hapus kategori ini?")
			if (ConfirmBox) this.$http.delete('/api/category/'+id);
			this.fetchCategories()
		}
	},
	ready: function(){
		this.fetchCategories();
	}
});
</script>

@endpush