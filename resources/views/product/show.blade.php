<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="container mt-4">
                         <!-- Back Button -->
                         <a href="{{ route('product.dashboard') }}" class="btn btn-dark mb-3">
                            ← Back
                        </a>
                        <!-- <h2 class="mb-4"> </h2> -->

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Created By</th>
                                        <th>Image</th>
                                       
                                        
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($product_data)
                                    <tr>
                                        <td>{{ $product_data->id }}</td>
                                        <td>{{ $product_data->title }}</td>
                                        <td>{{ $product_data->description }}</td>
                                        <td>{{ $product_data->price }}</td>
                                        <td>{{ $product_data->quantity }}</td>

                                        <td>{{ $product_data->user->name ?? 'N/A' }}</td>
                                        <td><img src="{{ asset('storage/private/product/' . $product_data->image) }}" alt="Product Image" width="50">
                                        <td>{{ $product_data->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">No user found</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>