@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $pageTitle }}</h2>
    <form id="product-form">
        @csrf
        <input type="hidden" id="product-id" value="{{ $product->id ?? '' }}">
        <div class="form-group">
            <label for="product-name">Product Name</label>
            <input type="text" class="form-control" name="id" id="product-name" value="{{ $product->title ?? '' }}">
        </div>
        <!-- Add the description field -->
        <div class="form-group">
            <label for="product-description">Description</label>
            <textarea class="form-control" id="product-description">{{ $product->description ?? '' }}</textarea>
        </div>

        <!-- Add the image field -->
        <div class="form-group">
            <label for="product-image">Image</label>
            <input type="file" class="form-control" id="product-image">
            @if(isset($product->image))
            <img src="{{ $product->image }}" alt="Product Image" width="150" class="mt-2">
            @endif
        </div>
        <!-- Add more form fields for other product attributes as needed -->
        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>
@endsection


@section('scripts')
<script>
    $('#product-form').on('submit', function(e) {
        e.preventDefault();

        const productId = $('#product-id').val();
        const productName = $('#product-name').val();
        const productDescription = $('#product-description').val();

        const productData = new FormData();
        productData.append('title', productName);
        productData.append('description', productDescription);
        productData.append('_token', $('input[name="_token"]').val());


        data = {
            title: productName,
            description: productDescription
        };


        const productImage = document.getElementById('product-image').files[0];
        if (productImage) {
            productData.append('image', productImage);
        }
        const ajaxConfig = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'PUT',
            url: `/api/products/${productId}`,
            contentType: "application/json",
            data: JSON.stringify(data),
            processData: false,
            contentType: false,
            success: function() {
                // Redirect to the products list page
                // window.location.href = '/products';
                alert(productData);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Display error message
                alert(jqXHR.responseJSON.message);
            }
        };

        $.ajax(ajaxConfig);
    });
</script>
@endsection