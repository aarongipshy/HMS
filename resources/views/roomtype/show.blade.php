@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$data->title}}
                <a href="{{url('admin/roomtype')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>ប្រភេទបន្ទប់</th>
                        <td>{{$data->title}}</td>
                    </tr>
                    <tr>
                        <th>តម្លៃ</th>
                        <td>{{$data->price}}</td>
                    </tr>
                    <tr>
                        <th>ពិពណ៌នាបន្ថែម</th>
                        <td>{{$data->detail}}</td>
                    </tr>
                    <tr>
                        <th>រូបភាព</th>
                        <td>
                            <table class="table table-bordered mt-3">
                                <tr>
                                    @foreach($data->roomtypeimgs as $img)
                                    <td class="imgcol{{$img->id}}">
                                        <img width="150" src="{{asset('storage/'.$img->img_src)}}" />
                                    </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection