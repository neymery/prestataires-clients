@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Bienvenue, {{ Auth::user()->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Mes Services</h5>
                                    <p class="card-text">Gérer vos services et catégories</p>
                                    <a href="#" class="btn btn-light">Voir plus</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Mes Clients</h5>
                                    <p class="card-text">Consulter vos clients et messages</p>
                                    <a href="{{ route('messages.index') }}" class="btn btn-light">Voir plus</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Mes Avis</h5>
                                    <p class="card-text">Voir et gérer vos avis</p>
                                    <a href="#" class="btn btn-light">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection