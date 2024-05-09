@extends($layout, ['title' => 'My Profile'])

@section('mainContent')
    <div class="container">
        <div class="products mb-3">
            @foreach($products as $product)
                <div class="__single">
                    <div class="image">
                        <img class="w-100" src="{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div>
                        <h2>{{ $product->name }}</h2>
                        <div>
                            <p class="fw-bold m-0">Categories:</p>
                            <div>
                                @foreach($product->category_names as $categoryName)
                                    <span class="badge bg-info text-capitalize">{{ $categoryName }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <p class="fw-bold m-0">Features:</p>
                            <ul>
                                @foreach($product->feature_names as $featureName)
                                    <li class="text-capitalize">{{ $featureName }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    </div>

    <script>
        $("#imgSrc").attr('src', "https://ui-avatars.com/api/?background=random&color=fff&name={{ auth()->user()->name }}")
    </script>
@endsection
