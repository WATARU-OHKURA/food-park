<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BannerSliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerSliderCreateRequest;
use App\Http\Requests\Admin\UpdateBannerSliderRequest;
use App\Models\BannerSlider;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerSliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BannerSliderDataTable $dataTable)
    {
        return $dataTable->render('admin.banner-slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.banner-slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerSliderCreateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'image');

        $bannerSlider = new BannerSlider();
        $bannerSlider->banner = $imagePath;
        $bannerSlider->title = $request->title;
        $bannerSlider->sub_title = $request->sub_title;
        $bannerSlider->url = $request->url;
        $bannerSlider->status = $request->status;
        $bannerSlider->save();

        toastr()->success("Created Successfully!");

        return to_route('admin.banner-slider.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerSlider $banner_slider): View
    {
        return view('admin.banner-slider.edit', compact('banner_slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerSliderRequest $request, BannerSlider $banner_slider)
    {
        $imagePath = $this->uploadImage($request, 'image');

        $banner_slider->banner = !empty($imagePath) ? $imagePath : $request->old_image;
        $banner_slider->title = $request->title;
        $banner_slider->sub_title = $request->sub_title;
        $banner_slider->url = $request->url;
        $banner_slider->status = $request->status;
        $banner_slider->save();

        toastr()->success("Updated Successfully!");

        return to_route('admin.banner-slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerSlider $banner_slider)
    {
        try {
            $banner_slider->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong']);
        }
    }
}
