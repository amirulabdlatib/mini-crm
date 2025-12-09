<template>
    <nav :class="['fixed top-0 right-0 h-16 bg-white/80 backdrop-blur-xl border-b border-stone-200/80 transition-all duration-300 z-30', sidebarCollapsed ? 'left-20' : 'left-64']">
        <div class="h-full px-6 flex items-center justify-between">
            <!-- Left Side - Search -->
            <div class="flex-1 max-w-2xl">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <Icon name="lucide:search" class="h-5 w-5 text-stone-400" />
                    </div>
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search leads, clients, deals..."
                        class="block w-full pl-10 pr-4 py-2.5 border border-stone-200 rounded-xl text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 bg-stone-50/50" />
                    <div v-if="searchQuery" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button class="text-stone-400 hover:text-stone-600 transition-colors" @click="searchQuery = ''">
                            <Icon name="lucide:x" class="h-4 w-4" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side - Actions -->
            <div class="flex items-center space-x-2 ml-6">
                <!-- Quick Add Button -->
                <button
                    class="relative px-4 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 flex items-center space-x-2 group"
                    @click="showQuickAdd = !showQuickAdd">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span class="hidden md:inline">Quick Add</span>
                </button>

                <!-- Notifications -->
                <div class="relative">
                    <button class="relative p-2.5 rounded-xl hover:bg-stone-100 transition-colors duration-200 text-stone-600 hover:text-amber-600" @click="showNotifications = !showNotifications">
                        <Icon name="lucide:bell" class="w-5 h-5" />
                        <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition ease-in duration-150"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 translate-y-1">
                        <div v-if="showNotifications" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-stone-200 overflow-hidden">
                            <div class="p-4 border-b border-stone-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-stone-900">Notifications</h3>
                                    <button class="text-xs text-amber-600 hover:text-amber-700 font-medium">Mark all read</button>
                                </div>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <div class="p-4 hover:bg-stone-50 transition-colors cursor-pointer border-b border-stone-100">
                                    <div class="flex space-x-3">
                                        <div class="shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <Icon name="lucide:user" class="w-5 h-5 text-blue-600" />
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-stone-900 font-medium">New lead assigned</p>
                                            <p class="text-xs text-stone-500 mt-0.5">John Doe has been assigned to you</p>
                                            <p class="text-xs text-stone-400 mt-1">2 minutes ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-stone-50 transition-colors cursor-pointer border-b border-stone-100">
                                    <div class="flex space-x-3">
                                        <div class="shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <Icon name="lucide:check-circle" class="w-5 h-5 text-green-600" />
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-stone-900 font-medium">Deal won!</p>
                                            <p class="text-xs text-stone-500 mt-0.5">Enterprise Package deal closed</p>
                                            <p class="text-xs text-stone-400 mt-1">1 hour ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-stone-50 transition-colors cursor-pointer">
                                    <div class="flex space-x-3">
                                        <div class="shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-stone-900 font-medium">Task reminder</p>
                                            <p class="text-xs text-stone-500 mt-0.5">Follow up call with Sarah Johnson</p>
                                            <p class="text-xs text-stone-400 mt-1">3 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 bg-stone-50 border-t border-stone-200 text-center">
                                <button class="text-xs text-amber-600 hover:text-amber-700 font-medium">View all notifications</button>
                            </div>
                        </div>
                    </transition>
                </div>

                <!-- User Menu -->
                <div class="relative">
                    <button class="flex items-center space-x-3 p-2 rounded-xl hover:bg-stone-100 transition-colors duration-200" @click="showUserMenu = !showUserMenu">
                        <div class="w-9 h-9 rounded-full bg-linear-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-semibold shadow-lg text-sm">A</div>
                        <Icon name="lucide:chevron-down" class="w-4 h-4 text-stone-400" />
                    </button>

                    <!-- User Dropdown -->
                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition ease-in duration-150"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 translate-y-1">
                        <div v-if="showUserMenu" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-stone-200 overflow-hidden">
                            <div class="p-4 border-b border-stone-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-full bg-linear-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-semibold shadow-lg">A</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-stone-900 truncate">Admin User</p>
                                        <p class="text-xs text-stone-500 truncate">admin@minicrm.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
                                <NuxtLink to="/profile" class="flex items-center px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 transition-colors space-x-2">
                                    <Icon name="lucide:user" class="w-4 h-4 text-stone-400" />
                                    <span>Profile</span>
                                </NuxtLink>
                            </div>
                            <div class="border-t border-stone-200 py-2">
                                <button class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors space-x-2" @click="handleLogout">
                                    <Icon name="lucide:log-out" class="w-4 h-4 text-stone-400" />
                                    <span>Logout</span>
                                </button>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    const { sidebarCollapsed } = defineProps({
        sidebarCollapsed: {
            type: Boolean,
            default: false,
        },
    });

    const searchQuery = ref("");
    const showNotifications = ref(false);
    const showUserMenu = ref(false);
    const showQuickAdd = ref(false);

    const handleLogout = () => {
        // Add logout logic here
        console.log("Logging out...");
        navigateTo("/login");
    };

    // Close dropdowns when clicking outside
    const closeDropdowns = () => {
        showNotifications.value = false;
        showUserMenu.value = false;
        showQuickAdd.value = false;
    };

    onMounted(() => {
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".relative")) {
                closeDropdowns();
            }
        });
    });
</script>
