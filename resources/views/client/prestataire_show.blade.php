<form action="{{ route('avis.store') }}" method="POST">
    @csrf
    <input type="hidden" name="prestataire_id" value="{{ $prestataire->id }}">

    <div class="mb-3">
        <label for="note">Note :</label>
        <select name="note" id="note" class="form-select" required>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} ★</option>
            @endfor
        </select>
    </div>

    <div class="mb-3">
        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
