@extends('master')
@section('content')
    <br><br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card">

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <div class="card-header">Edit Employe</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="itemFrom" role="form" method="POST" action="{{ route('employees.update',$info['id']) }}">
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="type">Name Surname</label>
                                        <input class="form-control" type="text" name="name_surname" value="{{ $info['name_surname'] }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="type">CV File <a target="_blank" href="{{ asset('myfiles/'.$info['cv_path'])  }}">CV</a></label>
                                        <input class="form-control" type="file" name="file">
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">
                                        <i class="fas fa-plus-circle"></i>
                                        <span> Update Employe </span>
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

