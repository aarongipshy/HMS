@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ធ្វើការកែប្រែ {{$data->title}}
                <a href="{{url('admin/roomtype')}}" class="float-right btn btn-success btn-sm">មើលទាំងអស់</a>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form enctype="multipart/form-data" method="post" action="{{url('admin/roomtype/'.$data->id)}}">
                    @csrf
                    @method('put')
                    <table class="table table-bordered">
                        <tr>
                            <th>បន្ទប់</th>
                            <td><input value="{{$data->title}}" name="title" type="text" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>តម្លៃ</th>
                            <td><input value="{{$data->price}}" name="price" type="number" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>បញ្ជាក់</th>
                            <td><textarea name="detail" class="form-control">{{$data->detail}}</textarea></td>
                        </tr>
                        <tr>
                            <th>រូបភាព</th>
                            <td>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <input type="file" multiple name="imgs[]" />
                                        @foreach($data->roomtypeimgs as $img)
                                        <td class="imgcol{{$img->id}}">
                                            <img width="150" src="{{asset(''.$img->img_src)}}" />
                                            <p class="mt-2">
                                                <button type="button"
                                                    onclick="return confirm('តើអ្នកប្រាកដជាចង់លុបរូបភាពនេះមែនទេ?')"
                                                    class="btn btn-danger btn-sm delete-image"
                                                    data-image-id="{{$img->id}}"><i class="fa fa-trash"></i></button>
                                            </p>
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".delete-image").on('click',function(){
            var _img_id=$(this).attr('data-image-id');
            var _vm=$(this);
            $.ajax({
                url:"{{url('admin/roomtypeimage/delete')}}/"+_img_id,
                dataType:'json',
                beforeSend:function(){
                    _vm.addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        $(".imgcol"+_img_id).remove();
                    }
                    _vm.removeClass('disabled');
                }
            });
        });
    });
</script>
@endsection

@endsection