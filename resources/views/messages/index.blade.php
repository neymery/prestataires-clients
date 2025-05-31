@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📥 Messages reçus</h2>
    @foreach($messagesRecus as $msg)
        <div class="border p-2 my-1">
            <strong>{{ $msg->expediteur->name }}</strong> : {{ $msg->contenu }}
            <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
        </div>
    @endforeach

    <hr>

    <h2>📤 Messages envoyés</h2>
    @foreach($messagesEnvoyes as $msg)
        <div class="border p-2 my-1">
            À <strong>{{ $msg->destinataire->name }}</strong> : {{ $msg->contenu }}
            <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
        </div>
    @endforeach
</div>
@endsection
