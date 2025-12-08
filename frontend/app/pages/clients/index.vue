<template>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-stone-900">Clients</h1>
                <p class="text-sm text-stone-500 mt-1">Manage your customer relationships</p>
            </div>
            <NuxtLink
                to="/clients/create"
                class="inline-flex items-center px-4 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 space-x-2">
                <Icon name="lucide:plus" class="w-4 h-4" />
                <span>Add Client</span>
            </NuxtLink>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-stone-500">Total Clients</h3>
                    <div class="w-10 h-10 bg-linear-to-br from-blue-50 to-blue-100 rounded-lg flex items-center justify-center">
                        <Icon name="lucide:briefcase" class="w-5 h-5 text-blue-600" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-900">{{ stats.total }}</p>
                <p class="text-sm text-green-600 mt-2 flex items-center">
                    <Icon name="lucide:trending-up" class="w-4 h-4 mr-1" />
                    +12% from last month
                </p>
            </div>

            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-stone-500">Active Deals</h3>
                    <div class="w-10 h-10 bg-linear-to-br from-amber-50 to-amber-100 rounded-lg flex items-center justify-center">
                        <Icon name="lucide:file-text" class="w-5 h-5 text-amber-600" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-900">{{ stats.activeDeals }}</p>
                <p class="text-sm text-stone-500 mt-2">Ongoing opportunities</p>
            </div>

            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-stone-500">Total Revenue</h3>
                    <div class="w-10 h-10 bg-linear-to-br from-green-50 to-green-100 rounded-lg flex items-center justify-center">
                        <Icon name="lucide:trending-up" class="w-5 h-5 text-green-600" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-stone-900">RM {{ formatNumber(stats.revenue) }}</p>
                <p class="text-sm text-green-600 mt-2 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-4 h-4 mr-1" />
                    +8.5% this quarter
                </p>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-xl border border-stone-200 p-4">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <Icon name="lucide:search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-stone-400" />
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search clients by name, email, or company..."
                            class="w-full pl-10 pr-4 py-2.5 border border-stone-200 rounded-xl text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 bg-stone-50/50" />
                    </div>
                </div>

                <!-- Industry Filter -->
                <select v-model="selectedIndustry" class="px-4 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 bg-stone-50/50">
                    <option value="">All Industries</option>
                    <option value="technology">Technology</option>
                    <option value="retail">Retail</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="services">Services</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="education">Education</option>
                </select>

                <!-- Status Filter -->
                <select v-model="selectedStatus" class="px-4 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 bg-stone-50/50">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="vip">VIP</option>
                </select>

                <!-- Sort -->
                <select v-model="sortBy" class="px-4 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 bg-stone-50/50">
                    <option value="name">Name (A-Z)</option>
                    <option value="name-desc">Name (Z-A)</option>
                    <option value="recent">Recently Added</option>
                    <option value="revenue">Revenue (High-Low)</option>
                </select>
            </div>
        </div>

        <!-- Clients List -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-stone-50 border-b border-stone-200 px-6 py-3">
                <div class="grid grid-cols-12 gap-4 text-xs font-semibold text-stone-600 uppercase tracking-wider">
                    <div class="col-span-4">Client</div>
                    <div class="col-span-2">Industry</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-2">Revenue</div>
                    <div class="col-span-1">Deals</div>
                    <div class="col-span-1 text-right">Actions</div>
                </div>
            </div>

            <!-- Table Body -->
            <div v-if="loading" class="p-12 text-center">
                <div class="inline-flex items-center space-x-2 text-stone-500">
                    <Icon name="lucide:loader-2" class="w-5 h-5 animate-spin" />
                    <span>Loading clients...</span>
                </div>
            </div>

            <div v-else-if="filteredClients.length === 0" class="p-12 text-center">
                <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <Icon name="lucide:briefcase" class="w-8 h-8 text-stone-400" />
                </div>
                <h3 class="text-lg font-semibold text-stone-900 mb-2">No clients found</h3>
                <p class="text-sm text-stone-500 mb-6">Get started by adding your first client</p>
                <button
                    class="inline-flex items-center px-4 py-2 bg-linear-to-r from-amber-600 to-orange-600 text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 space-x-2"
                    @click="showAddClientModal = true">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Client</span>
                </button>
            </div>

            <div v-else>
                <div v-for="client in filteredClients" :key="client.id" class="border-b border-stone-100 hover:bg-stone-50/50 transition-colors duration-200">
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center">
                        <!-- Client Info -->
                        <div class="col-span-4">
                            <div class="flex items-center space-x-3">
                                <div class="min-w-0">
                                    <NuxtLink :to="`/clients/${client.id}`" class="font-semibold text-stone-900 hover:text-amber-600 transition-colors truncate block">
                                        {{ client.name }}
                                    </NuxtLink>
                                    <p class="text-xs text-stone-500 truncate">{{ client.email }}</p>
                                    <p v-if="client.company" class="text-xs text-stone-400 truncate">{{ client.company }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Industry -->
                        <div class="col-span-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-stone-100 text-stone-700">
                                {{ client.industry }}
                            </span>
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <span
                                :class="[
                                    'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium',
                                    client.status === 'active' ? 'bg-green-100 text-green-700' : '',
                                    client.status === 'inactive' ? 'bg-stone-100 text-stone-700' : '',
                                    client.status === 'vip' ? 'bg-purple-100 text-purple-700' : '',
                                ]">
                                <span :class="['w-1.5 h-1.5 rounded-full mr-1.5', client.status === 'active' ? 'bg-green-500' : '', client.status === 'inactive' ? 'bg-stone-500' : '', client.status === 'vip' ? 'bg-purple-500' : '']"></span>
                                {{ client.status }}
                            </span>
                        </div>

                        <!-- Revenue -->
                        <div class="col-span-2">
                            <p class="text-sm font-semibold text-stone-900">RM {{ formatNumber(client.revenue) }}</p>
                            <p class="text-xs text-stone-500">Total value</p>
                        </div>

                        <!-- Deals Count -->
                        <div class="col-span-1">
                            <div class="flex items-center space-x-1">
                                <Icon name="lucide:file-text" class="w-4 h-4 text-stone-400" />
                                <span class="text-sm font-medium text-stone-900">{{ client.dealsCount }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-1 text-right">
                            <div class="relative inline-block">
                                <button class="p-2 rounded-lg hover:bg-stone-100 transition-colors duration-200 text-stone-400 hover:text-stone-600" @click="toggleActionMenu(client.id)">
                                    <Icon name="lucide:more-vertical" class="w-4 h-4" />
                                </button>

                                <!-- Action Dropdown -->
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="opacity-0 scale-95"
                                    enter-to-class="opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="opacity-100 scale-100"
                                    leave-to-class="opacity-0 scale-95">
                                    <div v-if="activeActionMenu === client.id" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-stone-200 overflow-hidden z-10">
                                        <NuxtLink :to="`/clients/${client.id}`" class="flex items-center px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 transition-colors space-x-2">
                                            <Icon name="lucide:eye" class="w-4 h-4 text-stone-400" />
                                            <span>View Details</span>
                                        </NuxtLink>
                                        <button class="flex items-center w-full px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 transition-colors space-x-2" @click="editClient(client)">
                                            <Icon name="lucide:edit" class="w-4 h-4 text-stone-400" />
                                            <span>Edit Client</span>
                                        </button>
                                        <button class="flex items-center w-full px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 transition-colors space-x-2" @click="createDeal(client)">
                                            <Icon name="lucide:plus-circle" class="w-4 h-4 text-stone-400" />
                                            <span>Create Deal</span>
                                        </button>
                                        <div class="border-t border-stone-200"></div>
                                        <button class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors space-x-2" @click="deleteClient(client)">
                                            <Icon name="lucide:trash-2" class="w-4 h-4" />
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="!loading && filteredClients.length > 0" class="flex items-center justify-between">
            <p class="text-sm text-stone-600">
                Showing <span class="font-medium">{{ (currentPage - 1) * itemsPerPage + 1 }}</span> to <span class="font-medium">{{ Math.min(currentPage * itemsPerPage, filteredClients.length) }}</span> of
                <span class="font-medium">{{ filteredClients.length }}</span> clients
            </p>
            <div class="flex items-center space-x-2">
                <button
                    :disabled="currentPage === 1"
                    class="px-3 py-2 rounded-lg border border-stone-200 text-sm font-medium text-stone-700 hover:bg-stone-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                    @click="currentPage--">
                    Previous
                </button>
                <button
                    v-for="page in totalPages"
                    :key="page"
                    :class="[
                        'px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200',
                        currentPage === page ? 'bg-linear-to-r from-amber-600 to-orange-600 text-white' : 'border border-stone-200 text-stone-700 hover:bg-stone-50',
                    ]"
                    @click="currentPage = page">
                    {{ page }}
                </button>
                <button
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 rounded-lg border border-stone-200 text-sm font-medium text-stone-700 hover:bg-stone-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                    @click="currentPage++">
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
    definePageMeta({
        layout: "default",
    });

    // State
    const searchQuery = ref("");
    const selectedIndustry = ref("");
    const selectedStatus = ref("");
    const sortBy = ref("recent");
    const loading = ref(false);
    const showAddClientModal = ref(false);
    const activeActionMenu = ref(null);
    const currentPage = ref(1);
    const itemsPerPage = 10;

    // Stats data
    const stats = ref({
        total: 247,
        activeDeals: 89,
        revenue: 1245800,
        newThisMonth: 18,
    });

    // Sample clients data
    const clients = ref([
        {
            id: 1,
            name: "Tech Solutions Sdn Bhd",
            email: "contact@techsolutions.my",
            company: "Tech Solutions",
            industry: "Technology",
            status: "active",
            revenue: 125000,
            dealsCount: 5,
        },
        {
            id: 2,
            name: "Retail World Malaysia",
            email: "info@retailworld.my",
            company: "Retail World",
            industry: "Retail",
            status: "vip",
            revenue: 245800,
            dealsCount: 8,
        },
        {
            id: 3,
            name: "Manufacturing Hub",
            email: "admin@mfghub.my",
            company: "MFG Hub",
            industry: "Manufacturing",
            status: "active",
            revenue: 89500,
            dealsCount: 3,
        },
        {
            id: 4,
            name: "Healthcare Plus",
            email: "contact@healthplus.my",
            company: "Healthcare Plus",
            industry: "Healthcare",
            status: "active",
            revenue: 156000,
            dealsCount: 6,
        },
        {
            id: 5,
            name: "Education First",
            email: "info@edufirst.my",
            company: "Education First",
            industry: "Education",
            status: "inactive",
            revenue: 45000,
            dealsCount: 2,
        },
    ]);

    // Computed
    const filteredClients = computed(() => {
        let filtered = clients.value;

        // Search filter
        if (searchQuery.value) {
            const query = searchQuery.value.toLowerCase();
            filtered = filtered.filter((client) => client.name.toLowerCase().includes(query) || client.email.toLowerCase().includes(query) || (client.company && client.company.toLowerCase().includes(query)));
        }

        // Industry filter
        if (selectedIndustry.value) {
            filtered = filtered.filter((client) => client.industry.toLowerCase() === selectedIndustry.value.toLowerCase());
        }

        // Status filter
        if (selectedStatus.value) {
            filtered = filtered.filter((client) => client.status === selectedStatus.value);
        }

        // Sort
        if (sortBy.value === "name") {
            filtered.sort((a, b) => a.name.localeCompare(b.name));
        } else if (sortBy.value === "name-desc") {
            filtered.sort((a, b) => b.name.localeCompare(a.name));
        } else if (sortBy.value === "revenue") {
            filtered.sort((a, b) => b.revenue - a.revenue);
        } else if (sortBy.value === "recent") {
            filtered.sort((a, b) => b.id - a.id);
        }

        return filtered;
    });

    const totalPages = computed(() => {
        return Math.ceil(filteredClients.value.length / itemsPerPage);
    });

    // Methods
    const formatNumber = (num) => {
        return new Intl.NumberFormat("en-MY").format(num);
    };

    const toggleActionMenu = (clientId) => {
        activeActionMenu.value = activeActionMenu.value === clientId ? null : clientId;
    };

    const editClient = (client) => {
        console.log("Edit client:", client);
        activeActionMenu.value = null;
        // Navigate to edit page or open modal
    };

    const createDeal = (client) => {
        console.log("Create deal for client:", client);
        activeActionMenu.value = null;
        navigateTo(`/deals/create?client=${client.id}`);
    };

    const deleteClient = (client) => {
        if (confirm(`Are you sure you want to delete ${client.name}?`)) {
            console.log("Delete client:", client);
            activeActionMenu.value = null;
            // Add delete logic here
        }
    };
</script>
