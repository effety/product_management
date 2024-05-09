@extends($layout, ['title' => 'My Profile'])

@section('mainContent')
    <div class="container">
        <div class="row row-gap-3">
            @foreach($categories as $category)
                <div class="col-md-6">
                    <div class="single-category">
                        <h3 class="fw-bold">{{ $category->name }}</h3>
                        <p class="m-0">Total Products: {{ $categoryProductCounts[$category->id] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $categories->links() }} 
    </div>
@endsection
