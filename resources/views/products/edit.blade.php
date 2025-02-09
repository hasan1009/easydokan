@extends('layouts._app')
@section('content')
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Edit Product</li>
    </ul>
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>এডিট</strong> প্রোডাক্ট</h3>
                            <ul class="panel-controls">
                            </ul>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের নাম</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control"
                                            value="{{ old('name', $getRecord->name) }}" required placeholder="Product Name"
                                            name="name">
                                    </div>
                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের বিবরণ (অপশনাল)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <textarea name="description" class="form-control">{{ $getRecord->description }}</textarea>
                                    </div>
                                    <div style="color:red">{{ $errors->first('description') }}</div>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">সিলেক্ট
                                    সাপ্লাইয়ার</label>
                                <div class="col-md-6 col-xs-12">
                                    <select name="supplier_id" class="form-control">
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                        <option>
                                            সাপ্লাইয়ার সেলেক্ট করুন
                                        </option>
                                        @foreach ($getSupplier as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('supplier_id', $getRecord->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="color:red">{{ $errors->first('supplier_id') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">প্রোডাক্টের ছবি (অপশনাল)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                        <input type="file" class="form-control"
                                            value="{{ old('photo', $getRecord->photo) }}" style="padding: 5px"
                                            name="photo">
                                    </div>
                                    <div style="color:red">{{ $errors->first('photo') }}</div>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">ইউনিট</label>
                                <div class="col-md-6 col-xs-12">

                                    <select name="unit" class="form-control" required>
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>

                                        <option {{ old('unit', $getRecord->unit) == 'Kg' ? 'selected' : '' }}
                                            value="Kg">
                                            Kg
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Litre' ? 'selected' : '' }}
                                            value="Litre">
                                            Liter
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Pcs' ? 'selected' : '' }}
                                            value="Pcs">
                                            Pcs
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Box' ? 'selected' : '' }}
                                            value="Box">
                                            Box
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Pair' ? 'selected' : '' }}
                                            value="Pair">
                                            Pair
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Miter' ? 'selected' : '' }}
                                            value="Miter">
                                            Miter
                                        </option>
                                        <option {{ old('unit', $getRecord->unit) == 'Gram' ? 'selected' : '' }}
                                            value="Gram">
                                            Gram
                                        </option>

                                    </select>
                                </div>
                                <div style="color:red">{{ $errors->first('unit') }}</div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">ক্রয়
                                    মূল্য (প্রতি ইউনিট)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('purchase_price', $getRecord->purchase_price) }}" required
                                            name="purchase_price">
                                    </div>
                                    <div style="color:red">{{ $errors->first('purchase_price') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">বিক্রয়
                                    মূল্য (প্রতি ইউনিট)</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input type="number" class="form-control"
                                            value="{{ old('sell_price', $getRecord->sell_price) }}" required
                                            name="sell_price">
                                    </div>
                                    <div style="color:red">{{ $errors->first('sell_price') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">মোট
                                    পরিমান</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-stack-overflow"></span></span>
                                        <input type="quantity" class="form-control"
                                            value="{{ old('quantity', $getRecord->quantity) }}" required name="quantity">
                                    </div>
                                    <div style="color:red">{{ $errors->first('quantity') }}</div>
                                </div>
                            </div>

                            @php
                                use Carbon\Carbon;
                                $getRecord->expire_date = Carbon::parse($getRecord->expire_date)->format('Y-m-d');
                            @endphp

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">মেয়াদ উত্তীর্ণের তারিখ</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="date" class="form-control"
                                            value="{{ old('expire_date', $getRecord->expire_date) }}" required
                                            name="expire_date">
                                    </div>
                                    <div style="color:red">{{ $errors->first('expire_date') }}</div>
                                </div>
                            </div>

                            @php
                                $getRecord->purchase_date = Carbon::parse($getRecord->purchase_date)->format('Y-m-d');
                            @endphp

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">ক্রয়ের তারিখ</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="date" class="form-control"
                                            value="{{ old('purchase_date', $getRecord->purchase_date) }}" required
                                            name="purchase_date">
                                    </div>
                                    <div style="color:red">{{ $errors->first('purchase_date') }}</div>
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
