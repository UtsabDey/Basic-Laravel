@extends('layout.master')
@section('title','About')
@push('styles')
<style>
.post{
    tab-size: 0mm;
}    
</style>
@endpush
@section('content')
<h1>{{$show}}</h1>
<h2>Current Date & Time: {{$datetime}}</h2>
@endsection