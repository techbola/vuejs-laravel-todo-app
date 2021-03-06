<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class TodoController extends Controller
{
    public function index()
    {
       return Todo::latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ],
            [
                'title.required' => 'Todo input field is required!'
            ]
        );

        Todo::create($request->all());
    }

    public function show(Todo $todo)
    {
        //
    }

    public function edit(Todo $todo)
    {
        //
    }

    public function update(Request $request, $todo)
    {
        $todo = Todo::findOrFail($todo);
        $todo->update($request->all());
        $todo->save();
    }

    public function destroy($todo)
    {
        $todo = Todo::findOrFail($todo);
        $todo->delete();
        return Todo::latest()->get();
    }
}
