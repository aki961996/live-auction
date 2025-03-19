<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    @include('sweetalert::alert')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container ">
                        <!-- session msg -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <!-- Create User Button -->
                        <a href="{{route('product.create')}}" class="btn btn-success mb-3">
                            ➕ Create Product
                        </a>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td><img src="{{ asset('storage/private/product/' . $product->image) }}" alt="Product Image" width="50">
                                        </td>

                                        <td>
                                            <!-- View Button -->
                                            <a href="{{ route('product.show', encrypt($product->id)) }}" class="btn btn-info btn-sm">
                                                View
                                            </a>

                                            <!-- Edit Button -->
                                            <a href="{{ route('product.edit', encrypt($product->id)) }}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <!-- Delete Button (with confirmation) -->
                                            <form action="{{ route('product.destroy', encrypt($product->id)) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No users found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- pagination --}}
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
</x-app-layout>