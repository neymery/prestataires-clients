<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PrestataireResource;
use App\Models\Prestataire;
use Illuminate\Http\Request;

class PrestataireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $prestataires = Prestataire::with(['user', 'categories'])->get();
        return PrestataireResource::collection($prestataires);
    }

    public function show(Prestataire $prestataire)
    {
        return new PrestataireResource($prestataire->load(['user', 'categories']));
    }

    public function search(Request $request)
    {
        $query = Prestataire::query()->with(['user', 'categories']);

        if ($request->has('categorie')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('id', $request->categorie);
            });
        }

        if ($request->has('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        return PrestataireResource::collection($query->get());
    }
}
