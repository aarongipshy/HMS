@extends('layout')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">គណនីអ្នកគ្រប់គ្រង</h1>
    <a href="{{url('admin/profile/edit')}}" class="float-right btn btn-primary btn-sm">កែប្រែប្រវត្តិរូប</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ប្រវត្តិរូបអ្នកគ្រប់គ្រង</h6>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>រូបថត</th>
                    <td>
                        @if($admin->photo)
                        <img width="100" src="{{asset('storage/'.$admin->photo)}}" />
                        @else
                        <img width="100" src="{{asset('img/avatar.png')}}" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>ឈ្មោះពេញ</th>
                    <td>{{$admin->full_name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>អ៊ីមែល</th>
                    <td>{{$admin->email ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>លេខទូរស័ព្ទ</th>
                    <td>{{$admin->mobile ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>អាសយដ្ឋាន</th>
                    <td>{{$admin->address ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>ឈ្មោះអ្នកប្រើប្រាស់</th>
                    <td>{{$admin->username}}</td>
                </tr>
            </table>
        </div>
        <a href="{{url('admin/change-password')}}" class="btn btn-primary">ប្តូរពាក្យសម្ងាត់</a>
    </div>
</div>
@endsection