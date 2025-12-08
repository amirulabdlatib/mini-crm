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
                <h1 class="text-3xl font-bold text-stone-900 mb-2">Create your account</h1>
                <p class="text-stone-600">Start managing your sales pipeline today</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 p-8">
                <form @submit.prevent="handleRegister" class="space-y-5">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-stone-700 mb-2"> Full Name </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-stone-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="John Doe" />
                        </div>
                    </div>

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
                    </div>

                    <!-- Company Input -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-stone-700 mb-2"> Company Name <span class="text-stone-400 text-xs">(Optional)</span> </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <input
                                id="company"
                                v-model="form.company"
                                type="text"
                                class="block w-full pl-10 pr-3 py-3 border border-stone-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="Your Company Sdn Bhd" />
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-700 mb-2"> Password </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                class="block w-full pl-10 pr-10 py-3 border border-stone-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="••••••••" />
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600">
                                <svg v-if="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Password strength indicator -->
                        <div class="mt-2">
                            <div class="flex gap-1">
                                <div :class="['h-1 flex-1 rounded-full transition-all duration-300', passwordStrength >= 1 ? 'bg-amber-500' : 'bg-stone-200']"></div>
                                <div :class="['h-1 flex-1 rounded-full transition-all duration-300', passwordStrength >= 2 ? 'bg-amber-500' : 'bg-stone-200']"></div>
                                <div :class="['h-1 flex-1 rounded-full transition-all duration-300', passwordStrength >= 3 ? 'bg-emerald-500' : 'bg-stone-200']"></div>
                                <div :class="['h-1 flex-1 rounded-full transition-all duration-300', passwordStrength >= 4 ? 'bg-emerald-500' : 'bg-stone-200']"></div>
                            </div>
                            <p class="text-xs text-stone-500 mt-1">
                                {{ passwordStrengthText }}
                            </p>
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-stone-700 mb-2"> Confirm Password </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input
                                id="confirmPassword"
                                v-model="form.confirmPassword"
                                :type="showConfirmPassword ? 'text' : 'password'"
                                required
                                class="block w-full pl-10 pr-10 py-3 border border-stone-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="••••••••" />
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600">
                                <svg v-if="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <input id="terms" v-model="form.agreeToTerms" type="checkbox" required class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-stone-300 rounded cursor-pointer mt-1" />
                        <label for="terms" class="ml-2 block text-sm text-stone-700 cursor-pointer">
                            I agree to the
                            <a href="#" class="font-medium text-amber-600 hover:text-amber-700">Terms of Service</a>
                            and
                            <a href="#" class="font-medium text-amber-600 hover:text-amber-700">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="loading || !isFormValid"
                        class="w-full relative px-6 py-3 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl overflow-hidden group shadow-lg shadow-amber-500/25 hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="!loading" class="relative z-10">Create Account</span>
                        <span v-else class="relative z-10 flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-linear-to-r from-amber-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-stone-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white/70 text-stone-500">Or sign up with</span>
                        </div>
                    </div>

                    <!-- Social Register Buttons -->
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="flex items-center justify-center px-4 py-3 border border-stone-300 rounded-xl hover:bg-stone-50 transition-all duration-200 bg-white/50">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span class="ml-2 text-sm font-medium text-stone-700">Google</span>
                        </button>
                        <button type="button" class="flex items-center justify-center px-4 py-3 border border-stone-300 rounded-xl hover:bg-stone-50 transition-all duration-200 bg-white/50">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                            <span class="ml-2 text-sm font-medium text-stone-700">GitHub</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sign In Link -->
            <p class="text-center mt-8 text-sm text-stone-600">
                Already have an account?
                <a href="/login" class="font-semibold text-amber-600 hover:text-amber-700 transition-colors"> Sign in </a>
            </p>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed } from "vue";

    definePageMeta({
        layout: "public",
    });

    const form = ref({
        name: "",
        email: "",
        company: "",
        password: "",
        confirmPassword: "",
        agreeToTerms: false,
    });

    const showPassword = ref(false);
    const showConfirmPassword = ref(false);
    const loading = ref(false);

    const passwordStrength = computed(() => {
        const password = form.value.password;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        return strength;
    });

    const passwordStrengthText = computed(() => {
        const texts = ["", "Weak", "Fair", "Good", "Strong"];
        return texts[passwordStrength.value];
    });

    const isFormValid = computed(() => {
        return form.value.name && form.value.email && form.value.password && form.value.confirmPassword && form.value.password === form.value.confirmPassword && form.value.agreeToTerms;
    });

    const handleRegister = async () => {
        if (!isFormValid.value) {
            return;
        }

        loading.value = true;

        // Simulate API call
        setTimeout(() => {
            console.log("Register:", form.value);
            loading.value = false;
            // Add your registration logic here
        }, 1500);
    };
</script>
