@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="alert alert-success" v-if="response" style="margin:0 15px 15px">@{{response}}</div>
	<div class="col-md-4 col-sm-4 banner">
			<h2>Supplier</h2><br>
			<div class="row">
				<div class="col-md-10">
				<autocomplete
				id="supplierautocomplete"
				class="form-control"
				name="supplier"
				placeholder="Tulis Kode / Nama Supplier"
				url="/api/getSupplier/"
				param="q"
				limit="5"
				anchor="name"
				label="address"
				model="model_supplier">
				</autocomplete>
				</div>
				<div class="col-md-2"><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#inputSupplierModal" @click="getProvinces"><i class="fa fa-stack fa-plus"></i></button></div></div>
			<hr>
			<table class="table" v-if="data_supplier">
				<tr>
					<td>Nama</td><td>@{{data_supplier.name}}</td>
				</tr>
				<tr>
					<td>Alamat</td><td>@{{data_supplier.address}}</td>
				</tr>
				<tr>
					<td>Phone</td><td>@{{data_supplier.phone}}</td>
				</tr>
				<tr>
					<td>BBM</td><td>@{{data_supplier.bbm}}</td>
				</tr>
			</table>
	</div>

	<div class="col-md-7 col-sm-6 banner" >
		<h2>Data Barang Pembelian</h2><br>
		<div v-if="supplierautocomplete" style="margin-left:-15px">
		<div class="col-md-6" ><autocomplete
			id="itemautocomplete"
			class="form-control"
			name="item"
			placeholder="Tulis Kode / Nama Barang"
			url="/api/getItems/"
			param="q"
			limit="5"
			anchor="name"
			label="description"
			model="model_item">
		</autocomplete>		
		</div>
		<div class="col-md-6">
			<h2 style=" padding-top: 5px; font-size: 25px;"> Total : @{{grand_total|currencyDisplay}}</h2>
		</div>
		<div class="col-md-12">
		<hr>
		<table class="table table-bordered table-condensed">
			<tr>
				<th class="col-xs-2">Kode</th>
				<th class="col-xs-3">Nama</th>
				<th class="col-xs-1">Jumlah</th>
				<th class="col-xs-3">Harga</th>
				<th class="col-xs-3">Total</th>
			</tr>
			<tr v-for="item in data_item">
				<td>@{{item.code}}</td>
				<td>@{{item.name}}</td>
				<td style="padding-top:5px"><input type="text" class="text-right input-sm form-control" style="margin:0px" v-model="item.amount" value="1" ></td>
				<td style="padding-top:5px"><input type="text" class="text-right input-sm form-control" style="margin:0px" v-model="item.price|currencyDisplay" ></td>
				<td class="text-right currency">@{{item.amount*item.price | currencyDisplay}}</td>
			</tr>
		</table>
		<button class="btn btn-success btn-save-transaction" @click="saveTransaction" v-if="data_item!=''"><i class="fa fa-save"></i>  Save</button> 
		</div>
		</div>
	</div>

	<!-- Modal -->
    @include('purchase.inputSupplierModal')
</div>
@endsection
@push('javascript')
<script src="/js/vue-autocomplete.js"></script>
<script>
var vue = new Vue({
	el:'#wrapper',
	data:{
		activepurchase: 'active',
		supplierautocomplete:false,
		model_supplier:'',
		data_supplier:'',
		model_item:'',
		data_item:[],
		response:'',
		provinces:'',
		cities:'',
		newSupplier:{
			id:'',name:'',phone:'',bbm:'',address:'',city_id:'',province_id:''
		}
	},
	methods:{
		saveTransaction: function(){
			var data_transaction = {
				supplier_id:this.data_supplier.id,
				grand_total:vue.grand_total,
				purchase_details:this.data_item
			}

			this.$http.post('/api/purchase',data_transaction).then((response) => {
				if(response.body.error == false){
					$('#supplierautocomplete').val('');
					this.supplierautocomplete=false,
					this.model_supplier='',
					this.data_supplier='',
					this.model_item='',
					this.data_item=[],
					this.response=response.body.message
					self = this
					setTimeout(function(){
						self.response = ''
					},2000)
				}
			})
		},
		getProvinces: function(){
			this.$http.get('/api/provinces').then((response) => {
				this.provinces = response.body
			})
		},
		getCity: function(id){
			this.$http.get('/api/cities/'+id).then((response) => {
				this.cities= response.body;
			})		
		},
		saveSupplier: function(){
			var supplier = this.newSupplier

			this.newSupplier={name:'',phone:'',bbm:'',address:'',city_id:'',province_id:''}
			this.$http.post('/api/supplier',supplier).then((response) => {
				this.data_supplier.id = response.body.id
			})		
			this.data_supplier=supplier;
			this.supplierautocomplete=true;
			setTimeout(function(){
				// --- jquery function to hide modal
				$('#inputSupplierModal').modal('hide');
				// ---
			},500)

		},
	},
	ready: function(){
		
	},
	events: {
		// Autocomplete on selected
		'autocomplete-supplier:selected': function(data){
			console.log('selected',data);
			this.data_supplier = data;
			this.supplierautocomplete=true;
		},
		'autocomplete-item:selected': function(data){
			console.log('items selected',data);
			this.data_item.push(data);
		},
		'autocomplete-supplier:hide': function(){
			$('#supplierautocomplete').val('');
		},
		'autocomplete-item:hide': function(){
			$('#itemautocomplete').val('');
		},
	},
	computed: {
  	grand_total: function(){
	    return this.data_item.reduce(function(prev, product){
	    	var sub_total = product.amount * product.price; 
	    	// this.grand_total = sub_total;
	       	return prev+sub_total;
	    },0); 
  	}
	}
});
Vue.filter('currencyDisplay', {
  // model -> view
  // formats the value when updating the input element.
  read: function(val) {
  	if(val > 0){
  	  	var parts = val.toString().split(".");
  	    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  	    return 'Rp '+parts.join(".");
  	}else{
  		return 'Rp '+0;
  	}
    // return 'Rp '+val.toFixed(2)
  },
  // view -> model
  // formats the value when writing to the data.
  write: function(val, oldVal) {
    var number = +val.replace(/[^\d.]/g, '')
    return isNaN(number) ? 0 : parseFloat(number.toFixed(2))
  }
})
</script>

@endpush