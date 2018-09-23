@extends('layouts.app')

@section('content')
    <h1>{{ __('Hello World') }}</h1>

    <p>
        {{ __('This view is loaded from module') }}
    </p>

    <p>
        {{ __('This is text from the third party composer package: :text', ['text' => (new \Rivsen\Demo\Hello())->getName()]) }}
    </p>
@stop
