<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(){
        return response(Employee::all(),200);
    }

    public function store(Request $request)
    {

        if ($request->file('file')) {

            //store file into document folder
            $file = $request->file->store('documents', ['disk' => 'my_files']);

            //store your file into database
            $employee = new Employee();
            $employee->cv_path = $file;
            $employee->name_surname = $request->name_surname;
            $employee->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
            ],201);

        }
    }

    public function update(Request $request, Employee $employee)
    {
        if($files = $request->file('file')) {
            //store file into document folder
            $file = $request->file->store('documents', ['disk' => 'my_files']);

            //store your file into database
            $employee->cv_path = $file;
        }

        $employee->name_surname = $request->name_surname;
        $employee->save();
        return response()->json([
            "success" => true,
            "message" => "Employee updated",
        ],200);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee,200);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return  response(['message' => 'User deleted'],200);
    }

}
