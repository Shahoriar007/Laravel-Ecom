@extends('admin/layout')

@section('product_select','active')

@section('page_title','Manage Product')

@section('container')

@if($id>0)
    {{$image_required=""}}
@else
    {{$image_required="required"}}
@endif



<h3>Manage Product</h3>

@if(session()->has('sku_error'))

<!-- Do some style if you want -->

    {{session('sku_error')}}

@endif

@error('attr_image.*')

<!-- Do some style if you want -->

    {{$message}}

@enderror

<div class="card-body">
    <a href="{{url('admin/product')}}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
</div>

<div class="card">

    <div class="card-body">
        <hr />

        <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name" class="control-label mb-1">Name</label>
                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required />
            </div>

            @error('name') {{$message}} @enderror

            <div class="form-group">
                <label for="image" class="control-label mb-1">Image</label>
                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}} />
            </div>

            @error('image') {{$message}} @enderror

            <div class="form-group">
                <label for="slug" class="control-label mb-1">Slug</label>
                <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required />
            </div>

            @error('slug') {{$message}} @enderror

            <div class="row">
                <div class="col-sm form-group">
                    <label for="category_id" class="control-label mb-1">Category</label>
                    <select id="category_id" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        <option value="">Select Categories</option>

                        @foreach($category as $list) @if($category_id==$list->id)
                        <option selected value="{{$list->id}}"> @else </option>

                        <option value="{{$list->id}}"> @endif {{$list->category_name}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="col-sm form-group">
                    <label for="brand" class="control-label mb-1">Brand</label>
                    <input id="brand" value="{{$brand}}" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" required />
                </div>

                <div class="col-sm form-group">
                    <label for="model" class="control-label mb-1">Model</label>
                    <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required />
                </div>
            </div>

            <div class="form-group">
                <label for="short_desc" class="control-label mb-1">Short Description</label>
                <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$short_desc}}

                </textarea>
            </div>

            <div class="form-group">
                <label for="desc" class="control-label mb-1">Description</label>
                <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$desc}}

                </textarea>
            </div>

            <div class="form-group">
                <label for="keywords" class="control-label mb-1">Keywords</label>
                <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$keywords}}

                </textarea>
            </div>

            <div class="form-group">
                <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$technical_specification}}

                </textarea>
            </div>

            <div class="form-group">
                <label for="uses" class="control-label mb-1">Uses</label>
                <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$uses}}

                </textarea>
            </div>

            <div class="form-group">
                <label for="warrenty" class="control-label mb-1">Warrenty</label>
                <textarea id="warrenty" name="warrenty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            {{$warrenty}}

                </textarea>
            </div>

            <input type="hidden" name="id" value="{{$id}}" />

            <hr />
            <h2>Products Attributes</h2>

                @php
                    $loop_count_num=1;
                @endphp

                @foreach($productAttrArr as $key=>$val)
                    @php
                        $loop_count_prev=$loop_count_num;
                        $pAArr=(array)$val;
                    @endphp

                    <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">

            <div class="" id="product_attr_{{$loop_count_num++}}">
                <div class="" id="product_attr_box">

                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="sku" name="sku[]" type="text" value="{{$pAArr['sku']}}" class="form-control" aria-required="true" aria-invalid="false" />
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" name="mrp[]" type="text" value="{{$pAArr['mrp']}}" class="form-control" aria-required="true" aria-invalid="false" />
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" name="price[]" type="text" value="{{$pAArr['price']}}" class="form-control" aria-required="true" aria-invalid="false" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="size_id" class="control-label mb-1">Size</label>
                            <select id="size_id" name="size_id[]" type="text"  class="form-control" aria-required="true" aria-invalid="false" required>
                                <option value="">Select Sizes</option>

                                @foreach($sizes as $list)
                                    @if($pAArr['size_id']==$list->id)

                                        <option value="{{$list->id}}" selected>{{$list->size}}</option>

                                        @else

                                        <option value="{{$list->id}}">{{$list->size}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="color_id" class="control-label mb-1">Color</label>
                            <select id="color_id" name="color_id[]" type="text" value="{{$pAArr['color_id']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                <option value="">Select Color</option>

                                @foreach($colors as $list)
                                    @if($pAArr['color_id']==$list->id)

                                        <option value="{{$list->id}}" selected>{{$list->color}}</option>

                                        @else

                                        <option value="{{$list->id}}">{{$list->color}}</option>

                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 form-group">
                            <label for="qyt" class="control-label mb-1">Qyt</label>
                            <input id="qyt" name="qyt[]" type="text" value="{{$pAArr['qyt']}}" class="form-control" aria-required="true" aria-invalid="false" />
                        </div>

                        @if($pAArr['attr_image']!='')
                            <img width="100px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}">
                        @endif

                        <div class="col-md-4 form-group">
                            <label for="attr_image" class="control-label mb-1">Image</label>
                            <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" />
                        </div>

                        <div>

                            @if($loop_count_num==2)
                                <label for="attr_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-success btn-lg" onclick="add_more()"><i class="fa fa-plus"></i> Add</button>
                            @else
                                <label for="attr_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                                <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"> <button type="button" class="btn btn-danger btn-lg"><i class="fa fa-minus"></i> Remove</button></a>
                            @endif

                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                Submit
            </button>


        </form>
    </div>
</div>
<script>
    var loop_count = 1;
    function add_more() {
        loop_count++;

        var html = '<input id="paid" type="text" name="paid[]"><div class="card-header" id="product_attr_' + loop_count + '"><div class="card-body"><div class="row">';

        html += '<div class="col-md-2 form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>';

        html += '<div class="col-md-2 form-group"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>';

        html += '<div class="col-md-2 form-group"><label for="price" class="control-label mb-1">Price</label><input id="price"  name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>';

        html +=
            '<div class="col-md-3 form-group"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id"  name="size_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required><option value="">Select Sizes</option>@foreach($sizes as $list)<option value="{{$list->id}}">{{$list->size}}</option>@endforeach</select></div>';

        html +=
            '<div class="col-md-3 form-group"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id"  name="color_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required><option value="">Select Color</option>@foreach($colors as $list)<option value="{{$list->id}}">{{$list->color}}</option>@endforeach</select></div>';

        html += '<div class="col-md-2 form-group"><label for="qyt" class="control-label mb-1">Qty</label><input id="qyt"  name="qyt[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>';

        html +=
            '<div class="col-md-4 form-group"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';

        html +=
            '<div><label for="attr_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("' + loop_count + '")><i class="fa fa-minus"></i> Remove</button></div>';

        html += "</div></div></div>";

        jQuery("#product_attr_box").append(html);
    }

    function remove_more(loop_count) {
        jQuery("#product_attr_" + loop_count).remove();
    }
</script>

@endsection
