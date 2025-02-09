@extends('layouts._app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Asset List</li>
    </ul>
    <!-- END BREADCRUMB -->

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
                                        <label>ID</label>
                                        <input type="number" class="form-control" name="id"
                                            value="{{ Request::get('id') }}" placeholder="ID">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Request::get('name') }}" placeholder="Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Purchase Date</label>
                                        <input type="date" class="form-control" name="purchase_date"
                                            value="{{ Request::get('purchase_date') }}" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btm btn-primary" type="submit"
                                            style="margin-top:25px;">Search</button>

                                        <a href="{{ url('products/list') }}" class="btm btn-success" type="submit"
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
                        <a href="{{ url('products/print') }}" class="btn btn-info pull-right" style="margin-left: 5px"
                            target="_blank">
                            <i class="fa fas fa-print"></i> প্রিন্ট </a>
                        <a href="{{ url('products/add') }}" class="btn btn-danger pull-right">+ এড প্রোডাক্ট</a>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width='50'>আইডি</th>
                                        <th>ছবি</th>
                                        <th>প্রোডাক্টের নাম</th>
                                        <th>প্রোডাক্টের বিবরণ</th>
                                        <th>সাপ্লাইয়ের</th>
                                        <th>ক্রয় মূল্য</th>
                                        <th>বিক্রয় মূল্য</th>
                                        <th>মোট পরিমান</th>
                                        <th>মোট মূল্য</th>
                                        <th>মেয়াদ উত্তীর্ণের তারিখ</th>
                                        <th>ক্রয়ের তারিখ</th>
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
                                            <td>{{ $value->supplier_name ?? 'No Supplier' }}</td>
                                            <td>{{ number_format($value->purchase_price, 2) }} টাকা</td>
                                            <td>{{ number_format($value->sell_price, 2) }} টাকা</td>
                                            <td>{{ $value->quantity }} {{ $value->unit }}</td>
                                            @php
                                                $totalPrice = $value->purchase_price * $value->quantity;
                                            @endphp
                                            <td>{{ number_format($totalPrice, 2) }} টাকা</td>

                                            <td>
                                                @if (!empty($value->expire_date))
                                                    {{ date('d-m-Y', strtotime($value->expire_date)) }}
                                                @else
                                                    No Data
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($value->purchase_date))
                                                    {{ date('d-m-Y', strtotime($value->purchase_date)) }}
                                                @else
                                                    No Data
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('products/edit/' . $value->id) }}"
                                                    class="btn btn-default btn-rounded btn-sm"><span
                                                        class="fa fa-pencil"></a>

                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#purchaseModal{{ $value->id }}">
                                                    ক্রয়
                                                </button>

                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#sellModal{{ $value->id }}">
                                                    বিক্রয়
                                                </button>

                                                <form action="{{ url('products/delete/' . $value->id) }}" method="POST"
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

                                        {{-- Purchase modal --}}
                                        <div class="modal fade" id="purchaseModal{{ $value->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal Header with Danger Background -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <div class="row">
                                                            <h3 class="modal-title" id="purchaseModalLabel"
                                                                style="color: white">
                                                                {{ $value->name }} - ক্রয়
                                                            </h3>
                                                            <button type="button" class="close" style="color: white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="{{ url('products/list/' . $value->id) }}"
                                                            method="POST">
                                                            {{ csrf_field() }}
                                                            <!-- Purchase Price Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়
                                                                    মূল্য (প্রতি ইউনিট) <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-dollar"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="purchase_price"
                                                                            value="{{ old('purchase_price') }}"
                                                                            placeholder="0.0" step="0.01" required>
                                                                    </div>
                                                                    @if ($errors->has('purchase_price'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('purchase_price') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Selling Price Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">বিক্রয়
                                                                    মূল্য (প্রতি ইউনিট) <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-dollar"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="sell_price"
                                                                            value="{{ old('sell_price') }}"
                                                                            placeholder="0.0" step="0.01" required>
                                                                    </div>
                                                                    @if ($errors->has('sell_price'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('sell_price') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Purchase Quantity Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়ের
                                                                    পরিমান <span class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-cubes"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="quantity" value="{{ old('quantity') }}"
                                                                            placeholder="0" required>
                                                                    </div>
                                                                    @if ($errors->has('quantity'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('quantity') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">মেয়াদ
                                                                    উত্তীর্ণের তারিখ </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-calendar"></span></span>
                                                                        <input type="date" class="form-control"
                                                                            value="{{ old('expire_date') }}"
                                                                            name="expire_date">
                                                                    </div>
                                                                    <div style="color:red">
                                                                        {{ $errors->first('expire_date') }}</div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়ের
                                                                    তারিখ </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-calendar"></span></span>
                                                                        <input type="date" class="form-control"
                                                                            value="{{ old('purchase_date') }}"
                                                                            placeholder="Unit Price" name="purchase_date">
                                                                    </div>
                                                                    <div style="color:red">
                                                                        {{ $errors->first('purchase_date') }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                <label
                                                                    class="col-md-4 col-form-label text-md-right">সিলেক্ট
                                                                    সাপ্লাইয়ার</label>
                                                                <div class="col-md-8">
                                                                    <select name="supplier_id" class="form-control">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-unlock-alt"></span></span>
                                                                        <option>
                                                                            সাপ্লাইয়ার সেলেক্ট করুন
                                                                        </option>
                                                                        @foreach ($getSupplier as $supplier)
                                                                            <option value="{{ $supplier->id }}"
                                                                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                                                {{ $supplier->name }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div style="color:red">{{ $errors->first('supplier_id') }}
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
                                        </div>

                                        {{-- ============================ --}}

                                        {{-- Sell modal --}}
                                        <div class="modal fade" id="sellModal{{ $value->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="sellModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal Header with Danger Background -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <div class="row">
                                                            <h3 class="modal-title" id="sellModalLabel"
                                                                style="color: white">
                                                                {{ $value->name }} - বিক্রয়
                                                            </h3>
                                                            <button type="button" class="close" style="color: white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="{{ url('products/list/' . $value->id) }}"
                                                            method="POST">
                                                            {{ csrf_field() }}
                                                            <!-- Purchase Price Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়
                                                                    মূল্য (প্রতি ইউনিট) <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-dollar"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="purchase_price"
                                                                            value="{{ old('purchase_price') }}"
                                                                            placeholder="0.0" step="0.01" required>
                                                                    </div>
                                                                    @if ($errors->has('purchase_price'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('purchase_price') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Selling Price Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">বিক্রয়
                                                                    মূল্য (প্রতি ইউনিট) <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-dollar"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="sell_price"
                                                                            value="{{ old('sell_price') }}"
                                                                            placeholder="0.0" step="0.01" required>
                                                                    </div>
                                                                    @if ($errors->has('sell_price'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('sell_price') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Purchase Quantity Field -->
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়ের
                                                                    পরিমান <span class="text-danger">*</span></label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-addon bg-light border"><span
                                                                                class="fa fa-cubes"></span></span>
                                                                        <input type="number" class="form-control"
                                                                            name="quantity" value="{{ old('quantity') }}"
                                                                            placeholder="0" required>
                                                                    </div>
                                                                    @if ($errors->has('quantity'))
                                                                        <small
                                                                            class="text-danger">{{ $errors->first('quantity') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">মেয়াদ
                                                                    উত্তীর্ণের তারিখ </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-calendar"></span></span>
                                                                        <input type="date" class="form-control"
                                                                            value="{{ old('expire_date') }}"
                                                                            name="expire_date">
                                                                    </div>
                                                                    <div style="color:red">
                                                                        {{ $errors->first('expire_date') }}</div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">ক্রয়ের
                                                                    তারিখ </label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-calendar"></span></span>
                                                                        <input type="date" class="form-control"
                                                                            value="{{ old('purchase_date') }}"
                                                                            placeholder="Unit Price" name="purchase_date">
                                                                    </div>
                                                                    <div style="color:red">
                                                                        {{ $errors->first('purchase_date') }}</div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                <label
                                                                    class="col-md-4 col-form-label text-md-right">সিলেক্ট
                                                                    সাপ্লাইয়ার</label>
                                                                <div class="col-md-8">
                                                                    <select name="supplier_id" class="form-control">
                                                                        <span class="input-group-addon"><span
                                                                                class="fa fa-unlock-alt"></span></span>
                                                                        <option>
                                                                            সাপ্লাইয়ার সেলেক্ট করুন
                                                                        </option>
                                                                        @foreach ($getSupplier as $supplier)
                                                                            <option value="{{ $supplier->id }}"
                                                                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                                                {{ $supplier->name }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div style="color:red">{{ $errors->first('supplier_id') }}
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
                                        </div>
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
