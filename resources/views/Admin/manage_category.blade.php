@extends('admin/layout')

@section('category_select','active')

@section('page_title','Manage Category')

@section('container')
    <h3>Manage Category</h3>

    <div class="card-body">
        <a href="{{url('admin/category')}}">
        <button type="button" class="btn btn-success">Back</button>
        </a>
    </div>

    
        <div class="card">
            <div class="card-header">Manage Category</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Pay Invoice</h3>
                </div>
                <hr>

                <form action="{{route('category.manage_category_process')}}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                    </div>

                    @error('category_name')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    @error('category_slug')
                    {{$message}}
                    @enderror
                    
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                           Submit
                        </button>
                    </div>

                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    
@endsection