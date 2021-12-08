<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\models\MajorCategory;
use App\models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category :: paginate(15);

        $major_categories = MajorCategory :: all( );

        return view('dashboard.categories.index' , compact('categories' , 'major_categories'));

        
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
            'description' => 'required',
        ],
        [
            'name.required' => 'カテゴリ名は必須です。',
            'description.required' => 'カテゴリの説明は必須です。',
        ]);

        $category = new Category( );
        
        $category -> name = $request -> input('name');
        $category->description = $request->input('description');
        $category->major_category_id = $request->input('major_category_id');
        $category->major_category_name = MajorCategory :: find($request -> input('major_category_id')) -> name;
       
        $category -> save( );

        return redirect("/dashboard/categories");
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $major_categories = MajorCategory :: all( );

        return view('dashboard.categories.edit' , compact('category' , 'major_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $category -> name = $request -> input('name');
        $category->description = $request->input('description');
        $category->major_category_id = $request->input('major_category_id');
        $category->major_category_name = MajorCategory :: find($request -> input('major_category_id')) -> name;
        $category -> update( );

        return redirect("/dashboard/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category -> delete( );

        return redirect("/dashboard/categories");
    }
}
