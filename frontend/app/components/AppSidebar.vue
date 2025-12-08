<template>
    <aside :class="['fixed left-0 top-0 h-screen bg-white border-r border-stone-200 transition-all duration-300 ease-in-out z-40 flex flex-col', isCollapsed ? 'w-20' : 'w-64']">
        <!-- Logo Section -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-stone-200">
            <NuxtLink to="/dashboard" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="w-9 h-9 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl transform rotate-45 group-hover:rotate-70 transition-all duration-300 shadow-lg shadow-amber-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
                <span v-show="!isCollapsed" class="text-xl font-bold bg-linear-to-r from-stone-900 to-stone-700 bg-clip-text text-transparent"> MiniCRM </span>
            </NuxtLink>
            <button @click="toggleSidebar" class="p-2 rounded-lg hover:bg-stone-100 transition-colors duration-200 text-stone-600 hover:text-amber-600">
                <svg v-if="!isCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-6 px-3 pb-0">
            <div class="space-y-1 pb-4">
                <!-- Dashboard -->
                <NuxtLink
                    to="/dashboard"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/dashboard') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Dashboard</span>
                </NuxtLink>

                <!-- Leads -->
                <NuxtLink
                    to="/leads"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/leads') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Leads</span>
                </NuxtLink>

                <!-- Clients -->
                <NuxtLink
                    to="/clients"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/clients') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Clients</span>
                </NuxtLink>

                <!-- Deals -->
                <NuxtLink
                    to="/deals"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/deals') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Deals</span>
                </NuxtLink>

                <!-- Products -->
                <NuxtLink
                    to="/products"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/products') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Products</span>
                </NuxtLink>

                <!-- Tasks -->
                <NuxtLink
                    to="/tasks"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/tasks') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Tasks</span>
                </NuxtLink>

                <!-- Divider -->
                <div class="my-4 border-t border-stone-200"></div>

                <!-- Settings Section -->
                <div v-show="!isCollapsed" class="px-3 py-2 text-xs font-semibold text-stone-400 uppercase tracking-wider">Settings</div>

                <!-- Users -->
                <NuxtLink
                    to="/users"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/users') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Users</span>
                </NuxtLink>

                <!-- Roles -->
                <NuxtLink
                    to="/roles"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/roles') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Roles</span>
                </NuxtLink>
            </div>
        </nav>

        <!-- User Profile Section -->
        <div class="border-t border-stone-200 p-4 mt-auto">
            <div :class="['flex items-center', isCollapsed ? 'justify-center' : 'space-x-3']">
                <div class="w-10 h-10 rounded-full bg-linear-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-semibold shadow-lg shrink-0">A</div>
                <div v-show="!isCollapsed" class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-stone-900 truncate">Admin User</p>
                    <p class="text-xs text-stone-500 truncate">admin@minicrm.com</p>
                </div>
                <button v-show="!isCollapsed" class="p-2 rounded-lg hover:bg-stone-100 transition-colors duration-200 text-stone-400 hover:text-stone-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </aside>
</template>

<script setup>
    const route = useRoute();
    const isCollapsed = ref(false);

    const toggleSidebar = () => {
        isCollapsed.value = !isCollapsed.value;
    };

    const isActive = (path) => {
        return route.path === path || route.path.startsWith(path + "/");
    };

    // Expose collapsed state for layout adjustments
    defineExpose({
        isCollapsed,
    });
</script>
