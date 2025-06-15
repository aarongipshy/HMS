@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ការកក់ទាំងអស់
                <a href="{{url('admin/booking/create')}}" class="float-right btn btn-success btn-sm">បន្ថែមការកក់</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>អតិថិជន</th>
                            <th>ពិពណ៌នា</th>
                            <th>ប្រភេទបន្ទប់</th>
                            <th>កាលបរិច្ឆេទចូលស្នាក់នៅ</th>
                            <th>កាលបរិច្ឆេទចាកចេញ</th>
                            <th>យោង</th>
                            <th>មុខងារ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $booking)
                        <tr>
                            <td>{{$booking->id}}</td>
                            <td>{{$booking->customer->full_name}}</td>
                            <td>{{$booking->room->title}}</td>
                            <td>{{$booking->room->roomtype->title}}</td>
                            <td>{{$booking->checkin_date}}</td>
                            <td>{{$booking->checkout_date}}</td>
                            <td>{{$booking->ref}}</td>
                            <td><a href="{{url('admin/booking/'.$booking->id.'/delete')}}" class="text-danger"
                                    onclick="return confirm('តើអ្នកប្រាកដជាចង់លុបទិន្នន័យនេះមែនទេ?')"><i
                                        class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
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