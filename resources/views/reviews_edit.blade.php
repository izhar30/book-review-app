<x-app-layout>

    @if (session('danger'))
        <div class="toast align-items-center text-success bg-danger border-0 position-fixed top-0 end-0 mt-3 me-3"
            id="toastMessage" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('danger') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="toast align-items-center text-success bg-success border-0 position-fixed top-0 end-0 mt-3 me-3"
            id="toastMessage" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 100vh; background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);">
        <div class="row w-100 justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden; background: #fff;">
                    <div class="card-body p-5">
                        <!-- Book Image -->
                        <div class="d-flex justify-content-center mb-2">
                            <img src="{{ asset($review->book->images) }}" class="img-fluid rounded shadow-sm"
                                alt="Book Cover"
                                style="max-height: 500px; width: auto; display: block; margin: 0 auto;">
                        </div>

                        <!-- Book Title -->
                        <h2 class="text-center mb-2" style="font-family: 'Georgia', serif; color: #2c3e50;">
                            <strong>Book:</strong> {{ $review->book->title }}
                        </h2>

                        <!-- Author -->
                        <p class="text-center mb-3"
                            style="font-family: 'Arial', sans-serif; color: #7f8c8d; font-size: 1.1rem;">
                            <strong>Author:</strong> {{ $review->book->author }}
                        </p>

                        <!-- Average Rating -->
                        <div class="text-center mb-4">
                            <p style="font-family: 'Arial', sans-serif; color: #34495e; font-size: 1rem;">
                                <strong>Average Rating:</strong>
                                @if ($review->book->reviews->count() > 0)
                                    <span class="badge bg-warning text-dark p-2" style="font-size: 1rem;">
                                        {{ number_format($review->book->reviews->avg('rating'), 1) }} ⭐
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white p-2" style="font-size: 1rem;">No
                                        ratings yet</span>
                                @endif
                            </p>
                        </div>


                        <!-- Review Form -->
                        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Rating -->
                            <div class="mb-3 text-center">
                                <label for="rating" class="form-label fw-bold d-block"
                                    style="color: #34495e; margin-bottom: 8px;">Rating:</label>
                                <select name="rating" class="form-select" required
                                    style="border-radius: 10px; padding: 10px; border: 1px solid #dcdcdc; max-width: 200px; display: block; margin: 0 auto;">
                                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)
                                    </option>
                                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)
                                    </option>
                                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)
                                    </option>
                                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐ (2)
                                    </option>
                                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐ (1)
                                    </option>
                                </select>
                            </div>

                            <!-- Review Text -->
                            <div class="mb-4 text-center">
                                <label for="review_text" class="form-label fw-bold d-block"
                                    style="color: #34495e; margin-bottom: 8px;">Review:</label>
                                <textarea name="review_text" class="form-control" rows="4" required
                                    style="border-radius: 10px; resize: vertical; border: 1px solid #dcdcdc; max-width: 100%; display: block; margin: 0 auto;">{{ $review->review_text }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="mb-4 text-center gap-3">
                                <button type="submit" class="btn btn-primary px-4 py-2"
                                    style="border-radius: 10px; background: #3498db; border: none; transition: background 0.3s;">Update</button>
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary px-4 py-2"
                                    style="border-radius: 10px; border: 1px solid #9f0505; color: #7f8c8d;">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let toastElement = document.getElementById("toastMessage");
            if (toastElement) {
                let toast = new bootstrap.Toast(toastElement);
                toast.show();
            }
        });
    </script>

</x-app-layout>

