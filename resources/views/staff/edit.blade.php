@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">កែប្រែបុគ្គលិក
                <a href="{{url('admin/rooms')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form enctype="multipart/form-data" method="post" action="{{url('admin/staff/'.$data->id)}}">
                    @method('put')
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>ឈ្មោះពេញ</th>
                            <td><input value="{{$data->full_name}}" name="full_name" type="text" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <th>ជ្រើសរើសទីតាំង</th>
                            <td>
                                <select name="department_id" class="form-control">
                                    <option value="0">--- ជ្រើសរើស ---</option>
                                    @foreach($departs as $dp)
                                    <option @if($data->id==$dp->id) selected @endif value="{{$dp->id}}">{{$dp->title}}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>រូបភាព</th>
                            <td>
                                <input name="photo" type="file" />
                                <input type="hidden" value="{{$data->photo}}" name="prev_photo" />
                                <img width="80" src="{{asset('storage/'.$data->photo)}}" />
                            </td>
                        </tr>
                        <tr>
                            <th>ពិពណ៌នា</th>
                            <td><textarea class="form-control" name="bio">{{$data->bio}}</textarea></td>
                        </tr>
                        <tr>
                            <th>ប្រភេទប្រាក់ខែ</th>
                            <td>
                                <input @if($data->salary_type=='daily') checked @endif type="radio" name="salary_type"
                                value="daily"> បើកប្រចាំថ្ងៃ
                                <input @if($data->salary_type=='monthly') checked @endif type="radio" name="salary_type"
                                value="monthly"> បើកប្រចាំខែ
                            </td>
                        </tr>
                        <tr>
                            <th>ចំនួនប្រាក់ខែ</th>
                            <td><input value="{{$data->salary_amt}}" name="salary_amt" class="form-control"
                                    type="number" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="ធ្វើការកែប្រែ" class="btn btn-primary" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection