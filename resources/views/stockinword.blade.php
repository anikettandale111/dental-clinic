@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <div class="card-body">
                    <table id="table_id" class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Manufacturer</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Rate</th>
                                <th>Stock Add Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result AS $key => $vl)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ucfirst($vl->pn_name)}}</td>
                                <td>{{ucfirst($vl->category_name)}}</td>
                                <td>{{ucfirst($vl->mn_name)}}</td>
                                <td>{{$vl->qty}}</td>
                                <td>{{$vl->name}}</td>
                                <td>{{$vl->cost}}</td>
                                <td>{{$vl->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 