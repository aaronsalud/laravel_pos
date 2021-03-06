@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="blank">
<div class="blank-page">
<div id="items ">
	<h2>Data Barang </h2>
	<span class="pull-right" style="margin:0 5px 5px 0;">
	<button @click="resetForm()" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">New</button></span>
	 
	<table class="table table-bordered">
	<thead>
	<tr>
		<th>Id</th>
		<th>Gambar</th>
		<th>Nama</th>
		<th>Kategori</th>
		<th>Keterangan</th>
		<th>Harga</th>
		<th>Status</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Operation</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="item in items">
			<td>@{{item.id}}</td>
			<td>
				<div v-for="image in item.images" class="list-inline" v-if="$index==0" style="position:relative">
						<img src="@{{image.path}}" alt="@{{image.path}}" class="img-thumbnail" width="100px">
						<span style="color:#7f8c8d;position:absolute;top:0px;left:0px">@{{item.code}}</span>
				</div>
				
			</td>
			<td>@{{item.name}}</td>
			<td>@{{item.category.name}}</td>
			<td>@{{item.description}}</td>
			<td class="text-right">@{{item.price}}</td>
			<td v-if="item.status==1">
				<span class="label label-success">Aktif</span>
			</td>
			<td v-if="item.status==0">
				<span class="label label-danger">Non Aktif</span>
			</td>
			<td>@{{item.created_at}}</td>
			<td>@{{item.updated_at}}</td>
			<td>
				<button class="btn btn-default btn-sm" @click="editItem(item.id)" data-toggle="modal" data-target="#inputModal"><i class="glyphicon glyphicon-edit"></i></button>
				<button class="btn btn-danger btn-sm" @click="removeItem(item.id)"><i class="glyphicon glyphicon-trash"></i></button>
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
	        <h4 class="modal-title" id="inputModalLabel">Input Barang</h4>
	      </div>
	      <div class="modal-body">
	       <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Detail</a></li>
		    <li role="presentation"><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">Properti</a></li>
		  </ul>
	      <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="details">
				<form action="" method="POST" class="form-horizontal" role="form" @submit.prevent="saveItem"> 
	        	<div class="form-group">
	        		<label for="code" class="control-label col-sm-2">Kode</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="code" id="code" class="form-control" placeholder="Kode Barang" autocomplete=off v-model="newItem.code">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="name" class="control-label col-sm-2">Nama</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="name" id="name" class="form-control" placeholder="Nama Barang" autocomplete=off v-model="newItem.name">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="description" class="control-label col-sm-2">Keterangan</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="description" id="description" class="form-control" placeholder="Keterangan" autocomplete=off v-model="newItem.description">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="categories" class="control-label col-sm-2">Kategori</label>
	        		<div class="col-sm-10">
	        			<select name="category_id" id="categories" class="form-control" v-model="newItem.category_id">
	        				@foreach ($categories as $category)
	        					<option value="{{$category->id}}">{{$category->name}}</option>
	        				@endforeach
	        			</select>
	        		</div>
	        	</div>
				<div class="form-group">
	        		<label for="price" class="control-label col-sm-2">Harga</label>
	        		<div class="col-sm-10">
	        			<input type="text" name="price" id="price" class="form-control" placeholder="Harga" autocomplete=off v-model="newItem.price">
	        		</div>
	        	</div>
				<div class="form-group" style="padding-left:120px;">
					<label for="status" class="control-label col-sm-offset-2">
						<input type="checkbox" name="status" id="status" v-model="newItem.status">   Active
					</label>
				</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="properties">
		    <div class="form-group">
		    	<p>Select an image</p>
		    		<input type="file" id="images" name="images" @change="uploadFile">
					<div ><img v-show="loading" v-bind:src="loading" alt="@{{loading}}"></div>
					
					<ul class="list-inline">
						<li v-for="r in newItem.itemImages">
							<div class="imgHolder">
							    <img v-bind:src="r" alt="@{{r}}" width="100px" class="img-thumbnail">
							    <span><a href="#" @click="deleteImage(r)">
							    	<span class="fa-stack fa-lg">
							    		<i class="fa fa-times-circle-o fa-lg" aria-hidden="true"></i>
							    	</span></a>
							    </span>
							</div>
						</li>
						<li v-for="img in itemImages" >
						<div class="imgHolder">
							<img v-bind:src="img.path" alt="@{{img.path}}" width="100px" class="img-thumbnail">
							<span><a href="#" @click="deleteImage(img.path)">
							    	<span class="fa-stack fa-lg">
							    		<i class="fa fa-times-circle-o fa-lg" aria-hidden="true"></i>
							    	</span></a>
							    </span>
						</div>
						</li>
					</ul>
					<div v-if="error">
						<span class="label label-danger">@{{message}}</span>
					</div>
		    </div>
		    </div>
		  </div>
	       <div class="alert alert-success" transition="success" v-if="success"> Barang berhasil disimpan</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button v-if="!edit" @click="saveItem()" type="submit" class="btn btn-primary">Add</button>
	        <button v-if="edit" @click="updateItem(newItem.id)" class="btn btn-primary">Update</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>
</div>
</div>
</div>
@endsection
@push('javascript')
<script>
var vue = new Vue({
	el:'#wrapper',
	data:{
		newItem:{
			id:'',code:'',name:'',description:'',price:'',status:'1',category_id:'',itemImages:[]
		},
		success: false,
		edit: false,
		activeitem:'active',
		message:'',
		loading:'',
		uploadImage:'',
		itemImages:[],
		
	},
	methods:{
		fetchItem: function(){
			this.$http.get('/api/items').then((response) => {
				this.$set('items',response.body)
				// console.log('asaeaea')
			});
		},
		saveItem: function(){
			var item = this.newItem

			this.newItem={code:'',name:'',description:'',price:'',status:'1',category_id:'',itemImages:[]}
			this.uploadImage=''
			this.response=[]
			this.itemImages=[]
			this.$http.post('/api/item',item)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchItem();
		},
		editItem: function(id){
			this.edit=true
			this.$http.get('/api/item/'+id).then((response) => {
				this.newItem.id = response.body.id;
				this.newItem.name = response.body.name;
				this.newItem.code = response.body.code;
				this.newItem.description = response.body.description;
				this.newItem.category_id = response.body.category_id;
				this.newItem.price = response.body.price;
				this.newItem.status = response.body.status;
				this.itemImages = response.body.images;
			})
		},
		updateItem: function(id){
			var item = this.newItem

			this.newItem={code:'',name:'',description:'',price:'',status:'1',category_id:'',itemImages:[]}
			this.uploadImage=''
			this.response=[]
			this.itemImages=[]
			this.$http.put('/api/item/'+id,item)
			this.success=true
			self = this
			setTimeout(function(){
				self.success = false
				self.edit = false
				// --- jquery function to hide modal
				$('#inputModal').modal('hide');
				// ---
			},500)

			this.fetchItem();
		},
		removeItem: function(id){
			var ConfirmBox = confirm("Hapus barang ini?")
			if (ConfirmBox) this.$http.delete('/api/item/'+id);
			this.fetchItem()
		},
		uploadFile(e){
			var file = e.target.files ||e.dataTransfer.files;
			if(!file.length)
				return;
			this.$set('loading','images/ajax-loader-bar.gif');
			this.processUpload(file[0]);
			// jquery function to reset input file
			var $el = $('#images');
	        $el.wrap('<form>').closest('form').get(0).reset();
	        $el.unwrap();
	        // ---
		},
		processUpload(file){
			var that = this;
			var formData = new FormData();						
			formData.append("images",file);
			that.$http.post('/api/add_item_image',formData).then(function (response) {
    			var resp = response.body;		                
            	that.$set('loading','');
            	if (resp.error==true) {
            		that.$set('error',true);
	                this.$set('message',resp.message);
	                // this.response.unshift(this.message);
            	}else{
            		that.$set('error',false);
					this.$set('uploadImage',resp.message);
					// this.response.unshift(this.uploadImage);
					this.newItem.itemImages.unshift(this.uploadImage);
            	}
            	// console.log(this.response)
	        },function (response){
	        	console.log(response.text())
	        });
		},
		deleteImage: function(imageName){
			var img = imageName.replace('images/items/','');

			this.$http.delete('/api/deleteImage/'+img).then(function (response) {
				if(response.body.images){
					this.itemImages = response.body.images
				}else{
					this.newItem.itemImages = _.without(this.newItem.itemImages, imageName)
				}
			});

			
		},
		resetForm: function(){
			this.newItem={
				id:'',code:'',name:'',description:'',price:'',status:'1',category_id:'',itemImages:[]
			}
			this.itemImages=[]
		}
	},
	
	ready: function(){
		this.fetchItem();
	}
});
</script>

@endpush