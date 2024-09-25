<?php

namespace App\Http\Controllers\Frontend;

use App\Events\RTOrderPlaceNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddressCreateRequest;
use App\Http\Requests\Frontend\AddressUpdateRequest;
use App\Models\Address;
use App\Models\DeliveryArea;
use App\Models\Order;
use App\Models\ProductRating;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(): View
    {
        $deliveryAreas = DeliveryArea::where('status', 1)->get();
        $userAddresses = Address::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $reviews = ProductRating::where('user_id', auth()->user()->id)->get();
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->latest()->paginate(3);
        $totalOrders = Order::where('user_id', auth()->user()->id)->count();
        $totalCompletedOrders = Order::where('user_id', auth()->user()->id)->where('order_status', 'delivered')->count();
        $totalCancelOrders = Order::where('user_id', auth()->user()->id)->where('order_status', 'declined')->count();


        return view('frontend.dashboard.index', compact(
            'deliveryAreas',
            'userAddresses',
            'orders',
            'reviews',
            'wishlist',
            'totalOrders',
            'totalCompletedOrders',
            'totalCancelOrders'
        ));
    }

    function createAddress(AddressCreateRequest $request)
    {
        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Created Successfully!');

        return redirect()->back();
    }

    function updateAddress(AddressUpdateRequest $request, string $id)
    {
        $address = Address::findOrFail($id);
        $address->user_id = Auth::user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Updated Successfully!');

        return to_route('dashboard');
    }

    function destroyAddress(string $id)
    {
        $address = Address::findOrFail($id);

        if ($address && $address->user_id === Auth::user()->id) {
            $address->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }

        return response(['status' => 'error', 'message' => 'something went wrong!']);
    }

    function sendMessage(Request $request)
    {
        $message = $request->input('message');

        event(new RTOrderPlaceNotificationEvent($message));

        return response()->json(['status' => 'Message Sent!']);
    }
}
