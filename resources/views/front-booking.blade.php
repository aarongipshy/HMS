@extends('frontlayout')
@section('content')
<br><br><br>
<div class="container my-4">
	<h3 class="mb-3">ការកក់បន្ទប់</h3>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
        @endforeach
    @endif

    @if(Session::has('success'))
    <p class="text-success">{{session('success')}}</p>
    @endif
    <div class="table-responsive">
        <form method="post" enctype="multipart/form-data" action="{{url('admin/booking')}}">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>កាលបរិច្ឆេទចូលស្នាក់នៅ<span class="text-danger">*</span></th>
                    <td><input name="checkin_date" type="date" class="form-control checkin-date" /></td>
                </tr>
                <tr>
                    <th>កាលបរិច្ឆេទចេញពីសណ្ឋាគារ<span class="text-danger">*</span></th>
                    <td><input name="checkout_date" type="date" class="form-control" /></td>
                </tr>
                <tr>
                    <th>បន្ទប់ដែលមានសល់ <span class="text-danger">*</span></th>
                    <td>
                        <select class="form-control room-list" name="room_id">

                        </select>
                        <br>
                        <p>តម្លែ: <span class="show-room-price"></span></p>
                    </td>
                </tr>
                <tr>
                    <th>ចំនួនមនុស្សពេញវ័យសរុប <span class="text-danger">*</span></th>
                    <td><input name="total_adults" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <th>ចំនួនកុមារសរុប</th>
                    <td><input name="total_children" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if(Session::has('data'))
                    	<input type="hidden" name="customer_id" value="{{session('data')[0]->id}}" />
                        @endif
                        <input type="hidden" name="roomprice" class="room-price" value="" />
                    	<input type="hidden" name="ref" value="front" />
                        <input type="submit" value="បញ្ជូន" class="btn btn-primary" />
                    </td> 
                </tr>
            </table>
        </form>
    </div>               
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".checkin-date").on('blur',function(){
            var _checkindate=$(this).val();
            // Ajax
            $.ajax({
                url:"{{url('admin/booking')}}/available-rooms/"+_checkindate,
                dataType:'json',
                beforeSend:function(){
                    $(".room-list").html('<option>--- Loading ---</option>');
                },
                success:function(res){
                    var _html='';
                    $.each(res.data,function(index,row){
                        _html+='<option data-price="'+row.roomtype.price+'" value="'+row.room.id+'">'+row.room.title+'-'+row.roomtype.title+'</option>';
                    });
                    $(".room-list").html(_html);

                    var _selectedPrice=$(".room-list").find('option:selected').attr('data-price');
                    $(".room-price").val(_selectedPrice);
                    $(".show-room-price").text(_selectedPrice);

                }
            });
        });

        $(document).on("change",".room-list",function(){
            var _selectedPrice=$(this).find('option:selected').attr('data-price');
            $(".room-price").val(_selectedPrice);
            $(".show-room-price").text(_selectedPrice);
        });

    });
</script>

@endsection