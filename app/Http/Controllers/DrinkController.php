<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrinkCategory;
use App\Models\Drink;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manageCategories()
    {
        $categories = DrinkCategory::all();
        return view('manageCategories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DrinkCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.manageCategories')->with('success', 'Category added successfully!');
    }
}