<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Imports\TodosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException; // Import the correct ValidationException

class TodoController extends Controller
{
    // this is just the form
    public function importForm()
    {
        return view('todos.importForm');
    }


    // store imported excel data
    public function importStore(Request $request)
    {
        // Validate the uploaded file
        $formFields = $request->validate([
            'file' => 'required|mimes:xlsx,xls:|max:50',
        ]);

        if (empty($request->file)) {
            return back();
        }

        // Get the uploaded file
        $file = $request->file('file');

        try {
            Excel::import(new TodosImport(), $file);
            return redirect()->route('todos.index');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            dd($e);
            return redirect()->back()->with('error', 'يوجد خطا في معلومات الملف');
        } catch (\Exception $e) {
            dd($e);

            return redirect()->back()->with('error', 'يوجد خطا في معلومات الملف');
        }
    }

    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Todo::create($request->all());

        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully.');
    }
}
