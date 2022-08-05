@extends('admin/layout')

@section('color_select','active')

@section('page_title','Manage Color')

@section('container')
    <h3>Manage Color</h3>

    <div class="card-body">
        <a href="{{url('admin/color')}}">
        <button type="button" class="btn btn-success">Back</button>
        </a>
    </div>

    
        <div class="card">
            <div class="card-header">Manage Color</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Pay Invoice</h3>
                </div>
                <hr>

                <form action="{{route('color.manage_color_process')}}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" value="{{$color}}" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                    </div>

                    @error('color')
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