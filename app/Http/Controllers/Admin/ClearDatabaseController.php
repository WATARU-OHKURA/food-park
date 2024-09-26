<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ClearDatabaseController extends Controller
{
    function index(): View
    {
        return view('admin.clear-database.index');
    }

    function clearDB()
    {
        try {
            // wipe database
            Artisan::call('migrate:fresh');

            // Seed Default data
            Artisan::call('db:seed', ['--class' => 'UserSeeder']);
            Artisan::call('db:seed', ['--class' => 'SettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'PaymentGatewaySettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'SectionTitleSeeder']);

            // Delete updated files
            $this->deleteFiles();

            return response(['status' => 'success', 'message' => 'Database wiped successfully!']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function deleteFiles() : void
    {
        $path = public_path('uploads');
        $preserveFiles = [
            'avatar.jpg',
            'media_66df0cf04592f.png',
            'media_66df09a947972.png',
        ];

        $allFiles = File::allFiles($path);

        foreach($allFiles as $file) {
            $fileName = $file->getFilename();

            if (!in_array($fileName, $preserveFiles)){
                File::delete($file->getPathname());
            }
        }
    }
}
