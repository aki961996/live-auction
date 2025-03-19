<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="container ">
                         <!-- Back Button -->
                         <a href="{{ route('user.dashboard') }}" class="btn btn-dark mb-3">
                            ← Back
                        </a>
                        <!-- <h2 class="mb-4"> </h2> -->

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($userBidderData)
                                    <tr>
                                        <!-- <td>{{ $userBidderData->id }}</td> -->
                                        <td>{{ $userBidderData->name }}</td>
                                        <td>{{ $userBidderData->email }}</td>
                                        <td>{{ $userBidderData->created_at->format('d-m-Y H:i') }}</td>
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