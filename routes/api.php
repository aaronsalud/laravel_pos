<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     // return $request->user();
//     $users = App\User::all();
//     return json_encode($users);
// })->middleware('auth:api');
Route::resource('category', 'CategoryController');
Route::resource('item', 'ItemController');
Route::resource('supplier', 'SupplierController');
Route::resource('customer', 'CustomerController');
Route::resource('purchase', 'PurchaseController');

Route::get('/categories', function() {
    $categories = App\Category::all();
    return response()->json($categories);
});
Route::get('/items', function() {
    $items = App\Item::with('category','images')->get();
    return response()->json($items);
});
Route::get('/suppliers', function() {
    $suppliers = App\Supplier::with('city','province')->get();
    return response()->json($suppliers);
});
Route::get('/provinces', function() {
    $provinces = App\Province::all();
    return response()->json($provinces);
});
Route::get('/cities/{province_id}', function($province_id) {
    $cities = App\City::where('province_id','=',$province_id)->get();
    return response()->json($cities);
});
Route::get('/customers', function() {
    $customers = App\Customer::with('city','province')->get();
    return response()->json($customers);
});
Route::get('/getSupplier', function(Request $request) {
    $suppliers = App\Supplier::where('name','LIKE',$request->q.'%')->with('city','province')->get();
    return response()->json($suppliers);
});

Route::get('/getItems', function(Request $request) {
    $suppliers = App\Item::where('code','LIKE',$request->q.'%')
                ->orWhere('name','LIKE',$request->q.'%')
                ->with('images')
                ->get();
    return response()->json($suppliers);
});
Route::post('add_item_image','ItemController@imageUploadPost');
Route::delete('deleteImage/{imageName}','ItemController@deleteImage');
