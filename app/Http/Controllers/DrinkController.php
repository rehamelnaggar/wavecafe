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
    public function showAddCategoryForm()
    {
        return view('dashAdmin.addCategory');
    }

    /**
     * 
     */
    public function index()
    {
        $categories = DrinkCategory::all();
        return view('dashAdmin.categories', compact('categories'));
    }

    /**
     * 
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DrinkCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }
    public function editCategory($id)
{
    $category = DrinkCategory::find($id);
    return view('dashAdmin.editCategory', compact('category'));
}

public function updateCategory(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = DrinkCategory::find($id);
    $category->name = $request->name;
    $category->save();

    return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
}

public function deleteCategory($id)
{
    $category = DrinkCategory::find($id);

    if ($category->drinks()->count() > 0) {
        return redirect()->route('admin.categories')
                         ->with('error', 'Cannot delete category. It contains products.');
    }

    $category->delete();
    return redirect()->route('admin.categories')
                     ->with('success', 'Category deleted successfully!');
}

//Beverage
public function showBeverages()
{
    
    $beverages = Drink::all(); 
    return view('dashAdmin.manageBeverage', compact('beverages'));
}
public function showAddBeverageForm()
{
    $categories = DrinkCategory::all();
    return view('dashAdmin.addBeverage', compact('categories'));
}

public function storeBeverage(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:drink_categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'special' => 'nullable|boolean',
        'published' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $drink = new Drink();
    $drink->category_id = $request->category_id;
    $drink->name = $request->name;
    $drink->description = $request->description;
    $drink->price = $request->price;
    $drink->special = $request->special;
    $drink->published = $request->published;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $drink->image = $imageName;
    }

    $drink->save();

    return redirect()->route('admin.beverages')->with('success', 'Beverage added successfully!');
}
}