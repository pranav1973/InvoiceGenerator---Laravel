@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add New Invoice</a>

                        <br><br>
                        <table class="table">
                            <tr>
                                <th>Invoice Date</th>
                                <th>Invoice Number</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <th>{{ $invoice->invoice_date }}</th>
                                    <th>{{ $invoice->invoice_number }}</th>
                                    <th>{{ $invoice->customer->name }}</th>
                                    <th>{{ number_format($invoice->total_amount, 2) }}</th>
                                    <th><a href="{{ route('invoices.show', $invoice->id) }}"
                                            class="btn btn-sm btn-info">View Invoice</a></th>
                                    <th><a href="{{ route('invoices.download', $invoice->id) }}"
                                            class="btn btn-sm btn-success">Download Pdf</a></th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
