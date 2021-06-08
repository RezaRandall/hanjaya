<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Item Master PDF</title>
</head>
<body>
<style>
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
    #tdCenter{
        text-align: center;
    }
    #headerCaption {
        text-align: center;
        width: 100%;
    }
    .float-right {
        font-size: 10px;
    }
</style>
<!-- date -->
    <p class="float-right" >{{date('d/m/Y')}}</p><br>

<!-- header caption -->
    <div class="container">
        <p id=headerCaption>CV. INDOSIA <br> Stock Item</p>
    </div>
<!-- end of header caption -->

<!-- table -->
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Code</th>
                <th rowspan="2">Item Name</th>
                <th rowspan="2">Qty</th>
                <th rowspan="2">Uom</th>
                <th colspan="3">Price</th>
                <th rowspan="2">Date Time</th>
            </tr>
            <tr>
                <th>Agen</th>
                <th>Penyalur</th>
                <th>Eceran</th>
            </tr>
        </thead>
        @foreach($itemMasterPrint as $imp)
        <tbody>
            <tr>
                <td id="tdCenter">{{$loop->iteration}}</td>
                <td id="tdCenter">{{$imp->item_code}}</td>
                <td id="tdCenter">{{$imp->item_name}}</td>
                <td id="tdCenter">{{$imp->item_quantity}}</td>
                <td id="tdCenter">{{$imp->item_uom}}</td>
                <td>{{'Rp. '.$imp->item_price_agen}}</td>
                <td>{{'Rp. '.$imp->item_price_penyalur}}</td>
                <td>{{'Rp. '.$imp->item_price_eceran}}</td>
                <td id="tdCenter">{{date('d-m-Y H:i:s', strtotime($imp->log_date_time))}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
<!-- end of table -->
</body>
</html>
