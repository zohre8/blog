@extends('layouts.master')

@section('title', ' نمایش مطلب'.$post->title)

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">خانه</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('post')}}">مدیریت مطالب </a></li>
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
                             مطلب {{$post->title}}
                        </h3>


                        <!-- tools box -->
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                            <div class="row">
                                <div class="col-4 col-md-4">
                                    <img src="{{$post->photo_id ? $post->photo->path : ''}}" class="img-rounded" style="width: 95%">
                                </div>
                                <div class="col-8 col-md-8">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">عنوان: </label> {{$post->title}}
                                        <div class="input-group">
                                            <p class="text-right" style="color: #cccccc; font-size: 12px">دسته:{{$post->category_id  ? $post->category->name : '------'}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! $post->description !!}
                                    </div>
                                    <div class="form-group">
                                            <p class="text-left" style="color: #cccccc; font-size: 12px">{{$post->user->name}} -{{\Morilog\Jalali\Jalalian::fromDateTime($post->created_at)->format('Y/m/d')}}</p>
                                    </div>
                                </div>




                        {{--                        <div class="mb-3">--}}
                        {{--                            <textarea id="editor1" name="editor1" style="width: 100%">لطفا متن مورد نظر خودتان را وارد کنید</textarea>--}}
                        {{--                        </div>--}}

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
