@extends('layouts.master')
@section('addcss')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style type="text/css">
        .date-ranges {
            background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;
        }
    </style>
@endsection
@section('content')
    <br/>
    <div class="row">
        <form name="ordersearchfrm" id="ordersearchfrm" method="get" action="{{ route('orders.index') }}">
            <div class="col-md-7 pull-left">
                <h3>Order Listing</h3>
            </div>
            <div class="col-md-5 text-right">
                <label class="font-weight-bold">Filter:</label>
                <input type="text" name="datefilter" readonly='true' id="datefilter" value="{{ request('datefilter') }}" />
                <button type="submit" name="btn_apply" id="btn_apply">Apply</button>
                <button type="button" name="btn_reset" id="btn_reset">Reset</button>
            </div>
        </form>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">

        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Order Total</th>
            <th width="280px">Order Quantity</th>
            <th>Order On</th>
        </tr>
        @if($orders->count())
            @foreach ($orders as $order)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $order->products->first()->name }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->quantity }}</td>

                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="6" class="text-center">No order found.</td></tr>
        @endif
    </table>
    {!! $orders->links() !!}
@endsection
@section('addjs')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            $('#datefilter').daterangepicker({
                autoUpdateInput: false,
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('#btn_reset').click(function (){
               document.location.href='{{ route('orders.index') }}';
            });
        });
    </script>
@endsection
