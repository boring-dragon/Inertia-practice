<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Publication;
use Faker\Provider\ar_JO\Internet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class PublicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Publications/Index', [
            'publications' => Publication::latest()->paginate(5)->transform(function ($publication) {
                return [
                    "id" => $publication->id,
                    "title" => $publication->title,
                    "created_at" => $publication->created_at->diffforHumans(),
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Publications/Create');
    }

    public function edit(Publication $publication)
    {
        return Inertia::render('Publications/Edit', [
            'publication' => [
                "id" => $publication->id,
                "title" => $publication->title,
                "author" => $publication->author,
                "content" => $publication->content
            ]
        ]);
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs["slug"] = Str::slug($inputs["title"]);
        Publication::create($inputs);

        return Redirect::route('publications')->with('success', 'Publication created.');
    }

    public function update(Publication $publication, Request $request)
    {
        $inputs = $request->all();
        $inputs["slug"] = Str::slug($inputs["title"]);

        $publication->update($inputs);

        return Redirect::back()->with('success', 'Publication updated.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return Redirect::back()->with('success', 'Publication deleted.');
    }
}
