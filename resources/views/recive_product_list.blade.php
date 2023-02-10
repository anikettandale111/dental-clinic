@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/scan_product')}}"> Product Scan </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Category Name
                    </th>
                    <th>
                        Manufacturer Name
                    </th>
                    <th>
                        Unit Size
                    </th>
                    <th>
                        Dispatch Quantity
                    </th>
                    <th>
                        Product Cost
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($data as $k =>$v)
                    <tr>
                        <td>
                            {{$v['product_model']['name']}}
                        </td>
                        <td>
                            {{$v['category_model']['category_name']}}
                        </td>
                        <td>
                            {{$v['manufacturer_model']['name']}}
                        </td>
                        <td>
                            {{$v['unit_model']['name']}}
                        </td>

                        <td>
                            {{$v['qty']}}
                        </td>
                        <td>
                            {{$v['cost']}}
                        </td>
                        <td>
                            <span style="color:red;">Pending</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   
@endsection 