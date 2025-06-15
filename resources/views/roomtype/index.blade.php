@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ប្រភេទបន្ទប់
                <a href="{{url('admin/roomtype/create')}}" class="float-right btn btn-success btn-sm">បន្ថែមថ្មី</a>
            </h6>
        </div>
        <div class="card-body ">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ឈ្មោះ</th>
                            <th>តម្លែ</th>
                            <th>រូបភាព</th>
                            <th>មុខងារ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach($data as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->title}}</td>
                            <td>{{$d->price}}</td>
                            <td>{{count($d->roomtypeimgs)}}</td>
                            <td>
                                <a href="{{url('admin/roomtype/'.$d->id)}}" class="btn btn-info btn-sm"><i
                                        class="fa fa-eye"></i></a>
                                <a href="{{url('admin/roomtype/'.$d->id).'/edit'}}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-edit"></i></a>
                                <a onclick="return confirm('តើអ្នកប្រាកដជាចង់លុបទិន្នន័យនេះមែនទេ?')"
                                    href="{{url('admin/roomtype/'.$d->id).'/delete'}}" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@section('scripts')
<!-- Custom styles for this page -->
<link href="{{asset('public')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{asset('public')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('public')}}/js/demo/datatables-demo.js"></script>

@endsection

@endsection