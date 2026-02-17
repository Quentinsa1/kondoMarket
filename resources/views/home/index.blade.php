@extends('template.template')

@section('title', 'Kondo Market - Marketplace B2B & B2C Internationale')

@section('content')
    @include('home.sections.hero')
    @include('home.sections.featured-categories')
    @include('home.sections.trending-products')
    @include('home.sections.products-by-category')
    @include('home.sections.top-vendors')
    @include('home.sections.daily-deals')
    @include('home.sections.new-arrivals')
    @include('home.sections.recommendations')
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush