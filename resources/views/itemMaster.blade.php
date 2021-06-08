<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- external css -->
    <link href="{{ asset('asset/css/common.css')}}" rel="stylesheet" type="text/css" />
    <!-- external js -->
    <script type="text/javascript" src="{{ asset('asset/js/common.js')}}"></script>

    <title>Item Master</title>
  </head>
  <body>

<!-- Header Content Logo-->
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
                <h2>Item Master</h2>
            </div>
        </div>
    </div>
</div>

<!-- List Order Button and Search -->
<div class="containerListAndSearch">
<p>Welcome! {{ auth()->user()->name ?? '' }}<br> <a href="/logout">LogOut</a></p>
    <div class="row">
        <div class="col">
            <a href="/listOrderItem" class="btn btn-success" type=button >List Order</a>
        </div>
        <form action="itemMaster" method="POST" class="form-inline my-2 my-lg-0" >
        @csrf
            <div class="col">
                <div class="input-group-prepend">
                    <input type="search" class="form-control mr-sm-2" name="searchItem" placeholder="Search Item.." aria-label="Search">
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Button Trigger the modal with a Row Add Item -->
<div class="containerAdd">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-addItem-modal-lg">Add Item</button> <!--id="option2" -->
            </div>
        </div>
    </div>
</div>

<!-- large Modal Insert dialog-->
<div class="container">
    <div class="modal fade bd-addItem-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <form action="/itemMaster/storeItemMaster" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Item Master</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputCode" name="CodeItem" required autocomplete="off">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="NameItem" required autocomplete="off">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Qty</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control numOnly" id="inputQty" name="QtyItem" required autocomplete="off">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Uom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputUom" name="UomItem" required>
                                </div>
                        </div>
                        <div class="form-row">
                        <label for="" class="col-sm-2 col-form-label">Price</label>
                            <div class="form-group col-md-3">
                                <label for="inputAgen">Agen</label>
                                <input class="form-control numOnly" id="inputAgen" type="text" name="PriceAgen" required autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPenyalur">penyalur</label>
                                <input class="form-control numOnly" id="inputPenyalur" type="text" name="PricePenyalur" required autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEceran">Eceran</label>
                                <input class="form-control numOnly" id="inputEceran" type="text" name="PriceEceran" required autocomplete="off">
                            </div>
                        </div>
                         <div class="modal-footer">
                           <button type="submit" class="btn btn-default" onclick="return confirm('Are you sure want to save this item?')">Save</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="containerListAndSearch" style="border-bottom: 3px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
<!-- Button Print -->
    <a href="/itemMaster/print_pdf" type="button" class="btn btn-warning btn-sm" target="_blank">PDF</a>
    <div>
        <br/>
    </div>
<!-- Table Header -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="tbHeader" >No</th>
                    <th rowspan="2" class="tbHeader">Code</th>
                    <th rowspan="2" class="tbHeader">Item Name</th>
                    <th rowspan="2" class="tbHeader">Qty</th>
                    <th rowspan="2" class="tbHeader">Uom</th>
                    <th colspan="3" class="tbHeader">Price</th>
                    <th rowspan="2" class="tbHeader">Date Time</th>
                    <th rowspan="2" class="tbHeader">Action</th>
                </tr>
                <tr>
                    <th class="tbHeaderRs">Agen</th>
                    <th class="tbHeaderRs">Penyalur</th>
                    <th class="tbHeaderRs">Eceran</th>
                </tr>
            </thead>
            @foreach($item_master as $item)
            <tbody>
                <tr>
                    <th scope="row" class="tbActionBtn">{{$loop->iteration}}</th>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->item_quantity }}</td>
                    <td>{{ $item->item_uom }}</td>
                    <td>{{ "Rp. ".$item->item_price_agen }}</td>
                    <td>{{ "Rp. ".$item->item_price_penyalur }}</td>
                    <td>{{ "Rp. ".$item->item_price_eceran }}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($item->log_date_time))}}</td><!-- {{date('d-m-Y', strtotime($item->log_date_time))}}  OR DEFAULT {{$item->log_date_time}} -->
                    <td class="tbActionBtn">
                        <a href="/itemMaster/edit/{{ $item->item_id }}" class="btn btn-success btn-sm" type=button >Edit</a>
                        <a href="/itemMaster/deleteItemMaster/{{ $item->item_id }}" class="btn btn-danger btn-sm" role="button" onclick="return confirm('Are you sure want to delete this item?')">Delete</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-right">
                <a href="/orderProcess" class="btn btn-sm btn-primary" type=button >Order</a>
            </div>
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
