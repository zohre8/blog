@extends('layouts.master')

@section('title', ' مدیریت کاربران')

@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">لیست کاربران</h3>
                        <div class="col-md-4 offset-8 text-left">
                            <a href="{{ route('user-creat') }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-user-plus"></i> ثبت کاربر </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @include('partials.form-errors')
                    @include('partials.form-success')
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> نام</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>تاریخ تولد</th>
                                <th>نقش</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت نام</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email }}</td>
                                    <td>{{$user->phone ?? 'وارد نشده'}}</td>
                                    <td>{{$user->birth_date ? \Morilog\Jalali\Jalalian::fromDateTime($user->birth_date)->format('Y/m/d') : 'وارد نشده' }}</td>
                                    <td>
                                       {{$user->roles->pluck('name')->join(', ')}}
                                    </td>
                                    <td>{!! $user->status == 1 ? '<span class="right badge badge-success">فعال</span>' : '<span class="right badge badge-danger">غیرفعال</span>'!!}</td>
                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($user->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <a href="{{ route('user-edit', $user->id) }}"  class="btn btn-info align-items-center gap-1"><i class="fa fa-edit"></i> ویرایش </a>
                                        <form action="{{ route('user-destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger me-2" onclick="return confirm('آیا از حذف کاربر مطمئن هستید؟')">
                                                <i class="fa fa-trash-o"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach




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
