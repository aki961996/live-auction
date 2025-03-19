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

                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="title" class="form-control" placeholder="Write A Title">
                                    <div class="error_style" style="color: red">{{$errors->first('title')}}</div>

                                </div>

                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description"  placeholder="Description" class="form-control">{{ old('description') }}</textarea>
                                    <div class="error_style" style="color: red;">{{ $errors->first('description') }}</div>
                                </div>
                            </div>

                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control" placeholder="Price">
                                    <div class="error_style" style="color: red">{{$errors->first('price')}}</div>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity">
                                    <div class="error_style" style="color: red">{{$errors->first('quantity')}}</div>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="" />

                                    <div class="error_style" style="color: red">{{$errors->first('image')}}</div>

                                </div>

                            </div>








                        </div>








                        <button type="submit" class="btn btn-success">Create User</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>