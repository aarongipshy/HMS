@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">បន្ថែមប្រភេទបន្ទប់
                                <a href="{{url('admin/customer')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <tr>
                                        <th>ឈ្មោះពេញ</th>
                                        <td>{{$data->full_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>រូបភាព</th>
                                        <td><img width="150" src="{{asset(''.$data->photo)}}" /></td>
                                    </tr>
                                    <tr>
                                        <th>អ៊ីមែល</th>
                                        <td>{{$data->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>លេខទូរស័ព្ទ</th>
                                        <td>{{$data->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>អាស័យដ្ថាន</th>
                                        <td>{{$data->address}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@endsection