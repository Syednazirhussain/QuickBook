@extends('layouts.admin')

@section('content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-12" style="">
                        <a href="{{ route('quickbook_customers_create') }}" class="mt-4 btn btn-primary" style="float: right;margin-bottom: 13px;">Add Customer</a>
                        <div class="table-responsive mb-4 mt-4">
                            @include('common.message')
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->Id }}</td>
                                            <td>{{ $customer->FullyQualifiedName }}</td>
                                            <td>{{ $customer->PrimaryEmailAddr ? $customer->PrimaryEmailAddr->Address: '' }}</td>
                                            <td>{{ $customer->PrimaryPhone ? $customer->PrimaryPhone->FreeFormNumber: '' }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ route('quickbook_customers_edit', [$customer->Id]) }}"> 
                                                    <i class="fa fa-edit"></i> 
                                                </a>
                                                <form action="{{ route('quickbook_customers_delete', [$customer->Id]) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button onclick="return confirm('Are you sure.?')" class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No customer(s) are found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection