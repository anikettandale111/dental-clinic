@extends('layouts.app_new')
@style
@endstyle
@section('content')
<main id="main" class="main">
    <div>
        <title>Stock Details</title>
        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Category
                    </th>
                    <th>
                        Manufacture Name
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Unit
                    </th>
                    <th>
                        Available Quantity
                    </th>
                    <th>
                        Order Received Quantity
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($data AS $dt)
                    <tr>
                        <td>{{$dt->category_name}}</td>
                        <td>{{$dt->mn_name}}</td>
                        <td>{{$dt->pn_name}}</td>
                        <td>{{$dt->un_name}}</td>
                        <td>{{$dt->unit}}</td>
                        <td>{{$dt->received_qty}}</td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   


@endsection 