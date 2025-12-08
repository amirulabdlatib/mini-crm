<template>
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
                        <NuxtLink to="/register" class="group px-8 py-4 bg-amber-600 text-white rounded-xl font-semibold hover:bg-amber-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                            Get Started for Free
                            <span class="inline-block ml-2 transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                        </NuxtLink>
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
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
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
</template>
