<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Routing\Controller;

class StaffDepartment extends Controller
{
    public function index()
    {
        $data = Department::all();
        return view('department.index', ['data' => $data]);
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $data = new Department;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        return redirect('admin/department/create')->with('success', 'Data has been added.');
    }

    public function show($id)
    {
        $data = Department::find($id);
        return view('department.show', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Department::find($id);
        return view('department.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = Department::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        return redirect('admin/department/' . $id . '/edit')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        Department::where('id', $id)->delete();
        return redirect('admin/department')->with('success', 'Data has been deleted.');
    }
}
