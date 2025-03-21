<x-app-layout>


    <!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Book Reviews</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" />
    </head>

    <body class="antialiased">

        @if(session('danger'))
        <div class="toast align-items-center text-white bg-danger border-0 position-fixed top-0 end-0 mt-3 me-3"
            id="toastMessage" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050;">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('danger') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gray-100">
            @if (Route::has('login'))
            <div class="login-register">
                @auth
                {{-- <a href="{{ url('/') }}" class="btn btn-primary">Home</a> --}}
                @else

                <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                @endif
                @endauth
            </div>
            @endif

            <div class="container">
                <h2 class="my-4 text-center">Book Reviews</h2>



                <div class="row">
                    @foreach ($books as $book)
                    <div class="col-md-4">
                        <div class="card ">
                            <img src="{{asset ($book->images)}}" class="card-img-top" alt="card cover" style="max-height: 450px;
                                     height: 415px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
                                <p class="card-text"><strong>Average Rating:</strong>
                                    @if($book->reviews->count() > 0)
                                    <span class="rating">{{ number_format($book->reviews->avg('rating'), 1) }} ⭐</span>
                                    @else
                                    No ratings yet
                                    @endif
                                </p>

                                @if(auth()->check())
                                <!-- Review Form -->
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <label for="rating">Rating:</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                    <textarea name="review_text" class="form-control mt-2" placeholder="Write a review..." required></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Save Review</button>
                                </form>
                                @else
                                <p><a href="{{ route('login') }}" class="btn btn-outline-primary">Login to review</a></p>
                                @endif
                            </div>

                            <div class="card-footer">
                                <h5>Reviews:</h5>
                                @foreach ($book->reviews as $review)
                                <div class="review">
                                    <p class="rating">
                                        <strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}⭐
                                    </p>
                                    <p>{{ $review->review_text }}</p>

                                    @if(auth()->id() === $review->user_id)
                                    <div class="btn-container">
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary mt-2">Edit Review</a>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>


</x-app-layout>
