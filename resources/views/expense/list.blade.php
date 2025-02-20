@extends('layouts._app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Expense List</li>
    </ul>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">সার্চ খরচ</h3>
                    </div>
                    <div class="panel-body">
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>আইডি</label>
                                        <input type="number" class="form-control" name="id"
                                            value="{{ Request::get('product_id') }}" placeholder="ID">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>খরচের টাইটেল</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>তারিখ(হইতে)</label>
                                        <input type="date" class="form-control" name="from_date"
                                            value="{{ Request::get('from_date') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>তারিখ(পর্যন্ত)</label>
                                        <input type="date" class="form-control" name="to_date"
                                            value="{{ Request::get('to_date') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btm btn-primary" type="submit"
                                            style="margin-top:25px;">Search</button>

                                        <a href="{{ url('expense/list') }}" class="btm btn-success" type="submit"
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
                        <a href="{{ url('expense/list') }}?filter=this_month"
                            class="btn {{ request('filter') == 'this_month' || empty(request()->all()) ? 'btn-primary' : 'btn-default' }}">
                            এই মাস
                        </a>

                        <a href="{{ url('expense/list') }}?filter=previous_month"
                            class="btn {{ request('filter') == 'previous_month' ? 'btn-primary' : 'btn-default' }}">
                            পূর্ববর্তী মাস
                        </a>

                        <a href="{{ url('expense/list') }}?filter=this_year"
                            class="btn {{ request('filter') == 'this_year' ? 'btn-primary' : 'btn-default' }}">
                            এই বছর
                        </a>

                        <a href="{{ url('expense/list') }}?filter=lifetime"
                            class="btn {{ request('filter') == 'lifetime' ? 'btn-primary' : 'btn-default' }}">
                            লাইফটাইম
                        </a>
                        <a href="{{ url('expense/print') }}" class="btn btn-info pull-right" style="margin-left: 5px"
                            target="_blank">
                            <i class="fa fas fa-print"></i> প্রিন্ট </a>
                        <a href="{{ url('expense/add') }}" class="btn btn-danger pull-right">+ এড খরচ</a>
                    </div>

                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width='50' class="text-center">#</th>
                                        <th>খরচের টাইটেল</th>
                                        <th>খরচের তারিখ</th>
                                        <th>খরচের পরিমান</th>
                                        <th>নোট</th>
                                        <th>একশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalExpense = 0;
                                    @endphp
                                    @foreach ($getRecord as $key => $value)
                                        @php
                                            $totalExpense += $value->amount;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $getRecord->firstItem() + $key }}</td>
                                            <td>{{ $value->name }}</td>

                                            <td>
                                                @if (!empty($value->expense_date))
                                                    {{ date('d-m-Y', strtotime($value->expense_date)) }}
                                                @else
                                                    No Data
                                                @endif
                                            </td>
                                            <td>{{ number_format($value->amount, 2) }} টাকা</td>
                                            <td>
                                                @if (!empty($value->remarks))
                                                    {{ $value->remarks }}
                                                @else
                                                    --No Data--
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('expense/edit/' . $value->id) }}"
                                                    class="btn btn-default btn-rounded btn-sm"><span
                                                        class="fa fa-pencil"></a>
                                                <form action="{{ url('expense/delete/' . $value->id) }}" method="POST"
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
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align: left;">টোটাল খরচ</th>
                                        <th colspan="1" style="text-align: left;">
                                            {{ number_format($totalExpense, 2) }} টাকা
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
