@extends('layouts.app')

@section('title', 'Pharmacies')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pharmacies</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="pharmacies-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#pharmacies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/api/pharmacies', // Replace with the appropriate URL for your API endpoint
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return '<a href="/pharmacies/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                }
            ]
        });
    });
</script>
@endsection