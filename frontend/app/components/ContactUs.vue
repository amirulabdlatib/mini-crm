<template>
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
                    <form class="space-y-6" @submit.prevent="handleSubmit">
                        <div>
                            <label for="name" class="block text-sm font-medium text-stone-700 mb-1">Name</label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200"
                                placeholder="Your name" />
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
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
</template>

<script setup>
    import { DotLottieVue } from "@lottiefiles/dotlottie-vue";

    const form = reactive({
        name: "",
        email: "",
        message: "",
    });

    const handleSubmit = () => {
        // Handle form submission
        console.log("Form submitted:", form);
        // Add your form submission logic here
        alert("Thank you for your message! We will get back to you soon.");
        form = { name: "", email: "", message: "" };
    };
</script>
