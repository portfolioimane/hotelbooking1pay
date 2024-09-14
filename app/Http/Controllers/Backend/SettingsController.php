<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::first();
        return view('backend.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $settings = Setting::first();
        $settings->update($request->all());

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully');
    }
}
