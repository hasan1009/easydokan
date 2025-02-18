@extends('layouts._app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Asset List</li>
    </ul>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">সার্চ প্রোডাক্ট</h3>
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
                                        <label>প্রোডাক্টের নাম</label>
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

                                        <a href="{{ url('sell/list') }}" class="btm btn-success" type="submit"
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
                        <h3 class="panel-title">বিক্রয় লিস্ট (মোট : {{ $getSell->total() }})</h3>
                        <a href="{{ url('sell/print') }}" class="btn btn-info pull-right" style="margin-left: 5px"
                            target="_blank">
                            <i class="fa fas fa-print"></i> প্রিন্ট </a>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width='50'>প্রোডাক্ট আইডি</th>
                                        <th width='50'>প্রোডাক্টের ছবি</th>
                                        <th>প্রোডাক্টের নাম</th>
                                        <th>বিক্রয়ের তারিখ</th>
                                        <th>ক্রয় মূল্য</th>
                                        <th>বিক্রয় মূল্য</th>
                                        <th>বিক্রয়ের পরিমান</th>
                                        <th>মোট ক্রয় মূল্য</th>
                                        <th>মোট বিক্রয় মূল্য</th>
                                        <th>মোট প্রফিট</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalpurchaseamount = 0;
                                        $totalsellamount = 0;
                                        $profit = 0;
                                        $totalProfit = 0;
                                    @endphp
                                    @foreach ($getSell as $value)
                                        @php
                                            $totalpurchaseamount = $value->buy_price * $value->sell_quantity;
                                            $totalsellamount = $value->sell_price * $value->sell_quantity;
                                            $profit = $totalsellamount - $totalpurchaseamount;
                                            $totalProfit += $profit;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $value->product_id }}</td>
                                            @if (!empty($value->getProfileDirect()))
                                                <td><img src="{{ $value->getProfileDirect() }}" alt=""
                                                        style="width:60px; height:60px; border-radius: 50%; border: 2px solid #ddd;">
                                                </td>
                                            @endif()
                                            <td>{{ $value->productname }}</td>
                                            <td>
                                                @if (!empty($value->sell_date))
                                                    {{ date('d-m-Y', strtotime($value->sell_date)) }}
                                                @else
                                                    No Data
                                                @endif
                                            </td>
                                            <td>{{ number_format($value->buy_price, 2) }} টাকা</td>
                                            <td>{{ number_format($value->sell_price, 2) }} টাকা</td>
                                            <td>{{ $value->sell_quantity }} {{ $value->unit }}</td>
                                            <td>{{ number_format($totalpurchaseamount, 2) }} টাকা</td>
                                            <td>{{ number_format($totalsellamount, 2) }} টাকা</td>
                                            <td>{{ number_format($profit, 2) }} টাকা</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="9" style="text-align: left;">Total</th>
                                        <th colspan="1" style="text-align: center;">
                                            {{ number_format($totalProfit, 2) }} টাকা
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px; float:right;">
                    {!! $getSell->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
