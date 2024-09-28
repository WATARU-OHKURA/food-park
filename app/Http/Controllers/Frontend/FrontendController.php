<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Counter;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\OurTeam;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View as ViewView;

class FrontendController extends Controller
{
    function index(): View
    {
        $sectionTitles = $this->getSectionTitles();

        $sliders = Slider::where('status', 1)->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();

        // $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();
        $categories = Category::where(['show_at_home' => 1, 'status' => 1])->with('products')->get();

        $dailyOffers = DailyOffer::with('product')->where('status', 1)->take(10)->get();
        $bannerSliders = BannerSlider::where('status', 1)->latest()->take(10)->get();
        $ourTeam = OurTeam::where(['show_at_home' => 1, 'status' => 1])->latest()->take(10)->get();
        $appSection = AppDownloadSection::first();
        $testimonials = Testimonial::where(['show_at_home' => 1, 'status' => 1])->get();
        $counter = Counter::first();
        $latestBlogs = Blog::withCount(['comments' => function ($query) {
            $query->where('status', 1);
        }])->with(['category', 'user'])->where('status', 1)->latest()->take(3)->get();

        return view(
            'frontend.home.index',
            compact(
                'sliders',
                'sectionTitles',
                'whyChooseUs',
                'categories',
                'dailyOffers',
                'bannerSliders',
                'ourTeam',
                'appSection',
                'testimonials',
                'counter',
                'latestBlogs',
            )
        );
    }

    function getSectionTitles(): Collection
    {
        return SectionTitle::pluck('value', 'key');
    }

    function chef(): View
    {
        $ourTeam = OurTeam::where(['status' => 1])->paginate(8);
        return view('frontend.pages.chefs', compact(['ourTeam']));
    }

    function testimonials(): View
    {
        $testimonials = Testimonial::where(['status' => 1])->paginate(9);
        return view('frontend.pages.testimonial', compact('testimonials'));
    }

    function blog(Request $request): View
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|exists:blog_categories,slug',
        ]);

        // Generate a unique cache key based on the full request URL
        $cacheKey = 'blogs_' . md5($request->fullUrl());

        // Attempt to retrieve blogs from cache
        $blogs = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($validated, $request) {
            return Blog::withCount(['comments' => function ($query) {
                $query->where('status', 1);
            }])
                ->with(['category', 'user'])
                ->where('status', 1)
                ->when($request->filled('search'), function ($query) use ($validated) {
                    $searchTerm = '%' . $validated['search'] . '%';
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('title', 'like', $searchTerm)
                            ->orWhere('description', 'like', $searchTerm);
                    });
                })
                ->when($request->filled('category'), function ($query) use ($validated) {
                    $query->whereHas('category', function ($q) use ($validated) {
                        $q->where('slug', $validated['category']);
                    });
                })
                ->latest()
                ->paginate(9)
                ->appends($request->only(['search', 'category']));
        });

        $categories = BlogCategory::where('status', 1)->get();
        return view('frontend.pages.blog', compact('blogs', 'categories'));
    }

    function blogShow(string $slug): View
    {
        $blog = Blog::with(['user'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        $comments = $blog->comments()->where('status', 1)->latest()->paginate(15);

        $latestBlogs = Blog::select('id', 'title', 'slug', 'created_at', 'image')
            ->where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()->take(5)->get();
        $categories = BlogCategory::withCount(['blogs' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->get();

        $nextBlog = Blog::select('id', 'title', 'slug', 'image')->where('id', '>', $blog->id)->orderBy('id', 'ASC')->first();
        $previousBlog = Blog::select('id', 'title', 'slug', 'image')->where('id', '<', $blog->id)->orderBy('id', 'DESC')->first();

        return view('frontend.pages.blog-show', compact('blog', 'latestBlogs', 'categories', 'nextBlog', 'previousBlog', 'comments'));
    }

    function blogCommentStore(Request $request, string $blog_id): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'max:255']
        ]);

        Blog::findOrFail($blog_id);

        $comment = new BlogComment();
        $comment->blog_id = $blog_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        toastr()->success('Comment submitted successfully and waiting to approve.');

        return redirect()->back();
    }

    function products(Request $request): View
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|exists:categories,slug',
        ]);

        // Generate a unique cache key based on the full request URL
        $cacheKey = 'categories_' . md5($request->fullUrl());

        // Attempt to retrieve blogs from cache
        $products = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($validated, $request) {
            return Product::with(['category',])
                ->where('status', 1)
                ->when($request->filled('search'), function ($query) use ($validated) {
                    $searchTerm = '%' . $validated['search'] . '%';
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm)
                            ->orWhere('long_description', 'like', $searchTerm);
                    });
                })
                ->when($request->filled('category'), function ($query) use ($validated) {
                    $query->whereHas('category', function ($q) use ($validated) {
                        $q->where('slug', $validated['category']);
                    });
                })
                ->latest()
                ->withAvg('reviews', 'rating')
                ->withCount('reviews')
                ->paginate(12)
                ->appends($request->only(['search', 'category']));
        });

        $categories = Category::where('status', 1)->get();

        return view('frontend.pages.product', compact('products', 'categories'));
    }

    function showProduct(string $slug): View
    {
        $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where(['slug' => $slug, 'status' => 1])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->get();
        $reviews = ProductRating::where(['product_id' => $product->id, 'status' => 1])->paginate(30);

        return view('frontend.pages.product-view', compact('product', 'relatedProducts', 'reviews'));
    }

    function loadProductModal($productId)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);

        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

    function productReviewStore(Request $request)
    {
        $request->validate([
            'rating' => ['required', 'min:1', 'max:5', 'integer'],
            'review' => ['required', 'max:500'],
            'product_id' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        $hasPurchased = $user->orders()->whereHas('orderItems', function ($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })
            ->where('order_status', 'delivered')
            ->get();

        if (count($hasPurchased) == 0) {
            throw ValidationException::withMessages(['Please Buy the product before submit a review!']);
        }

        $alreadyReviewed = ProductRating::where(['user_id' => $user->id, 'product_id' => $request->product_id])->exists();
        if ($alreadyReviewed) {
            throw ValidationException::withMessages(['You already reviewed this product']);
        }

        $review = new ProductRating();
        $review->user_id = $user->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->status = 0;
        $review->save();

        toastr()->success('Review addded successfully and waiting to approve');

        return redirect()->back();
    }

    function applyCoupon(Request $request)
    {
        $subTotal = $request->subTotal;
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response(['message' => 'Invalid Coupon Code.'], 422);
        }
        if ($coupon->quantity <= 0) {
            return response(['message' => 'This coupon has been fully redeemed.'], 422);
        }
        if ($coupon->expire_date < now()) {
            return response(['message' => 'This coupon has expired.'], 422);
        }

        if ($coupon->discount_type === 'percent') {
            $discount = number_format($subTotal * ($coupon->discount / 100), 2, '.', ',');
        } elseif ($coupon->discount_type === 'amount') {
            $discount = number_format($coupon->discount, 2, '.', ',');
        }

        $finalTotal = $subTotal - $discount;

        session()->put('coupon', ['code' => $code, 'discount' => $discount]);

        return response([
            'message' => 'Coupon Applied Successfully.',
            'discount' => $discount,
            'finalTotal' => $finalTotal,
            'coupon_code' => $code,
        ]);
    }

    function destroyCoupon()
    {
        try {
            session()->forget('coupon');

            return response([
                'message' => 'Coupon Removed!',
                'grand_cart_total' => grandCartTotal(),
            ]);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong!']);
        }
    }
}
