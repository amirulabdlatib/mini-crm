<template>
    <div class="min-h-screen bg-stone-50">
        <AppSidebar ref="sidebarRef" />

        <div :class="['transition-all duration-300', sidebarCollapsed ? 'ml-20' : 'ml-64']">
            <AppNavbar :sidebar-collapsed="sidebarCollapsed" />
            <main class="pt-16">
                <div class="px-6 py-4 bg-white border-b border-stone-200">
                    <BreadCrumbs />
                </div>
                <div class="p-6">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
    const sidebarRef = ref(null);
    const sidebarCollapsed = ref(false);

    // Watch for sidebar collapse state changes
    watch(
        () => sidebarRef.value?.isCollapsed,
        (newValue) => {
            if (newValue !== undefined) {
                sidebarCollapsed.value = newValue;
            }
        },
        { deep: true }
    );

    // Poll for sidebar state (alternative approach since ref access might be delayed)
    onMounted(() => {
        const checkSidebarState = () => {
            if (sidebarRef.value?.isCollapsed !== undefined) {
                sidebarCollapsed.value = sidebarRef.value.isCollapsed;
            }
        };

        // Check immediately and set up interval
        checkSidebarState();
        const interval = setInterval(checkSidebarState, 100);

        // Cleanup
        onUnmounted(() => {
            clearInterval(interval);
        });
    });
</script>
