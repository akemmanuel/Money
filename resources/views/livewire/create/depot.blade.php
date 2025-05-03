<div class="p-3">
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold">Create depot</h1>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div>
        <form wire:submit.prevent="create">
            <div>
                <div class="grow">
                    <label class="label label-text font-medium" for="name">Name <span class="text-red-600">*</span></label>
                    <input
                        type="text"
                        placeholder="Enter name"
                        class="input"
                        id="name"
                        wire:model="name"
                        maxlength="255"
                        required
                        value="{{ old('name') }}"
                    />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grow">
                    <label class="label label-text font-medium" for="name">Description</label>
                    <textarea
                        placeholder="Enter a description"
                        class="textarea input-bordered w-full focus:input-primary"
                        id="name"
                        wire:model="description"
                        maxlength="255"
                        value="{{ old('description') }}"
                    ></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="btn btn-primary hover:btn-primary-focus transition"
                >
                    Create depot
                </button>
            </div>
        </form>
    </div>
</div>
