<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('user.dashboard') }}" class="btn btn-dark mb-3">← Back</a>

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Write a name" >
                            <div class="error_style" style="color: red">{{$errors->first('name')}}</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Write a email"  >
                            <div class="error_style" style="color: red">{{$errors->first('email')}}</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Write a password" >
                            <div class="error_style" style="color: red">{{$errors->first('password')}}</div>
                        </div>

                        <button type="submit" class="btn btn-success">Create </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
