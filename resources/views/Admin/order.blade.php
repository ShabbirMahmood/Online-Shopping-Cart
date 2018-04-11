@extends('layouts.master')

@section('title')
    New Product
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Producs Order Lists</h1>
            <hr>
            <table id="example" class="display " cellspacing="0" width="100%">
                <thead>
                <!-- Header Row -->
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Products & Quantity</th>
                    <th>TotalPrice</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($shipments as $shipment)
                    <tr>
                        <td>{{$shipment->user->name}}</td>
                        <td>{{$shipment->user->address}}</td>
                        <td>{{$shipment->user->phone}}</td>
                        <td>{{$shipment->user->email}}</td>
                        <td>
                        @foreach($shipment->cart->items as $item)
                            {{ $item['item']['code'] }} {{" | "}}  {{ $item['qty'] }} {{",  "}}
                        @endforeach
                        </td>
                        <td>{{$shipment->price}}</td>
                        <td>
                            <a href="{{ route('confirmShipment', ['id' => $shipment->id]) }}" class="btn btn-success pull-left" role="button"><span class="glyphicon glyphicon-send"></span> Confirm</a>

                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
@endsection
