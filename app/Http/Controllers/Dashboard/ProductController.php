<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\models\Product;
use App\models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request -> category !== null) {
            $products = Product :: where('category_id' , $request -> category) -> paginate(10);
            $total_count = Product :: where('category_id' , $request -> category) -> count( );
            $category = Category :: find($request -> category);
    }   else {
            $products = Product :: paginate(15);
            $total_count = "";
            $category = null;
    }

    $categories = Category :: all( );
    $major_category_names = Category :: pluck('major_category_name') -> unique( );

    return view('dashboard.products.index' , compact('products' , 'category' , 'categories' ,'major_category_names' , 'total_count'));
}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

         return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
             'name' => 'required',
            'price' => 'required',
            'description' => 'required',
             ],
            [
            'name.required' => '商品名は必須です。',
             'price.required' => '価格は必須です。',
             'description.required' => '商品説明は必須です。',
             ]);
            
            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');

            if ($request -> input('recommend') =='on') {
                $product -> recommend_flag = true;
            }else {
                $product -> recommend_flag = false;
            }

            if ($request->file('image') !== null) {
                $image = $request->file('image')->store('public/products');
                 $product->image = basename($image);
            } else {
                 $product->image = '';
            }

            $product->save();
            
            return redirect()->route('dashboard.products.index');
            }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
             'price' => 'required',
            'description' => 'required',
            ],
            [
             'name.required' => '商品名は必須です。',
             'price.required' => '価格は必須です。',
            'description.required' => '商品説明は必須です。',
            ]);
            
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');

            if ($request -> input('recommend') =='on') {
                $product -> recommend_flag = true;
            }else {
                $product -> recommend_flag = false;
            }

            if ($request -> hasFile('image')) {
                $image = $request -> file('image') -> store('public/products');
                $product -> image = basename($image);
            }else {
                $product -> image = ' ';
            }

            $product->update();
            
            return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

         return redirect()->route('dashboard.products.index');
      
    }
}
