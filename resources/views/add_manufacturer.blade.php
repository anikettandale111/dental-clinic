@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Add Manufacturer') }}</div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                    @endif
                    <div class="col-md-5">
                        <form method="POST" action="{{ url('insert_manufacturer') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="form-group row">
                                <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                                <div class="col-md-6">
                                    <select class="category_name form-select" name="category_name">
                                        
                                        @foreach($Category as $k => $v)
                                            <option value="{{$v['id']}}">{{$v['category_name']}}</option>
                                        @endforeach    
                                    </select>
                                   
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="manufacturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>

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
                                    <a href="{{url('/product')}}" class="btn btn-primary">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
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
                                            @if(isset($v['category']))
                                            {{$v['category']['category_name']}}
                                            @else
                                            -
                                            @endif
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
                                            <a class="btn btn-primary edit" href="{{url('edit_manufacturer/'.$v['id'])}}">Edit</a>
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