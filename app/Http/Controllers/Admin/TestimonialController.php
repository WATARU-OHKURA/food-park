<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialCreateRequest;
use App\Http\Requests\Admin\TestimonialUpdateRequest;
use App\Models\SectionTitle;
use App\Models\Testimonial;
use App\Traits\FileUploadTrait;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialDataTable $dataTable): View|JsonResponse
    {
        $keys = ['testimonial_top_title', 'testimonial_main_title', 'testimonial_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        return $dataTable->render('admin.testimonial.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');

        $testimonial = new Testimonial();
        $testimonial->image = $imagePath;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->show_at_home = $request->show_at_home;
        $testimonial->status = $request->status;
        $testimonial->save();

        toastr()->success('created Successfully');

        return to_route('admin.testimonial.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialUpdateRequest $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image');

        $testimonial->image = !empty($imagePath) ? $imagePath : $testimonial->image;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->review = $request->review;
        $testimonial->show_at_home = $request->show_at_home;
        $testimonial->status = $request->status;
        $testimonial->save();

        toastr()->success('Updated Successfully');

        return to_route('admin.testimonial.index');
    }

    function updateTitle(Request $request)
    {
        $validatedData = $request->validate([
            'testimonial_top_title' => ['max:100'],
            'testimonial_main_title' => ['max:200'],
            'testimonial_sub_title' => ['max:500'],
        ]);

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong']);
        }
    }
}
