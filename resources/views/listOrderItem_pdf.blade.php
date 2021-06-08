<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>List Order PDF</title>
</head>
<body>
<style>
    .float-right {
        font-size: 10px;
    }
    #headerCaption {
        text-align: center;
        width: 100%;
    }
    table { width: 100%;}
    th {
        border: 1px solid black;
        border-collapse: collapse;
        padding:0px;
        text-align: center;
        font-size: 10pt;
    }
    td {
        border: 1px solid black;
        font-size: 10pt;
    }
    td.borderNone {
        border-width: 0px;
        border-style: none !important;
    }
    #tdCenter{
        text-align: center;
    }
    tbody tr td {
        vertical-align : middle; text-align:center;
    }
</style>
<!-- date -->
    <p class="float-right">{{date('d/m/Y')}}</p><br>

<!-- header caption -->
    <div class="container">
        <p id=headerCaption>CV. INDOSIA <br> Stock Item</p>
    </div>
<!-- end of header caption -->

<!-- table -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Item Name</th>
            <th>Qty</th>
            <th>Uom</th>
            <th>Price</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <?php $total=0 ?>
    @foreach($listOrderItem as $loi)
    <tbody>
        <tr>
            <td >{{$loop->iteration}}</td>
            <td>{{ $loi->customer_name }}</td>
            <td>{{ $loi->phone }}</td>
            <td>{{ $loi->address }}</td>
            <td>{{ $loi->item_name }}</td>
            <td >{{ $loi->qty }}</td>
            <td>{{ $loi->uom }}</td>
            <td>{{'Rp. '.$loi->item_price }}</td>
            <td>{{'Rp. '.$loi->total_price }}</td>
            <td >{{ $loi->status }}</td>
            <td style="text-align: center;">{{ date('d/m/Y', strtotime($loi->log_date_time)) }}</td>
            <div style="display: none">{{$total += $loi->total_price}}</div>
        </tr>
    </tbody>
    @endforeach
    <tfoot>
        <tr>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        <td class="borderNone centerTxt font-weight-bold">Total :</td>
        <td class="borderNone font-weight-bold">{{'Rp. '.$total}}</td>
        <td class="borderNone"></td>
        <td class="borderNone"></td>
        </tr>
    </tfoot>
</table>
<!-- end of table -->
</body>
</html>
