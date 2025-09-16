@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Equipment</h1>
        <a href="{{ route('admin.equipment.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Back to Equipment
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Edit Equipment Details</h2>
        </div>
        <form action="{{ route('admin.equipment.update', $equipment->id) }}" method="POST" enctype="multipart/form-data" class="px-6 py-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Item Name</label>
                <input type="text" name="item_name" id="item_name" value="{{ old('item_name', $equipment->item_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('item_name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="item_status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="item_status" id="item_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="available" {{ old('item_status', $equipment->item_status) === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('item_status', $equipment->item_status) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('item_status')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="item_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" name="item_quantity" id="item_quantity" value="{{ old('item_quantity', $equipment->item_quantity) }}" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @error('item_quantity')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="item_image" class="block text-gray-700 text-sm font-bold mb-2">Image (Optional)</label>
                <input type="file" name="item_image" id="item_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if($equipment->item_image)
                <div class="mt-2">
                    <p class="text-gray-700 text-sm mb-2">Current Image:</p>
                    <img src="{{ asset('images/' . $equipment->item_image) }}" alt="{{ $equipment->item_name }}" class="h-20 w-20 object-cover rounded">
                </div>
                @endif
                @error('item_image')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <i class="fas fa-save mr-2"></i>Update Equipment
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
    @endif
</script>
@endsection