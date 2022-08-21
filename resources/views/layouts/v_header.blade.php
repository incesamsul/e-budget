<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>e-budget</title>

  {{-- csrf token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  {{-- sweetalert --}}
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

</head>

@if (session('message'))
{{ sweetAlert(session('message'), 'success') }}
@endif
@if (session('error'))
{{ sweetAlert(session('error'), 'warning') }}
@endif
<div class="loader">
    <img src="{{ asset('img/svg_animated/loading.svg') }}" alt="loading">
</div>
