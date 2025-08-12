@extends('layouts.master')

@section('title', 'ویرایش مطلب  '.$post->title)

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ویرایش مطلب {{$post->title}}</h1>
                </div>
                <div class="col-sm-6">
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
                            ویرایش مطلب {{$post->title}}
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
                        <form role="form" action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">عنوان </label>
                                        <div class="input-group">

                                            <input type="text" name="title" placeholder="" style="direction: ltr;" id="name" class="border-info text-right form-control " value="{{$post->title}}"   >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">اسلاگ</label>
                                        <div class="input-group">
                                            <input type="text" name="slug" placeholder="" style="direction: ltr;" id="slug" class="border-info form-control text-right "  value="{{$post->slug}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 ">
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                                <textarea class="textarea text-right" placeholder="لطفا متن خود را وارد کنید" name="description"
                                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$post->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 ">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300" >دسته </label>
                                        <select class="form-control" name="category_id" >
                                            <option value="">یکی از دسته ها را انتخاب کنید</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}" {{$post->category_id == $cat->id ? 'selected':''}} >{{$cat->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">وضعیت</label>
                                        <select class="form-control" name="is_published" >
                                            <option value="0" {{$post->is_published == 0 ? 'selected':''}}>غیر فعال</option>
                                            <option value="1" {{$post->is_published == 1 ? 'selected':''}}>فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6  mb-5">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">تصویر مطلب</label>
                                        <input type="file" class="form-control" name="photo_id">
                                    </div>
                                </div>

                                <div class="col-6 col-md-6 mt-4">
                                    <img src="{{$post->photo_id ? $post->photo->path : ''}}" class="img-rounded" width="300px">
                                </div>
                                <h5 class="col-12 col-md-12 mt-6 mb-3 text-black">سئو مطلب</h5>
                                <div class="col-6 col-md-6 mt-4 ">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">عنوان متا </label>
                                        <div class="input-group">
                                            <input type="text" name="meta_title" placeholder="" style="direction: ltr;" id="name" class="border-info text-right form-control " value="{{$post->meta_title}}"   >
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pad col-12 col-md-12">
                                    <div class="mb-3">
                                            <textarea class="textarea text-right" placeholder="لطفا متن خود را وارد کنید" name="meta_description"
                                                      style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$post->meta_description}}</textarea>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" type="submit">ثبت اطلاعات</button>

                        </form>
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
