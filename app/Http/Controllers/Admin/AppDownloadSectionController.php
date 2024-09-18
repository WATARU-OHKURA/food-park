<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppDownloadSectionCreateRequest;
use App\Models\AppDownloadSection;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppDownloadSectionController extends Controller
{
    use FileUploadTrait;

    function index(): View
    {
        $appSection = AppDownloadSection::first();
        return view('admin.app-download-section.index', compact('appSection'));
    }

    function store(AppDownloadSectionCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image', $request->old_image);
        $backgroundPath = $this->uploadImage($request, 'background', $request->old_bg);

        AppDownloadSection::updateOrCreate(
            ['id' => 1],
            [
                'image' => !empty($imagePath) ? $imagePath : $request->old_image,
                'background' => !empty($backgroundPath) ? $backgroundPath : $request->old_bg,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'play_store_link' => $request->ps_link,
                'app_store_link' => $request->as_link,
            ]
        );

        toastr()->success('Updated Successfully!');

        return to_route('admin.app-download.index');
    }
}
