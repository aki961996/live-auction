<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard/Bidder/List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <!-- <h1 class="animated-title">Bid Products </h1> -->

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td><img src="{{ asset('storage/private/product/' . $product->image) }}" alt="Product Image" width="50"></td>
                                        <td>
                                            <a href="{{route('product.placeBidder', encrypt($product->id))}}" class="btn btn-info btn-sm">
                                                Bidder
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No products found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div style="padding: 10px; float:right;">
                            {!!
                            $products->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                            !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container">
                        <!-- <h1 style="font-size: 30px;" class="mb-3 ">Bidded Users List</h1> -->
                        <h1 class="animated-title">Bidded Products </h1>

                        <div class="table-responsive">
                            <table id="bidded-products" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Bidded User name</th>
                                        <th>Product title</th>
                                        <th>Bidded Price</th>
                                        <th>Product Image</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bidded_data as $bid)
                                    <tr>
                                        <td>{{ $bid->id }}</td>
                                        <td>{{ $bid->user->name }}</td>
                                        <td>{{ $bid->product->title }}</td>
                                        <td>{{ $bid->amount }}</td>
                                        <td><img src="{{ asset('storage/private/product/' . $bid->product->image) }}" alt="Product Image" width="50"></td>
                                        <!-- <td>
                                            <a href="{{route('product.placeBidder', encrypt($product->id))}}" class="btn btn-info btn-sm">
                                                Bidder
                                            </a>
                                        </td> -->
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No products found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div style="padding: 10px; float:right;">
                            {!!
                            $products->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                            !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- <script>
        Pusher.logToConsole = true;


        var pusher = new Pusher('ac15ce3bea9001cc9568', {
            cluster: 'ap2'
        });


        var channel = pusher.subscribe('bidder-channel');
        channel.bind('bidder-event', function(data) {
            alert(JSON.stringify(data));
          

        });
    </script> -->
    <!-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> -->
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('ac15ce3bea9001cc9568', {
            cluster: 'ap2'
        });


        var channel = pusher.subscribe('bidder-channel');


        channel.bind('bidder-event', function(data) {
            // console.log('Received bidder event:', data);
            // console.log(JSON.stringify(data));
            let html = `<tr>
                        <td>${data.bid.id}</td>
                        <td>${data.bid.user.name}</td>
                        <td>${data.bid.product.title}</td>
                        <td>${data.bid.amount}</td>
                        <td><img src="${data.bid.product.image}" alt="Product Image" width="50"></td>
                        <!-- <td>
                            <a href="http://127.0.0.1:8000/product/bidder/eyJpdiI6IjhMNUlWTUxWZUZPV2pTM3dkeXk1QVE9PSIsInZhbHVlIjoiamhVOVdiU0FWd1hnRXh5b0M1eEYrQT09IiwibWFjIjoiNTliMzYyNThjNzY0M2Y0ZmQ2ZmFkYjdkYWQzMzdmOTZkODkxNjNiNzljZjFkNTkwNzViNjQyZmNkYjE4YTY5MCIsInRhZyI6IiJ9" class="btn btn-info btn-sm">
                                Bidder
                            </a>
                        </td> -->
                    </tr>`;
            $('#bidded-products tbody tr:first').prepend(html);

        });
    </script>



</x-app-layout>