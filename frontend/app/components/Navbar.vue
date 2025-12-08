<template>
    <nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-stone-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <NuxtLink to="/" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="w-9 h-9 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl transform rotate-45 group-hover:rotate-50 transition-all duration-300 shadow-lg shadow-amber-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute inset-0 w-9 h-9 bg-linear-to-br from-amber-400 to-orange-500 rounded-xl transform rotate-45 blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                    </div>
                    <span class="text-xl font-bold bg-linear-to-r from-stone-900 to-stone-700 bg-clip-text text-transparent">MiniCRM</span>
                </NuxtLink>

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
                    <NuxtLink to="/login" class="px-4 py-2 text-sm font-medium text-stone-700 hover:text-amber-600 transition-colors duration-200"> Sign In </NuxtLink>
                    <NuxtLink
                        to="/register"
                        class="relative px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl overflow-hidden group shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300">
                        <span class="relative z-10">Get Started</span>
                        <div class="absolute inset-0 bg-linear-to-r from-amber-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </NuxtLink>
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
                        <NuxtLink to="/login" class="w-full px-4 py-2.5 text-sm font-medium text-stone-700 hover:text-amber-600 hover:bg-stone-50 rounded-lg transition-all duration-200 text-center">Sign In</NuxtLink>
                        <NuxtLink
                            to="/register"
                            class="w-full px-6 py-3 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300">
                            Get Started
                        </NuxtLink>
                    </div>
                </div>
            </transition>
        </div>
    </nav>
</template>

<script setup>
    const mobileMenuOpen = ref(false);
</script>
