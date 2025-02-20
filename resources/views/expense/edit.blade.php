@extends('layouts._app')
@section('content')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Edit Expense</li>
    </ul>

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>এডিট</strong> খরচ</h3>
                            <ul class="panel-controls">
                            </ul>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">খরচের টাইটেল<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"
                                            value="{{ old('name', $getRecord->name) }}" required placeholder="খরচের টাইটেল"
                                            name="name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">খরচের পরিমান<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('amount', $getRecord->amount) }}" required placeholder="0.0 টাকা"
                                            name="amount">
                                    </div>
                                    <div style="color:red">{{ $errors->first('amount') }}</div>
                                </div>
                            </div>
                            @php
                                use Carbon\Carbon;
                                $getRecord->expense_date = Carbon::parse($getRecord->expense_date)->format('Y-m-d');
                            @endphp
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">খরচের তারিখ<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="date" class="form-control"
                                            value="{{ old('expense_date', $getRecord->expense_date) }}" required
                                            placeholder="খরচের তারিখ" name="expense_date">
                                    </div>
                                    <div style="color:red">{{ $errors->first('expense_date') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">নোট</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                        <textarea name="remarks" class="form-control">{{ old('remarks', $getRecord->remarks) }}</textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('remarks') }}</div>
                                </div>
                            </div>


                        </div>


                        <div class="panel-footer">
                            <button class="btn btn-danger pull-right"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
@endsection
