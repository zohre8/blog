@extends('layouts.master')

@section('title', ' مدیریت کاربران')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">لیست نقش ها</h3>
                        <div class="col-md-4 offset-8 text-left">
                            <a href="{{ route('role.create') }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-user-plus"></i> ثبت نقش جدید </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @include('partials.form-errors')
                    @include('partials.form-success')
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> نام دسته</th>
                                <th>اسلوگ</th>
                                <th>تاریخ ثبت نام</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug }}</td>

                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($role->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $role->id) }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-edit"></i> ویرایش </a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-2" onclick="return confirm('آیا از حذف کاربر مطمئن هستید؟')">
                                                <i class="fa fa-trash-o"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
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
