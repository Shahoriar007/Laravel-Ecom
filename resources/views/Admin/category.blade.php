@extends('admin/layout')

@section('page_title','Category')

@section('category_select','active')

@section('container')
    <h3>Category</h3>

    {{session('message')}}

    <div class="card-body">
    <a href="{{url('admin/category/manage_category')}}">
        <button type="button" class="btn btn-success">Add Category</button>
        </a>
    </div>

    <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($data as $list)

                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->category_name}}</td>
                                                <td>{{$list->category_slug}}</td>
                                                <td>

                                                    <a href="{{url('admin/category/manage_category/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-success">Edit</button>
                                                    </a>

                                                    @if($list->status==1)

                                                    <a href="{{url('admin/category/status/0')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-primary">Active</button>
                                                    </a>

                                                    @elseif($list->status==0)

                                                    <a href="{{url('admin/category/status/1')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-outline-primary">Deactive</button>
                                                    </a>

                                                    @endif

                                                    <a href="{{url('admin/category/delete/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
@endsection