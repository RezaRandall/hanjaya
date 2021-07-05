<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->

    <!-- DatePicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- HighChart CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

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
                <a href="/itemMaster">
                    <img class="imageLogoSize" src="{{ asset('asset/img/ind3.png') }}" alt="logoHeader">
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="align-middle text-right" style="padding: 30px;">
                <h2>List Order</h2>
            </div>
        </div>
    </div>
</div>

<div class="containerListAndSearch">
    <form action="listOrderItem" method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <a href="/itemMaster" class="btn btn-success btn-sm float-left">Item Master</a>
        </div>
        <div class="col">
            <a href="/orderProcess" class="btn btn-primary btn-sm float-right" type=button >Make Order</a>
        </div>
    </div>
</div>

<!-- Search by date and by name -->
<div class="containerFilter">
    @csrf
        <div class="row float-right">
            <div class="col-md-auto d-flex p-2">
                <select name="itemFiltered" id="itemFiltered" class="form-control nameItemFilter">
                    <option value="0" selected="true">All Data</option>
                    @foreach($dataItem['items'] as $i)
                    <option value="{{$i->item_id}}">{{$i->item_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                Start Date
            </div>
            <div class="col-md-auto d-flex p-2">
                <input type="date" id="dateStart" class="form-control float-right" name="fromDate">
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                End Date
            </div>
            <div class="col-md-auto d-flex p-2">
                <input type="date" id="dateEnd" class="form-control float-right" name="toDate">
            </div>
            <div class="col-md-auto text-right d-flex p-2">
                <button type="submit" class="btn btn-success btn-sm float-right" id="filter">Filter</button>
            </div>
        </div>
    </form>
</div>
<!-- end of Search by date and by name -->

<!-- PDF Button -->
    <div class="containerListItemMaster">
    <a href="/listOrderItem/print_pdf" type="button" class="btn btn-warning btn-sm" target="_blank">PDF</a>
    <div>
<!-- end of PDF Button -->
        <br/>

<!-- table header -->
    </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="border: 3px solid black !important;">
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
            <?php $total=0 ?>
            @foreach($dataOrder['orders'] as $o)
            <tbody>
                <tr>
                    <td class="tbCenter">{{$loop->iteration}}</td>
                    <td>{{$o->customer_name}}</td>
                    <td>{{$o->phone}}</td>
                    <td>{{$o->address}}</td>
                    <td>{{$o->item_name}}</td>
                    <td>{{$o->qty}}</td>
                    <td>{{$o->uom}}</td>
                    <td>{{"Rp. ".$o->item_price}}</td>
                    <td>{{"Rp. ".$o->total_price}}</td>
                    <td>{{$o->status}}</td>
                    <td type="date" style="text-align: center;">{{ date('d-m-Y', strtotime($o->log_date_time)) }}</td>
                    <div style="display: none">{{$total += $o->total_price}}</div>
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
                    <td class="centerTxt font-weight-bold">Total :</td>
                    <td class="borderNone font-weight-bold">{{"Rp. ".$total}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
<!-- end of table header -->

<!-- Chart section  -->
    <div class="panel">
        <div id="chartSelling"></div>
    </div>
<!-- End of Graphic Chart -->
</div>

<script type="text/javascript">
    Highcharts.chart('chartSelling', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Sales'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Terjual (liter)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: {},
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }]
    });
</script>
</body>
</html>
