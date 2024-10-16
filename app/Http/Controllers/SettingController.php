<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting as Table;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    $settings = getSettings();
    return kview('settings.general', [
      'form_action' => route('admin.settings.update'),
      'edit' => 1,
      'settings' => $settings,
    ]);
  }
  public function edit_profile() {
    $user = Auth::user();
    $roles = Role::get();
    return kview('users.manage', [
      'form_action' => route('admin.users.update'),
      'edit' => 1,
      'data' => $user,
      'roles' => $roles,
    ]);
  }

  public function update(Request $request) {
    if (isset($request->site_name)) {
      $this->updateSetting('site_name', $request->site_name);
    }
    if (isset($request->site_url)) {
      $this->updateSetting('site_url', $request->site_url);
    }
    if (isset($request->tagline)) {
      $this->updateSetting('tagline', $request->tagline);
    }

    if (isset($request->front_title)) {
      $this->updateSetting('front_title', $request->front_title);
    }

    if (isset($request->front_color_card_header)) {
      $this->updateSetting('front_color_card_header', $request->front_color_card_header);
    }

    if (isset($request->front_color_background)) {
      $this->updateSetting('front_color_background', $request->front_color_background);
    }



    if ($request->hasFile('front_image')) {
      // Validate the uploaded image
      $validated = $request->validate([
          'front_image' => 'required', // You can modify these rules as needed
      ]);



      // Check if validation passed
      if ($validated) {
          // Store the uploaded file (it will be stored in storage/app/public/front_images directory)
          $path = $request->file('front_image')->store('front_images', 'public');

          // Optionally, you can store the image URL in the database
          $this->updateSetting('front_image', $path); // Assuming this stores the path in the database

          // If you need to access the image publicly, you can use this URL
          $imageUrl = Storage::url($path);
      }
  }



    if (isset($request->theme)) {
      $this->updateSetting('theme', $request->theme);
    }
    return redirect()->back()->with('success', 'Settings has been updated');
  }
  public function updateSetting($key, $value) {
    $where = [
      'key' => $key,
    ];
    $update_array = [
      'value' => $value,
    ];
    Table::updateOrCreate($where, $update_array);
  }
}
