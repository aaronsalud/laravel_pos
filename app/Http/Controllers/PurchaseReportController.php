<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Purchase;
class PurchaseReportController extends Controller
{
    public function index(){
    	$title  = 'Laporan Pembelian';
    	return view('report/purchase')->with(['title'=>$title]);
    }

}
