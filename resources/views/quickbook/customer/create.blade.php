@extends('layouts.admin')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-12">
                        <h3 class="well mt-3">Add Customer</h3>
                        <div class="table-responsive mb-4 mt-4">
                            @include('common.message')
                            <form method="POST" action="{{ route('quickbook_customers_store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Name</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Phone</label>
                                    <input class="form-control" type="number" name="phone" required>
                                </div>
                                <button class="btn btn-primary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection