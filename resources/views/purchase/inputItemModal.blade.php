<div class="modal fade" id="inputItemModal" tabindex="-1" role="dialog" aria-labelledby="inputItemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="inputItemModalLabel">Input Barang</h4>
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
        				<option v-if="categories" v-for="category in categories" value="@{{ category.id }}">@{{ category.name }}</option> 
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