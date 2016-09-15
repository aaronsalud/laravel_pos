@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="col-md-4 col-sm-4 banner">
			<h2>Supplier</h2><br>
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
				<th>Kode</th>
				<th>Nama</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Total</th>
			</tr>
			<tr v-for="item in data_item">
				<td>@{{item.code}}</td>
				<td>@{{item.name}}</td>
				<td class="col-sm-1" style="padding-top:5px"><input style="width:50px" type="text" class="text-right input-sm" v-model="item.jumlah" value="1" ></td>
				<td class="text-right currency">@{{item.price|currencyDisplay}}</td>
				<td class="text-right currency">@{{item.jumlah*item.price | currencyDisplay}}</td>
			</tr>
		</table>
		<button class="btn btn-success btn-save-transaction" @click="saveTransaction" v-if="data_item!=''"><i class="fa fa-save"></i>  Save</button>
		</div>
		</div>
	</div>

	
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
	},
	methods:{
		saveTransaction: function(){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();

			if(dd<10) {
			    dd='0'+dd
			} 

			if(mm<10) {
			    mm='0'+mm
			} 

			today = yyyy+'-'+mm+'-'+dd;
			var data_transaction = {
				purchase_date:today,
				supplier_id:this.data_supplier.id,
				item_data:this.data_item,
				grand_total:vue.grand_total
			}

			this.$http.post('/api/purchase',data_transaction)
		}
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
		'autocomplete-item:hide': function(){
			this.model_item='';
		},
	},
	computed: {
  	grand_total: function(){
	    return this.data_item.reduce(function(prev, product){
	    	var sub_total = product.jumlah * product.price; 
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