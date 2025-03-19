<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('product.dashboard') }}" class="btn btn-dark mb-3">← Back</a>

                    <form action="{{ route('product.update', encrypt($product_data->id)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="title" value="{{ old('name', $product_data->title) }}" class="form-control" placeholder="Write A Title">
                                    <div class="error_style" style="color: red">{{$errors->first('title')}}</div>

                                </div>

                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description">{{ old('description', $product_data->description) }}</textarea>
                                    <div class="error_style" style="color: red;">{{ $errors->first('description') }}</div>
                                </div>
                            </div>


                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" value="{{old('price', $product_data->price)}}" name="price" class="form-control" placeholder="Price">
                                    <div class="error_style" style="color: red">{{$errors->first('price')}}</div>

                                </div>

                            </div>

                       

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" />

                                    @if(!empty($product_data->image))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/private/product/' . $product_data->image) }}" alt="Product Image" width="100">
                                    </div>
                                    @endif

                                    <div class="error_style" style="color: red;">
                                        {{ $errors->first('image') }}
                                    </div>
                                </div>
                            </div>









                        </div>








                        <button type="submit" class="btn btn-success">Update </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>