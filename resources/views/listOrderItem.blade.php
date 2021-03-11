<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <!-- DatePicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- external css -->
    <link href="{{ asset('asset/css/common.css')}}" rel="stylesheet" type="text/css" />
    <!-- external js -->
    <script type="text/javascript" src="{{ asset('asset/js/common.js')}}"></script>

    <title>List Order</title>
</head>
<body>
<!-- Header Content -->
<div class="containerHeader">
    <div class="row">
        <div class="col-md-6">
            <div class="text-left">
                <img class="imageLogoSize" src="{{ asset('asset/img/sakanato.png') }}" alt="logoHeader">
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-right" style="margin-top:30px;">
                <h2>List Order</h2>
            </div>
        </div>
    </div>
</div>

<!-- PDF & Search by date -->
<div class="containerListAndSearch">
    <form action="listOrderItem" method="POST">
    <!-- {{ csrf_field() }} -->
    @csrf
        <div class="row">
            <div class="col">
                <a href="/itemMaster" class="btn btn-success btn-sm float-left" type=button >Item Master</a>
            </div>
            <div class="col">
                <a href="/orderProcess" class="btn btn-primary btn-sm float-left" type=button >Make Order</a>
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                Start Date
            </div>
            <div class="col-md-auto d-flex p-2">
                <input type="date" id="date" class="form-control float-right" name="fromDate">
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                End Date
            </div>
            <div class="col-md-auto d-flex p-2">
                <input type="date" id="date" class="form-control float-right" name="toDate">
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                <button type="submit" class="btn btn-success btn-sm float-right">Filter</button>
            </div>
        </div>
    </form>
</div>

<!-- Table Header -->
<div class="containerListItemMaster">
    <a href="/listOrderItem/print_pdf" type="button" class="btn btn-warning btn-sm" target="_blank">PDF</a>
    <div>
        <br/>
    </div>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="tbHeader">No</th>
                    <th class="tbHeader">Customer Name</th>
                    <th class="tbHeader">Phone</th>
                    <th class="tbHeader">Address</th>
                    <th class="tbHeader">Item Name</th>
                    <th class="tbHeader">Qty</th>
                    <th class="tbHeader">Uom</th>
                    <th class="tbHeader">Price</th>
                    <th class="tbHeader">Total</th>
                    <th class="tbHeader">Status</th>
                    <th class="tbHeader">Date</th>
                </tr>
            </thead>
            @foreach($orderList as $order)
            <tbody>
                <tr>
                    <td class="tbCenter">{{$loop->iteration}}</td>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->item_name}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{$order->uom}}</td>
                    <td>{{$order->item_price}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->status}}</td>
                    <td type="date" style="text-align: center;">{{ date('d-m-Y', strtotime($order->log_date_time)) }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
