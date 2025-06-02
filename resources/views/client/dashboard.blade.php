<!-- resources/views/client/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Bienvenue {{ auth()->user()->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection