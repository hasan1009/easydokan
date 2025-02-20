@extends('layouts._app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Employee List</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">সার্চ কর্মকর্তা/কর্মচারী</h3>
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
                                        <label>কর্মকর্তা/কর্মচারীর নাম</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>কর্মকর্তা/কর্মচারীর মোবাইল</label>
                                        <input type="number" class="form-control" name="mobile"
                                            value="{{ Request::get('mobile') }}" placeholder="Mobile">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <button class="btm btn-primary" type="submit"
                                            style="margin-top:25px;">Search</button>

                                        <a href="{{ url('employee/list') }}" class="btm btn-success" type="submit"
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
                        <h3 class="panel-title">কর্মকর্তা/কর্মচারীর লিস্ট (মোট : {{ $getRecord->total() }})</h3>
                        <a href="{{ url('employee/print') }}" class="btn btn-info pull-right" style="margin-left: 5px"
                            target="_blank">
                            <i class="fa fas fa-print"></i> প্রিন্ট </a>
                        <a href="{{ url('employee/add') }}" class="btn btn-danger pull-right">+ এড কর্মকর্তা/কর্মচারীর</a>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width='50'>আইডি</th>
                                        <th>ছবি</th>
                                        <th>কর্মকর্তা/কর্মচারীর নাম</th>
                                        <th>কর্মকর্তা/কর্মচারীর ঠিকানা</th>
                                        <th>মোবাইল</th>
                                        <th>কর্মকর্তা/কর্মচারীর পদবী</th>
                                        <th>কর্মকর্তা/কর্মচারীর বেতন</th>
                                        <th>মোট ছুটি</th>
                                        <th width=17% class="text-center">একশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalSalary = 0;
                                    @endphp
                                    @foreach ($getRecord as $value)
                                        @php
                                            $totalSalary += $value->salary;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $value->id }}</td>
                                            @if (!empty($value->getProfileDirect()))
                                                <td><img src="{{ $value->getProfileDirect() }}" alt=""
                                                        style="width:60px; height:60px; border-radius: 50%; border: 2px solid #ddd;">
                                                </td>
                                            @endif()
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->mobile }}</td>
                                            <td>{{ $value->designation }}</td>
                                            <td>{{ number_format($value->salary, 2) }} টাকা</td>
                                            <td>{{ $value->holyday }} দিন</td>
                                            <td>
                                                <a href="{{ url('employee/edit/' . $value->id) }}"
                                                    class="btn btn-default btn-rounded btn-sm"><span
                                                        class="fa fa-pencil"></a>
                                                {{-- <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#purchaseModal{{ $value->id }}">
                                                    দেনা / বাকী
                                                </button> --}}
                                                {{-- <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#smsModal{{ $value->id }}">
                                                    SMS
                                                </button> --}}
                                                <form action="{{ url('employee/delete/' . $value->id) }}" method="POST"
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

                                        {{-- <div class="modal fade" id="purchaseModal{{ $value->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal Header with Danger Background -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h3 class="modal-title" id="purchaseModalLabel"
                                                                    style="color: white">
                                                                    {{ $value->name }} এর কাছে
                                                                </h3>
                                                                <h4 style="color: white">পূর্বের দেনাঃ
                                                                    {{ number_format($value->paid, 2) }} টাকা
                                                                </h4>
                                                                <h4 style="color: white">পূর্বের পাওনাঃ
                                                                    {{ number_format($value->due, 2) }} টাকা
                                                                </h4>
                                                            </div>
                                                            <button type="button" class="close" style="color: white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="{{ url('customer/paiddue/' . $value->id) }}"
                                                            method="POST">
                                                            {{ csrf_field() }}
                                                            <!-- Purchase Price Field -->

                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">নতুন
                                                                    দেনা </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-money"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="paid" value="{{ old('paid') }}"
                                                                            placeholder="0.0" step="0.01">
                                                                    </div>
                                                                    @if ($errors->has('paid'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('paid') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">নতুন
                                                                    পাওনা </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-money"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="due" value="{{ old('due') }}"
                                                                            placeholder="0.0" step="0.01">
                                                                    </div>
                                                                    @if ($errors->has('due'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('due') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">বন্ধ করুন</button>
                                                                <button type="submit" class="btn btn-primary">সংরক্ষণ
                                                                    করুন</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- SMS Model  --}}


                                        {{-- <div class="modal fade" id="smsModal{{ $value->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="smsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h3 class="modal-title" id="smsModalLabel" style="color: white">
                                                            {{ $value->name }} এর কাছে SMS পাঠান
                                                        </h3>
                                                        <button type="button" class="close" style="color: white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{ route('send.sms', $value->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">মোবাইল
                                                                    নম্বর</label>
                                                                <div class="col-md-8">
                                                                    <input type="number" class="form-control"
                                                                        name="mobile" value="{{ $value->mobile }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-md-4 col-form-label text-md-right">মেসেজ</label>
                                                                <div class="col-md-8">
                                                                    <textarea name="message" class="form-control" required>আপনার কাছে মোট পাওনা {{ number_format($value->due, 2) }} টাকা। দয়া করে পাওনা পরিশোধ করুন (ব্যবসায়ী ভাই)</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">বন্ধ করুন</button>
                                                                <button type="submit" class="btn btn-success">Send
                                                                    SMS</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" style="text-align: left;">Total Salary</th>


                                        <th colspan="1" style="text-align: center;">
                                            {{ number_format($totalSalary, 2) }} টাকা
                                        </th>

                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
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
