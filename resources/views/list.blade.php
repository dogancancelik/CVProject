@extends('master')
@section('content')
    <br><br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Employee List</div>
                    <div>
                        <a class="btn btn-success" href="{{ route('employees.create') }}" style="float:right; margin-right:10px;margin-top:10px;">Add Employee</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Name Surname</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($list) >0)
                                    @foreach($list as $value)
                                        <tr>
                                            <td>{{ $value['id'] }}</td>
                                            <td>{{ $value['name_surname'] }}</td>
                                            <td><a target="_blank" href="{{ asset('myfiles/'.$value['cv_path'])  }}">CV</a></td>
                                            <td>
                                                <a href="{{ route('employees.edit',$value['id']) }}" class="btn btn-info" style="color:#fff">Edit</a>

                                                <form action="{{ route('employees.destroy', $value['id'])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')" value="Delete" />
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="7">No records found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

