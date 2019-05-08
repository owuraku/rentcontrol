@extends('layouts.master')

@section('content')
<div class="row">

        <div class=" ml-auto mr-auto col-sm-6 col-md-8 col-lg-9">
            <!--  -->

            @if (Route::currentRouteName()=='property.me')
                @include('properties.myproperties')
            @endif

            <!-- Product -->
           @include('properties.property')


        </div>
    </div>

    @endsection
