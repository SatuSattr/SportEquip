@extends('layouts.app')

@section('content')
    <div class="py-8 bg-slate-50 min-h-screen">
        <!-- Enhanced user equipment page with modern card-based design -->
        <div class="container mx-auto max-w-7xl">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">Available Sports Equipment</h1>
                    <p class="text-slate-600">Browse and request equipment for your activities</p>
                </div>
                <a href="{{ route('borrow.create') }}"
                    class="mt-4 sm:mt-0 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Borrow Equipment
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-8 flex items-center"
                    role="alert">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <div>
                        <strong class="font-semibold">Success!</strong>
                        <span class="block sm:inline ml-1">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Equipment Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($equipment as $item)
                    <div
                        class="group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-slate-200">
                        <div class="relative overflow-hidden">
                            @if ($item->item_image)
                                <img src="{{ asset('images/' . $item->item_image) }}" alt="{{ $item->item_name }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="bg-gradient-to-br from-slate-100 to-slate-200 w-full h-48 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-dumbbell text-slate-400 text-4xl mb-2"></i>
                                        <span class="text-slate-500 text-sm">No Image Available</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full backdrop-blur-sm
                            {{ $item->item_status === 'available' ? 'bg-green-100/90 text-green-700 border border-green-200' : 'bg-orange-100/90 text-orange-700 border border-orange-200' }}">
                                    <i
                                        class="fas {{ $item->item_status === 'available' ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                                    {{ ucfirst($item->item_status) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3
                                class="text-xl font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $item->item_name }}</h3>

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center text-slate-600">
                                    <i class="fas fa-boxes mr-2"></i>
                                    <span class="text-sm font-medium">{{ $item->item_quantity }} available</span>
                                </div>
                            </div>

                            <a href="{{ route('borrow.create') }}"
                                class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl text-center block transition-all duration-200 transform hover:scale-[1.02] shadow-sm">
                                <i class="fas fa-hand-pointer mr-2"></i>Request to Borrow
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-dumbbell text-slate-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-800 mb-3">No Equipment Available</h3>
                            <p class="text-slate-600 max-w-md mx-auto">There is currently no sports equipment available for
                                borrowing. Please check back later or contact an administrator.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
