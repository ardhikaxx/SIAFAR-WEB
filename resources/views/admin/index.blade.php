@extends('layouts.adminlte')

@section('content')
<x-card :transactionIn="$transactionIn" :transactionOut="$transactionOut" :medicines="$medicines" :users="$users" />
@endsection