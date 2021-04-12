@extends('layouts.master')



@section('content')
    <br/>
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Product Listing</h2>

            </div>


        </div>

    </div>



    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif



    <table class="table table-bordered">

        <tr>



            <th>Name</th>



            <th width="280px">Action</th>

        </tr>

        @foreach ($products as $product)

        <tr>



            <td>{{ $product->name }}</td>



            <td>

                <form action="{{ route('addtocart',$product->uuid) }}" method="POST">
@csrf
<input type='number' name='qty' id='qty' value=''/>
                    <button type="submit" class="btn">Add to cart</button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>



    {!! $products->links() !!}



@endsection
