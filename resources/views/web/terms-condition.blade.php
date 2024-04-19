@extends('web.layout.master')

@section('content')

@php

    $page_data = DB::table('settings')->where('id','1')->pluck('termsAndConditions')->first();

@endphp

<section class="whowearesec">



    <div class="container my-5 privacypolicycontent" id="privacypolicycontent">

        {!! $page_data !!}

    </div>



</section>

@endsection