<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">RBAC Permissions</h1>
                <p class="text-stone-600 mt-1">Manage role-based access control and permissions</p>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button v-if="changesPending > 0" class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2" @click="cancelChanges">
                    <Icon name="lucide:x" class="w-4 h-4" />
                    <span>Cancel</span>
                </button>
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2" @click="resetPermissions">
                    <Icon name="lucide:refresh-cw" class="w-4 h-4" />
                    <span>Reset</span>
                </button>
                <button
                    :disabled="changesPending === 0"
                    :class="[
                        'px-6 py-2.5 font-semibold rounded-xl transition-all duration-300 flex items-center space-x-2',
                        changesPending > 0 ? 'bg-linear-to-r from-amber-600 to-orange-600 text-white hover:shadow-lg hover:shadow-amber-500/30 cursor-pointer' : 'bg-stone-300 text-stone-500 cursor-not-allowed',
                    ]"
                    @click="updatePermissions">
                    <Icon name="lucide:check" class="w-4 h-4" />
                    <span>Update Permissions</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Total Permissions</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ totalPermissions }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:key" class="w-6 h-6 text-purple-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Permission Groups</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ permissionCategories.length }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:folder" class="w-6 h-6 text-blue-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Active Roles</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ roles.length }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:shield" class="w-6 h-6 text-amber-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Changes Pending</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ changesPending }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:alert-circle" class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Selection -->
        <div class="bg-white rounded-xl border border-stone-200 p-4">
            <div class="flex items-center space-x-4">
                <label class="text-sm font-semibold text-stone-900">Select Role:</label>
                <div class="flex-1 max-w-md">
                    <select v-model="selectedRole" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">View All Roles</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>
                <div v-if="selectedRole" class="flex items-center space-x-2 px-4 py-2 bg-amber-50 rounded-lg border border-amber-200">
                    <Icon name="lucide:shield" class="w-4 h-4 text-amber-600" />
                    <span class="text-sm font-medium text-amber-900">{{ getRoleName(selectedRole) }}</span>
                </div>
            </div>
        </div>

        <!-- RBAC Matrix -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-stone-200 bg-stone-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-stone-900">Permission Matrix</h3>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 text-stone-600 hover:bg-stone-100 rounded-lg transition-colors" @click="expandAll">
                            <Icon name="lucide:chevrons-down" class="w-5 h-5" />
                        </button>
                        <button class="p-2 text-stone-600 hover:bg-stone-100 rounded-lg transition-colors" @click="collapseAll">
                            <Icon name="lucide:chevrons-up" class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Matrix Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-stone-50 border-b border-stone-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider w-64">Permission</th>
                            <th v-for="role in filteredRolesForMatrix" :key="role.id" scope="col" class="px-4 py-3 text-center text-xs font-semibold text-stone-600 uppercase tracking-wider">
                                <div class="flex flex-col items-center space-y-1">
                                    <Icon :name="getRoleIconForMatrix(role.type)" class="w-5 h-5" :class="role.type === 'system' ? 'text-blue-600' : 'text-amber-600'" />
                                    <span>{{ role.name }}</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <template v-for="category in permissionCategories" :key="category.name">
                            <!-- Category Header -->
                            <tr class="bg-stone-50 hover:bg-stone-100 transition-colors cursor-pointer" @click="toggleCategory(category.name)">
                                <td class="px-6 py-3" colspan="100%">
                                    <div class="flex items-center space-x-3">
                                        <Icon :name="expandedCategories.includes(category.name) ? 'lucide:chevron-down' : 'lucide:chevron-right'" class="w-5 h-5 text-stone-500" />
                                        <Icon :name="category.icon" class="w-5 h-5 text-stone-600" />
                                        <span class="text-sm font-semibold text-stone-900">{{ category.label }}</span>
                                        <span class="text-xs text-stone-500">({{ category.permissions.length }} permissions)</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- Permissions Rows -->
                            <template v-if="expandedCategories.includes(category.name)">
                                <tr v-for="permission in category.permissions" :key="permission.key" class="hover:bg-stone-50 transition-colors">
                                    <td class="px-6 py-3">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-stone-900">{{ permission.label }}</span>
                                            <span class="text-xs text-stone-500">{{ permission.description }}</span>
                                        </div>
                                    </td>
                                    <td v-for="role in filteredRolesForMatrix" :key="role.id" class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center">
                                            <input
                                                v-model="rolePermissions[role.id]"
                                                type="checkbox"
                                                :value="permission.key"
                                                :disabled="role.type === 'system' && isSystemProtected(role.id, permission.key)"
                                                class="w-5 h-5 text-amber-600 border-stone-300 rounded focus:ring-amber-500 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                                                @change="markAsChanged(role.id, permission.key)" />
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Legend -->
            <div class="px-6 py-4 border-t border-stone-200 bg-stone-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-5 h-5 rounded border-2 border-amber-600 bg-amber-50 flex items-center justify-center">
                                <Icon name="lucide:check" class="w-3 h-3 text-amber-600" />
                            </div>
                            <span class="text-xs text-stone-600">Permission Granted</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <Icon name="lucide:lock" class="w-4 h-4 text-stone-400" />
                            <span class="text-xs text-stone-600">System Protected</span>
                        </div>
                    </div>
                    <p class="text-xs text-stone-500">Changes will be applied to all users with the selected role</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    useHead({
        title: "RBAC Permissions | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const selectedRole = ref("");
    const expandedCategories = ref(["users", "leads", "deals"]);
    const changesPending = ref(0);

    // Roles
    const roles = ref([
        { id: 1, name: "Admin", type: "system" },
        { id: 2, name: "Sales Manager", type: "system" },
        { id: 3, name: "Salesperson", type: "system" },
        { id: 4, name: "Sales Support", type: "custom" },
        { id: 5, name: "Account Manager", type: "custom" },
        { id: 6, name: "Marketing", type: "custom" },
    ]);

    // Permission Categories
    const permissionCategories = ref([
        {
            name: "users",
            label: "User Management",
            icon: "lucide:users",
            permissions: [
                { key: "users.view", label: "View Users", description: "Can view user list and profiles" },
                { key: "users.create", label: "Create Users", description: "Can add new users to the system" },
                { key: "users.edit", label: "Edit Users", description: "Can modify user information" },
                { key: "users.delete", label: "Delete Users", description: "Can remove users from the system" },
            ],
        },
        {
            name: "roles",
            label: "Role Management",
            icon: "lucide:shield",
            permissions: [
                { key: "roles.view", label: "View Roles", description: "Can view role list and details" },
                { key: "roles.create", label: "Create Roles", description: "Can create custom roles" },
                { key: "roles.edit", label: "Edit Roles", description: "Can modify role permissions" },
                { key: "roles.delete", label: "Delete Roles", description: "Can delete custom roles" },
            ],
        },
        {
            name: "leads",
            label: "Lead Management",
            icon: "lucide:user-plus",
            permissions: [
                { key: "leads.view", label: "View Leads", description: "Can view own leads" },
                { key: "leads.view_all", label: "View All Leads", description: "Can view all leads in the system" },
                { key: "leads.create", label: "Create Leads", description: "Can add new leads" },
                { key: "leads.edit", label: "Edit Leads", description: "Can modify own leads" },
                { key: "leads.edit_all", label: "Edit All Leads", description: "Can modify any lead" },
                { key: "leads.delete", label: "Delete Leads", description: "Can delete leads" },
                { key: "leads.convert", label: "Convert Leads", description: "Can convert leads to clients" },
            ],
        },
        {
            name: "clients",
            label: "Client Management",
            icon: "lucide:briefcase",
            permissions: [
                { key: "clients.view", label: "View Clients", description: "Can view client list and details" },
                { key: "clients.create", label: "Create Clients", description: "Can add new clients" },
                { key: "clients.edit", label: "Edit Clients", description: "Can modify client information" },
                { key: "clients.delete", label: "Delete Clients", description: "Can remove clients" },
            ],
        },
        {
            name: "deals",
            label: "Deal Management",
            icon: "lucide:file-text",
            permissions: [
                { key: "deals.view", label: "View Deals", description: "Can view own deals" },
                { key: "deals.view_all", label: "View All Deals", description: "Can view all deals in the system" },
                { key: "deals.create", label: "Create Deals", description: "Can create new deals" },
                { key: "deals.edit", label: "Edit Deals", description: "Can modify own deals" },
                { key: "deals.edit_all", label: "Edit All Deals", description: "Can modify any deal" },
                { key: "deals.delete", label: "Delete Deals", description: "Can delete deals" },
            ],
        },
        {
            name: "products",
            label: "Product Management",
            icon: "lucide:package",
            permissions: [
                { key: "products.view", label: "View Products", description: "Can view product catalog" },
                { key: "products.create", label: "Create Products", description: "Can add new products" },
                { key: "products.edit", label: "Edit Products", description: "Can modify product details" },
                { key: "products.delete", label: "Delete Products", description: "Can remove products" },
            ],
        },
        {
            name: "tasks",
            label: "Task Management",
            icon: "lucide:check-square",
            permissions: [
                { key: "tasks.view", label: "View Tasks", description: "Can view own tasks" },
                { key: "tasks.view_all", label: "View All Tasks", description: "Can view all team tasks" },
                { key: "tasks.create", label: "Create Tasks", description: "Can create new tasks" },
                { key: "tasks.assign", label: "Assign Tasks", description: "Can assign tasks to others" },
                { key: "tasks.edit", label: "Edit Tasks", description: "Can modify tasks" },
                { key: "tasks.delete", label: "Delete Tasks", description: "Can delete tasks" },
            ],
        },
        {
            name: "reports",
            label: "Reports & Analytics",
            icon: "lucide:bar-chart",
            permissions: [
                { key: "reports.view", label: "View Reports", description: "Can view reports and dashboards" },
                { key: "reports.generate", label: "Generate Reports", description: "Can create custom reports" },
                { key: "reports.export", label: "Export Reports", description: "Can export reports to files" },
            ],
        },
        {
            name: "settings",
            label: "System Settings",
            icon: "lucide:settings",
            permissions: [
                { key: "settings.view", label: "View Settings", description: "Can view system settings" },
                { key: "settings.edit", label: "Edit Settings", description: "Can modify system configuration" },
                { key: "settings.manage_roles", label: "Manage Roles", description: "Can manage role permissions" },
            ],
        },
    ]);

    // Role Permissions (simulated from backend)
    const rolePermissions = ref({
        1: [
            // Admin - all permissions
            "users.view",
            "users.create",
            "users.edit",
            "users.delete",
            "roles.view",
            "roles.create",
            "roles.edit",
            "roles.delete",
            "leads.view",
            "leads.view_all",
            "leads.create",
            "leads.edit",
            "leads.edit_all",
            "leads.delete",
            "leads.convert",
            "clients.view",
            "clients.create",
            "clients.edit",
            "clients.delete",
            "deals.view",
            "deals.view_all",
            "deals.create",
            "deals.edit",
            "deals.edit_all",
            "deals.delete",
            "products.view",
            "products.create",
            "products.edit",
            "products.delete",
            "tasks.view",
            "tasks.view_all",
            "tasks.create",
            "tasks.assign",
            "tasks.edit",
            "tasks.delete",
            "reports.view",
            "reports.generate",
            "reports.export",
            "settings.view",
            "settings.edit",
            "settings.manage_roles",
        ],
        2: [
            // Sales Manager
            "leads.view",
            "leads.view_all",
            "leads.create",
            "leads.edit",
            "leads.edit_all",
            "leads.convert",
            "clients.view",
            "clients.edit",
            "deals.view",
            "deals.view_all",
            "deals.create",
            "deals.edit",
            "deals.edit_all",
            "products.view",
            "tasks.view",
            "tasks.view_all",
            "tasks.create",
            "tasks.assign",
            "tasks.edit",
            "reports.view",
            "reports.generate",
            "reports.export",
        ],
        3: [
            // Salesperson
            "leads.view",
            "leads.create",
            "leads.edit",
            "leads.convert",
            "clients.view",
            "clients.edit",
            "deals.view",
            "deals.create",
            "deals.edit",
            "products.view",
            "tasks.view",
            "tasks.create",
            "tasks.edit",
            "reports.view",
        ],
        4: [
            // Sales Support
            "leads.view",
            "leads.create",
            "leads.edit",
            "clients.view",
            "tasks.view",
            "tasks.create",
        ],
        5: [
            // Account Manager
            "clients.view",
            "clients.edit",
            "deals.view",
            "deals.create",
            "deals.edit",
            "products.view",
            "tasks.view",
            "tasks.create",
            "tasks.edit",
            "reports.view",
        ],
        6: [
            // Marketing
            "leads.view",
            "leads.create",
            "reports.view",
        ],
    });

    // Computed
    const totalPermissions = computed(() => {
        return permissionCategories.value.reduce((sum, category) => sum + category.permissions.length, 0);
    });

    const filteredRolesForMatrix = computed(() => {
        if (selectedRole.value) {
            return roles.value.filter((role) => role.id === parseInt(selectedRole.value));
        }
        return roles.value;
    });

    // Methods
    const getRoleName = (roleId) => {
        const role = roles.value.find((r) => r.id === parseInt(roleId));
        return role ? role.name : "";
    };

    const getRoleIconForMatrix = (type) => {
        return type === "system" ? "lucide:shield-check" : "lucide:shield";
    };

    const toggleCategory = (categoryName) => {
        const index = expandedCategories.value.indexOf(categoryName);
        if (index > -1) {
            expandedCategories.value.splice(index, 1);
        } else {
            expandedCategories.value.push(categoryName);
        }
    };

    const expandAll = () => {
        expandedCategories.value = permissionCategories.value.map((cat) => cat.name);
    };

    const collapseAll = () => {
        expandedCategories.value = [];
    };

    const isSystemProtected = (roleId) => {
        // Admin role (ID 1) has all permissions protected
        if (roleId === 1) return true;
        return false;
    };

    const markAsChanged = () => {
        changesPending.value++;
    };

    const updatePermissions = () => {
        if (changesPending.value === 0) return;

        console.log("Updating permissions:", rolePermissions.value);
        // Add API call here
        alert("Permissions updated successfully!");
        changesPending.value = 0;
    };

    const cancelChanges = () => {
        if (confirm("Are you sure you want to cancel all changes?")) {
            location.reload();
        }
    };

    const resetPermissions = () => {
        if (confirm("Are you sure you want to reset all changes?")) {
            location.reload();
        }
    };

    // Initialize expanded categories
    onMounted(() => {
        expandedCategories.value = permissionCategories.value.map((cat) => cat.name).slice(0, 3);
    });
</script>
