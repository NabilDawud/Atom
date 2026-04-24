<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function Flasher\Prime\flash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function settings()
    {
        $settings = Setting::latest()->pluck('value', 'key')->toArray();
        return view('dashboard.settings.create', compact('settings'));
    }

    public function settingsave(Request $request)
    {

        $settings = $request->except('_token', '_method');
        foreach ($settings as $key => $value) {
            if ($key === 'logo' && $request->hasFile('logo')) {
                File::delete(setting('logo'));
                $value = $request->file('logo')->store('uploads/settings', 'custom');
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        flash()->success('Settings updated successfully!');
        return redirect()->back();
    }
}
