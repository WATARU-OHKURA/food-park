<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OurTeamDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurTeamCreateRequest;
use App\Http\Requests\Admin\OurTeamUpdateRequest;
use App\Models\OurTeam;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OurTeamController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(OurTeamDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.our-team.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.our-team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OurTeamCreateRequest $request) : RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');

        $ourTeam = new OurTeam();
        $ourTeam->image = $imagePath;
        $ourTeam->name = $request->name;
        $ourTeam->title = $request->title;
        $ourTeam->fb = $request->fb;
        $ourTeam->in = $request->in;
        $ourTeam->x = $request->x;
        $ourTeam->web = $request->web;
        $ourTeam->show_at_home = $request->show_at_home;
        $ourTeam->status = $request->status;
        $ourTeam->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.our-team.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurTeam $our_team) : View
    {
        return view('admin.our-team.edit', compact('our_team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OurTeamUpdateRequest $request, OurTeam $our_team) : RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image', $request->old_image);

        $our_team->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $our_team->name = $request->name;
        $our_team->title = $request->title;
        $our_team->fb = $request->fb;
        $our_team->in = $request->in;
        $our_team->x = $request->x;
        $our_team->web = $request->web;
        $our_team->show_at_home = $request->show_at_home;
        $our_team->status = $request->status;
        $our_team->save();

        toastr()->success('Updated Successfully!');

        return to_route('admin.our-team.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurTeam $our_team) : Response
    {
        try {
            $this->removeImage($our_team->image);
            $our_team->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong']);
        }
    }
}
