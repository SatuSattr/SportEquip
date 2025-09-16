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

                <div class="mb-4">
                    <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Equipment to Borrow</label>
                    <select name="item_name" id="item_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                        <option value="">Select Equipment</option>
                        @foreach ($equipment as $item)
                            @if ($item->item_status === 'available' && $item->item_quantity > 0)
                                <option value="{{ $item->item_name }}">{{ $item->item_name }} ({{ $item->item_quantity }}
                                    available)</option>
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
                        <label for="borrow_date" class="block text-gray-700 text-sm font-bold mb-2">Borrow Date</label>
                        <input type="date" name="borrow_date" id="borrow_date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        @error('borrow_date')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="return_date" class="block text-gray-700 text-sm font-bold mb-2">Return Date</label>
                        <input type="date" name="return_date" id="return_date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        @error('return_date')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
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
