@extends('layouts.master')

@section('title', ' ویرایش دسته '.$category->name)

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ویرایش دسته {{$category->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">خانه</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('category')}}">مدیریت دسته ها</a></li>
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
                            ,ویرایش دسته {{$category->name}}
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
                        <form role="form" action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">نام </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" name="name" placeholder="" style="direction: ltr;" id="name" class="border-info text-right form-control" value="{{$category->name}}"  >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">اسلاگ</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" name="slug" placeholder="" style="direction: ltr;" id="slug" class="border-info text-left form-control "  value="{{$category->slug}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(count($categories) > 0)
                                <div class="col-6 col-md-6 mb-5">
                                    <div class="form-group">
                                        <label for="link" class="required text-gray-300">دسته والد</label>
                                        <select class="form-control" name="parent_id" >
                                            <option value="">یکی از دسته ها را انتخاب کنید</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}"{{isset($category) && $category->parent_id == $cat->id ? 'selected': ''}} >{{$cat->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="card-body pad">
                                <div class="mb-3">
                                            <textarea class="textarea text-right" placeholder="لطفا متن خود را وارد کنید" name="description"
                                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$category->description}}</textarea>
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
