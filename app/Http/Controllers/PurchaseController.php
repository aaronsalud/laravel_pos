<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Purchase;
use App\PurchaseDetail;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.form')
                ->with(['title'=>'Pembelian Barang']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase =  new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->total = $request->grand_total;
        if ($purchase->save()) {
            foreach ($request->purchase_details as $purchase_details) {
                $purchase_detail = new PurchaseDetail();
                $purchase_detail->purchase_id = $purchase->id;
                $purchase_detail->item_id = $purchase_details['id'];
                $purchase_detail->amount = $purchase_details['amount'];
                $purchase_detail->sub_total = ($purchase_details['amount'] * $purchase_details['price']);
                if ($purchase_detail->save()) {
                    $response['error'] = false;
                    $response['message'] =  'Saved';
                }else{
                    $response['error'] = true;
                    $response['message'] =  'Error';

                }
            }
                return response()->json($response);


        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
