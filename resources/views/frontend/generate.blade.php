@extends('frontend.layout')
@section('title')
    News Blog
@endsection
@section('content')
      <div class="container m-5">
            <div class="generate-form-wrapper">
                <div class="generate-form">
                     <div class="card">
                    <div class="card-body">
                        <h5 class="title">Change Password</h5>
                        <form action="">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="password" class="col-form-label">Password</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="password" class="form-control" >
                                </div>
                                {{-- <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">Must be 8-20 characters long. </span>
                                </div> --}}
                            </div>
                            <button type="button" class="btn btn-success mt-2">Generate</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            
            
        </div>
@endsection