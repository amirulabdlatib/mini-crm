<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Leads</h1>
                <p class="text-stone-600 mt-1">Manage and track your sales leads</p>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button @click="showImportModal = true" class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2">
                    <Icon name="lucide:upload" class="w-4 h-4" />
                    <span>Import</span>
                </button>
                <button @click="exportLeads" class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2">
                    <Icon name="lucide:download" class="w-4 h-4" />
                    <span>Export</span>
                </button>
                <button
                    @click="showCreateModal = true"
                    class="px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 flex items-center space-x-2">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Lead</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Total Leads</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">245</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:users" class="w-6 h-6 text-blue-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">New</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">68</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:user-plus" class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Qualified</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">92</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:check-circle" class="w-6 h-6 text-amber-600" />
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-stone-600 font-medium">Contacted</p>
                        <p class="text-2xl font-bold text-stone-900 mt-1">85</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <Icon name="lucide:mail" class="w-6 h-6 text-purple-600" />
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
                            placeholder="Search leads by name, email, or company..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-stone-300 rounded-xl text-sm placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200" />
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <select v-model="filters.status" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">All Status</option>
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="qualified">Qualified</option>
                        <option value="not_interested">Not Interested</option>
                    </select>
                </div>

                <!-- Source Filter -->
                <div>
                    <select v-model="filters.source" class="block w-full px-3 py-2.5 border border-stone-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200">
                        <option value="">All Sources</option>
                        <option value="website">Website</option>
                        <option value="referral">Referral</option>
                        <option value="social_media">Social Media</option>
                        <option value="event">Event</option>
                        <option value="cold_call">Cold Call</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Leads Table -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <!-- Table Header Actions -->
            <div class="px-6 py-4 border-b border-stone-200 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <input type="checkbox" v-model="selectAll" @change="toggleSelectAll" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                    <span class="text-sm text-stone-600"> {{ selectedLeads.length }} selected </span>
                    <div v-if="selectedLeads.length > 0" class="flex items-center space-x-2">
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
                                <input type="checkbox" v-model="selectAll" @change="toggleSelectAll" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Lead</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Company</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Source</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Value</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Created</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="lead in filteredLeads" :key="lead.id" class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" :value="lead.id" v-model="selectedLeads" class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-stone-900">{{ lead.name }}</div>
                                        <div class="text-sm text-stone-500">{{ lead.email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-stone-900">{{ lead.company }}</div>
                                <div class="text-sm text-stone-500">{{ lead.phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusClass(lead.status)" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {{ getStatusLabel(lead.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                {{ getSourceLabel(lead.source) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                {{ formatCurrency(lead.estimated_value) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                {{ formatDate(lead.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button @click="viewLead(lead.id)" class="text-amber-600 hover:text-amber-900 transition-colors">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button @click="editLead(lead.id)" class="text-stone-600 hover:text-stone-900 transition-colors">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button @click="deleteLead(lead.id)" class="text-red-600 hover:text-red-900 transition-colors">
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
                            <span class="font-medium">10</span>
                            of
                            <span class="font-medium">{{ leads.length }}</span>
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
        title: "Leads | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const showCreateModal = ref(false);
    const showImportModal = ref(false);
    const selectAll = ref(false);
    const selectedLeads = ref([]);

    const filters = ref({
        search: "",
        status: "",
        source: "",
    });

    // Sample leads data
    const leads = ref([
        {
            id: 1,
            name: "Ahmad Hakim",
            email: "ahmad.hakim@example.com",
            phone: "+60 12-345 6789",
            company: "Tech Solutions Sdn Bhd",
            status: "new",
            source: "website",
            estimated_value: 45000,
            created_at: "2025-01-05",
        },
        {
            id: 2,
            name: "Sarah Lim",
            email: "sarah.lim@example.com",
            phone: "+60 16-789 0123",
            company: "Digital Marketing Pro",
            status: "contacted",
            source: "referral",
            estimated_value: 32000,
            created_at: "2025-01-04",
        },
        {
            id: 3,
            name: "Raj Kumar",
            email: "raj.kumar@example.com",
            phone: "+60 19-234 5678",
            company: "Smart Retail Sdn Bhd",
            status: "qualified",
            source: "social_media",
            estimated_value: 78000,
            created_at: "2025-01-03",
        },
        {
            id: 4,
            name: "Michelle Tan",
            email: "michelle.tan@example.com",
            phone: "+60 11-567 8901",
            company: "Startup Hub KL",
            status: "new",
            source: "event",
            estimated_value: 25000,
            created_at: "2025-01-02",
        },
        {
            id: 5,
            name: "Azman Ismail",
            email: "azman.ismail@example.com",
            phone: "+60 13-890 1234",
            company: "Construction Plus Sdn Bhd",
            status: "contacted",
            source: "cold_call",
            estimated_value: 95000,
            created_at: "2025-01-01",
        },
        {
            id: 6,
            name: "Emily Wong",
            email: "emily.wong@example.com",
            phone: "+60 17-345 6789",
            company: "Fashion Forward",
            status: "qualified",
            source: "website",
            estimated_value: 52000,
            created_at: "2024-12-30",
        },
        {
            id: 7,
            name: "Kumar Rajan",
            email: "kumar.rajan@example.com",
            phone: "+60 14-678 9012",
            company: "Food & Beverage Co",
            status: "not_interested",
            source: "referral",
            estimated_value: 15000,
            created_at: "2024-12-29",
        },
        {
            id: 8,
            name: "Siti Nurhaliza",
            email: "siti.nur@example.com",
            phone: "+60 18-901 2345",
            company: "Healthcare Solutions",
            status: "contacted",
            source: "social_media",
            estimated_value: 68000,
            created_at: "2024-12-28",
        },
    ]);

    // Computed
    const filteredLeads = computed(() => {
        return leads.value.filter((lead) => {
            const matchesSearch =
                !filters.value.search ||
                lead.name.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                lead.email.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                lead.company.toLowerCase().includes(filters.value.search.toLowerCase());

            const matchesStatus = !filters.value.status || lead.status === filters.value.status;
            const matchesSource = !filters.value.source || lead.source === filters.value.source;

            return matchesSearch && matchesStatus && matchesSource;
        });
    });

    // Methods
    const toggleSelectAll = () => {
        if (selectAll.value) {
            selectedLeads.value = filteredLeads.value.map((lead) => lead.id);
        } else {
            selectedLeads.value = [];
        }
    };

    const getStatusClass = (status) => {
        const classes = {
            new: "bg-blue-100 text-blue-800",
            contacted: "bg-purple-100 text-purple-800",
            qualified: "bg-green-100 text-green-800",
            not_interested: "bg-red-100 text-red-800",
        };
        return classes[status] || "bg-stone-100 text-stone-800";
    };

    const getStatusLabel = (status) => {
        const labels = {
            new: "New",
            contacted: "Contacted",
            qualified: "Qualified",
            not_interested: "Not Interested",
        };
        return labels[status] || status;
    };

    const getSourceLabel = (source) => {
        const labels = {
            website: "Website",
            referral: "Referral",
            social_media: "Social Media",
            event: "Event",
            cold_call: "Cold Call",
        };
        return labels[source] || source;
    };

    const formatCurrency = (value) => {
        return new Intl.NumberFormat("en-MY", {
            style: "currency",
            currency: "MYR",
            minimumFractionDigits: 0,
        }).format(value);
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

    const viewLead = (id) => {
        navigateTo(`/leads/${id}`);
    };

    const editLead = (id) => {
        navigateTo(`/leads/${id}/edit`);
    };

    const deleteLead = (id) => {
        if (confirm("Are you sure you want to delete this lead?")) {
            leads.value = leads.value.filter((lead) => lead.id !== id);
        }
    };

    const exportLeads = () => {
        console.log("Exporting leads...");
        // Add export logic here
    };

    // Watch for selection changes
    watch(
        selectedLeads,
        (newVal) => {
            selectAll.value = newVal.length === filteredLeads.value.length && filteredLeads.value.length > 0;
        },
        { deep: true }
    );
</script>
