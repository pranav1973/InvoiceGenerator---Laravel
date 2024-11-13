@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crete Invoice</div>
                    <form action="{{ route('invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-md-4 offset-4 text-center">
                                        Invoice Number
                                        <br>
                                        <input type="text" name="invoice[invoice_number]" class="form-control"
                                            placeholder="AA001" required>
                                        Invoice Date
                                        <br>
                                        <input type="text" name="invoice[invoice_date]" class="form-control"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-left col-md-6">
                                            Choose customer:
                                            <br />
                                            <select name="invoice[customer_id]">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="float-end col-md-4">
                                            <b>Seller details</b>:
                                            <br /><br />
                                            Pranav Confectionary Store
                                            <br />
                                            Shop No.- 213, New Atam Nagar,Ludhiana,Punjab
                                            <br />
                                            Email: bansalpranav1999@gmail.com
                                            <br />
                                            GST Number: 21344311121321
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top: 20px;">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> # </th>
                                                    <th class="text-center"> Product </th>
                                                    <th class="text-center"> Qty </th>
                                                    <th class="text-center"> Price ({{ config('invoices.currency') }})
                                                    </th>
                                                    <th class="text-center"> Total ({{ config('invoices.currency') }})
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id='addr0'>
                                                    <td>1</td>
                                                    <td>
                                                        <select name="product[]" class="form-control">
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name='quantity[]' placeholder='Enter Qty'
                                                            class="form-control qty" step="0" min="0" />
                                                    </td>
                                                    <td>
                                                        <input type="number" name='price[]' placeholder='Enter Unit Price'
                                                            class="form-control price" step="0.00" min="0" />
                                                    </td>
                                                    <td>
                                                        <input type="number" name='total[]' placeholder='0.00'
                                                            class="form-control total" readonly />
                                                    </td>
                                                </tr>
                                                <tr id='addr1'></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <button id="add_row" type="button" class="btn btn-primary float-start">Add
                                            Row</button>
                                        <button id='delete_row' type="button" class="float-end btn btn-info">Delete
                                            Row</button>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-end col-md-5">
                                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center" width="50%">Sub Total
                                                            ({{ config('invoices.currency') }})</th>
                                                        <td class="text-center"><input type="number" name='sub_total'
                                                                placeholder='0.00' class="form-control" id="sub_total"
                                                                readonly /></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Tax</th>
                                                        <td class="text-center">
                                                            <div class="input-group mb-2 mb-sm-0">
                                                                <input type="number" class="form-control" id="tax"
                                                                    name="invoice[tax_percent]" placeholder="0">
                                                                <div class="input-group-addon">%</div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Tax Amount
                                                            ({{ config('invoices.currency') }}) </th>
                                                        <td class="text-center"><input type="number" name='tax_amount'
                                                                id="tax_amount" placeholder='0.00' class="form-control"
                                                                readonly /></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Grand Total
                                                            ({{ config('invoices.currency') }})</th>
                                                        <td class="text-center"><input type="number" name='total_amount'
                                                                id="total_amount" placeholder='0.00' class="form-control"
                                                                readonly /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Save Invoice">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                // e.preventDefault();
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                // e.preventDefault();
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


        });

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);

                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }
    </script>
@endsection
