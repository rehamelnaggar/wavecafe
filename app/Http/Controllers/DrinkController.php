<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrinkCategory;
use App\Models\Drink;
use App\Traits\Traits\UploadFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;
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
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('dashAdmin.categories', compact('categories','messages','unreadMessagesCount'));
    }

    public function storeCategory(Request $request)
    {
        $messages = Contact::all();
    $unreadMessagesCount = Contact::where('readable', 0)->count();

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    DrinkCategory::create([
        'name' => $request->name,
    ]);

    session()->flash('messages', $messages);
    session()->flash('unreadMessagesCount', $unreadMessagesCount);

    return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
}
    public function editCategory($id)
    {
        $category = DrinkCategory::find($id);
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('dashAdmin.editCategory', compact('category','messages','unreadMessagesCount'));
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
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('dashAdmin.addBeverage', compact('categories','messages','unreadMessagesCount'));
    }

    public function indexBeverage()
    {
        $beverages = Drink::with('category')->get();
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('dashAdmin.beverages', compact('beverages','messages','unreadMessagesCount'));
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
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('dashAdmin.editBeverage', compact('beverage', 'categories','messages','unreadMessagesCount'));
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
        $messages = Contact::all();
        $unreadMessagesCount = Contact::where('readable', 0)->count();
        return view('products.index', compact('categories', 'beverages','messages','unreadMessagesCount'));
    }
    public function indexCafe()
    {
        $categories = DrinkCategory::all(); 
        $icedCoffee = Drink::where('category_id', 1)->get(); 
        $hotCoffee = Drink::where('category_id', 2)->get();
        $fruitJuice = Drink::where('category_id', 3)->get();
        $specialItems = Drink::where('special', true)->get();
        
        return view('drinks.index', compact('categories', 'icedCoffee', 'hotCoffee', 'fruitJuice','specialItems'));
    
}
}
