@extends('layouts.app_new')

@section('content')
<div class="container" style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Product Name') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('insert_manufacturer') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                       
                        <div class="form-group row">
                            <label for="manufacturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="manufacturer_name" type="text" class="form-control @error('manufacturer_name') is-invalid @enderror" name="manufacturer_name" value="{{ old('manufacturer_name') }}" required autocomplete="email">

                                @error('manufacturer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        </br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/product')}}"  class="btn btn-primary">
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
@endsection
