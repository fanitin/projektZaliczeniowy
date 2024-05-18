<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;

class IndexController extends Controller{
    public function __invoke(){
        $categories = DishCategory::all();
        return view('worker.category.index', ['categories'=> $categories]);
    }
}