<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OurWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OurWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ourWork = OurWork::latest()->paginate(25);
        //
        return view("admin.ourWork.index", compact("ourWork"))->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.ourWork.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        $photo->move(public_path("ourWork"), $storedPhotoName);

        // add to database
        /* Product::create($request->all()); */
        $ourWork = new OurWork();
        $ourWork->title_en = $request->title_en;
        $ourWork->title_fr = $request->title_fr;
        $ourWork->title_ar = $request->title_ar;
        $ourWork->description_en = $request->description_en;
        $ourWork->description_fr = $request->description_fr;
        $ourWork->description_ar = $request->description_ar;

        $ourWork->photo = $storedPhotoName;

        $ourWork->save();

         // Sync categories
         if ($request->has('category_ids')) {
            $projId = $ourWork->id;
            $categoryIds = $request->input('category_ids');

            foreach ($categoryIds as $categoryId) {
                DB::table('workcatproj')->insert([
                    'projId' => $projId,
                    'catId' => $categoryId,
                ]);
            }
        }


        return redirect()->route("ourWork.index")->with("success", "ourWork has been Added !!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ourWork = OurWork::where('id', $id)->get();
        return view("admin.ourWork.show", compact("ourWork"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurWork $ourWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OurWork $ourWork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurWork $ourWork)
    {
        //
    }
}