@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">កែប្រែសេវាកម្ម
                <a href="{{url('admin/service')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">

            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif

            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data" action="{{url('admin/service/'.$data->id)}}">
                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <th>សេវាកម្ម<span class="text-danger">*</span></th>
                            <td><input value="{{$data->title}}" name="title" type="text" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>ពិពណ៌នា<span class="text-danger">*</span></th>
                            <td><textarea name="small_desc" class="form-control">{{$data->small_desc}}</textarea></td>
                        </tr>
                        <tr>
                            <th>ពិពណ៌នាបន្ថែម<span class="text-danger">*</span></th>
                            <td><textarea name="detail_desc" class="form-control">{{$data->detail_desc}}</textarea></td>
                        </tr>
                        <tr>
                            <th>រូបភាព</th>
                            <td>
                                <input name="photo" type="file" />
                                <input type="hidden" name="prev_photo" value="{{$data->photo}}" />
                                <img width="100" src="{{asset('storage/'.$data->photo)}}" />
                            </td>
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