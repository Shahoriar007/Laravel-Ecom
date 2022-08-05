@extends('admin/layout')

@section('page_title','Size')

@section('size_select','active')

@section('container')
    <h3>Size</h3>

    {{session('message')}}

    <div class="card-body">
        <a href="{{url('admin/size/manage_size')}}">
        <button type="button" class="btn btn-success">Add Size</button>
        </a>
    </div>

    <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Size</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($data as $list)

                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->size}}</td>
                                                <td>

                                                    <a href="{{url('admin/size/manage_size/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-success">Edit</button>
                                                    </a>

                                                    @if($list->status==1)

                                                    <a href="{{url('admin/size/status/0')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-primary">Active</button>
                                                    </a>

                                                    @elseif($list->status==0)

                                                    <a href="{{url('admin/size/status/1')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-outline-primary">Deactive</button>
                                                    </a>

                                                    @endif

                                                    <a href="{{url('admin/size/delete/')}}/{{$list->id}}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
@endsection