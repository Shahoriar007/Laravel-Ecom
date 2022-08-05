<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Show data from database
        $result['data']=Color::all();
        return view('admin/color',$result);
    }

    public function manage_color(Request $request ,$id='')
    {
        if($id>0){
            $arr=Color::where(['id'=>$id])->get();

            $result['color']=$arr['0']->color;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }else{
            $result['color']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin/manage_color', $result);
    }

    public function manage_color_process(Request $request)
    {
         //return $request->post();

        //validation
        $request->validate([
            'color'=>'required|unique:colors,color,'.$request->post('id'),
        ]);

        if($request->post('id')>0){
            $model=Color::find($request->post('id'));
            $msg="color Updated";
        }else{
            $model=new Color();
            $msg="color Inserted";
        }

        // save in database
        $model->color=$request->{'color'};
        $model->status=1;
        $model->save();

        // Show success massage
        $request->session()->flash('message', $msg);
        return redirect('admin/color');
    }

    public function delete(Request $request, $id)
    {
        $model=Color::find($id);
        $model->delete();
        $request->session()->flash('message','Color Deleted');
        return redirect('admin/color');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Color::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Color Status Updated');
        return redirect('admin/color');
    }
}
