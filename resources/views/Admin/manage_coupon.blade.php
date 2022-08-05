@extends('admin/layout')

@section('coupon_select','active')

@section('page_title','Manage Coupon')

@section('container')
    <h3>Manage Coupon</h3>

    <div class="card-body">
        <a href="{{url('admin/coupon')}}">
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

                <form action="{{route('coupon.manage_coupon_process')}}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" value="{{$title}}" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                    </div>

                    @error('title')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" value="{{$code}}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    @error('code')
                    {{$message}}
                    @enderror

                    <div class="form-group">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" value="{{$value}}" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>

                    @error('value')
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