<template>
    <aside :class="['fixed left-0 top-0 h-screen bg-white border-r border-stone-200 transition-all duration-300 ease-in-out z-40 flex flex-col', isCollapsed ? 'w-20' : 'w-64']">
        <!-- Logo Section -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-stone-200">
            <NuxtLink to="/dashboard" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="w-9 h-9 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl transform rotate-45 group-hover:rotate-70 transition-all duration-300 shadow-lg shadow-amber-500/20 flex items-center justify-center">
                        <Icon name="lucide:zap" class="w-5 h-5 text-white transform -rotate-45" />
                    </div>
                </div>
                <span v-show="!isCollapsed" class="text-xl font-bold bg-linear-to-r from-stone-900 to-stone-700 bg-clip-text text-transparent"> MiniCRM </span>
            </NuxtLink>
            <button
                @click="toggleSidebar"
                class="p-2 rounded-lg hover:bg-stone-100 transition-all duration-200 text-stone-600 hover:text-amber-600 transform hover:scale-105"
                :aria-label="isCollapsed ? 'Expand sidebar' : 'Collapse sidebar'">
                <Icon name="lucide:chevron-left" class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': !isCollapsed }" />
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
                    <Icon name="lucide:layout-dashboard" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Dashboard</span>
                </NuxtLink>

                <!-- Leads -->
                <NuxtLink
                    to="/leads"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/leads') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:users" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Leads</span>
                </NuxtLink>

                <!-- Clients -->
                <NuxtLink
                    to="/clients"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/clients') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:briefcase" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Clients</span>
                </NuxtLink>

                <!-- Deals -->
                <NuxtLink
                    to="/deals"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/deals') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:file-text" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Deals</span>
                </NuxtLink>

                <!-- Products -->
                <NuxtLink
                    to="/products"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/products') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:package" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Products</span>
                </NuxtLink>

                <!-- Tasks -->
                <NuxtLink
                    to="/tasks"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/tasks') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:check-square" class="w-5 h-5 shrink-0" />
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
                    <Icon name="lucide:user" class="w-5 h-5 shrink-0" />
                    <span v-show="!isCollapsed" class="ml-3 font-medium">Users</span>
                </NuxtLink>

                <!-- Roles -->
                <NuxtLink
                    to="/roles"
                    :class="[
                        'flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group',
                        isActive('/roles') ? 'bg-linear-to-r from-amber-50 to-orange-50 text-amber-600 shadow-sm' : 'text-stone-600 hover:bg-stone-50 hover:text-amber-600',
                    ]">
                    <Icon name="lucide:shield" class="w-5 h-5 shrink-0" />
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
                    <Icon name="lucide:more-vertical" class="w-4 h-4" />
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
