@extends('layouts.master')

@section('title', ' مدیریت پست ها')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">لیست مطلب ها</h3>
                        <div class="col-md-4 offset-8 text-left">
                            <a href="{{ route('post.create') }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-user-plus"></i> ثبت مطلب جدید </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @include('partials.form-errors')
                    @include('partials.form-success')
                    <div class="card-body">
                        @if($posts->isEmpty())
                            <p>هیچ پستی تا کنون منتشر نشده</p>
                        @else
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>اسلوگ</th>
                                <th>نویسنده</th>
                                <th> دسته</th>
                                <th>تاریخ ثبت </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->slug }}</td>
                                    <td>{{$post->user->name }}</td>
                                    <td>{{$post->category_id  ? $post->category->name : '------' }}</td>

                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($post->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <a href="{{ route('post.show', $post->id) }}"  class="btn btn-light align-items-center gap-1"><i class="fa fa-eye"></i> نمایش </a>
                                        @if($permissions->contains('name', 'edit_post'))
                                            <a href="{{ route('post.edit', $post->id) }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-edit"></i>ویرایش </a>
                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger me-2" onclick="return confirm('آیا از حذف مطلب مطمئن هستید؟')">
                                                    <i class="fa fa-trash-o"></i> حذف
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
