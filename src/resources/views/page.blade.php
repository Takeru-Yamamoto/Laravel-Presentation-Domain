@extends('mycustom::base')

@section('body')
    <div class="wrapper">
        @include("mycustom::components.page.navbar")

        @include("mycustom::components.page.sidebar")

        @include("mycustom::components.page.content")

        @include("mycustom::components.page.footer")
    </div>
@stop
