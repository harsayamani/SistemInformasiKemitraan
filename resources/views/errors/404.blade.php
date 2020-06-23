@extends('errors::minimal')
<h2>{{ $exception->getMessage() }}</h2>

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
