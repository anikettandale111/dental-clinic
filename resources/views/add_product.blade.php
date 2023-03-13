@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <div class="card-header">{{ __('Add Product') }}</div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                    @endif
                    <div class="col-md-4">
                        <form method="POST" action="{{ url('set_product') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                            <div >
                                <label for="category_name" class="col-form-label text-md-right">{{ __('Category Name') }}</label>
                                <select class="category_name form-select" name="category_name" onchange="ManufactureFunction()">
                                    <option value="0">--Select--</option>
                                    @foreach($category as $k => $v)
                                    <option value="{{$v['id']}}">{{$v['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div >
                                <label for="manufacturer_name" class="col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                                <select class="manu_select form-select" name="manu_name" id="manu_name">
                                </select>
                            </div>
                            <div >
                                <label for="product_name" class="col-form-label text-md-right">{{ __('Product Name') }}</label>
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="email">

                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            </br>
                            <div class="form-group row mb-0">
                                <div >
                                    <button type="submit" class="btn btn-primary btn-save-width">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{url('/product')}}" class="btn btn-secondary btn-save-width">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div>
                            <table id="table_id" class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            Category Name
                                        </th>
                                        <th>
                                            Manufacturer Name
                                        </th>
                                        <th>
                                            Product Name
                                        </th>
                                        <th>
                                            Status
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
                                            {{$v['category_model']['category_name']}}
                                        </td>
                                        <td>
                                            {{$v['manufacturer_model']['name']}}
                                        </td>
                                        <td>
                                            {{$v['name']}}
                                        </td>
                                        <td>
                                            @if($v['is_active'] == 1)
                                            Active
                                            @else
                                            InActive
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-primary edit" href="{{url('edit_product/'.$v['id'])}}">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('child-scripts')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function ManufactureFunction() {
            var category_name = $('.category_name').val();
            $(".manu_select").empty();
            if (category_name != 0) {
                $.ajax({
                    url: '/get_manuf_data',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        category_id: category_name
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        var str = '';
                        $.each(data.data, function(i, val) {
                            str += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $(".manu_select").html(str);
                    }
                });
            } else {
                alert("Please Select Category");
                return false;
            }
        }
    </script>
    @endpush