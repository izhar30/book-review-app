<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// this one is without rating order


// Route::get('/', function () {
//     $books = Book::all();
//     return view('book' , compact('books'));
// })->name('home');

// for shorting the most rated book order

Route::get('/', function () {
    $books = Book::with('reviews')
        ->leftJoin('reviews', 'books.id', '=', 'reviews.book_id') // Join reviews table
        ->select('books.*', DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating')) // Calculate average
        ->groupBy('books.id', 'books.title', 'books.author', 'books.images', 'books.created_at', 'books.updated_at') // Group by book fields
        ->orderByDesc('avg_rating')
        ->get();

    return view('book', compact('books'));
})->name('home');


Route::get('/dashboard', function () {
    $books = Book::all();
    return view('dashboard', compact('books'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

require __DIR__.'/auth.php';
