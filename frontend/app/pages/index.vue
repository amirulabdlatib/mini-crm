<template>
    <div class="min-h-screen bg-stone-50">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-stone-200/50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3 group cursor-pointer">
                        <div class="relative">
                            <div class="w-9 h-9 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl transform rotate-45 group-hover:rotate-50 transition-all duration-300 shadow-lg shadow-amber-500/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 w-9 h-9 bg-linear-to-br from-amber-400 to-orange-500 rounded-xl transform rotate-45 blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                        </div>
                        <span class="text-xl font-bold bg-linear-to-r from-stone-900 to-stone-700 bg-clip-text text-transparent">MiniCRM</span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="#features" class="relative px-4 py-2 text-sm font-medium text-stone-600 hover:text-amber-600 transition-colors duration-200 group">
                            Features
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-amber-600 transform -translate-x-1/2 group-hover:w-3/4 transition-all duration-300"></span>
                        </a>
                        <a href="#testimonials" class="relative px-4 py-2 text-sm font-medium text-stone-600 hover:text-amber-600 transition-colors duration-200 group">
                            Testimonials
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-amber-600 transform -translate-x-1/2 group-hover:w-3/4 transition-all duration-300"></span>
                        </a>
                        <a href="#contact" class="relative px-4 py-2 text-sm font-medium text-stone-600 hover:text-amber-600 transition-colors duration-200 group">
                            Contact
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-amber-600 transform -translate-x-1/2 group-hover:w-3/4 transition-all duration-300"></span>
                        </a>
                    </div>

                    <!-- Desktop CTA Buttons -->
                    <div class="hidden md:flex items-center space-x-3">
                        <button class="px-4 py-2 text-sm font-medium text-stone-700 hover:text-amber-600 transition-colors duration-200">Sign In</button>
                        <button
                            class="relative px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl overflow-hidden group shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300">
                            <span class="relative z-10">Get Started</span>
                            <div class="absolute inset-0 bg-linear-to-r from-amber-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-stone-900 hover:text-amber-600 focus:outline-none transition-colors duration-200">
                        <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu -->
                <transition
                    enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 -translate-y-4"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 -translate-y-4">
                    <div v-if="mobileMenuOpen" class="md:hidden py-4 space-y-3 border-t border-stone-200/50">
                        <a @click="mobileMenuOpen = false" href="#features" class="block px-4 py-2.5 text-sm font-medium text-stone-600 hover:text-amber-600 hover:bg-amber-50/50 rounded-lg transition-all duration-200"> Features </a>
                        <a @click="mobileMenuOpen = false" href="#testimonials" class="block px-4 py-2.5 text-sm font-medium text-stone-600 hover:text-amber-600 hover:bg-amber-50/50 rounded-lg transition-all duration-200"> Testimonials </a>
                        <a @click="mobileMenuOpen = false" href="#contact" class="block px-4 py-2.5 text-sm font-medium text-stone-600 hover:text-amber-600 hover:bg-amber-50/50 rounded-lg transition-all duration-200"> Contact </a>
                        <div class="pt-4 space-y-3 border-t border-stone-200/50">
                            <button class="w-full px-4 py-2.5 text-sm font-medium text-stone-700 hover:text-amber-600 hover:bg-stone-50 rounded-lg transition-all duration-200 text-center">Sign In</button>
                            <button
                                class="w-full px-6 py-3 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300">
                                Get Started
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="inline-block">
                            <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium"> Built for Malaysian SMEs </span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-stone-900 leading-tight">
                            Manage your sales
                            <span class="text-amber-600 inline-block transform hover:rotate-2 transition-transform duration-300"> pipeline </span>
                            with clarity
                        </h1>
                        <p class="text-xl text-stone-600 leading-relaxed">A lightweight CRM that helps small teams track leads, manage deals, and close sales faster. No bloat, just what you need.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="group px-8 py-4 bg-amber-600 text-white rounded-xl font-semibold hover:bg-amber-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                Get Started for Free
                                <span class="inline-block ml-2 transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                            </button>
                            <a
                                href="#features"
                                class="px-8 py-4 border-2 border-stone-300 text-stone-700 rounded-xl font-semibold hover:border-amber-600 hover:text-amber-600 transform hover:scale-105 transition-all duration-300 inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                View Features
                            </a>
                        </div>
                        <div class="flex items-center space-x-8 pt-4">
                            <div class="flex -space-x-3">
                                <img src="https://i.pravatar.cc/150?img=12" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 object-cover" />
                                <img src="https://i.pravatar.cc/150?img=47" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 object-cover" />
                                <img src="https://i.pravatar.cc/150?img=32" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 object-cover" />
                            </div>
                            <div>
                                <p class="text-sm text-stone-600">Trusted by 500+ SMEs</p>
                            </div>
                        </div>
                    </div>

                    <!-- Animated Cards -->
                    <div class="relative h-[600px] hidden lg:block">
                        <!-- Card 1: Pipeline View -->
                        <div class="absolute top-0 right-0 w-72 h-96 bg-linear-to-br from-amber-400 to-orange-500 rounded-3xl transform rotate-6 hover:rotate-3 transition-transform duration-500 shadow-2xl">
                            <div class="p-6 text-white">
                                <div class="w-12 h-12 bg-white/20 rounded-xl mb-4 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Pipeline View</h3>
                                <p class="text-white/80">Drag & drop deals through stages</p>
                            </div>
                        </div>

                        <!-- Card 2: Lead Tracking -->
                        <div class="absolute top-20 left-0 w-72 h-96 bg-linear-to-br from-stone-700 to-stone-900 rounded-3xl transform -rotate-6 hover:rotate-0 transition-transform duration-500 shadow-2xl">
                            <div class="p-6 text-white">
                                <div class="w-12 h-12 bg-white/20 rounded-xl mb-4 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Lead Tracking</h3>
                                <p class="text-white/80">Never miss a follow-up</p>
                            </div>
                        </div>

                        <!-- Card 3: Analytics -->
                        <div class="absolute bottom-0 right-20 w-64 h-80 bg-linear-to-br from-emerald-400 to-teal-500 rounded-3xl transform rotate-3 hover:-rotate-2 transition-transform duration-500 shadow-2xl">
                            <div class="p-6 text-white">
                                <div class="w-12 h-12 bg-white/20 rounded-xl mb-4 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Analytics</h3>
                                <p class="text-white/80">Track your growth</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid -->
        <section id="features" class="py-20 px-6 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-stone-900 mb-4">Everything you need to sell</h2>
                    <p class="text-xl text-stone-600">Simple tools that actually work together</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-amber-50 transition-all duration-300 border border-stone-200 hover:border-amber-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-amber-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Lead Management</h3>
                        <p class="text-stone-600">Capture, qualify, and convert leads with automatic activity tracking and follow-up reminders.</p>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 border border-stone-200 hover:border-emerald-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-emerald-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Sales Pipeline</h3>
                        <p class="text-stone-600">Visual kanban board to track deals through every stage from first contact to closed won.</p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-rose-50 transition-all duration-300 border border-stone-200 hover:border-rose-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-rose-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Task Management</h3>
                        <p class="text-stone-600">Schedule calls, meetings, and follow-ups. Get reminded so nothing falls through the cracks.</p>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-sky-50 transition-all duration-300 border border-stone-200 hover:border-sky-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-sky-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Product Catalog</h3>
                        <p class="text-stone-600">Manage your products and services. Quickly add them to deals with auto-calculated values.</p>
                    </div>

                    <!-- Feature Card 5 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-violet-50 transition-all duration-300 border border-stone-200 hover:border-violet-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-violet-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Team Roles</h3>
                        <p class="text-stone-600">Admin, Sales Manager, and Salesperson roles with proper access control and permissions.</p>
                    </div>

                    <!-- Feature Card 6 -->
                    <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-orange-50 transition-all duration-300 border border-stone-200 hover:border-orange-200 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-orange-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-stone-900 mb-3">Dashboard</h3>
                        <p class="text-stone-600">Real-time insights on leads, pipeline value, tasks, and team performance at a glance.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-20 px-6 bg-stone-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-stone-900 mb-4">Loved by Businesses</h2>
                    <p class="text-xl text-stone-600">Don't just take our word for it</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <img src="https://i.pravatar.cc/150?img=32" alt="Sarah K." class="w-12 h-12 rounded-full mr-4 border-2 border-amber-200" />
                            <div>
                                <h4 class="font-semibold text-stone-900">Sarah K.</h4>
                                <p class="text-sm text-amber-600">Small Business Owner</p>
                            </div>
                        </div>
                        <p class="text-stone-600 mb-4">"MiniCRM has transformed how we manage our sales pipeline. The interface is so intuitive that my team was up and running in minutes!"</p>
                        <div class="flex text-amber-400">★★★★★</div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <img src="https://i.pravatar.cc/150?img=12" alt="Ahmad R." class="w-12 h-12 rounded-full mr-4 border-2 border-amber-200" />
                            <div>
                                <h4 class="font-semibold text-stone-900">Ahmad R.</h4>
                                <p class="text-sm text-amber-600">Sales Director</p>
                            </div>
                        </div>
                        <p class="text-stone-600 mb-4">"The best CRM solution for Malaysian businesses. The local support is outstanding and the features are perfectly tailored for our market needs."</p>
                        <div class="flex text-amber-400">★★★★★</div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <img src="https://i.pravatar.cc/150?img=8" alt="Mei Ling" class="w-12 h-12 rounded-full mr-4 border-2 border-amber-200" />
                            <div>
                                <h4 class="font-semibold text-stone-900">Mei Ling</h4>
                                <p class="text-sm text-amber-600">Marketing Manager</p>
                            </div>
                        </div>
                        <p class="text-stone-600 mb-4">"We've tried many CRMs but none as user-friendly as this. The mobile app keeps our team productive even on the go. Highly recommended!"</p>
                        <div class="flex text-amber-400">★★★★★</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-20 px-6 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-stone-900 mb-4">Get in Touch</h2>
                    <p class="text-xl text-stone-600">Have questions? We'd love to hear from you.</p>
                </div>
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Contact Form -->
                    <div class="bg-stone-50 p-8 rounded-2xl shadow-lg">
                        <form @submit.prevent="handleSubmit" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-stone-700 mb-1">Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="form.name"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Your name" />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    v-model="form.email"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                                    placeholder="your.email@example.com" />
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-stone-700 mb-1">Message</label>
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    rows="4"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                                    placeholder="How can we help you?"></textarea>
                            </div>
                            <button type="submit" class="w-full px-6 py-3.5 bg-amber-600 text-white font-semibold rounded-xl hover:bg-amber-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-amber-500/20">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Lottie Animation -->
                    <div class="hidden lg:block">
                        <div class="relative">
                            <div class="absolute inset-0 bg-linear-to-br from-amber-100 to-orange-100 rounded-2xl transform rotate-2"></div>
                            <div class="relative">
                                <ClientOnly>
                                    <DotLottieVue style="height: 400px; width: 400px" autoplay loop src="https://lottie.host/0e09e516-7c30-4aa3-8705-b2b0fd331990/ZTwksOYiKy.lottie" class="mx-auto" />
                                </ClientOnly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 bg-stone-900 text-stone-400">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4 group cursor-pointer">
                            <div class="relative">
                                <div class="w-8 h-8 bg-amber-600 rounded-lg transform rotate-45 group-hover:rotate-50 transition-all duration-300 shadow-lg shadow-amber-500/20 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 w-8 h-8 bg-amber-500 rounded-lg transform rotate-45 blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                            </div>
                            <span class="text-xl font-bold text-white">MiniCRM</span>
                        </div>
                        <p class="text-sm">Lightweight CRM for Malaysian SMEs</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Product</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Features</a></li>
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Pricing</a></li>
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Demo</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-amber-400 transition-colors">About</a></li>
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Blog</a></li>
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Privacy</a></li>
                            <li><a href="#" class="hover:text-amber-400 transition-colors">Terms</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pt-8 border-t border-stone-800 text-center text-sm">
                    <p>&copy; 2024 MiniCRM. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
    import { ref } from "vue";
    import { DotLottieVue } from "@lottiefiles/dotlottie-vue";

    useHead({
        title: "Mini CRM",
    });

    const form = ref({
        name: "",
        email: "",
        message: "",
    });

    const handleSubmit = () => {
        // Handle form submission
        console.log("Form submitted:", form.value);
        // Add your form submission logic here
        alert("Thank you for your message! We will get back to you soon.");
        form.value = { name: "", email: "", message: "" };
    };

    const mobileMenuOpen = ref(false);
</script>

<style scoped>
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Custom animations */
    @keyframes float {
        0%,
        100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>
