<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public $client;

    public function __construct(){
        $this->client  = new Client([
            'base_uri' => 'http://dev.cv.project.com/api/v1/'
        ]);
    }

    public function index(){
        $response = $this->client->request('GET', 'employees');

        if ($response->getStatusCode() == 200) { // 200 OK
            $list = json_decode($response->getBody()->getContents(),true);
        }

        return view('list',compact('list'));
    }

    public function show($id){
        $response = $this->client->request('GET', 'employees/'.$id);

        if ($response->getStatusCode() == 200) { // 200 OK
            $row = json_decode($response->getBody()->getContents(),true);
        }

        return $row;
    }

    public function create(){
        return view('add');
    }

    public function store(Request $request){
        $response = $this->client->request('POST', 'employees',    [
            'multipart' => [
                [
                    'name' => 'name_surname',
                    'contents' => $request->input('name_surname'),
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($request->file('file')->path(), 'r'),
                ]
            ]
        ]);

        if ($response->getStatusCode() == 201) { // 201 Created
            return redirect('/employees');
        }


    }

    public function edit($id){
        $info = $this->show($id);

        return view('edit',compact('info'));
    }

    public function update(Request $request,$id){

        $options = [
            'multipart' => [
                [
                    'name' => 'name_surname',
                    'contents' => $request->input('name_surname'),
                ]
            ]
        ];

        if($request->file('file')){
            $options['multipart'][] = [
                'name'     => 'file',
                'contents' => fopen($request->file('file')->path(), 'r'),
            ];
        }

        $response = $this->client->request('POST','employees/'.$id.'/update', $options );

        if ($response->getStatusCode() == 200) {
            return redirect('/employees');
        }
    }

    public function destroy($id){
        $response = $this->client->request('DELETE', 'employees/'.$id);

        if ($response->getStatusCode() == 200) { // 200 OK
            return redirect('/employees');
        }
    }
}
