<template>
    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-block">
                        <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium"> Built for Malaysian SMEs </span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-stone-900 leading-tight">
                        Manage your sales
                        <span class="text-amber-600 inline-block transform hover:rotate-2 transition-transform duration-300"> pipeline </span>
                        with clarity
                    </h1>
                    <p class="text-lg text-stone-600 leading-relaxed">A lightweight CRM that helps small teams track leads, manage deals, and close sales faster. No bloat, just what you need.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <NuxtLink to="/register" class="group px-8 py-4 bg-amber-600 text-white rounded-xl font-semibold hover:bg-amber-700 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                            Get Started for Free
                            <span class="inline-block ml-2 transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                        </NuxtLink>
                        <a
                            href="#features"
                            class="px-8 py-4 border-2 border-stone-300 text-stone-700 rounded-xl font-semibold hover:border-amber-600 hover:text-amber-600 transform hover:scale-105 transition-all duration-300 inline-flex items-center justify-center gap-2">
                            <Icon name="lucide:file-text" class="h-5 w-5" />
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
                                <Icon name="lucide:kanban" class="w-7 h-7 text-white" />
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Pipeline View</h3>
                            <p class="text-white/80">Drag & drop deals through stages</p>
                        </div>
                    </div>

                    <!-- Card 2: Lead Tracking -->
                    <div class="absolute top-20 left-0 w-72 h-96 bg-linear-to-br from-stone-700 to-stone-900 rounded-3xl transform -rotate-6 hover:rotate-0 transition-transform duration-500 shadow-2xl">
                        <div class="p-6 text-white">
                            <div class="w-12 h-12 bg-white/20 rounded-xl mb-4 backdrop-blur-sm flex items-center justify-center">
                                <Icon name="lucide:users" class="w-7 h-7 text-white" />
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Lead Tracking</h3>
                            <p class="text-white/80">Never miss a follow-up</p>
                        </div>
                    </div>

                    <!-- Card 3: Analytics -->
                    <div class="absolute bottom-0 right-20 w-64 h-80 bg-linear-to-br from-emerald-400 to-teal-500 rounded-3xl transform rotate-3 hover:-rotate-2 transition-transform duration-500 shadow-2xl">
                        <div class="p-6 text-white">
                            <div class="w-12 h-12 bg-white/20 rounded-xl mb-4 backdrop-blur-sm flex items-center justify-center">
                                <Icon name="lucide:bar-chart-3" class="w-7 h-7 text-white" />
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
