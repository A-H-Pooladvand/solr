@extends('main._layouts.front.front')

@section('content')

    @include('main.front._partials.index-create')
    @include('main.front._partials.index-delete')
    @include('main.front._partials.document-truncate')
    @include('main.front._partials.document-seed')
    @include('main.front._partials.document-fields')

@endsection

