<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <!-- external css -->
    <link href="{{ asset('asset/css/common.css')}}" rel="stylesheet" type="text/css" />
    <!-- external js -->
    <script type="text/javascript" src="{{ asset('asset/js/common.js')}}"></script>

    <title>Order Process</title>
</head>
<body>
<!-- Header Content -->
    <div class="containerHeader">
        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
                    <a href="/itemMaster">
                        <img class="imageLogoSize" src="{{ asset('asset/img/ind3.png') }}" alt="logoHeader">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="align-middle text-right" style="padding: 15px 20px;">
                    <h2>Order Process</h2>
                </div>
            </div>
        </div>
    </div>

<!-- List Orders -->
<div class="containerListAndSearch">
    <div class="row">
        <div class="col" style='float: left; padding: 0px 0px 0px 25px'>
            <a href="/itemMaster" class="btn btn-success btn-sm float-left" type=button >Item Master</a>
        </div>
        <div class="col" style='float: right; padding: 0px 25px 0px 0px'>
            <a href="/listOrderItem" class="btn btn-success btn-sm text-right" type=button >List Order</a>
        </div>
    </div>
</div>

<!-- Table Header -->
<div class="containerListItemMaster">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="orderProcess/storeOrder">
            {{ csrf_field() }}
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th class="tbHeaderOrder">Customer Name </th>
                        <th>
                            <input type="text" class="form-control" name="customerName" id="customerName" required>
                        </th>
                        <th></th>
                        <th class="tbHeaderOrder">Phone</th>
                        <th>
                            <input type="text" class="form-control numOnly" name="phone" id="phone" required>
                        </th>
                    </tr>
                    <tr>
                        <th class="tbHeaderOrder">Address</th>
                        <th>
                            <input class="form-control" type="text" name="address" id="address" required>
                        </th>
                        <th></th>
                        <th class="tbHeaderOrder">Item Name</th>
                        <th>
                            <select name="itemIdSelected" id="itemNameSelected" class="form-control nameItem" >
                                <option value="0" disabled="true" selected="true" >Select Item Name</option>
                                @foreach($listItem as $item)
                                <option value="{{ $item->item_id }}:{{$item->item_name}}">{{ $item->item_name }}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th class="tbHeaderOrder">Quantity</th>
                        <th>
                            <input type="text" class="form-control numOnly" name="qty" id="qty" required>
                        </th>
                        <th>
                            <input class="form-control" type="text" id="qtyReady" name="qtyReady" readonly>
                        </th>
                        <th class="tbHeaderOrder">UOM</th>
                        <th>
                            <input class="form-control" type="text" name="uom" id="uom" required>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <br>
                        </th>
                    </tr>
                    <tr>
                        <th class="tbHeaderOrder">Price</th>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="chkAgen" id="agenCbx" >
                                <label class="custom-control-label" for="agenCbx" value="Agen">Agen</label>
                                <input class="form-control" id="priceAgen" name="prcAgen" type="text" readonly />
                            </div>
                        </th>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="chkPenyalur" id="penyalurCbx" >
                                <label class="custom-control-label" for="penyalurCbx">Penyalur</label>
                                <input class="form-control" id="pricePenyalur" name="prcPenyalur" type="currency" readonly />
                            </div>
                        </th>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="chkEceran" id="eceranCbx" >
                                <label class="custom-control-label" for="eceranCbx">Eceran</label>
                                <input class="form-control" id="priceEceran" name="prcEceran" type="currency" readonly />
                            </div>
                        </th>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <label class="custom-control-label" for="defaultunchecked">Total</label>
                                <input class="form-control" name="totalPrice" id="totalPrice" type="currency" readonly >
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="tbHeaderOrder">Status</th>
                        <th >
                            <input type="text" class="form-control " name="status" id="status" required>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-right">
                <input type="submit" class="btn btn-success" value="Confirm Order">
            </div>
        </div>
    </div>
    </form>
</div>
</body>
</html>
