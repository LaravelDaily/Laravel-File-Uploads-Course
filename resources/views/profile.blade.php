<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        Your avatar:
                        <br />
                        <img src="{{ Storage::disk('s3')->url('avatars/' . auth()->id() . '/' . auth()->user()->avatar) }}" />
                        <br /><br />
                        <input type="file" name="avatar" />
                        <br /><br />
                        <x-button>Update</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
