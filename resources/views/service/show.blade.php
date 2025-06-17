@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ព័ត៌មានលម្អិតអំពីសេវាកម្ម
                <a href="{{url('admin/service')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>សេវាកម្ម</th>
                        <td>{{$data->title}}</td>
                    </tr>
                    <tr>
                        <th>រូបភាព</th>
                        <td><img width="100" src="{{asset('storage/'.$data->photo)}}" /></td>
                    </tr>
                    <tr>
                        <th>ពិពណ៌នា</th>
                        <td>{{$data->small_desc}}</td>
                    </tr>
                    <tr>
                        <th>ពិពណ៌នាបន្ថែម</th>
                        <td>{{$data->detail_desc}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection