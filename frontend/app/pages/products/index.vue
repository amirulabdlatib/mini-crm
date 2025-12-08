<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Product Catalogue</h1>
                <p class="text-stone-600 mt-1">Manage your products and services that can be added to deals</p>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2">
                    <Icon name="lucide:filter" class="w-4 h-4" />
                    <span>Filter</span>
                </button>
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2">
                    <Icon name="lucide:download" class="w-4 h-4" />
                    <span>Export</span>
                </button>
                <button
                    class="px-6 py-2.5 bg-linear-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 flex items-center space-x-2"
                    @click="showCreateProductModal = true">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Product</span>
                </button>
            </div>
        </div>

        <!-- Product Stats -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Total Products</p>
                    <Icon name="lucide:package" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ products.length }}</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    3 new this month
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Active Products</p>
                    <Icon name="lucide:check-circle" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ activeProducts }}</p>
                <p class="text-xs text-stone-500 mt-1">{{ inactiveProducts }} inactive</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Avg Price</p>
                    <Icon name="lucide:dollar-sign" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ formatCurrency(averagePrice) }}</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    8% increase
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Total Value</p>
                    <Icon name="lucide:trending-up" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ formatCurrency(totalCatalogueValue) }}</p>
                <p class="text-xs text-stone-600 mt-1">Catalogue value</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Used in Deals</p>
                    <Icon name="lucide:shopping-cart" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ totalDealsCount }}</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    12 more than last month
                </p>
            </div>
        </div>

        <!-- Filters and Bulk Actions -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <!-- Bulk Actions (shown when items selected) -->
                <div v-if="selectedProducts.length > 0" class="flex items-center space-x-2 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2">
                    <span class="text-sm font-medium text-amber-900">{{ selectedProducts.length }} selected</span>
                    <div class="h-4 w-px bg-amber-300"></div>
                    <button class="text-sm text-amber-700 hover:text-amber-900 font-medium transition-colors flex items-center space-x-1" @click="bulkActivate">
                        <Icon name="lucide:check-circle" class="w-4 h-4" />
                        <span>Activate</span>
                    </button>
                    <button class="text-sm text-amber-700 hover:text-amber-900 font-medium transition-colors flex items-center space-x-1" @click="bulkDeactivate">
                        <Icon name="lucide:x-circle" class="w-4 h-4" />
                        <span>Deactivate</span>
                    </button>
                    <button class="text-sm text-red-600 hover:text-red-900 font-medium transition-colors flex items-center space-x-1" @click="bulkDelete">
                        <Icon name="lucide:trash-2" class="w-4 h-4" />
                        <span>Delete</span>
                    </button>
                    <div class="h-4 w-px bg-amber-300"></div>
                    <button class="text-sm text-stone-600 hover:text-stone-900 transition-colors" @click="clearSelection">Clear</button>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <!-- Search -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <Icon name="lucide:search" class="h-4 w-4 text-stone-400" />
                    </div>
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search products..."
                        class="pl-10 pr-4 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>
                <!-- Category Filter -->
                <select v-model="categoryFilter" class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option value="">All Categories</option>
                    <option value="Software">Software</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Service">Service</option>
                    <option value="Subscription">Subscription</option>
                </select>
                <!-- Status Filter -->
                <select v-model="statusFilter" class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- List View -->
        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-12">
                                <input
                                    type="checkbox"
                                    :checked="isAllSelected"
                                    :indeterminate="isIndeterminate"
                                    class="w-4 h-4 text-amber-600 bg-white border-stone-300 rounded focus:ring-amber-500 focus:ring-2 cursor-pointer"
                                    @change="toggleSelectAll" />
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">SKU</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Used in Deals</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Created</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="product in filteredProducts" :key="product.id" :class="['hover:bg-stone-50 transition-colors', isProductSelected(product.id) ? 'bg-amber-50/50' : '']">
                            <td class="px-6 py-4">
                                <input
                                    type="checkbox"
                                    :checked="isProductSelected(product.id)"
                                    class="w-4 h-4 text-amber-600 bg-white border-stone-300 rounded focus:ring-amber-500 focus:ring-2 cursor-pointer"
                                    @change="toggleProductSelection(product.id)" />
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-linear-to-br from-amber-100 to-orange-100 flex items-center justify-center shrink-0 mr-3">
                                        <Icon name="lucide:package" class="w-5 h-5 text-amber-600" />
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-stone-900">{{ product.name }}</div>
                                        <div class="text-sm text-stone-500 truncate max-w-xs">{{ product.description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-3 py-1 text-xs font-semibold rounded-full', getCategoryClass(product.category)]">
                                    {{ product.category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                {{ product.sku }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-stone-900">{{ formatCurrency(product.price) }}</div>
                                <div v-if="product.recurring" class="text-xs text-stone-500">{{ product.recurring }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-3 py-1 text-xs font-semibold rounded-full', getStatusClass(product.status)]">
                                    {{ product.status === "active" ? "Active" : "Inactive" }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ product.deals_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ formatDate(product.created_at) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-amber-600 hover:text-amber-900 transition-colors" @click="viewProduct(product.id)">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button class="text-stone-600 hover:text-stone-900 transition-colors" @click="editProduct(product.id)">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors" @click="deleteProduct(product.id)">
                                        <Icon name="lucide:trash-2" class="w-5 h-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
    useHead({
        title: "Products | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const showCreateProductModal = ref(false);
    const selectedProducts = ref([]);
    const searchQuery = ref("");
    const categoryFilter = ref("");
    const statusFilter = ref("");

    // Sample Products Data
    const products = ref([
        {
            id: 1,
            name: "Enterprise CRM Suite",
            description: "Complete CRM solution with advanced features for large organizations",
            price: 125000,
            category: "Software",
            sku: "CRM-ENT-001",
            status: "active",
            deals_count: 12,
            recurring: "One-time",
            created_at: "2024-01-15",
        },
        {
            id: 2,
            name: "Digital Marketing Package",
            description: "Comprehensive digital marketing services including SEO, SEM, and social media",
            price: 8500,
            category: "Service",
            sku: "MKT-DIG-002",
            status: "active",
            deals_count: 24,
            recurring: "per month",
            created_at: "2024-02-10",
        },
        {
            id: 3,
            name: "Cloud Hosting Premium",
            description: "Premium cloud hosting with 99.9% uptime guarantee and 24/7 support",
            price: 2500,
            category: "Subscription",
            sku: "HOST-CLR-003",
            status: "active",
            deals_count: 45,
            recurring: "per month",
            created_at: "2024-01-20",
        },
        {
            id: 4,
            name: "Business Server Hardware",
            description: "High-performance server hardware for business applications",
            price: 45000,
            category: "Hardware",
            sku: "HW-SRV-004",
            status: "active",
            deals_count: 8,
            recurring: "One-time",
            created_at: "2024-03-05",
        },
        {
            id: 5,
            name: "Mobile App Development",
            description: "Custom mobile app development for iOS and Android platforms",
            price: 85000,
            category: "Service",
            sku: "DEV-MOB-005",
            status: "active",
            deals_count: 15,
            recurring: "per project",
            created_at: "2024-02-28",
        },
        {
            id: 6,
            name: "Basic CRM Starter",
            description: "Entry-level CRM for small businesses and startups",
            price: 15000,
            category: "Software",
            sku: "CRM-BAS-006",
            status: "inactive",
            deals_count: 32,
            recurring: "One-time",
            created_at: "2023-11-10",
        },
        {
            id: 7,
            name: "Website Maintenance",
            description: "Monthly website maintenance and support services",
            price: 1200,
            category: "Service",
            sku: "WEB-MNT-007",
            status: "active",
            deals_count: 56,
            recurring: "per month",
            created_at: "2024-01-05",
        },
        {
            id: 8,
            name: "Security Software Suite",
            description: "Enterprise-grade security software with advanced threat protection",
            price: 28000,
            category: "Software",
            sku: "SEC-ENT-008",
            status: "active",
            deals_count: 18,
            recurring: "per year",
            created_at: "2024-03-15",
        },
    ]);

    // Computed
    const activeProducts = computed(() => {
        return products.value.filter((p) => p.status === "active").length;
    });

    const inactiveProducts = computed(() => {
        return products.value.filter((p) => p.status === "inactive").length;
    });

    const averagePrice = computed(() => {
        if (products.value.length === 0) return 0;
        const total = products.value.reduce((sum, product) => sum + product.price, 0);
        return total / products.value.length;
    });

    const totalCatalogueValue = computed(() => {
        return products.value.reduce((sum, product) => sum + product.price, 0);
    });

    const totalDealsCount = computed(() => {
        return products.value.reduce((sum, product) => sum + product.deals_count, 0);
    });

    const filteredProducts = computed(() => {
        return products.value.filter((product) => {
            const matchesSearch =
                searchQuery.value === "" ||
                product.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                product.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                product.sku.toLowerCase().includes(searchQuery.value.toLowerCase());

            const matchesCategory = categoryFilter.value === "" || product.category === categoryFilter.value;

            const matchesStatus = statusFilter.value === "" || product.status === statusFilter.value;

            return matchesSearch && matchesCategory && matchesStatus;
        });
    });

    const isAllSelected = computed(() => {
        return filteredProducts.value.length > 0 && selectedProducts.value.length === filteredProducts.value.length;
    });

    const isIndeterminate = computed(() => {
        return selectedProducts.value.length > 0 && selectedProducts.value.length < filteredProducts.value.length;
    });

    // Methods
    const toggleSelectAll = () => {
        if (isAllSelected.value) {
            selectedProducts.value = [];
        } else {
            selectedProducts.value = filteredProducts.value.map((p) => p.id);
        }
    };

    const toggleProductSelection = (productId) => {
        const index = selectedProducts.value.indexOf(productId);
        if (index > -1) {
            selectedProducts.value.splice(index, 1);
        } else {
            selectedProducts.value.push(productId);
        }
    };

    const isProductSelected = (productId) => {
        return selectedProducts.value.includes(productId);
    };

    const clearSelection = () => {
        selectedProducts.value = [];
    };

    const bulkActivate = () => {
        if (confirm(`Activate ${selectedProducts.value.length} products?`)) {
            selectedProducts.value.forEach((id) => {
                const product = products.value.find((p) => p.id === id);
                if (product) {
                    product.status = "active";
                }
            });
            clearSelection();
        }
    };

    const bulkDeactivate = () => {
        if (confirm(`Deactivate ${selectedProducts.value.length} products?`)) {
            selectedProducts.value.forEach((id) => {
                const product = products.value.find((p) => p.id === id);
                if (product) {
                    product.status = "inactive";
                }
            });
            clearSelection();
        }
    };

    const bulkDelete = () => {
        if (confirm(`Are you sure you want to delete ${selectedProducts.value.length} products? This action cannot be undone.`)) {
            products.value = products.value.filter((product) => !selectedProducts.value.includes(product.id));
            clearSelection();
        }
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
        return date.toLocaleDateString("en-MY", { year: "numeric", month: "short", day: "numeric" });
    };

    const getCategoryClass = (category) => {
        const classes = {
            Software: "bg-blue-100 text-blue-800",
            Hardware: "bg-purple-100 text-purple-800",
            Service: "bg-green-100 text-green-800",
            Subscription: "bg-amber-100 text-amber-800",
        };
        return classes[category] || "bg-stone-100 text-stone-800";
    };

    const getStatusClass = (status) => {
        return status === "active" ? "bg-green-100 text-green-800" : "bg-stone-100 text-stone-600";
    };

    const viewProduct = (id) => {
        navigateTo(`/products/${id}`);
    };

    const editProduct = (id) => {
        navigateTo(`/products/${id}/edit`);
    };

    const deleteProduct = (id) => {
        if (confirm("Are you sure you want to delete this product?")) {
            products.value = products.value.filter((product) => product.id !== id);
        }
    };
</script>
