@extends('admin/layout')

@section('size_select','active')

@section('page_title','Manage Size')

@section('container')
    <h3>Manage Size</h3>

    <div class="card-body">
        <a href="{{url('admin/size')}}">
        <button type="button" class="btn btn-success">Back</button>
        </a>
    </div>

    
        <div class="card">
            <div class="card-header">Manage Size</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Pay Invoice</h3>
                </div>
                <hr>

                <form action="{{route('size.manage_size_process')}}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <input id="size" value="{{$size}}" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                    </div>

                    @error('size')
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