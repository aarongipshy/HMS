@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">ភ្លេចពាក្យសម្ងាត់?</h1>
                        </div>
                        <form class="user" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user" placeholder="ឈ្មោះអ្នកប្រើ">
                            </div>
                            <div class="form-group">
                                <input type="text" name="telegram_id" class="form-control form-control-user" placeholder="Telegram ID">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">ផ្ញើ OTP</button>
                        </form>
                        @if(Session::has('error'))
                        <div class="alert alert-danger mt-4">{{session('error')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection