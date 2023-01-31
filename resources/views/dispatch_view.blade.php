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
   
<script 
src="https://code.jquery.com/jquery-1.11.1.min.js"></script> // JQuery Reference

<script 
src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script 
src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js">
</script>
<link rel="stylesheet" 
href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" 
href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.css">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/
smoothness/jquery-ui.css">

<script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable({
           "pagingType": "full_numbers",
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
           "scrollY"  : "400px",
           
         });
    });
</script>

@endsection 