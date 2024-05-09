<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function category()
    {
        $categories = Category::withCount('products')->paginate(4);

        $user = auth()->user();
        $userProducts = Product::where('user_id', $user->id)->get();

        $categoryProductCounts = [];

        foreach ($categories as $category) {
            $productCount = 0;
            foreach ($userProducts as $product) {
                if (in_array($category->id, $product->category_id)) {
                    $productCount++; 
                }
            }

            $categoryProductCounts[$category->id] = $productCount;
        }
    
        return view('category', [
            'categories' => $categories,
            'categoryProductCounts' => $categoryProductCounts,
            'user' => $user,
        ]);
    }
    public function products()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->paginate(4);
        $filteredCategoryIds = [];
        $filteredFeatureIds = [];
        foreach ($products as $product) {
            $categoryIds = $product->category_id;
            $featureIds = $product->feature_ids;
            $filteredCategoryIds = array_merge($filteredCategoryIds, $categoryIds);
            $filteredFeatureIds = array_merge($filteredFeatureIds, $featureIds);
        }
    
        $filteredCategoryIds = array_unique($filteredCategoryIds);
        $filteredFeatureIds = array_unique($filteredFeatureIds);
        $categories = Category::whereIn('id', $filteredCategoryIds)->pluck('name', 'id');
        $features = Feature::whereIn('id', $filteredFeatureIds)->pluck('name', 'id');
        foreach ($products as $product) {
            $product->category_names = $categories->only($product->category_id)->values()->toArray();
            $product->feature_names = $features->only($product->feature_ids)->values()->toArray();
        }
    
        return view('products', [
            'products' => $products,
            'user' => $user,
        ]);
    }
    



    
}
