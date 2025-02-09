@extends('layouts._app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">suppliers List</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">সার্চ সাপ্লাইয়ার</h3>
                    </div>
                    <div class="panel-body">
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>আইডি</label>
                                        <input type="number" class="form-control" name="id"
                                            value="{{ Request::get('id') }}" placeholder="ID">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>সাপ্লাইয়ারের নাম</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>সাপ্লাইয়ারের মোবাইল</label>
                                        <input type="number" class="form-control" name="mobile"
                                            value="{{ Request::get('mobile') }}" placeholder="Mobile">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>সাপ্লাইয়ারের ইমেইল</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ Request::get('email') }}" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btm btn-primary" type="submit"
                                            style="margin-top:25px;">Search</button>

                                        <a href="{{ url('supplier/list') }}" class="btm btn-success" type="submit"
                                            style="margin-top:35px; padding: 4px 15px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('_message')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">প্রোডাক্ট লিস্ট (মোট : {{ $getRecord->total() }})</h3>
                        <a href="{{ url('supplier/print') }}" class="btn btn-info pull-right" style="margin-left: 5px"
                            target="_blank">
                            <i class="fa fas fa-print"></i> প্রিন্ট </a>
                        <a href="{{ url('supplier/add') }}" class="btn btn-danger pull-right">+ এড সাপ্লাইয়ার</a>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width='50'>আইডি</th>
                                        <th>ছবি/লোগো</th>
                                        <th>সাপ্লাইয়ারের নাম</th>
                                        <th>সাপ্লাইয়ারের বিবরণ</th>
                                        <th>সাপ্লাইয়ারের ঠিকানা</th>
                                        <th>ইমেইল</th>
                                        <th>মোবাইল</th>
                                        <th>ব্যাংকের নাম</th>
                                        <th>একাউন্ট নম্বর</th>
                                        <th>সাপ্লাইয়ারে পাবে</th>
                                        <th>সাপ্লাইয়ারের কাছে পাবো</th>
                                        <th width=15% class="text-center">একশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->id }}</td>
                                            @if (!empty($value->getProfileDirect()))
                                                <td><img src="{{ $value->getProfileDirect() }}" alt=""
                                                        style="width:60px; height:60px; border-radius: 50%; border: 2px solid #ddd;">
                                                </td>
                                            @endif()
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->mobile }}</td>
                                            <td>{{ $value->bank_name }}</td>
                                            <td>{{ $value->bank_account_no }}</td>
                                            <td>{{ number_format($value->due, 2) }} টাকা</td>
                                            <td>{{ number_format($value->paid, 2) }} টাকা</td>

                                            <td>
                                                <a href="{{ url('supplier/edit/' . $value->id) }}"
                                                    class="btn btn-default btn-rounded btn-sm"><span
                                                        class="fa fa-pencil"></a>
                                                <form action="{{ url('supplier/delete/' . $value->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete?')">
                                                        <span class="fa fa-times"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
