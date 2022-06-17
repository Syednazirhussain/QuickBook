@extends('layouts.admin')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-12">
                        <h3 class="well mt-3">Edit Customer</h3>
                        <div class="table-responsive mb-4 mt-4">
                            @include('common.message')
                            <form method="POST" action="{{ route('quickbook_customers_update', [$customer->Id]) }}">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" value="{{ $customer->PrimaryEmailAddr->Address }}">
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection