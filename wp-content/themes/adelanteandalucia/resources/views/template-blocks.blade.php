{{--
  Template Name: Página de bloques
--}}

@extends('layouts.app')

@section('content')

@while (have_rows('blocks')) @php(the_row())
  @include('partials.block-' . get_row_layout())
@endwhile

@endsection


