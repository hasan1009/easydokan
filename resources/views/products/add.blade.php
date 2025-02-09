@extends('layouts._app')
@section('content')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Add Product</li>
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
                            <h3 class="panel-title"><strong>এড</strong> প্রোডাক্ট</h3>
                            <ul class="panel-controls">
                            </ul>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের নাম<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-stack-overflow"></span></span>
                                        <input type="text" class="form-control" value="{{ old('name') }}" required
                                            placeholder="Asset Name" name="name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের বিবরণ (অপশনাল)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('description') }}</div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের ছবি (অপশনাল)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                        <input type="file" class="form-control" style="padding: 5px" name="photo">
                                    </div>
                                    <div style="color:red">{{ $errors->first('photo') }}</div>
                                </div>
                            </div>







                            {{-- <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">ক্রয়ের পরিমান <span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="number" class="form-control" value="{{ old('quantity') }}" required
                                            placeholder="0.0" name="quantity" step="0.01">
                                    </div>
                                    <div style="color:red">{{ $errors->first('quantity') }}</div>
                                </div>
                            </div> --}}


                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">ইউনিট<span
                                        style="color:red;">*</span></label>
                                <div class="col-md-6 col-xs-12">

                                    <select name="unit" class="form-control" required>
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>

                                        <option {{ old('unit') == 'Kg' ? 'selected' : '' }} value="Kg">
                                            Kg
                                        </option>
                                        <option {{ old('unit') == 'Litre' ? 'selected' : '' }} value="Litre">
                                            Liter
                                        </option>
                                        <option {{ old('unit') == 'Pcs' ? 'selected' : '' }} value="Pcs">
                                            Pcs
                                        </option>
                                        <option {{ old('unit') == 'Box' ? 'selected' : '' }} value="Box">
                                            Box
                                        </option>
                                        <option {{ old('unit') == 'Pair' ? 'selected' : '' }} value="Pair">
                                            Pair
                                        </option>
                                        <option {{ old('unit') == 'Miter' ? 'selected' : '' }} value="Miter">
                                            Miter
                                        </option>
                                        <option {{ old('unit') == 'Gram' ? 'selected' : '' }} value="Gram">
                                            Gram
                                        </option>

                                    </select>
                                </div>
                                <div style="color:red">{{ $errors->first('unit') }}</div>
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
