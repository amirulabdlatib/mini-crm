<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Roles & Permissions</h1>
                <p class="text-stone-600 mt-1">Manage user roles and access controls</p>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2" @click="exportRoles">
                    <Icon name="lucide:download" class="w-4 h-4" />
                    <span>Export</span>
                </button>
                <button
                    class="px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 flex items-center space-x-2"
                    @click="showCreateModal = true">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Role</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Total Roles</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ roles.length }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:shield" class="w-6 h-6 text-purple-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">System Roles</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ systemRolesCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:lock" class="w-6 h-6 text-blue-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Custom Roles</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ customRolesCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:settings" class="w-6 h-6 text-amber-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Total Users</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ totalUsersCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:users" class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-xl border border-stone-200 p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <Icon name="lucide:search" class="w-5 h-5 text-stone-400" />
                        </div>
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search roles by name or description..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-stone-300 rounded-xl text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200" />
                    </div>
                </div>

                <!-- Type Filter -->
                <div>
                    <select v-model="filters.type" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">All Types</option>
                        <option value="system">System Roles</option>
                        <option value="custom">Custom Roles</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <!-- Table Header Actions -->
            <div class="px-6 py-4 border-b border-stone-200 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <input v-model="selectAll" type="checkbox" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" @change="toggleSelectAll" />
                    <span class="text-sm text-stone-600"> {{ selectedRoles.length }} selected </span>
                    <div v-if="selectedRoles.length > 0" class="flex items-center space-x-2">
                        <button class="px-3 py-1.5 text-xs font-medium text-stone-700 border border-stone-300 rounded-lg hover:bg-stone-50 transition-colors">Bulk Edit</button>
                        <button class="px-3 py-1.5 text-xs font-medium text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition-colors">Delete</button>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="p-2 text-stone-600 hover:bg-stone-100 rounded-lg transition-colors">
                        <Icon name="lucide:filter" class="w-5 h-5" />
                    </button>
                    <button class="p-2 text-stone-600 hover:bg-stone-100 rounded-lg transition-colors">
                        <Icon name="lucide:settings-2" class="w-5 h-5" />
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left">
                                <input v-model="selectAll" type="checkbox" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" @change="toggleSelectAll" />
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Role Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Users</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Permissions</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Updated</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="role in filteredRoles" :key="role.id" class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input v-model="selectedRoles" type="checkbox" :value="role.id" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div :class="['w-10 h-10 rounded-xl flex items-center justify-center shrink-0', getRoleIconClass(role.type)]">
                                        <Icon :name="getRoleIcon(role.type)" class="w-5 h-5" />
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-stone-900">{{ role.name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-stone-900 max-w-md">{{ role.description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getRoleTypeClass(role.type)" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ role.type === "system" ? "System" : "Custom" }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="text-sm text-amber-600 hover:text-amber-900 font-medium transition-colors" @click="viewRoleUsers(role.id)">{{ role.users_count }} users</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-900 font-medium">{{ role.permissions.length }} permissions</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                {{ formatDate(role.updated_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-amber-600 hover:text-amber-900 transition-colors" @click="viewRole(role.id)">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button class="text-stone-600 hover:text-stone-900 transition-colors" @click="editRole(role.id)">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-900 transition-colors" @click="duplicateRole(role.id)">
                                        <Icon name="lucide:copy" class="w-5 h-5" />
                                    </button>
                                    <button v-if="role.type === 'custom'" class="text-red-600 hover:text-red-900 transition-colors" @click="deleteRole(role.id)">
                                        <Icon name="lucide:trash-2" class="w-5 h-5" />
                                    </button>
                                    <div v-else class="text-stone-400" title="System role - protected">
                                        <Icon name="lucide:lock" class="w-5 h-5" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-stone-200 flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-stone-300 text-sm font-medium rounded-lg text-stone-700 bg-white hover:bg-stone-50">Previous</button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-stone-300 text-sm font-medium rounded-lg text-stone-700 bg-white hover:bg-stone-50">Next</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-stone-700">
                            Showing
                            <span class="font-medium">1</span>
                            to
                            <span class="font-medium">{{ Math.min(10, filteredRoles.length) }}</span>
                            of
                            <span class="font-medium">{{ filteredRoles.length }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-lg shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-lg border border-stone-300 bg-white text-sm font-medium text-stone-500 hover:bg-stone-50">
                                <Icon name="lucide:chevron-left" class="w-5 h-5" />
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-stone-300 bg-amber-50 text-sm font-medium text-amber-600">1</button>
                            <button class="relative inline-flex items-center px-2 py-2 rounded-r-lg border border-stone-300 bg-white text-sm font-medium text-stone-500 hover:bg-stone-50">
                                <Icon name="lucide:chevron-right" class="w-5 h-5" />
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    useHead({
        title: "Roles & Permissions | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const showCreateModal = ref(false);
    const selectAll = ref(false);
    const selectedRoles = ref([]);

    const filters = ref({
        search: "",
        type: "",
    });

    // Sample roles data
    const roles = ref([
        {
            id: 1,
            name: "Admin",
            type: "system",
            description: "Full system access with all permissions. Can manage users, roles, and all CRM modules.",
            users_count: 2,
            permissions: [
                { category: "users", name: "view_users" },
                { category: "users", name: "create_users" },
                { category: "users", name: "edit_users" },
                { category: "users", name: "delete_users" },
                { category: "leads", name: "view_leads" },
                { category: "leads", name: "create_leads" },
                { category: "leads", name: "edit_leads" },
                { category: "leads", name: "delete_leads" },
                { category: "deals", name: "view_deals" },
                { category: "deals", name: "create_deals" },
                { category: "deals", name: "edit_deals" },
                { category: "deals", name: "delete_deals" },
                { category: "products", name: "view_products" },
                { category: "products", name: "create_products" },
                { category: "products", name: "edit_products" },
                { category: "products", name: "delete_products" },
                { category: "settings", name: "manage_settings" },
                { category: "settings", name: "manage_roles" },
            ],
            updated_at: "2025-01-05",
        },
        {
            id: 2,
            name: "Sales Manager",
            type: "system",
            description: "Manage sales team, view all leads and deals, assign tasks, and generate reports.",
            users_count: 3,
            permissions: [
                { category: "leads", name: "view_leads" },
                { category: "leads", name: "create_leads" },
                { category: "leads", name: "edit_leads" },
                { category: "leads", name: "view_all_leads" },
                { category: "deals", name: "view_deals" },
                { category: "deals", name: "create_deals" },
                { category: "deals", name: "edit_deals" },
                { category: "deals", name: "view_all_deals" },
                { category: "tasks", name: "view_tasks" },
                { category: "tasks", name: "create_tasks" },
                { category: "tasks", name: "assign_tasks" },
                { category: "reports", name: "view_reports" },
                { category: "reports", name: "generate_reports" },
            ],
            updated_at: "2025-01-03",
        },
        {
            id: 3,
            name: "Salesperson",
            type: "system",
            description: "Manage own leads and deals, create tasks, and update client information.",
            users_count: 5,
            permissions: [
                { category: "leads", name: "view_leads" },
                { category: "leads", name: "create_leads" },
                { category: "leads", name: "edit_own_leads" },
                { category: "deals", name: "view_deals" },
                { category: "deals", name: "create_deals" },
                { category: "deals", name: "edit_own_deals" },
                { category: "clients", name: "view_clients" },
                { category: "clients", name: "edit_clients" },
                { category: "tasks", name: "view_tasks" },
                { category: "tasks", name: "create_tasks" },
                { category: "tasks", name: "edit_own_tasks" },
            ],
            updated_at: "2025-01-02",
        },
        {
            id: 4,
            name: "Sales Support",
            type: "custom",
            description: "Support sales team with lead qualification and data entry. Limited access to sensitive information.",
            users_count: 2,
            permissions: [
                { category: "leads", name: "view_leads" },
                { category: "leads", name: "create_leads" },
                { category: "leads", name: "edit_leads" },
                { category: "clients", name: "view_clients" },
                { category: "tasks", name: "view_tasks" },
                { category: "tasks", name: "create_tasks" },
            ],
            updated_at: "2024-12-28",
        },
        {
            id: 5,
            name: "Account Manager",
            type: "custom",
            description: "Manage client relationships and deals. Focus on existing customer accounts.",
            users_count: 3,
            permissions: [
                { category: "clients", name: "view_clients" },
                { category: "clients", name: "edit_clients" },
                { category: "deals", name: "view_deals" },
                { category: "deals", name: "create_deals" },
                { category: "deals", name: "edit_deals" },
                { category: "tasks", name: "view_tasks" },
                { category: "tasks", name: "create_tasks" },
                { category: "reports", name: "view_reports" },
            ],
            updated_at: "2024-12-25",
        },
        {
            id: 6,
            name: "Marketing",
            type: "custom",
            description: "Access leads and campaign data. Can view analytics but cannot modify deals.",
            users_count: 2,
            permissions: [
                { category: "leads", name: "view_leads" },
                { category: "leads", name: "create_leads" },
                { category: "campaigns", name: "view_campaigns" },
                { category: "campaigns", name: "manage_campaigns" },
                { category: "reports", name: "view_reports" },
                { category: "reports", name: "view_analytics" },
            ],
            updated_at: "2024-12-20",
        },
    ]);

    // Computed
    const filteredRoles = computed(() => {
        return roles.value.filter((role) => {
            const matchesSearch = !filters.value.search || role.name.toLowerCase().includes(filters.value.search.toLowerCase()) || role.description.toLowerCase().includes(filters.value.search.toLowerCase());

            const matchesType = !filters.value.type || role.type === filters.value.type;

            return matchesSearch && matchesType;
        });
    });

    const systemRolesCount = computed(() => {
        return roles.value.filter((role) => role.type === "system").length;
    });

    const customRolesCount = computed(() => {
        return roles.value.filter((role) => role.type === "custom").length;
    });

    const totalUsersCount = computed(() => {
        return roles.value.reduce((sum, role) => sum + role.users_count, 0);
    });

    // Methods
    const toggleSelectAll = () => {
        if (selectAll.value) {
            selectedRoles.value = filteredRoles.value.map((role) => role.id);
        } else {
            selectedRoles.value = [];
        }
    };

    const getRoleIconClass = (type) => {
        return type === "system" ? "bg-blue-100 text-blue-600" : "bg-amber-100 text-amber-600";
    };

    const getRoleIcon = (type) => {
        return type === "system" ? "lucide:shield-check" : "lucide:shield";
    };

    const getRoleTypeClass = (type) => {
        return type === "system" ? "bg-blue-100 text-blue-800" : "bg-amber-100 text-amber-800";
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        const today = new Date();
        const diffTime = Math.abs(today - date);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays === 0) return "Today";
        if (diffDays === 1) return "Yesterday";
        if (diffDays < 7) return `${diffDays} days ago`;

        return date.toLocaleDateString("en-MY", { year: "numeric", month: "short", day: "numeric" });
    };

    const viewRole = (id) => {
        navigateTo(`/roles/${id}`);
    };

    const editRole = (id) => {
        navigateTo(`/roles/${id}/edit`);
    };

    const viewRoleUsers = (id) => {
        navigateTo(`/users?role=${id}`);
    };

    const duplicateRole = (id) => {
        console.log("Duplicating role:", id);
        // Add duplicate logic here
    };

    const deleteRole = (id) => {
        if (confirm("Are you sure you want to delete this role?")) {
            roles.value = roles.value.filter((role) => role.id !== id);
        }
    };

    const exportRoles = () => {
        console.log("Exporting roles...");
        // Add export logic here
    };

    // Watch for selection changes
    watch(
        selectedRoles,
        (newVal) => {
            selectAll.value = newVal.length === filteredRoles.value.length && filteredRoles.value.length > 0;
        },
        { deep: true }
    );
</script>
