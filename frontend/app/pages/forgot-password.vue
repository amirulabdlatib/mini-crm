<template>
    <div class="bg-linear-to-br from-stone-50 via-amber-50/30 to-orange-50/20 py-32">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="relative">
                        <div class="w-12 h-12 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl transform rotate-45 shadow-lg shadow-amber-500/30">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-stone-900 mb-2">Forgot password?</h1>
                <p class="text-stone-600">No worries, we'll send you reset instructions</p>
            </div>

            <!-- Forgot Password Card -->
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 p-8">
                <!-- Success Message -->
                <div v-if="emailSent" class="space-y-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-stone-900 mb-2">Check your email</h3>
                        <p class="text-stone-600 mb-6">
                            We sent a password reset link to
                            <span class="font-medium text-stone-900">{{ form.email }}</span>
                        </p>
                        <button class="text-sm text-amber-600 hover:text-amber-700 font-medium transition-colors" @click="resetForm">Didn't receive the email? Click to resend</button>
                    </div>
                </div>

                <!-- Form -->
                <form v-else class="space-y-6" @submit.prevent="handleForgotPassword">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-700 mb-2"> Email Address </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-stone-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="you@example.com" />
                        </div>
                        <p class="mt-2 text-xs text-stone-500">Enter the email address associated with your account</p>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full relative px-6 py-3 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl overflow-hidden group shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="!loading" class="relative z-10">Send Reset Link</span>
                        <span v-else class="relative z-10 flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-linear-to-r from-amber-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </form>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center mt-8">
                <NuxtLink to="/login" class="inline-flex items-center text-sm text-stone-600 hover:text-amber-600 transition-colors group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Sign In
                </NuxtLink>
            </div>
        </div>
    </div>
</template>

<script setup>
    useHead({
        title: "Mini CRM | Forgot Password",
    });

    definePageMeta({
        layout: "public",
    });

    const form = ref({
        email: "",
    });

    const loading = ref(false);
    const emailSent = ref(false);

    const handleForgotPassword = async () => {
        loading.value = true;

        // Simulate API call
        setTimeout(() => {
            console.log("Password reset requested for:", form.value.email);
            emailSent.value = true;
            loading.value = false;
            // Add your password reset logic here
        }, 1500);
    };

    const resetForm = () => {
        emailSent.value = false;
        form.value.email = "";
    };
</script>
