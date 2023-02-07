@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_stock')}}"> Add Stock </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
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
                        Usage
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Unit
                    </th>
                    <th>
                        Photo
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
                            {{$v['category']}}
                        </td>
                        <td>
                            {{$v['manufacture_name']}}
                        </td>
                        <td>
                            {{$v['product_name']}}
                        </td>
                        <td>
                            {{$v['usage']}}
                        </td>
                        <td>
                            {{$v['qty']}}
                        </td>
                        <td>
                            {{$v['unit']}}
                        </td>
                        <td>
                            <img src="{{URL::to('/').'/images/'.$v['photo']}}" alt="{{$v['manufacture_name']}}" style="width: 100px; height: 50px;">
                        </td>
                        <td>
                            <a class="btn btn-primary edit" href="{{url('/edit_stock/'.$v['id'])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   


@endsection 