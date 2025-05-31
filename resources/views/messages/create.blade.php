@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Envoyer un message à {{ $receiver->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('messages.envoyer', $receiver->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="contenu" class="form-label">Message :</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>
@endsection