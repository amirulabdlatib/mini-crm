<template>
    <nav class="flex items-center space-x-2 text-sm">
        <NuxtLink to="/dashboard" class="flex items-center text-stone-500 hover:text-amber-600 transition-colors duration-200 group">
            <svg class="w-4 h-4 mr-1 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Home</span>
        </NuxtLink>

        <template v-for="(item, index) in breadcrumbs" :key="index">
            <svg class="w-4 h-4 text-stone-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>

            <NuxtLink v-if="item.to && index < breadcrumbs.length - 1" :to="item.to" class="text-stone-500 hover:text-amber-600 transition-colors duration-200 font-medium">
                {{ item.label }}
            </NuxtLink>

            <span v-else class="text-stone-900 font-semibold">
                {{ item.label }}
            </span>
        </template>
    </nav>
</template>

<script setup>
    const props = defineProps({
        items: {
            type: Array,
            default: () => [],
        },
    });

    const route = useRoute();

    // Generate breadcrumbs based on route or use provided items
    const breadcrumbs = computed(() => {
        if (props.items && props.items.length > 0) {
            return props.items;
        }

        // Auto-generate from route path
        const paths = route.path.split("/").filter((p) => p);
        const items = [];

        paths.forEach((path, index) => {
            const to = "/" + paths.slice(0, index + 1).join("/");
            const label = path.charAt(0).toUpperCase() + path.slice(1).replace(/-/g, " ");

            items.push({
                label,
                to: index < paths.length - 1 ? to : null,
            });
        });

        return items;
    });
</script>
