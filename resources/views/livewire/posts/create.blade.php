<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <div>
        <x-label for="title" :value="__('Title')"/>

        <x-input wire:model="title" id="title" class="block mt-1 w-full" type="text" :value="old('title')" required
                 autofocus/>
    </div>

    <div class="mt-4">
        <x-label for="post_text" :value="__('Post Text')"/>

        <textarea wire:model="post_text" id="post_text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('post_text') }}</textarea>
    </div>

    <div class="mt-4">
        <x-label for="photo" :value="__('Photo')"/>

        <input wire:model="photo" type="file">
        <div wire:loading wire:target="photo">Loading...</div>
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button type="button" class="ml-4" wire:click="submit">
            {{ __('Save Post') }}
        </x-button>
    </div>
</div>
