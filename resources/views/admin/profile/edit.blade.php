@extends('layout')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">កែប្រែប្រវត្តិរូប</h1>
    <a href="{{url('admin/profile')}}" class="float-right btn btn-success btn-sm">ត្រឡប់ក្រោយ</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">កែប្រែប្រវត្តិរូប</h6>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif
        <div class="table-responsive">
            <form method="post" enctype="multipart/form-data" action="{{url('admin/profile/update')}}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>រូបថតបច្ចុប្បន្ន</th>
                        <td>
                            @if($admin->photo)
                            <img width="100" src="{{asset('storage/'.$admin->photo)}}" />
                            @else
                            <img width="100" src="{{asset('img/avatar.png')}}" />
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>រូបថតថ្មី</th>
                        <td><input type="file" name="photo" /></td>
                    </tr>
                    <tr>
                        <th>ឈ្មោះពេញ <span class="text-danger">*</span></th>
                        <td><input value="{{$admin->full_name}}" name="full_name" type="text" class="form-control" />
                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>អ៊ីមែល <span class="text-danger">*</span></th>
                        <td><input value="{{$admin->email}}" name="email" type="email" class="form-control" />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>លេខទូរស័ព្ទ <span class="text-danger">*</span></th>
                        <td><input value="{{$admin->mobile}}" name="mobile" type="text" class="form-control" />
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>អាសយដ្ឋាន <span class="text-danger">*</span></th>
                        <td><textarea name="address" class="form-control">{{$admin->address}}</textarea>
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-primary" value="រក្សាទុក" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection