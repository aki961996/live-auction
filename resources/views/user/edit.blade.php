<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container mt-4">
                         <!-- Back Button -->
                         <a href="{{ route('user.dashboard') }}" class="btn btn-dark mb-3">
                            ← Back
                        </a>
                        <h2 class="mb-4">Edit UserBidder</h2>

                        <form action="{{route('admin.users.update', encrypt($userBidderData->id))}}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $userBidderData->name }}" required>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $userBidderData->email }}" required>
                            </div>

                            <!-- Role Selection -->
                            <!-- <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="user" {{ $userBidderData->hasRole('bidder') ? 'selected' : '' }}>UserBidder</option>
                                    <option value="admin" {{ $userBidderData->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div> -->

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update User</button>

                          
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
