@extends('admin/layout')

@section('container')
    <h3>Category</h3>

    {{session('message')}}

    <div class="card-body">
        <a href="manage_category">
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
                                                <td></td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
@endsection