@extends('layouts._app')
@section('content')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Edit Customer</li>
    </ul>

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>এডিট</strong> কাস্টমার</h3>
                            <ul class="panel-controls">
                            </ul>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের নাম<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"
                                            value="{{ old('name', $getRecord->name) }}" required
                                            placeholder="কাস্টমারের নাম" name="name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের ঠিকানা</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                        <textarea name="address" class="form-control">{{ old('name', $getRecord->address) }}</textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('address') }}</div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের ছবি</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                        <input type="file" class="form-control" style="padding: 5px" name="photo">
                                    </div>
                                    <div style="color:red">{{ $errors->first('photo') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের মোবাইল নম্বর <span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('mobile', $getRecord->mobile) }}" placeholder="01*********"
                                            name="mobile" required>
                                    </div>
                                    <div style="color:red">{{ $errors->first('mobile') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের কাছে দেনা</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('paid', $getRecord->paid) }}" placeholder="0.0 ৳" name="paid">
                                    </div>
                                    <div style="color:red">{{ $errors->first('paid') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">কাস্টমারের কাছে পাওনা</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('due', $getRecord->due) }}" placeholder="0.0 ৳" name="due">
                                    </div>
                                    <div style="color:red">{{ $errors->first('due') }}</div>
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
