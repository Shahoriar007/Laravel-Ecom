<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Show data from database
        $result['data']=Product::all();
        return view('admin/product',$result);
    }

    public function manage_product(Request $request ,$id='')
    {
        if($id>0){
            $arr=Product::where(['id'=>$id])->get();

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warrenty']=$arr['0']->warrenty;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

            $result['productAttrArr']=DB::table('products_attr')->where(['products_id'=>$id])->get();

            // Print data
            // echo '<pre>';
            // print_r($result['productAttrArr']);
            // die();

             

        }else{
            $result['category_id']='';
            $result['name']='';
            $result['image']='';
            $result['slug']='';
            $result['brand']='';
            $result['model']='';
            $result['short_desc']='';
            $result['desc']='';
            $result['keywords']='';
            $result['technical_specification']='';
            $result['uses']='';
            $result['warrenty']='';
            $result['status']='';
            $result['id']='0';

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['products_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qyt']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
        }

        // for dropdown
        $result['category']=DB::table('categories')->where('status','=',1)->get();

        $result['sizes']=DB::table('sizes')->where('status','=',1)->get();

        $result['colors']=DB::table('colors')->where('status','=',1)->get();

        return view('admin/manage_product', $result);
    }

    public function manage_product_process(Request $request)
    {
         //return $request->post();

        //  Image Validation condition
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";
        }else{
            $image_validation="required|mimes:jpeg,jpg,png";
        }

        //validation
        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
            'slug'=>'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*'=>'mimes:jpeg,jpg,png'
        ]);

        // sku unique

        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qytArr=$request->post('qyt');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');

        foreach($skuArr as $key=>$val){
            $check=DB::table('products_attr')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key] .'  SKU Already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg="Product Updated";
        }else{
            $model=new Product();
            $msg="Product Inserted";
        }

        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        // save in database
        $model->category_id=$request->post('category_id');
        $model->name=$request->{'name'};
        $model->slug=$request->{'slug'};
        $model->brand=$request->{'brand'};
        $model->model=$request->{'model'};
        $model->short_desc=$request->{'short_desc'};
        $model->desc=$request->{'desc'};
        $model->keywords=$request->{'keywords'};
        $model->technical_specification=$request->{'technical_specification'};
        $model->uses=$request->{'uses'};
        $model->warrenty=$request->{'warrenty'};

        $model->status=1;
        $model->save();

        $pid=$model->id;

        // Attribute Adding
        // $paidArr=$request->post('paid');
        // $skuArr=$request->post('sku');
        // $mrpArr=$request->post('mrp');
        // $priceArr=$request->post('price');
        // $qytArr=$request->post('qyt');
        // $size_idArr=$request->post('size_id');
        // $color_idArr=$request->post('color_id');

        foreach($skuArr as $key=>$val){

            $productAttrArr['products_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qyt']=$qytArr[$key];

            if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;
            }else{
                $productAttrArr['size_id']=$size_idArr[$key];
            }

            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }

            // multiple image save

            if($request->hasFile("attr_image.$key")){
                $rand=rand('1111111','9999999');

                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
            }else{
                $productAttrArr['attr_image']='';
            }

            // Update or insert

            if ($paidArr[$key]!=''){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else{
                DB::table('products_attr')->insert($productAttrArr);
            }

        }

        // Show success massage
        $request->session()->flash('message', $msg);
        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product Deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $paid, $pid)
    {
        DB::table('products_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function status(Request $request, $status, $id)
    {
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product Status Updated');
        return redirect('admin/product');
    }
}
