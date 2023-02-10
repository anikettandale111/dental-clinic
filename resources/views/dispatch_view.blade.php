@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_dispatch')}}"> Add Dispatch </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Barcode
                    </th>
                    <th>
                        Branch Name
                    </th>
                    <th>
                        Branch Location
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Dispatched Quantity
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Dispatched By
                    </th>
                    <th>
                        Photo
                    </th>
                    <!-- <th>
                        Action
                    </th> -->
                </tr>
            </thead>

            <tbody>
                
                @foreach($dispatch_data as $k =>$v)
                    <tr>
                        <td>
                            {{$v['barcode_id']}}
                        </td>
                        <td>
                            {{$v['branch_name']}}
                        </td>
                        <td>
                            {{$v['location']}}
                        </td>
                        <td>
                            {{$v['p_name']}}
                        </td>
                        <td>
                            {{$v['received_qty']}}
                        </td>
                        <td>
                            {{$v['created_at']}}
                        </td>
                        <td>
                            {{$v['u_name']}}
                        </td>
                        <td>
                            <img src="{{URL::to('/').'/images/'.$v['photo']}}" alt="{{$v['manufacture_name']}}" style="width: 100px; height: 50px;">
                        </td>
                        <!-- <td>
                            <a class="btn btn-primary edit" href="{{url('/edit_stock/'.$v['id'])}}">Edit</a>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->

@endsection 