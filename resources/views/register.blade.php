@extends('frontlayout')
@section('content')
<br><br>
<div class="container my-4">
    <h3 class="mb-3">ចុះឈ្មោះ</h3>
    @if(Session::has('success'))
    <p class="text-success">{{session('success')}}</p>
    @endif
    <form method="post" action="{{url('admin/customer')}}" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tr>
                <th>ឈ្មោះពេញ<span class="text-danger">*</span></th>
                <td><input required type="text" class="form-control" name="full_name"></td>
            </tr>
            <tr>
                <th>អ៊ីមែល<span class="text-danger">*</span></th>
                <td><input required type="email" class="form-control" name="email"></td>
            </tr>
            <tr>
                <th>ពាក្យសម្ងាត់<span class="text-danger">*</span></th>
                <td><input required type="password" class="form-control" name="password"></td>
            </tr>
            <tr>
                <th>លេខសម្ងាត់<span class="text-danger">*</span></th>
                <td><input required type="number" class="form-control" name="mobile"></td>
            </tr>
            <tr>
                <th>អាស័យដ្ឋាន</th>
                <td><input type="text" class="form-control" name="address"></td>
            </tr>
            <tr>
                <th>រូបភាព<span class="text-danger">*</span></th>
                <td><input type="file" class="form-control" name="photo"></td>
            </tr>
            <tr>
                <input type="hidden" name="ref" value="front" />
                <td colspan="2">
                    <input type="submit" value="បញ្ជូន" class="btn btn-primary" />
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection