@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">បន្ថែមការទូទាត់ប្រាក់បុគ្គលិក
                <a href="{{url('admin/staff')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form method="post" action="{{url('admin/staff/payment/'.$staff_id)}}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>ចំនួនប្រាក់ខែ</th>
                            <td><input name="amount" type="text" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>កាលបរិច្ឆេទ</th>
                            <td><input name="amount_date" class="form-control" type="date" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="បញ្ជូល" class="btn btn-primary" />
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