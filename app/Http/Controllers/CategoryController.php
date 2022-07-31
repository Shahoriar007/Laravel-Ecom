<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Show data from database
        $result['data']=Category::all();
        return view('admin/category',$result);
    }

    public function manage_category()
    {
        return view('admin/manage_category');
    }

    public function manage_category_process(Request $request)
    {
        // return $request->post();

        //validation
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories',
        ]);

        // save in database
        $model = new Category();
        $model->category_name=$request->{'category_name'};
        $model->category_slug=$request->{'category_slug'};
        $model->save();

        // Show success massage
        $request->session()->flash('message','Category Inserted');
        return redirect('admin/category');
    }
}
