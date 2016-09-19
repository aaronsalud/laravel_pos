@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="alert alert-success" v-if="response" style="margin:0 15px 15px">@{{response}}</div>
	<div class="col-md-4 col-sm-4 banner">
			<h2>Supplier</h2><br>
			<div class="row">
				<div class="col-md-10">
				@{{purchase.supplier.name}}
				</div>
			<hr>
			<table class="table">
				<tr>
					<td>Alamat</td><td>@{{purchase.supplier.address}}</td>
				</tr>
				<tr>
					<td>Phone</td><td>@{{purchase.supplier.phone}}</td>
				</tr>
				<tr>
					<td>BBM</td><td>@{{purchase.supplier.bbm}}</td>
				</tr>
			</table>
			</div>	
	</div>

	<div class="col-md-7 col-sm-6 banner" >
		<h2>Data Barang Pembelian</h2><br>
		<div style="margin-left:-15px">
			<div class="col-md-6">
				<h2 style=" padding-top: 5px; font-size: 25px;"> Total : @{{purchase.total|currencyDisplay}}</h2>
			</div>
			<div class="col-md-6"><span class="pull-right" style="padding-top:10px">@{{purchase.created_at}}</span></div>
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
					<tr v-for="detail in purchase.details">
						<td>@{{detail.item.code}}</td>
						<td>@{{detail.item.name}}</td>
						<td class="text-right">@{{detail.amount}}</td>
						<td class="text-right">@{{detail.price|currencyDisplay}}</td>
						<td class="text-right currency">@{{detail.amount*detail.price | currencyDisplay}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="id" value="{{$id}}">
@endsection
@push('javascript')
<script>
var id=$('#id').val();
var vue = new Vue({
	el:'#wrapper',
	data:{
		activepurchasereport: 'active',
		purchase:[]
	},
	methods:{
		fetchPurchaseDetail: function(){
			this.$http.get('/api/purchase/'+id).then((response) => {
				this.$set('purchase',response.body)
			});
		},
	},
	ready: function(){
		this.fetchPurchaseDetail();
	},
	events: {
		
	},
	computed: {
  	
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