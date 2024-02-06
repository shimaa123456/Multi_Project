<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mainbanner;

class MainBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainBanner = Mainbanner::latest()->paginate(25);
        //
        return view("admin.mainBanner.index", compact("mainBanner"))->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.mainbanner.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_fr' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_fr' => 'required',
            'description_ar' => 'required',

            'photo' => 'required|mimes:jpg,jpeg,png,svg'
        ]);

        //
        $photo = $request->file("photo");
        $storedPhotoName = time() . $request->photo->getClientOriginalName();
        $request->photo = $storedPhotoName;

        $photo->move(public_path("mainBanner"), $storedPhotoName);

        // add to database
        /* Product::create($request->all()); */
        $mainbanner = new Mainbanner();
        $mainbanner->title_en = $request->title_en;
        $mainbanner->title_fr = $request->title_fr;
        $mainbanner->title_ar = $request->title_ar;
        $mainbanner->description_en = $request->description_en;
        $mainbanner->description_fr = $request->description_fr;
        $mainbanner->description_ar = $request->description_ar;

        $mainbanner->photo = $storedPhotoName;

        $mainbanner->save();

        return redirect()->route("mainBanner.index")->with("success", "Banner has been Added !!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mainBanner = Mainbanner::where('id', $id)->get();
        return view("admin.mainbanner.show", compact("mainBanner"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
