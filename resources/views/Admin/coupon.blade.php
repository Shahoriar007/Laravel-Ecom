@extends('admin/layout')

@section('page_title','Coupon')

@section('container')
    <h3>Coupon</h3>

    {{session('message')}}

    <div class="card-body">
        <a href="{{url('admin/coupon/manage_coupon')}}">
        <button type="button" class="btn btn-success">Add Coupon</button>
        </a>
    </div>

    <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Value</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($data as $list)

                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->title}}</td>
                                                <td>{{$list->code}}</td>
                                                <td>{{$list->value}}</td>
                                                <td>
                                                    <a href="{{url('admin/coupon/delete/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                    <a href="{{url('admin/coupon/manage_coupon/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-success">Edit</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
@endsection