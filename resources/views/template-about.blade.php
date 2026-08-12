{{--
  Template Name: About Template
--}}

@extends('layouts.app')

@section('content')
    @include('sections.about-hero')
    @include('sections.about-services')
    @include('sections.about-award')
    @include('sections.about-vision')
    @dump($forms)
    <x-form-popup :forms="$forms" />
@endsection
