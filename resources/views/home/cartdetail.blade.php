@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Cart Detail</h2>

            </div>

        </div>
    </div>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>
        </div>
    @endif
    <form name="orderplacefrm" id="orderplacefrm" method="post" action="{{ route('order.place') }}">
    @csrf
        <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th width="280px">Price</th>
            <th width="280px">Quantity</th>
        </tr>

        @foreach ($cart as $cartItem)
            <tr>
                <td>{{ $cartItem->name }}</td>
                <td>{{ $cartItem->price }}</td>
                <td>
                    {{ $cartItem->quantity }}
                    <input type="hidden" value="{{ $cartItem->getUniqueId() }}" name="sku[]" id="sku[]">
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">
                <button type="submit" id="place_order" name="place_order">Place Order</button>
            </td>
        </tr>
    </table>
    </form>
@endsection
