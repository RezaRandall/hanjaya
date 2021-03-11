<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>List Order PDF</title>
  </head>
  <body>
  <style type="text/css">
		table tr td,
		table tr th{
			font-size: 8pt;
		}
	</style>
  <div class="containerListItemMaster">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">No</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Customer Name</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Phone</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Address</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Item Name</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Qty</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Uom</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Price</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Total</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Status</th>
                        <th class="tbHeader" style="vertical-align : middle; text-align:center;">Date</th>
                    </tr>
                </thead>
                @foreach($listOrderItem as $order)
                <tbody>
                    <tr>
                        <td style="vertical-align : middle; text-align:center;">{{$loop->iteration}}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->item_name }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ $order->uom }}</td>
                        <td>{{ $order->item_price }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->status }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($order->log_date_time)) }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
