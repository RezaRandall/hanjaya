<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Item Master PDF</title>
</head>
<body>
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 8pt;
		}
	</style>
        <!-- Table Header -->
<div class="containerListItemMaster">
    <div class="card">
        <div class="card-body">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">No</th>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">Code</th>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">Item Name</th>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">Qty</th>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">Uom </th>
                <th colspan="3" class="tbHeader" style="vertical-align : middle; text-align:center;">Price</th>
                <th rowspan="2" class="tbHeader" style="vertical-align : middle; text-align:center;">Date Time</th>
            </tr>
            <tr>
                <th class="tbHeaderRs" style="vertical-align : middle; text-align:center;">Agen</th>
                <th class="tbHeaderRs" style="vertical-align : middle; text-align:center;">Penyalur</th>
                <th class="tbHeaderRs" style="vertical-align : middle; text-align:center;">Eceran</th>
            </tr>
        </thead>
            @foreach($itemMasterPrint as $item)
        <tbody>
            <tr>
                <th scope="row" style="vertical-align : middle; text-align:center;">{{$loop->iteration}}</th>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->item_quantity }}</td>
                <td>{{ $item->item_uom }}</td>
                <td>{{ "Rp. ".$item->item_price_agen }}</td>
                <td>{{ "Rp. ".$item->item_price_penyalur }}</td>
                <td>{{ "Rp. ".$item->item_price_eceran }}</td>
                <td>{{date('d-m-Y H:i:s', strtotime($item->log_date_time))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
