<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
    function store(string $productId): Response
    {
        if(!Auth::check()) {
            throw ValidationException::withMessages(['Please login for add product in wishlist']);
        }
        
        $productAlreadyExist = Wishlist::where(['user_id' => Auth::user()->id, 'product_id' => $productId])->exists();
        if($productAlreadyExist){
            throw ValidationException::withMessages(['Product is already add to wishlist']);
        }


        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::user()->id;
        $wishlist->product_id = $productId;
        $wishlist->save();

        return response(['status' => 'success', 'message' => 'Product added to wishlist!']);
    }
}
