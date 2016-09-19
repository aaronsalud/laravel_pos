@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="blank">
<div class="blank-page">
<div id="suppliers">
	<h2>Laporan Pembelian </h2>
	<span class="pull-right" style="margin:0 5px 5px 0;">
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">New</button></span>
	 
	<table class="table table-bordered">
	<thead>
	<tr>
		<th>Tanggal</th>
		<th>Nama Supplier</th>
		<th>Total</th>
		<th>Operation</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="purchase in purchases">
			<td>@{{purchase.created_at}}</td>
			<td>@{{purchase.supplier.name}}</td>
			<td class="text-right">@{{purchase.total|currencyDisplay}}</td>
			<td> <a href="/report/purchase/@{{purchase.id}}"><i class="glyphicon glyphicon-edit"></i></a>
			</td>
		</tr>
	</tbody>
	</table>
</div>
</div>
</div>
@endsection
@push('javascript')
<script>
var vue = new Vue({
	el:'#wrapper',
	data:{
		activepurchasereport:'active',
		purchases:[]
	},
	methods:{
		fetchPurchases: function(){
			this.$http.get('/api/purchases/reports').then((response) => {
				this.$set('purchases',response.body)
			});
		},
	},
	ready: function(){
		this.fetchPurchases();
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