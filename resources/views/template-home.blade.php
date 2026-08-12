{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
    @include('sections.home-hero')
    @include('sections.home-categories')
    @include('sections.home-services')
    @include('sections.home-teams')
    @include('sections.home-project-logo')
@endsection
