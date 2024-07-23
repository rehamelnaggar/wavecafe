<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrinkCategory;
use App\Models\Drink;
use App\Traits\Traits\UploadFile;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
{
    use UploadFile;

    // Category Methods
    public function showAddCategoryForm()
    {
        return view('dashAdmin.addCategory');
    }

    public function index()
    {
        $categories = DrinkCategory::all();
        return view('dashAdmin.categories', compact('categories'));
    }

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

    // Beverage Methods

    public function showAddBeverageForm()
    {
        $categories = DrinkCategory::all();
        return view('dashAdmin.addBeverage', compact('categories'));
    }

    public function indexBeverage()
    {
        $beverages = Drink::with('category')->get();
        return view('dashAdmin.beverages', compact('beverages'));
    }

    public function storeBeverage(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:drink_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|between:0,99999999.99',
            'special' => 'nullable|boolean',
            'published' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $drink = new Drink();
        $drink->category_id = $request->category_id;
        $drink->name = $request->name;
        $drink->description = $request->description;
        $drink->price = $request->price;
        $drink->special = $request->has('special');
        $drink->published = $request->has('published');

        if ($request->hasFile('image')) {
            $drink->image = $this->upload($request->file('image'), 'images');
        }

        $drink->save();

        return redirect()->route('admin.beverages')->with('success', 'Beverage added successfully!');
    }

    public function editBeverage($id)
    {
        $beverage = Drink::findOrFail($id);
        $categories = DrinkCategory::all();
        return view('dashAdmin.editBeverage', compact('beverage', 'categories'));
    }

    public function updateBeverage(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'published' => 'nullable|boolean',
            'special' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:drink_categories,id',
        ]);
    
        $drink = Drink::findOrFail($id);
    
        $drink->name = $request->input('name');
        $drink->description = $request->input('description');
        $drink->price = $request->input('price');
        $drink->published = $request->has('published');
        $drink->special = $request->has('special');
        $drink->category_id = $request->input('category_id');
    
        if ($request->hasFile('image')) {
            if ($drink->image) {
                Storage::delete($drink->image);
            }
            $drink->image = $request->file('image')->store('images');
        }
    
        $drink->save();
    
        return redirect()->route('admin.beverages')->with('success', 'Beverage updated successfully!');
    }

    public function deleteBeverage($id)
    {
        $beverage = Drink::findOrFail($id);

        // Delete the image if it exists
        if ($beverage->image) {
            $this->deleteFile($beverage->image);
        }

        $beverage->delete();
        return redirect()->route('admin.beverages')->with('success', 'Beverage deleted successfully!');
    }

    public function showProducts()
    {
        $categories = DrinkCategory::all();
        $beverages = Drink::with('category')->get(); 

        return view('products.index', compact('categories', 'beverages'));
    }

  
}