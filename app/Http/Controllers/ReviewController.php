<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request)
    {
        // dd($request->all);
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        $existingReview = Review::where('book_id', $request->book_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('danger', 'You have already reviewed this book.');
        }

        Review::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    // Show edit form
    public function edit($id)
    {

        // dd($id);
        $review = Review::with('book')->findOrFail($id);
// dd($review);
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // $book = $review->book;

        return view('reviews_edit', compact('review'  ));
    }

    // Update review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    // Delete review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return redirect()->back()->with('danger', 'Review deleted successfully!');
    }
}
