@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <!-- SubCategory List -->
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>images</th>
                                    <th>Products Name En</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <img src="{{asset($item->product_thambnail)}}" width="80px">
                                        </td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->selling_price }}</td>
                                        <td>
                                            @if ($item->selling_price == NULL)
                                                <span class="badge badge-danger">No Discount</span>
                                            @else
                                                @php
                                                    $amount = $item->selling_price - $item->discount_price;
                                                    $discount =($amount/$item->selling_price) * 100;
                                                @endphp
                                                <span class="badge badge-success">{{round($discount)}} % </span>
                                            @endif
                                        </td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>
                                            @if ($item->status == 1)
                                               <span class="badge badge-success">Active</span>
                                            @else
                                               <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-primary mb-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger mb-2" id="delete">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            @if ($item->status == 1)
                                            <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-danger mb-2" title="InActive">
                                                <i class="fa fa-arrow-down"></i>
                                            </a>       
                                            @else
                                            <a href="{{ route('product.active', $item->id) }}" class="btn btn-primary mb-2" title="Active">
                                                <i class="fa fa-arrow-up"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

    </div>
</section>
<!-- /.content-wrapper -->

@endsection
