<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DailyOfferDataTable;
use App\Http\Controllers\Controller;
use App\Models\DailyOffer;
use App\Models\Product;
use App\Models\SectionTitle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DailyOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DailyOfferDataTable $dataTable): View|JsonResponse
    {
        $keys = ['daily_offer_top_title', 'daily_offer_main_title', 'daily_offer_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        return $dataTable->render('admin.daily-offer.index', compact('titles'));
    }

    function productSearch(Request $request): Response
    {
        $search = $request->input('search');
        $product = Product::select('id', 'name', 'thumb_image')->where('name', 'LIKE', '%' . $search . '%')->get();
        return response($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.daily-offer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
        ]);

        $offer = new DailyOffer();
        $offer->product_id = $request->product;
        $offer->status = $request->status;
        $offer->save();

        toastr()->success('Created Successfully!');
        return to_route('admin.daily-offer.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dailyOffer = DailyOffer::with('product')->findOrFail($id);
        return view('admin.daily-offer.edit', compact('dailyOffer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
        ]);

        $offer = DailyOffer::findOrFail($id);
        $offer->product_id = $request->product;
        $offer->status = $request->status;
        $offer->save();

        toastr()->success('Updated Successfully!');
        return to_route('admin.daily-offer.index');
    }

    function updateTitle(Request $request)
    {
        $validatedData = $request->validate([
            'daily_offer_top_title' => ['max:100'],
            'daily_offer_main_title' => ['max:200'],
            'daily_offer_sub_title' => ['max:500'],
        ]);

        foreach($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    public function destroy(DailyOffer $daily_offer)
    {
        try {
            $daily_offer->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Deleted Successfully!'
            ], 200);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Failed to delete DailyOffer: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
