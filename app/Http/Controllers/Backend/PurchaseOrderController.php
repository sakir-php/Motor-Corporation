<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\VendorInfo;
use Illuminate\Http\Request;
use PDF;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderBy('id','desc')->get();
        return view('backend.po.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = VendorInfo::orderBy('id','desc')->get();
        return view('backend.po.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'vendor_name' => 'required|exists:vendor_infos,id',
            'amount' => 'required|numeric',
            'job_finish_date' => 'required|string',
            'work_description' => 'required|string',
        ]);

        PurchaseOrder::create($validate_data);
        toastr()->success('Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $pdf = PDF::loadView('backend.po.show-pdf', compact('purchaseOrder'));
        return $pdf->stream('PO-' . config('app.name') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $vendors = VendorInfo::orderBy('id','desc')->get();
        return view('backend.po.edit', compact('purchaseOrder', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validate_data = $request->validate([
            'vendor_name' => 'required|string',
            'amount' => 'required|numeric',
            'job_finish_date' => 'required|string',
            'work_description' => 'required|string',
        ]);

        $purchaseOrder->update($validate_data);
        toastr()->success('Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return [
            'type' => 'success',
            'message' => 'Destroy',
        ];
    }
}
