<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    // 🔑 Liste des clés API de l'utilisateur
    public function index()
    {
        $apiKeys = ApiKey::where('user_id', auth()->id())->get();

        return Inertia::render('ApiKeys/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    
    public function create()
    {
        return Inertia::render('ApiKeys/Create');
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ApiKey::create([
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
            'name' => $request->name,
            'key' => Str::random(40),
        ]);

        return redirect()->route('api-keys.index')->with('success', 'Clé API créée !');
    }

    // ❌ Suppression d'une clé API
    public function destroy(ApiKey $apiKey)
    {
        if ($apiKey->user_id !== auth()->id()) {
            abort(403);
        }

        $apiKey->delete();

        return redirect()->route('api-keys.index')->with('success', 'Clé API supprimée.');
    }
}
