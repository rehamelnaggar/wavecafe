<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrinkCategory;
use App\Models\Drink;
class HomeCafeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function cafeIndex()
    {
        $categories = DrinkCategory::with('drinks')->get();
        $specialItems = Drink::where('special', true)->take(6)->get();
        return view('cafeIndex', compact('categories', 'specialItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DrinkCategory::all();
        return view('addBeverage', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:drink_categories,id',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');

        Drink::create([
            'name' => $request->title,
            'description' => $request->content,
            'price' => $request->price,
            'published' => $request->has('published'),
            'special' => $request->has('special'),
            'image' => $imagePath,
            'category_id' => $request->category,
        ]);

        return redirect()->route('admin.addBeverageView')->with('success', 'Beverage added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
