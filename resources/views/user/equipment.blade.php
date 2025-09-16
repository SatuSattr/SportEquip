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

            <!-- Search Form -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
                <form method="GET" action="{{ route('equipment.list') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-slate-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-10 p-3 text-sm text-slate-900 border border-slate-300 rounded-lg bg-slate-50 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search equipment...">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                        @if(request('search'))
                        <a href="{{ route('equipment.list') }}"
                            class="px-5 py-3 text-sm font-medium text-slate-700 bg-slate-200 rounded-lg hover:bg-slate-300 focus:ring-4 focus:outline-none focus:ring-slate-300">
                            Clear
                        </a>
                        @endif
                    </div>
                </form>
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

                            <a href="{{ route('borrow.create', ['item' => $item->item_name]) }}"
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
                            <h3 class="text-xl font-semibold text-slate-800 mb-3">No Equipment Found</h3>
                            <p class="text-slate-600 max-w-md mx-auto">No sports equipment matches your search. Try different keywords or browse all equipment.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($equipment->hasPages())
            <div class="mt-8">
                <div class="flex justify-center">
                    <nav class="inline-flex rounded-md shadow">
                        @if($equipment->onFirstPage())
                            <span class="px-4 py-2 text-sm font-medium text-slate-500 bg-slate-100 border border-slate-300 rounded-l-lg cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $equipment->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-l-lg hover:bg-slate-50">
                                Previous
                            </a>
                        @endif

                        @foreach(range(1, $equipment->lastPage()) as $i)
                            @if($i == $equipment->currentPage())
                                <span class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $equipment->url($i) }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50">
                                    {{ $i }}
                                </a>
                            @endif
                        @endforeach

                        @if($equipment->hasMorePages())
                            <a href="{{ $equipment->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-r-lg hover:bg-slate-50">
                                Next
                            </a>
                        @else
                            <span class="px-4 py-2 text-sm font-medium text-slate-500 bg-slate-100 border border-slate-300 rounded-r-lg cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
