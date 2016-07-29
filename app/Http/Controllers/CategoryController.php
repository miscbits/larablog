<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{

    public function create(CreateCategory $request){
        return Category::create($request->all());
    }
    public function read(Category $category){
        return $category->articles()->active()->get();
    }
    public function all() {
        return Category::all();
    }
    public function update(){
        //
    }
    public function destroy(CreateCategory $request, Category $category) {
        $category->destroy();
    }

}
