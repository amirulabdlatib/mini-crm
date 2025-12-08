<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Sales Pipeline</h1>
                <p class="text-stone-600 mt-1">Track deals through every stage from first contact to closed won</p>
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
                    @click="showCreateDealModal = true">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Deal</span>
                </button>
            </div>
        </div>

        <!-- Pipeline Stats -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Total Pipeline</p>
                    <Icon name="lucide:trending-up" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">RM 488K</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    12.5% from last month
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Avg Deal Size</p>
                    <Icon name="lucide:dollar-sign" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">RM 54K</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    8.2% increase
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Win Rate</p>
                    <Icon name="lucide:target" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">68%</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    5.3% improvement
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Avg Sales Cycle</p>
                    <Icon name="lucide:clock" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">28 days</p>
                <p class="text-xs text-red-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-down" class="w-3 h-3 mr-1" />
                    2 days longer
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Deals This Month</p>
                    <Icon name="lucide:briefcase" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">23</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    4 more than last month
                </p>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <button
                    :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                        viewMode === 'kanban' ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'text-stone-600 hover:bg-stone-50 border border-transparent',
                    ]"
                    @click="viewMode = 'kanban'">
                    <Icon name="lucide:columns" class="w-4 h-4 inline mr-2" />
                    Kanban
                </button>
                <button
                    :class="['px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200', viewMode === 'list' ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'text-stone-600 hover:bg-stone-50 border border-transparent']"
                    @click="viewMode = 'list'">
                    <Icon name="lucide:list" class="w-4 h-4 inline mr-2" />
                    List
                </button>
            </div>
            <div class="flex items-center space-x-2">
                <select class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option>All Team Members</option>
                    <option>My Deals</option>
                    <option>Ahmad Hakim</option>
                    <option>Sarah Lim</option>
                </select>
            </div>
        </div>

        <!-- Kanban Board with Drag & Drop -->
        <div v-if="viewMode === 'kanban'" class="overflow-x-auto pb-4">
            <div class="flex space-x-4 min-w-max">
                <!-- Stage Column -->
                <div v-for="stage in pipelineStages" :key="stage.id" class="shrink-0 w-80 bg-stone-50 rounded-xl p-4">
                    <!-- Stage Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div :class="['w-3 h-3 rounded-full', stage.color]"></div>
                            <h3 class="font-semibold text-stone-900">{{ stage.name }}</h3>
                            <span class="px-2 py-0.5 bg-white rounded-full text-xs font-medium text-stone-600">
                                {{ getStageDeals(stage.id).length }}
                            </span>
                        </div>
                        <button class="p-1 hover:bg-stone-200 rounded transition-colors">
                            <Icon name="lucide:more-horizontal" class="w-4 h-4 text-stone-600" />
                        </button>
                    </div>

                    <!-- Stage Value -->
                    <div class="mb-4 p-3 bg-white rounded-lg border border-stone-200">
                        <p class="text-xs text-stone-600 mb-1">Total Value</p>
                        <p class="text-lg font-bold text-stone-900">{{ formatCurrency(getStageValue(stage.id)) }}</p>
                    </div>

                    <!-- Draggable Deals Cards -->
                    <draggable
                        :list="getStageDeals(stage.id)"
                        :animation="200"
                        ghost-class="ghost-card"
                        group="deals"
                        item-key="id"
                        class="space-y-3 max-h-[600px] overflow-y-auto pr-1 min-h-[100px]"
                        @start="drag = true"
                        @end="drag = false"
                        @change="onDealMove($event, stage.id)">
                        <template #item="{ element: deal }">
                            <div class="bg-white rounded-lg border border-stone-200 p-4 hover:shadow-md transition-all duration-200 cursor-move group" @click="viewDeal(deal.id)">
                                <!-- Deal Header -->
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-stone-900 mb-1 group-hover:text-amber-600 transition-colors">
                                            {{ deal.title }}
                                        </h4>
                                        <p class="text-sm text-stone-600">{{ deal.company }}</p>
                                    </div>
                                    <button class="p-1 hover:bg-stone-100 rounded transition-colors" @click.stop="toggleFavorite(deal.id)">
                                        <Icon :name="deal.is_favorite ? 'lucide:star' : 'lucide:star'" :class="deal.is_favorite ? 'text-amber-500 fill-amber-500' : 'text-stone-400'" class="w-4 h-4" />
                                    </button>
                                </div>

                                <!-- Deal Value -->
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-amber-600">{{ formatCurrency(deal.value) }}</span>
                                    <span :class="['px-2 py-1 text-xs font-medium rounded-full', getPriorityClass(deal.priority)]">
                                        {{ deal.priority }}
                                    </span>
                                </div>

                                <!-- Deal Meta -->
                                <div class="flex items-center justify-between text-xs text-stone-500">
                                    <div class="flex items-center space-x-1">
                                        <Icon name="lucide:user" class="w-3 h-3" />
                                        <span>{{ deal.owner }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <Icon name="lucide:calendar" class="w-3 h-3" />
                                        <span>{{ formatDate(deal.close_date) }}</span>
                                    </div>
                                </div>

                                <!-- Deal Progress -->
                                <div class="mt-3 pt-3 border-t border-stone-100">
                                    <div class="flex items-center justify-between text-xs text-stone-600 mb-1">
                                        <span>Progress</span>
                                        <span>{{ deal.probability }}%</span>
                                    </div>
                                    <div class="w-full bg-stone-200 rounded-full h-1.5">
                                        <div :style="{ width: `${deal.probability}%` }" class="bg-linear-to-r from-amber-500 to-orange-500 h-1.5 rounded-full transition-all duration-300"></div>
                                    </div>
                                </div>

                                <!-- Deal Tags -->
                                <div v-if="deal.tags && deal.tags.length > 0" class="flex flex-wrap gap-1 mt-3">
                                    <span v-for="tag in deal.tags" :key="tag" class="px-2 py-0.5 bg-stone-100 text-stone-600 text-xs rounded-full">
                                        {{ tag }}
                                    </span>
                                </div>
                            </div>
                        </template>

                        <!-- Empty State -->
                        <template #footer>
                            <div v-if="getStageDeals(stage.id).length === 0" class="text-center py-8">
                                <Icon name="lucide:inbox" class="w-12 h-12 text-stone-300 mx-auto mb-2" />
                                <p class="text-sm text-stone-500">No deals in this stage</p>
                                <p class="text-xs text-stone-400 mt-1">Drag deals here</p>
                            </div>
                        </template>
                    </draggable>

                    <!-- Add Deal Button -->
                    <button class="w-full mt-3 py-2 border-2 border-dashed border-stone-300 rounded-lg text-sm text-stone-600 hover:border-amber-500 hover:text-amber-600 transition-colors">
                        <Icon name="lucide:plus" class="w-4 h-4 inline mr-1" />
                        Add Deal
                    </button>
                </div>
            </div>
        </div>

        <!-- List View -->
        <div v-else class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200">
                    <thead class="bg-stone-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Deal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Stage</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Value</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Owner</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Close Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Probability</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="deal in deals" :key="deal.id" class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-stone-900">{{ deal.title }}</div>
                                    <div class="text-sm text-stone-500">{{ deal.company }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-3 py-1 text-xs font-semibold rounded-full', getStageClass(deal.stage)]">
                                    {{ getStageName(deal.stage) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                {{ formatCurrency(deal.value) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-2 py-1 text-xs font-medium rounded-full', getPriorityClass(deal.priority)]">
                                    {{ deal.priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ deal.owner }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">{{ formatDate(deal.close_date) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-stone-900 mr-2">{{ deal.probability }}%</span>
                                    <div class="w-16 bg-stone-200 rounded-full h-2">
                                        <div :style="{ width: `${deal.probability}%` }" class="bg-linear-to-r from-amber-500 to-orange-500 h-2 rounded-full"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button class="text-amber-600 hover:text-amber-900 transition-colors" @click="viewDeal(deal.id)">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button class="text-stone-600 hover:text-stone-900 transition-colors" @click="editDeal(deal.id)">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors" @click="deleteDeal(deal.id)">
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
    import draggable from "vuedraggable";

    useHead({
        title: "Sales Pipeline | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const viewMode = ref("kanban");
    const showCreateDealModal = ref(false);
    const drag = ref(false);

    // Pipeline Stages
    const pipelineStages = ref([
        { id: "new", name: "New", color: "bg-blue-500" },
        { id: "contacted", name: "Contacted", color: "bg-purple-500" },
        { id: "meeting", name: "Meeting", color: "bg-indigo-500" },
        { id: "proposal", name: "Proposal", color: "bg-amber-500" },
        { id: "negotiation", name: "Negotiation", color: "bg-orange-500" },
        { id: "won", name: "Won", color: "bg-green-500" },
        { id: "lost", name: "Lost", color: "bg-red-500" },
    ]);

    // Sample Deals Data
    const deals = ref([
        {
            id: 1,
            title: "Enterprise CRM Package",
            company: "Tech Solutions Sdn Bhd",
            value: 125000,
            stage: "proposal",
            priority: "High",
            owner: "Ahmad Hakim",
            close_date: "2025-01-20",
            probability: 75,
            is_favorite: true,
            tags: ["Enterprise", "Hot Lead"],
        },
        {
            id: 2,
            title: "Digital Marketing Suite",
            company: "Digital Marketing Pro",
            value: 89000,
            stage: "negotiation",
            priority: "High",
            owner: "Sarah Lim",
            close_date: "2025-01-15",
            probability: 85,
            is_favorite: false,
            tags: ["Marketing", "Upsell"],
        },
        {
            id: 3,
            title: "Retail Management System",
            company: "Smart Retail Sdn Bhd",
            value: 156000,
            stage: "meeting",
            priority: "Medium",
            owner: "Raj Kumar",
            close_date: "2025-02-05",
            probability: 60,
            is_favorite: true,
            tags: ["Retail"],
        },
        {
            id: 4,
            title: "Startup Package",
            company: "Startup Hub KL",
            value: 45000,
            stage: "contacted",
            priority: "Low",
            owner: "Michelle Tan",
            close_date: "2025-02-28",
            probability: 40,
            is_favorite: false,
            tags: ["Startup"],
        },
        {
            id: 5,
            title: "Construction Management",
            company: "Construction Plus Sdn Bhd",
            value: 198000,
            stage: "new",
            priority: "Medium",
            owner: "Azman Ismail",
            close_date: "2025-03-10",
            probability: 30,
            is_favorite: false,
            tags: ["Construction", "Large Deal"],
        },
        {
            id: 6,
            title: "E-commerce Platform",
            company: "Fashion Forward",
            value: 78000,
            stage: "won",
            priority: "High",
            owner: "Emily Wong",
            close_date: "2025-01-05",
            probability: 100,
            is_favorite: true,
            tags: ["E-commerce", "Closed"],
        },
        {
            id: 7,
            title: "F&B POS System",
            company: "Food & Beverage Co",
            value: 52000,
            stage: "lost",
            priority: "Low",
            owner: "Kumar Rajan",
            close_date: "2024-12-20",
            probability: 0,
            is_favorite: false,
            tags: ["POS"],
        },
        {
            id: 8,
            title: "Healthcare CRM",
            company: "Healthcare Solutions",
            value: 142000,
            stage: "proposal",
            priority: "High",
            owner: "Siti Nurhaliza",
            close_date: "2025-01-25",
            probability: 70,
            is_favorite: false,
            tags: ["Healthcare", "Compliance"],
        },
    ]);

    // Computed
    const getStageDeals = (stageId) => {
        return deals.value.filter((deal) => deal.stage === stageId);
    };

    const getStageValue = (stageId) => {
        return getStageDeals(stageId).reduce((sum, deal) => sum + deal.value, 0);
    };

    // Methods
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

    const getPriorityClass = (priority) => {
        const classes = {
            High: "bg-red-100 text-red-800",
            Medium: "bg-amber-100 text-amber-800",
            Low: "bg-blue-100 text-blue-800",
        };
        return classes[priority] || "bg-stone-100 text-stone-800";
    };

    const getStageClass = (stage) => {
        const classes = {
            new: "bg-blue-100 text-blue-800",
            contacted: "bg-purple-100 text-purple-800",
            meeting: "bg-indigo-100 text-indigo-800",
            proposal: "bg-amber-100 text-amber-800",
            negotiation: "bg-orange-100 text-orange-800",
            won: "bg-green-100 text-green-800",
            lost: "bg-red-100 text-red-800",
        };
        return classes[stage] || "bg-stone-100 text-stone-800";
    };

    const getStageName = (stageId) => {
        const stage = pipelineStages.value.find((s) => s.id === stageId);
        return stage ? stage.name : stageId;
    };

    const toggleFavorite = (dealId) => {
        const deal = deals.value.find((d) => d.id === dealId);
        if (deal) {
            deal.is_favorite = !deal.is_favorite;
        }
    };

    const onDealMove = (evt, newStageId) => {
        // Handle deal moved to a new stage
        if (evt.added) {
            const movedDeal = evt.added.element;
            const oldStage = movedDeal.stage;

            // Update the deal's stage
            const dealIndex = deals.value.findIndex((d) => d.id === movedDeal.id);
            if (dealIndex !== -1) {
                deals.value[dealIndex].stage = newStageId;

                // Update probability based on stage
                const probabilityMap = {
                    new: 10,
                    contacted: 25,
                    meeting: 50,
                    proposal: 65,
                    negotiation: 80,
                    won: 100,
                    lost: 0,
                };
                deals.value[dealIndex].probability = probabilityMap[newStageId] || 50;

                // Show notification (you can integrate with a toast notification library)
                console.log(`Deal "${movedDeal.title}" moved from ${oldStage} to ${newStageId}`);

                // Here you would typically make an API call to update the deal on the backend
                // updateDealStage(movedDeal.id, newStageId);
            }
        }
    };

    const viewDeal = (id) => {
        navigateTo(`/deals/${id}`);
    };

    const editDeal = (id) => {
        navigateTo(`/deals/${id}/edit`);
    };

    const deleteDeal = (id) => {
        if (confirm("Are you sure you want to delete this deal?")) {
            deals.value = deals.value.filter((deal) => deal.id !== id);
        }
    };
</script>

<style scoped>
    /* Ghost card style when dragging */
    .ghost-card {
        opacity: 0.5;
        background: #f59e0b;
        border: 2px dashed #d97706;
    }

    /* Smooth transitions */
    .draggable-item {
        transition: transform 0.2s ease;
    }

    /* Custom scrollbar for deal columns */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: transparent;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #d6d3d1;
        border-radius: 3px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #a8a29e;
    }
</style>
