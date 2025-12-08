<template>
    <div>
        <Hero />
        <Features />
        <Testimonials />
        <ContactUs />
    </div>
</template>

<script setup>
    useHead({
        title: "Mini CRM",
    });

    definePageMeta({
        layout: "public",
    });
</script>

<style scoped>
    html {
        scroll-behavior: smooth;
    }

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
