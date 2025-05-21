<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKey::where('user_id', auth()->id())->get();
        return view('dashboard.api-keys.index', compact('apiKeys'));
    }

    public function create()
    {
        return view('dashboard.api-keys.create');
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

    public function destroy(ApiKey $apiKey)
    {
        if ($apiKey->user_id !== auth()->id()) {
            abort(403);
        }

        $apiKey->delete();
        return redirect()->route('api-keys.index')->with('success', 'Clé API supprimée.');
    }
}