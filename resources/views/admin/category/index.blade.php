@extends('layouts.master')

@section('title', ' مدیریت دسته ها')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">لیست دست ها</h3>
                        <div class="col-md-4 offset-8 text-left">
                            <a href="{{ route('category.create') }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-user-plus"></i> ثبت دسته جدید </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @include('partials.form-errors')
                    @include('partials.form-success')
                    <div class="card-body">
                        @if($categories->isEmpty())
                            <p>دسته‌بندی‌ای وجود ندارد</p>
                        @else
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> نام دسته</th>
                                <th>اسلوگ</th>
                                <th>زیر دسته</th>
                                <th>تاریخ ثبت </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug }}</td>
                                    <td>{{$category->parent ? $category->parent->name : '------' }}</td>

                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($category->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-edit"></i> ویرایش </a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-2" onclick="return confirm('آیا از حذف دسته مطمئن هستید؟')">
                                                <i class="fa fa-trash-o"></i> حذف
                                            </button>
                                        </form>
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
