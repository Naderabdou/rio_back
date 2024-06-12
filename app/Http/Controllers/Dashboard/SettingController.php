<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\SettingRequest;
use App\Repositories\Contract\SettingRepositoryInterface;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {

        $this->settingRepository = $settingRepository;
    } // end of contruct

    public function create()
    {

        $settings = $this->settingRepository->getAll(['column' => 'id', 'dir' => 'ASC']);

        return view('dashboard.settings.edit', compact('settings'));
    } // end of create

    public function store(SettingRequest $request)
    {

        $images = Setting::where('type' , 'file' )->select( 'key' ,  'value')->get();

        $attribute = $request->except(array_merge(['_token', '_method'], $images->pluck('key')->toArray()));

        foreach ($images as $image) {
            if ($request->has($image->key)) {
                Storage::delete($image->value);

                $attribute[$image->key] = $request->file($image->key)->store('setting');
            }
        }

        $this->settingRepository->updateSetting($attribute);

        return redirect()->back()->with('success', __('models.update_success'));
    } // end of update
}
