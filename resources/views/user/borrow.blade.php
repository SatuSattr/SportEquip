@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Borrow Equipment</h1>
            <a href="{{ route('equipment.list') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Back to Equipment
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Borrow Request Form</h2>
            </div>
            <form action="{{ route('borrow.store') }}" method="POST" class="px-6 py-4">
                @csrf
                <div class="mb-4">
                    <label for="borrower_name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                    <input type="text" name="borrower_name" id="borrower_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                    @error('borrower_name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-4">
                    <div class="lg:col-span-2">
                        <div class="mb-4">
                            <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Equipment to
                                Borrow</label>
                            <select name="item_name" id="item_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">Select Equipment</option>
                                @foreach ($equipment as $item)
                                    @if ($item->item_status === 'available' && $item->item_quantity > 0)
                                        <option value="{{ $item->item_name }}"
                                            data-image="{{ $item->item_image ? asset('images/' . $item->item_image) : '' }}"
                                            data-quantity="{{ $item->item_quantity }}"
                                            {{ isset($selectedItem) && $selectedItem == $item->item_name ? 'selected' : '' }}>
                                            {{ $item->item_name }} ({{ $item->item_quantity }} available)
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('item_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                            @error('quantity')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="borrow_date" class="block text-gray-700 text-sm font-bold mb-2">Borrow
                                    Date</label>
                                <input type="date" name="borrow_date" id="borrow_date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                @error('borrow_date')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="return_date" class="block text-gray-700 text-sm font-bold mb-2">Return
                                    Date</label>
                                <input type="date" name="return_date" id="return_date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                @error('return_date')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image Preview Section -->
                    <div class="lg:col-span-1">
                        <div class=" rounded-lg p-4 h-full">
                            <div class="flex flex-col items-center">
                                <div id="image-preview"
                                    class="w-full h-48 flex items-center justify-center bg-white rounded-lg border border-gray-200 overflow-hidden">
                                    <div class="text-center">
                                        <i class="fas fa-image text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-500 text-sm">Select an item to preview</p>
                                    </div>
                                </div>
                                <div id="item-details" class="mt-4 w-full">
                                    <h4 id="preview-name" class="font-semibold text-gray-800 text-center truncate"></h4>
                                    <div class="flex justify-center mt-2">
                                        <span id="preview-quantity"
                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-boxes mr-1"></i> <span id="quantity-text">0</span> available
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Set min date for borrow date to today
        document.getElementById('borrow_date').min = new Date().toISOString().split('T')[0];

        // Update return date min when borrow date changes
        document.getElementById('borrow_date').addEventListener('change', function() {
            document.getElementById('return_date').min = this.value;
        });

        // Handle equipment selection and image preview
        const itemSelect = document.getElementById('item_name');
        const imagePreview = document.getElementById('image-preview');
        const previewName = document.getElementById('preview-name');
        const previewQuantity = document.getElementById('preview-quantity');
        const quantityText = document.getElementById('quantity-text');
        const quantityInput = document.getElementById('quantity');

        itemSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const imageSrc = selectedOption.getAttribute('data-image');
            const quantity = selectedOption.getAttribute('data-quantity');
            const itemName = selectedOption.text.split(' (')[0]; // Get item name without quantity text

            // Update preview
            if (imageSrc) {
                imagePreview.innerHTML =
                    `<img src="${imageSrc}" alt="${itemName}" class="w-full h-full object-contain">`;
            } else {
                imagePreview.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-dumbbell text-gray-300 text-4xl mb-2"></i>
                        <p class="text-gray-500 text-sm">No image available</p>
                    </div>
                `;
            }

            // Update details
            previewName.textContent = itemName;
            quantityText.textContent = quantity;

            // Set max quantity for input
            if (quantity) {
                quantityInput.max = quantity;
            }
        });

        // Trigger change event on page load if an item is pre-selected
        window.addEventListener('DOMContentLoaded', function() {
            if (itemSelect.value) {
                itemSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
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
