<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\PartnerRequest;
use App\Models\Partner;

class PartnerController extends Controller
{

    protected $partnerRepository;






    public function index()
    {

        $partners = Partner::latest()->get();
        return view('dashboard.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('dashboard.partners.create');
    }

    public function store(PartnerRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partners', 'public');
        }


          Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', transWord('تم اضافة الشريك بنجاح'));
    }

    public function edit($id)
    {
        $partner =Partner::findOrFail($id);
        return view('dashboard.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, $id)
    {

        $partner = Partner::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
          if ($partner->image) {
            Storage::disk('public')->delete($partner->image);
          }
            $data['image'] = $request->file('image')->store('partners', 'public');
        }
           $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', transWord('تم تعديل الشريك بنجاح'));

    }

    public function destroy($id)
    {
        $Partner = Partner::findOrFail($id);

        if ($Partner->image) {
            Storage::disk('public')->delete($Partner->image);
        }
        $Partner->delete();


        return response()->json(['message' => transWord('Program deleted successfully')] , 200);
    }

    public function show($id)
    {
        return \redirect()->route('admin.partners.index');
    }
}
