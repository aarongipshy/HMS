<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{

    public function index()
    {
        $data = Service::all();
        return view('service.index', ['data' => $data]);
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'small_desc' => 'required',
            'detail_desc' => 'required',
            'photo' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('service',['disk'=>'public']);
        } else {
            $imgPath = null;
        }

        $data = new Service;
        $data->title = $request->title;
        $data->small_desc = $request->small_desc;
        $data->detail_desc = $request->detail_desc;
        $data->photo = $imgPath;
        $data->save();

        return redirect('admin/service/create')->with('success', 'Data has been added.');
    }

    public function show($id)
    {
        $data = Service::find($id);
        return view('service.show', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Service::find($id);
        return view('service.edit', ['data' => $data]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'small_desc' => 'required',
            'detail_desc' => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('service',['disk'=>'public']);
        } else {
            $imgPath = null;
        }

        $data = Service::find($id);
        $data->title = $request->title;
        $data->small_desc = $request->small_desc;
        $data->detail_desc = $request->detail_desc;
        $data->photo = $imgPath;
        $data->save();

        return redirect('admin/service/' . $id . '/edit')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        Service::where('id', $id)->delete();
        return redirect('admin/service')->with('success', 'Data has been deleted.');
    }
}
