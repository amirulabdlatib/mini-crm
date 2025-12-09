<template>
    <div class="fixed top-20 sm:top-4 right-4 z-60 space-y-3 max-w-sm w-full px-4 sm:px-0">
        <TransitionGroup name="toast">
            <div
                v-for="toast in toasts"
                :key="toast.id"
                :class="['flex items-start gap-3 p-4 rounded-xl shadow-xl border backdrop-blur-sm transform transition-all duration-300 ease-in-out', toastStyles[toast.type].bg, toastStyles[toast.type].border]">
                <!-- Icon with colored background -->
                <div :class="['shrink-0 w-9 h-9 rounded-lg flex items-center justify-center', toastStyles[toast.type].iconBg]">
                    <svg v-if="toast.type === 'success'" :class="['w-5 h-5', toastStyles[toast.type].iconColor]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                    <svg v-else-if="toast.type === 'error'" :class="['w-5 h-5', toastStyles[toast.type].iconColor]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m15 9-6 6M9 9l6 6" />
                    </svg>
                    <svg v-else-if="toast.type === 'warning'" :class="['w-5 h-5', toastStyles[toast.type].iconColor]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                        <path d="M12 9v4M12 17h.01" />
                    </svg>
                    <svg v-else :class="['w-5 h-5', toastStyles[toast.type].iconColor]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4M12 8h.01" />
                    </svg>
                </div>

                <!-- Message -->
                <p :class="['flex-1 text-sm font-medium leading-relaxed', toastStyles[toast.type].textColor]">
                    {{ toast.message }}
                </p>

                <!-- Close Button -->
                <button :class="['shrink-0 transition-colors rounded-lg p-1 hover:bg-stone-200/50', toastStyles[toast.type].closeColor]" aria-label="Close" @click="removeToast(toast.id)">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </TransitionGroup>
    </div>
</template>

<script setup>
    const { toasts, removeToast } = useToast();

    const toastStyles = {
        success: {
            bg: "bg-white/95",
            border: "border-green-200",
            iconBg: "bg-green-100",
            iconColor: "text-green-600",
            textColor: "text-stone-900",
            closeColor: "text-stone-400 hover:text-stone-600",
        },
        error: {
            bg: "bg-white/95",
            border: "border-red-200",
            iconBg: "bg-red-100",
            iconColor: "text-red-600",
            textColor: "text-stone-900",
            closeColor: "text-stone-400 hover:text-stone-600",
        },
        warning: {
            bg: "bg-white/95",
            border: "border-amber-200",
            iconBg: "bg-amber-100",
            iconColor: "text-amber-600",
            textColor: "text-stone-900",
            closeColor: "text-stone-400 hover:text-stone-600",
        },
        info: {
            bg: "bg-white/95",
            border: "border-blue-200",
            iconBg: "bg-blue-100",
            iconColor: "text-blue-600",
            textColor: "text-stone-900",
            closeColor: "text-stone-400 hover:text-stone-600",
        },
    };
</script>

<style scoped>
    .toast-enter-active {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .toast-leave-active {
        transition: all 0.3s ease;
    }

    .toast-enter-from {
        opacity: 0;
        transform: translateX(100%) scale(0.9);
    }

    .toast-leave-to {
        opacity: 0;
        transform: translateX(100%) scale(0.9);
    }

    .toast-move {
        transition: transform 0.4s ease;
    }
</style>
