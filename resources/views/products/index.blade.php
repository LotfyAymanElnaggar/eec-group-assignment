@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><span id="add-product-btn" class="action-icon btn btn-sm btn-primary"><i class="fas fa-plus"></i></span> Products</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Your table element -->
            <table class="table table-bordered" id="dataTable" class="display" style="width:100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- The product data will be populated here via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Initialize DataTable with Ajax configuration
        const dataTable = $('#dataTable').DataTable({
            columns: [{
                    data: 'id'
                },
                {
                    data: 'image',
                    render: function(data, type, row) {
                        if (data) {
                            return '<img src="' + data + '" alt="Product Image" width="50" height="50">';
                        } else {
                            return '<img src="https://via.placeholder.com/640x480.png/0055cc?text=product+autem" alt="Default Image" width="50" height="50">';
                        }
                    }
                },
                {
                    data: 'title',
                    render: function(data, type, row) {
                        return '<a href="/products/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    data: 'description'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-primary btn-sm edit-product-btn" data-id="${row.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-product-btn" data-id="${row.id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                    }
                }
            ],
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('api.products') }}",
                data: function(d) {
                    d.page = d.start / d.length + 1;
                    d.perPage = d.length;
                    d.search = d.search.value;
                },
                dataSrc: function(json) {
                    return json.data;
                },
                error: function(xhr, error, thrown) {
                    if (xhr.status === 429) {
                        alert("You have made too many requests. Please wait and try again later.");
                    } else {
                        alert("An error occurred while loading the data. Please try again later.");
                    }
                }
            },
            drawCallback: function(settings) {
                var api = this.api();
                var json = api.ajax.json();

                if (json) {
                    api.context[0]._iRecordsTotal = json.recordsTotal;
                    api.context[0]._iRecordsDisplay = json.recordsFiltered;
                }
            }
        });

        // Handle page length change
        $('#dataTable_length select').on('change', function() {
            dataTable.page.len($(this).val()).draw();
        });


        // Handle the "Add Product" button click event
        $('#add-product-btn').on('click', function() {
            // Replace with your page URL to create a new product
            window.location.href = '/products/create';
        });

        // Handle the "Edit" button click event
        $('#dataTable').on('click', '.edit-product-btn', function() {
            let productId = $(this).data('id');
            // Replace with your page URL to edit the specified product
            window.location.href = '/products/edit/' + productId;
        });

        // Handle the "Delete" button click event
        $('#dataTable').on('click', '.delete-product-btn', function() {
            let productId = $(this).data('id');
            // Replace with your API route to delete the specified product
            $.ajax({
                url: '/api/products/' + productId,
                type: 'DELETE',
                success: function() {
                    dataTable.ajax.reload();
                    // Display success message
                    alert(data.message);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Display error message
                    alert(jqXHR.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection