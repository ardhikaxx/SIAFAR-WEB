@extends('layouts.app')

@section('content-customer')

<div class="flex flex-wrap gap-4 bg-neutral-100 overflow-x-hidden">
    <x-hero />
    <div class="flex flex-col">
        <x-discount-medicines />
        <x-list-medicines />
    </div>
    <x-scroll-comment />
</div>
@endsection