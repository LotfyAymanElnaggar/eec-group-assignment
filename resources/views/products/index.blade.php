@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
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
                    data: 'title'
                },
                {
                    data: 'description'
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
    });
</script>
@endsection