@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_store')}}"> Add Store </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email Id /User Id
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Location
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($data as $k =>$v)
                    <tr>
                        <td>
                            {{$v['name']}}
                        </td>
                        <td>
                            {{$v['email']}}
                        </td>
                        <td>
                            {{$v['address']}}
                        </td>
                        <td>
                            {{$v['location']}}
                        </td>
                        <td>
                            {{$v['status']}}
                        </td>
                        <td>
                            <a class="btn btn-primary edit" href="{{url('edit_details/'.$v['id'])}}">Edit</a>
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