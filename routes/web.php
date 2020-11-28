<?php

use App\Http\Controllers\PublicationController;
use App\Models\Publication;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard/publications', [PublicationController::class, 'index'])->middleware('auth')->name('publications');

Route::get('dashboard/publications/create', [PublicationController::class, 'create'])->middleware('auth')->name('publications.create');
Route::get('dashboard/publication/{publication}/edit', [PublicationController::class, 'edit'])->middleware('auth')->name('publications.edit');
Route::put('dashboard/{publication}', [PublicationController::class, 'update'])->middleware('auth')->name('publications.update');
Route::post('dashboard/publications', [PublicationController::class, 'store'])->middleware('auth')->name('publications.store');
Route::delete('dashboard/publications/{publication}', [PublicationController::class, 'destroy'])->middleware('auth')->name('publications.destroy');


Route::get('dashboard/mypub', function(){
    return Inertia::render('Publications/MyPublications', [
        'publications' => auth()->user()->publications()->latest()->paginate(5)->transform(function ($publication) {
            return [
                "id" => $publication->id,
                "title" => $publication->title,
                "author" => $publication->user->name,
                "created_at" => $publication->created_at->diffforHumans(),
            ];
        })
    ]);
})->name('mypublications')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'publication' => Publication::count()
        ]
    ]);
})->name('dashboard');
