@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">បន្ថែមទីតាំង
                <a href="{{url('admin/department')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form method="post" action="{{url('admin/department')}}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>ឈ្មោះទីតាំង</th>
                            <td><input name="title" type="text" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>បញ្ជាក់</th>
                            <td>
                                <textarea name="detail" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="បញ្ជូន" class="btn btn-primary" />
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