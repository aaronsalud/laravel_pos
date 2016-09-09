<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use App\Category;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('item.index')->with(['categories'=>$categories,'title'=>'Daftar Barang']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item =  new Item();
        $item->code = $request->code;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->status = $request->status;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->productImages = $request->productImages;
        dd($item);
        // $item->save();    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item  =  Item::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item  =  Item::find($request->id);
        $item->code = $request->code;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category_id = $request->category_id;
        $item->status = $request->status;
        $item->description = $request->description;
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
    }

    public function imageUploadPost(Request $request){
       if (isset($_FILES['images'])) {
            $file_name = $_FILES['images']['name'];
            $file_size = $_FILES['images']['size'];
            $file_tmp = $_FILES['images']['tmp_name'];
            $file_type =$_FILES['images']['type'];

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $errors = array();
            $extensions = array("jpeg","jpg","png","gif");

            if (in_array($file_ext,$extensions)===false) {
                $errors[]="file tidak didukung, gunakan ekstensi jpeg,jpg,png,gif";
            }

            if ($file_size > 2097152) {
                $errors[]="Ukuran file ".$file_name." harus lebih kecil dari 2 MB";
            }

            if (empty($errors)===true) {
                $newName = date('Ymdhis');
                move_uploaded_file($file_tmp, public_path('images/items/'.$newName.".".$file_ext));
                $response['error'] = false;
                $response['message'] =  'images/items/'.$newName.".".$file_ext;
            }else{
                $response['error'] = true;
                $response['message'] =  $errors;
            }
        }
            return response()->json($response);
    }

    public function deleteImage($imageName){
        if (unlink(('images/items/'.$imageName))) {
            $response['error'] = false;
        }else{
            $response['error'] = true;
        }
         return response()->json($response);
    }
}
