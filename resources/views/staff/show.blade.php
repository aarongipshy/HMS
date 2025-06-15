@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$data->full_name}} បញ្ជាក់
                <a href="{{url('admin/staff')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>ឈ្មោះពេញ</th>
                        <td>{{$data->full_name}}</td>
                    </tr>
                    <tr>
                        <th>ទីតាំង</th>
                        <td>{{$data->department->title}}</td>
                    </tr>
                    <tr>
                        <th>រូបភាព</th>
                        <td><img width="80" src="{{asset(''.$data->photo)}}" /></td>
                    </tr>
                    <tr>
                        <th>ពិពណ៌នា</th>
                        <td>{{$data->bio}}</td>
                    </tr>
                    <tr>
                        <th>ប្រភេទប្រាក់ខែ</th>
                        <td>{{$data->salary_type}}</td>
                    </tr>
                    <tr>
                        <th>ចំនួនប្រាក់ខែ</th>
                        <td>{{$data->salary_amt}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection