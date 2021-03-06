@extends('page.layout.main')

@section('content')
<div id="UserPage">
    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="user-box">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="user-menu">
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-tab" data-toggle="tab" href="#accountTab" role="tab" aria-controls="account" aria-selected="true">
                                    {{ __('userPage.accInfo') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="promotion-tab" data-toggle="tab" href="#promotionTab" role="tab" aria-controls="promotion" aria-selected="false">Khuyến mãi của bạn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="film-tab" data-toggle="tab" href="#filmTab" role="tab" aria-controls="film" aria-selected="false">
                                    {{ __('userPage.journey') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-10">
                    <div class="tab-content">
                        <div class="tab-pane active" id="accountTab" role="tabpanel" aria-labelledby="account-tab">
                            {!! Form::open(['method' => 'PUT', 'url' => "user/$user->id", 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="user-image">
                                            <img src="storage/img/user/{{Auth::user()->image}}" alt="avatar">
                                            <div class="custom-file mt-3">
                                                {!! Form::label( 'customFile', __('userPage.uploadImg'), ['class' => 'custom-file-label']) !!}
                                                {!! Form::file('image', ['class' => 'custom-file-input']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-9">
                                        <div class="user-info">
                                            <p class="txt-hello">Xin chào,
                                                <span>{{ Auth::user()->name }}</span>
                                            </p>
                                            <p class="txt-description">{{ __('userPage.note') }}</p>
                                            <div class="form-group row">
                                                {!! Form::label('Email') !!}
                                                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Email', 'disabled' => 'disabled']) !!}
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label( __('userPage.name')) !!}
                                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Tên', 'required' => 'required']) !!}
                                            </div>
                                            <div class="form-group row mb-3 ">
                                                {!! Form::checkbox('editpass', null, false, ['class' => 'editpass', 'id' => 'ChangePassCheck']) !!}
                                                {!! Form::label( 'ChangePassCheck', __('userPage.editPass'), ['class' => 'form-check-label ml-1']) !!}
                                            </div>
                                            <div class="form-group row mb-2">
                                                {!! Form::label('Mật khẩu') !!}
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu']) !!}
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('Nhập lại mật khẩu') !!}
                                                {!! Form::password('passwordAgain', ['class' => 'form-control', 'placeholder' => 'Nhập lại mật khẩu']) !!}
                                            </div>
                                        </div>
                                        {!! Form::button('Sửa thông tin', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                                    </div>

                                </div>

                            {!! Form::close() !!}
                        </div>

                        <div class="tab-pane" id="promotionTab" role="tabpanel" aria-labelledby="promotion-tab">
                            <div class="user-filmtour table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Loại</th>
                                            <th>Mã</th>
                                            <th>Ưu đãi</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    @if ($user->coupon_code != null)
                                        <tbody class="table-bordered">
                                            @php $stt=1 @endphp
                                                <tr>
                                                    <td>{{$stt++}}</td>
                                                    <td>
                                                        {{ 'Sinh nhật' }}
                                                    </td>
                                                    <td>
                                                        @if ($user->active == 1)
                                                            {{ $user->coupon_code }}
                                                        @else
                                                            {{ 'Vui lòng kích hoạt mã' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ 'Giảm 30% giá vé trong ngày' }}
                                                        {{ date('d/m/Y')}}

                                                    </td>
                                                    <td>
                                                        @if ($user->active == 0)
                                                            <b>{{ 'Chưa kích hoạt' }}</b>
                                                        @elseif ($user->active == 2)
                                                            {{ 'Đã sử dụng' }}
                                                        @else
                                                            {{ 'Đã kính hoạt' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                        </tbody>
                                    @endif
                                </table>

                            </div>
                            <div class="container">
                                {!! Form::open(['method' => 'POST', 'url' => "activeCoupon/$user->id", 'files' => true]) !!}
                                <div class="form-group row">
                                    {!! Form::text('coupon', null, ['class' => 'form-control', 'placeholder' => 'Nhập mã khuyến mãi', 'required' => '']) !!}
                                </div>
                                {!! Form::button('Kích hoạt', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                            </div>
                        </div>

                        <div class="tab-pane" id="filmTab" role="tabpanel" aria-labelledby="film-tab">
                            @if (isset($tk))
                                <div class="user-filmtour table-responsive-md">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>{{ __('userPage.film') }}</th>
                                                <th>{{ __('userPage.theater') }}</th>
                                                <th>{{ __('userPage.room') }}</th>
                                                <th>{{ __('userPage.calendar') }}</th>
                                                <th>{{ __('userPage.seat') }}</th>
                                                <th>{{ __('userPage.create_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-bordered">
                                            @php $stt=1 @endphp
                                                @foreach ($tk as $ticket)
                                                    <tr>
                                                        <td>{{$stt++}}</td>
                                                        <td>
                                                            {{$ticket->calendar->film->name}}
                                                        </td>
                                                        <td>
                                                            {{$ticket->calendar->room->theater->name}}
                                                        </td>
                                                        <td>
                                                            {{$ticket->calendar->room->name}}
                                                        </td>
                                                        <td>
                                                            {{$ticket->calendar->calendarTimes[0]->time_show .' - '.$ticket->calendar->date_show  }}
                                                        </td>
                                                        <td>
                                                            @foreach ($ticket->seats as $seat)
                                                                {{ $loop->first ? '' : ',' }}
                                                                {{ $seat->name }}
                                                            @endforeach
                                                        </td>
                                                        <td>{{$ticket->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    Bạn chưa đặt vé nào
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(function() {
            enable_cb();
            $(".editpass").click(enable_cb);
            });
            function enable_cb() {
                if (this.checked) {
                    $("input[name='password']").removeAttr("disabled");
                    $("input[name='passwordAgain']").removeAttr("disabled");
                } else {
                    $("input[name='password']").attr("disabled", true);
                    $("input[name='passwordAgain']").attr("disabled", true);
                }
            }
    </script>
@endsection
