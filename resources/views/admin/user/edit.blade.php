@extends('layouts.master')

@section('title', 'ویرایش کاربران')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ویرایش کاربر  {{$user->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}>خانه</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('user')}}"> مدیریت کاربران</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            ویرایش کاربر {{$user->name}}
                        </h3>


                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm"
                                    data-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool btn-sm"
                                    data-widget="remove"
                                    data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @include('partials.form-errors')
                        @include('partials.form-success')
                        <form role="form" action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5 class="mt-3 mb-3 text-black">اطلاعات شخصی</h5>
                            <div class="row">
                                <div class="col-7 col-md-7 mt-4">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">نام و نام خانوادگی</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" name="name" placeholder="" style="direction: ltr;" id="name" class="border-info text-right form-control " value="{{$user->name}}"   >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">شماره تماس</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="phone" placeholder="" style="direction: ltr;" id="phone" class="border-info text-left form-control "  value="{{$user->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">پست الکترونیکی</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <input type="text" name="email" placeholder="" style="direction: ltr;" id="email" class="border-info text-left form-control "  value="{{$user->email }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-5">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">تاریخ تولد</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" name="birth_date" id="birth_date" class="border-info form-control" placeholder="تاریخ تولد"value="{{ $user->birth_date ? \Morilog\Jalali\Jalalian::fromDateTime(\Carbon\Carbon::parse($user->birth_date))->format('Y/m/d') : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <h5 class="col-12 col-md-12 mt-6 mb-3 text-black">تنظیمات حساب کاربری</h5>
                                <div class="col-12">
                                    <div class="col-6 col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="link" class="required text-gray-300">رمز عبور</label>
                                            <input type="password" name="password" placeholder="" style="direction: ltr;" id="link" class="border-info text-right form-control "   >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-5">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">نقش کاربر</label>
                                        <select class="form-control" name="role[]" multiple>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }} >{{$role->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-5">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">وضعیت</label>
                                        <select class="form-control" name="status" >
                                            <option value="0"  {{ $user->status == 0 ? 'selected' : '' }}>غیر فعال</option>
                                            <option value="1"  {{ $user->status == 1 ? 'selected' : '' }}>فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <h5 class="col-12 col-md-12 mt-6 mb-3 text-black">تصویر کاربر</h5>
                                <div class="col-6 col-md-6 mt-4">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">تصویر پروفایل</label>
                                        <input type="file" class="form-control" name="photo_id">
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mt-4">
                                   <img src="{{$user->photo_id ? $user->photo->path : ''}}" class="img-rounded">
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">ویرایش اطلاعات</button>

                        </form>


                    </div>
                </div>
                <!-- /.card -->

                {{--                <div class="card card-outline card-info">--}}
                {{--                    <div class="card-header">--}}
                {{--                        <h3 class="card-title">--}}
                {{--                            ویرایشگر بوت استرپ WYSIHTML5--}}
                {{--                            <small>ساده و سریع</small>--}}
                {{--                        </h3>--}}
                {{--                        <!-- tools box -->--}}
                {{--                        <div class="card-tools">--}}
                {{--                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip"--}}
                {{--                                    title="Collapse">--}}
                {{--                                <i class="fa fa-minus"></i></button>--}}
                {{--                            <button type="button" class="btn btn-tool btn-sm" data-widget="remove" data-toggle="tooltip"--}}
                {{--                                    title="Remove">--}}
                {{--                                <i class="fa fa-times"></i></button>--}}
                {{--                        </div>--}}
                {{--                        <!-- /. tools -->--}}
                {{--                    </div>--}}
                {{--                    <!-- /.card-header -->--}}
                {{--                    <div class="card-body pad">--}}
                {{--                        <div class="mb-3">--}}
                {{--                <textarea class="textarea" placeholder="لطفا متن خود را وارد کنید"--}}
                {{--                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>--}}
                {{--                        </div>--}}
                {{--                        <p class="text-sm mb-0">--}}
                {{--                            مشاهده <a href="https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg">مستندات و توضیحات این ویرایشگر</a>--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->

@endsection
