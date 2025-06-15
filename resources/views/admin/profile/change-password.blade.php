@extends('layout')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ប្តូរពាក្យសម្ងាត់</h1>
    <a href="{{url('admin/profile')}}" class="float-right btn btn-success btn-sm">ត្រឡប់ក្រោយ</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ប្តូរពាក្យសម្ងាត់</h6>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif
        @if(Session::has('error'))
        <p class="text-danger">{{session('error')}}</p>
        @endif
        <div class="table-responsive">
            <form method="post" action="{{url('admin/update-password')}}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>ពាក្យសម្ងាត់បច្ចុប្បន្ន <span class="text-danger">*</span></th>
                        <td><input name="current_password" type="password" class="form-control" />
                            @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>ពាក្យសម្ងាត់ថ្មី <span class="text-danger">*</span></th>
                        <td><input name="password" type="password" class="form-control" />
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>បញ្ជាក់ពាក្យសម្ងាត់ថ្មី <span class="text-danger">*</span></th>
                        <td><input name="password_confirmation" type="password" class="form-control" />
                            @error('password_confirmation')
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