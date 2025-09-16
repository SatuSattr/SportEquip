@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Added beautiful gradient background -->
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="container mx-auto px-4 py-16">
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mb-6">
                        <i class="fas fa-dumbbell text-white text-2xl"></i>
                    </div>
                    <h1 class="text-5xl font-bold text-slate-800 mb-6 leading-tight">
                        Sports Equipment
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Inventory
                            System</span>
                    </h1>
                    <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                        Streamline your sports equipment management with our modern, efficient inventory system.
                        Perfect for schools, clubs, and organizations managing sports equipment loans.
                    </p>
                </div>

                <!-- Feature Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto mb-16">
                    <!-- User Card -->
                    <div
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-2xl font-bold text-white">For Users</h2>
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xl"></i>
                                </div>
                            </div>
                            <p class="text-blue-100 text-lg">Browse and borrow available sports equipment with ease.</p>
                        </div>
                        <div class="p-8">
                            <div class="space-y-4">
                                <a href="{{ route('equipment.list') }}"
                                    class="group/btn w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl text-center block transition-all duration-200 transform hover:scale-[1.02]">
                                    <i class="fas fa-search mr-3"></i>Browse Equipment
                                    <i
                                        class="fas fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                                </a>
                                <a href="{{ route('borrow.create') }}"
                                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-4 px-6 rounded-xl text-center block transition-all duration-200">
                                    <i class="fas fa-plus mr-3"></i>Request Equipment
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Card -->
                    <div
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-2xl font-bold text-white">For Administrators</h2>
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-white text-xl"></i>
                                </div>
                            </div>
                            <p class="text-indigo-100 text-lg">Manage equipment inventory and borrowing requests
                                efficiently.</p>
                        </div>
                        <div class="p-8">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="group/btn w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl text-center block transition-all duration-200 transform hover:scale-[1.02]">
                                        <i class="fas fa-tachometer-alt mr-3"></i>Admin Dashboard
                                        <i
                                            class="fas fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="group/btn w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl text-center block transition-all duration-200 transform hover:scale-[1.02]">
                                        <i class="fas fa-sign-in-alt mr-3"></i>Admin Login
                                        <i
                                            class="fas fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

                <!-- How It Works Section -->
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-slate-800 mb-4">How It Works</h3>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto">Simple, efficient, and user-friendly equipment
                        management</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="text-center group">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-search text-white text-2xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800 mb-3">Browse Equipment</h4>
                        <p class="text-slate-600 leading-relaxed">Explore our comprehensive inventory of sports equipment
                            with detailed information and availability status.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calendar-plus text-white text-2xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800 mb-3">Submit Request</h4>
                        <p class="text-slate-600 leading-relaxed">Fill out our streamlined borrowing form with your
                            equipment needs and preferred dates.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clipboard-check text-white text-2xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-800 mb-3">Admin Approval</h4>
                        <p class="text-slate-600 leading-relaxed">Our administrators quickly review and approve requests,
                            ensuring efficient equipment distribution.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
