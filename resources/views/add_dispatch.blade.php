@extends('layouts.app_new')

@section('content')
<div class="container" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dispatch Stock') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('insert_dispatch') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Receiver Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="reciver_id" id="reciver_id">
                                    <option disabled selected> Select Name</option>
                                    <option value="AAA">AAA</option>
                                    <option value="BBB">BBB</option>
                                    <option value="CCC">CCC</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Scan Barcode') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="barcode_text" id="barcode_text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Product Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="product_name" id="product_name" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Category Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="category_name" id="category_name" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Unit Size') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="prd_unit" id="prd_unit" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Dispatch Quantity') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="disp_quantity" id="disp_quantity" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Product Image') }}</label>
                            </div>
                            <div class="col-md-8">
                                <img src="" class="form-control" name="product_image" id="product_image" ></img>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/dispatch')}}"  class="btn btn-primary">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
$("#barcode_text").on('keyup focus', function(e) {
    if($.isNumeric($(this).val()) && $(this).val().length >= 6){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/get_bar_code_data',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, barcode_text:$(this).val()},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                $('#product_name').val(data.product_name);
                $('#category_name').val(data.category);
                $('#prd_unit').val(data.unit);
                $('#product_image').attr('src','/images/'+data.photo);
            }
        });
    }
});
</script>
@endsection