<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Users</h1>
                <p class="text-stone-600 mt-1">Manage team members and their access</p>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2" @click="showImportModal = true">
                    <Icon name="lucide:upload" class="w-4 h-4" />
                    <span>Import</span>
                </button>
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2" @click="exportUsers">
                    <Icon name="lucide:download" class="w-4 h-4" />
                    <span>Export</span>
                </button>
                <button
                    class="px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 flex items-center space-x-2"
                    @click="showCreateModal = true">
                    <Icon name="lucide:user-plus" class="w-4 h-4" />
                    <span>Add User</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Total Users</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ users.length }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:users" class="w-6 h-6 text-blue-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Admins</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ usersByRole("admin") }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:shield" class="w-6 h-6 text-purple-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Sales Managers</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ usersByRole("sales_manager") }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:briefcase" class="w-6 h-6 text-amber-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Salespersons</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">{{ usersByRole("salesperson") }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:user" class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-xl border border-stone-200 p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <Icon name="lucide:search" class="w-5 h-5 text-stone-400" />
                        </div>
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search users by name, email, or role..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-stone-300 rounded-xl text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200" />
                    </div>
                </div>

                <!-- Role Filter -->
                <div>
                    <select v-model="filters.role" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="sales_manager">Sales Manager</option>
                        <option value="salesperson">Salesperson</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select v-model="filters.status" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <!-- Table Header Actions -->
            <div class="px-6 py-4 border-b border-stone-200 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <input v-model="selectAll" type="checkbox" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" @change="toggleSelectAll" />
                    <span class="text-sm text-stone-600"> {{ selectedUsers.length }} selected </span>
                    <div v-if="selectedUsers.length > 0" class="flex items-center space-x-2">
                        <button class="px-3 py-1.5 text-xs font-medium text-stone-700 border border-stone-300 rounded-lg hover:bg-stone-50 transition-colors">Bulk Edit</button>
                        <button class="px-3 py-1.5 text-xs font-medium text-amber-600 border border-amber-300 rounded-lg hover:bg-amber-50 transition-colors">Deactivate</button>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Department</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Last Login</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Created</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="user in filteredUsers" :key="user.id" class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input v-model="selectedUsers" type="checkbox" :value="user.id" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" :src="user.avatar" :alt="user.name" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-stone-900">{{ user.name }}</div>
                                        <div class="text-sm text-stone-500">{{ user.email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getRoleClass(user.role)" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ getRoleLabel(user.role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-stone-900">{{ user.department }}</div>
                                <div class="text-sm text-stone-500">{{ user.phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusClass(user.status)" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ getStatusLabel(user.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                <div class="flex items-center space-x-1">
                                    <Icon name="lucide:clock" class="w-4 h-4" />
                                    <span>{{ formatDate(user.last_login) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                {{ formatDate(user.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-amber-600 hover:text-amber-900 transition-colors" @click="viewUser(user.id)">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button class="text-stone-600 hover:text-stone-900 transition-colors" @click="editUser(user.id)">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button v-if="user.status === 'active'" class="text-amber-600 hover:text-amber-900 transition-colors" @click="toggleUserStatus(user.id)">
                                        <Icon name="lucide:user-x" class="w-5 h-5" />
                                    </button>
                                    <button v-else class="text-green-600 hover:text-green-900 transition-colors" @click="toggleUserStatus(user.id)">
                                        <Icon name="lucide:user-check" class="w-5 h-5" />
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors" @click="deleteUser(user.id)">
                                        <Icon name="lucide:trash-2" class="w-5 h-5" />
                                    </button>
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
                            <span class="font-medium">{{ Math.min(10, filteredUsers.length) }}</span>
                            of
                            <span class="font-medium">{{ filteredUsers.length }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-lg shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-lg border border-stone-300 bg-white text-sm font-medium text-stone-500 hover:bg-stone-50">
                                <Icon name="lucide:chevron-left" class="w-5 h-5" />
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-stone-300 bg-white text-sm font-medium text-stone-700 hover:bg-stone-50">1</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-stone-300 bg-amber-50 text-sm font-medium text-amber-600">2</button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-stone-300 bg-white text-sm font-medium text-stone-700 hover:bg-stone-50">3</button>
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
        title: "Users | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const showCreateModal = ref(false);
    const showImportModal = ref(false);
    const selectAll = ref(false);
    const selectedUsers = ref([]);

    const filters = ref({
        search: "",
        role: "",
        status: "",
    });

    // Sample users data
    const users = ref([
        {
            id: 1,
            name: "Ahmad Faiz",
            email: "ahmad.faiz@minicrm.com",
            phone: "+60 12-345 6789",
            avatar: "https://i.pravatar.cc/150?img=12",
            role: "admin",
            department: "Management",
            status: "active",
            last_login: "2025-01-09T08:30:00",
            created_at: "2024-06-15",
        },
        {
            id: 2,
            name: "Sarah Tan",
            email: "sarah.tan@minicrm.com",
            phone: "+60 16-789 0123",
            avatar: "https://i.pravatar.cc/150?img=5",
            role: "sales_manager",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T09:15:00",
            created_at: "2024-07-20",
        },
        {
            id: 3,
            name: "Kumar Raj",
            email: "kumar.raj@minicrm.com",
            phone: "+60 19-234 5678",
            avatar: "https://i.pravatar.cc/150?img=33",
            role: "salesperson",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T07:45:00",
            created_at: "2024-08-10",
        },
        {
            id: 4,
            name: "Michelle Wong",
            email: "michelle.wong@minicrm.com",
            phone: "+60 11-567 8901",
            avatar: "https://i.pravatar.cc/150?img=9",
            role: "salesperson",
            department: "Sales",
            status: "active",
            last_login: "2025-01-08T16:20:00",
            created_at: "2024-08-15",
        },
        {
            id: 5,
            name: "Azman Hassan",
            email: "azman.hassan@minicrm.com",
            phone: "+60 13-890 1234",
            avatar: "https://i.pravatar.cc/150?img=15",
            role: "sales_manager",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T10:00:00",
            created_at: "2024-09-01",
        },
        {
            id: 6,
            name: "Emily Lim",
            email: "emily.lim@minicrm.com",
            phone: "+60 17-345 6789",
            avatar: "https://i.pravatar.cc/150?img=27",
            role: "salesperson",
            department: "Sales",
            status: "inactive",
            last_login: "2024-12-20T14:30:00",
            created_at: "2024-09-15",
        },
        {
            id: 7,
            name: "Rajan Kumar",
            email: "rajan.kumar@minicrm.com",
            phone: "+60 14-678 9012",
            avatar: "https://i.pravatar.cc/150?img=51",
            role: "salesperson",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T08:00:00",
            created_at: "2024-10-05",
        },
        {
            id: 8,
            name: "Siti Aminah",
            email: "siti.aminah@minicrm.com",
            phone: "+60 18-901 2345",
            avatar: "https://i.pravatar.cc/150?img=20",
            role: "salesperson",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T09:30:00",
            created_at: "2024-10-20",
        },
        {
            id: 9,
            name: "David Chen",
            email: "david.chen@minicrm.com",
            phone: "+60 12-456 7890",
            avatar: "https://i.pravatar.cc/150?img=68",
            role: "admin",
            department: "IT",
            status: "active",
            last_login: "2025-01-09T11:00:00",
            created_at: "2024-11-01",
        },
        {
            id: 10,
            name: "Nurul Huda",
            email: "nurul.huda@minicrm.com",
            phone: "+60 19-567 8901",
            avatar: "https://i.pravatar.cc/150?img=45",
            role: "salesperson",
            department: "Sales",
            status: "active",
            last_login: "2025-01-09T08:45:00",
            created_at: "2024-11-15",
        },
    ]);

    // Computed
    const filteredUsers = computed(() => {
        return users.value.filter((user) => {
            const matchesSearch =
                !filters.value.search ||
                user.name.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                user.email.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                user.role.toLowerCase().includes(filters.value.search.toLowerCase());

            const matchesRole = !filters.value.role || user.role === filters.value.role;
            const matchesStatus = !filters.value.status || user.status === filters.value.status;

            return matchesSearch && matchesRole && matchesStatus;
        });
    });

    const usersByRole = (role) => {
        return users.value.filter((user) => user.role === role).length;
    };

    // Methods
    const toggleSelectAll = () => {
        if (selectAll.value) {
            selectedUsers.value = filteredUsers.value.map((user) => user.id);
        } else {
            selectedUsers.value = [];
        }
    };

    const getRoleClass = (role) => {
        const classes = {
            admin: "bg-purple-100 text-purple-800",
            sales_manager: "bg-amber-100 text-amber-800",
            salesperson: "bg-blue-100 text-blue-800",
        };
        return classes[role] || "bg-stone-100 text-stone-800";
    };

    const getRoleLabel = (role) => {
        const labels = {
            admin: "Admin",
            sales_manager: "Sales Manager",
            salesperson: "Salesperson",
        };
        return labels[role] || role;
    };

    const getStatusClass = (status) => {
        const classes = {
            active: "bg-green-100 text-green-800",
            inactive: "bg-red-100 text-red-800",
        };
        return classes[status] || "bg-stone-100 text-stone-800";
    };

    const getStatusLabel = (status) => {
        const labels = {
            active: "Active",
            inactive: "Inactive",
        };
        return labels[status] || status;
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffMinutes = Math.ceil(diffTime / (1000 * 60));
        const diffHours = Math.ceil(diffTime / (1000 * 60 * 60));
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffMinutes < 60) return `${diffMinutes}m ago`;
        if (diffHours < 24) return `${diffHours}h ago`;
        if (diffDays === 0) return "Today";
        if (diffDays === 1) return "Yesterday";
        if (diffDays < 7) return `${diffDays} days ago`;

        return date.toLocaleDateString("en-MY", { year: "numeric", month: "short", day: "numeric" });
    };

    const viewUser = (id) => {
        navigateTo(`/users/${id}`);
    };

    const editUser = (id) => {
        navigateTo(`/users/${id}/edit`);
    };

    const toggleUserStatus = (id) => {
        const user = users.value.find((u) => u.id === id);
        if (user) {
            user.status = user.status === "active" ? "inactive" : "active";
        }
    };

    const deleteUser = (id) => {
        if (confirm("Are you sure you want to delete this user?")) {
            users.value = users.value.filter((user) => user.id !== id);
        }
    };

    const exportUsers = () => {
        console.log("Exporting users...");
        // Add export logic here
    };

    // Watch for selection changes
    watch(
        selectedUsers,
        (newVal) => {
            selectAll.value = newVal.length === filteredUsers.value.length && filteredUsers.value.length > 0;
        },
        { deep: true }
    );
</script>
