<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function index()
    {
        $addresses = Address::where(['user_id' => Auth::user()->id])->get();
        $deliveryAreas = DeliveryArea::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'deliveryAreas'));
    }

    function calculateDeliveryCharge(string $id)
    {
        try {
            $address = Address::findOrFail($id);
            $deliveryFee = $address->deliveryArea->delivery_fee;
            $grandTotal = grandCartTotal($deliveryFee);

            return response(['deliveryFee' => $deliveryFee, 'grand_total' => $grandTotal]);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong!'], 422);
        }
    }

    function checkoutRedirect(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $address = Address::with('deliveryArea')->findOrFail($request->id);

        $selectedAddress = $address->address . ', Area: ' . $address->deliveryArea?->area_name;

        session()->put('address', $selectedAddress);
        session()->put('delivery_fee', $address->deliveryArea->delivery_fee);
        session()->put('delivery_area_id', $address->deliveryArea->id);

        return response(['redirect_url' => route('payment.index')]);
    }
}
