@extends('layouts.app')

@section('title', __('message.Sign_In') . ' - ' . config('app.name'))

@section('content')


    @livewire('auth.login')


@endsection