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

    <div class="card-body">
        <a href="{{url('admin/product')}}">
        <button type="button" class="btn btn-success">Back</button>
        </a>
    </div>

    
        <div class="card">
            <div class="card-header">Manage Product</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Pay Invoice</h3>
                </div>
                <hr>

               
                <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                    </div>

                    @error('name')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                    </div>

                    @error('image')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="category_id" class="control-label mb-1">Category</label>
                        <select id="category_id"  name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           
                            <option value="">Select Categories</option>

                                @foreach($category as $list)
                                    @if($category_id==$list->id)
                                        <option selected value="{{$list->id}}">
                                    @else
                                        <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}</option>

                                @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="slug" class="control-label mb-1">Slug</label>
                        <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    @error('slug')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" value="{{$brand}}" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    <div class="form-group">
                        <label for="model" class="control-label mb-1">Model</label>
                        <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
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

                    
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                           Submit
                        </button>
                    </div>

                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    
@endsection