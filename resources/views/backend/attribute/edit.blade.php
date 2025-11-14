@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Add Post
    @endsection
    @section('page-main-title')
        Edit Attribute
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="/admin/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (Session::has('message'))
                            <p class="text-primary text-center mt-3 mb-0">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                    <div class="mb-3 col-6">              
                                        <input type="hidden" name="id" value="{{$attrs->id}}">  
                                        <label for="formFile" class="form-label">Type</label>
                                        <select name="type" class="form-control">
                                            {{-- <option value="size" >Size</option>
                                            <option value="color" >Color</option> --}}
                                            <option value="size" {{ $attrs->type === 'size' ? 'selected' : '' }}>Size</option>
                                            <option value="color" {{ $attrs->type === 'color' ? 'selected' : '' }}>Color</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="formFile" class="form-label">Value</label>
                                        <input class="form-control" type="text" name="value" value="{{$attrs->value}}"/>
                                    </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Post">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
