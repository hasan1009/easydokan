@extends('layouts._app')
@section('content')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Add Supplier</li>
    </ul>
    {{-- <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> প্রোডাক্ট</h2>
    </div> --}}
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>এড</strong> সাপ্লাইয়ার</h3>
                            <ul class="panel-controls">
                            </ul>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের নাম<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control" value="{{ old('name') }}" required
                                            placeholder="উদাঃ স্কয়ার টয়লেট্রিজ" name="name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের বিবরণ</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('description') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের ঠিকানা</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                        <textarea name="address" class="form-control"></textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('address') }}</div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের ছবি</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                        <input type="file" class="form-control" style="padding: 5px" name="photo">
                                    </div>
                                    <div style="color:red">{{ $errors->first('photo') }}</div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের মোবাইল নম্বর</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                        <input type="number" class="form-control" value="{{ old('mobile') }}"
                                            placeholder="01*********" name="mobile">
                                    </div>
                                    <div style="color:red">{{ $errors->first('mobile') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের ইমেইল</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                        <input type="text" class="form-control" value="{{ old('email') }}"
                                            placeholder="example@gmail.com" name="email">
                                    </div>
                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের ব্যাংকের নাম</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-university"></span></span>
                                        <input type="text" class="form-control" value="{{ old('bank_name') }}"
                                            placeholder="উদাঃ সোনালী ব্যাংক" name="bank_name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('bank_name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">ব্যাংক একাউন্ট নম্বর</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-university"></span></span>
                                        <input type="text" class="form-control" value="{{ old('bank_account_no') }}"
                                            placeholder="***********" name="bank_account_no">
                                    </div>
                                    <div style="color:red">{{ $errors->first('bank_account_no') }}</div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ারের কাছে পাওনা</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control" value="{{ old('due') }}"
                                            placeholder="0.0 ৳" name="due">
                                    </div>
                                    <div style="color:red">{{ $errors->first('due') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">সাপ্লাইয়ার পাবে</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control" value="{{ old('paid') }}"
                                            placeholder="0.0 ৳" name="paid">
                                    </div>
                                    <div style="color:red">{{ $errors->first('paid') }}</div>
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
