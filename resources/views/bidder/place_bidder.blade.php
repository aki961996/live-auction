<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bidder Amount') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('dashboard') }}" class="btn btn-dark mb-3">← Back</a>

                    <form action="{{ route('product.placeBidder.submit', encrypt($product->id)) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                        <label for="amount">Bid Amount</label>
                        <input type="number" name="amount" class="form-control" min="{{ $product->price }}">
                            <div class="error_style" style="color: red">{{$errors->first('amount')}}</div>
                        </div>

                      

                     

                        <button type="submit" class="btn btn-success">Create </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
