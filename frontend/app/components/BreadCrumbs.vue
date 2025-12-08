<template>
    <nav class="flex items-center space-x-2 text-sm">
        <NuxtLink to="/dashboard" class="flex items-center text-stone-500 hover:text-amber-600 transition-colors duration-200 group">
            <Icon name="lucide:home" class="w-4 h-4 mr-1 group-hover:scale-110 transition-transform duration-200" />
            <span class="font-medium">Home</span>
        </NuxtLink>

        <template v-for="(item, index) in breadcrumbs" :key="index">
            <Icon name="lucide:chevron-right" class="w-4 h-4 text-stone-300 shrink-0" />

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
