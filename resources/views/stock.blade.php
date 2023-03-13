@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
                <div class="card-body col-md-6">
                    <form method="POST" action="{{ url('stock_register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <div>
                            <label for="category" class=" col-form-label text-md-right">{{ __('Category') }}</label>
                            <select name="category" class="form-select">
                                @foreach($category as $k => $val)
                                <option value="{{$val['id']}}">{{$val['category_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="manufacture_name" class=" col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                            <select name="manufacture_name" class="form-select">
                                @foreach($manu as $k => $val)
                                <option value="{{$val['id']}}">{{$val['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="product_name" class=" col-form-label text-md-right">{{ __('Product Brand/Model Name') }}</label>
                            <select name="product_name" class="form-select">
                                @foreach($product_name as $k => $val)
                                <option value="{{$val['id']}}">{{$val['name']}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div>
                            <label for="usage" class=" col-form-label text-md-right">{{ __('Usage') }}</label>
                            <input id="usage" type="text" class="form-control @error('usage') is-invalid @enderror" name="usage" value="{{ old('usage') }}" required autocomplete="usage">

                            @error('usage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="qty" class=" col-form-label text-md-right">{{ __('Quantity') }}</label>
                            <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required autocomplete="qty">

                            @error('qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="cost" class=" col-form-label text-md-right">{{ __('Cost Price/Unit') }}</label>
                            <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}" required autocomplete="cost">
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="unit" class=" col-form-label text-md-right">{{ __('Unit') }}</label>
                            <select name="unit" class="form-select">
                                @foreach($unit as $k => $val)
                                <option value="{{$val['id']}}">{{$val['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tags" class=" col-form-label text-md-right">{{ __('Tags') }}</label>
                            <input id="tags" type="text" class="form-control" name="tags" value="{{ old('tags') }}" required autocomplete="tags">
                            @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="photo" class=" col-form-label text-md-right">{{ __('Photo') }}</label>


                            <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}" autocomplete="photo">
                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class=" col-form-label text-md-right">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" cols="4"> </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-save-width">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/store-eq')}}" class="btn btn-secondary btn-save-width">
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