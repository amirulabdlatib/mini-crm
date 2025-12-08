<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Tasks</h1>
                <p class="text-stone-600 mt-1">Manage and track your follow-ups and activities</p>
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
                    @click="showCreateTaskModal = true">
                    <Icon name="lucide:plus" class="w-4 h-4" />
                    <span>Add Task</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Total Tasks</p>
                    <Icon name="lucide:check-square" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ tasks.length }}</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    12 new this week
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Today</p>
                    <Icon name="lucide:calendar" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ todayTasksCount }}</p>
                <p class="text-xs text-amber-600 mt-1">Due today</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Overdue</p>
                    <Icon name="lucide:alert-circle" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ overdueTasksCount }}</p>
                <p class="text-xs text-red-600 mt-1">Needs attention</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">Completed</p>
                    <Icon name="lucide:check-circle-2" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ completedTasksCount }}</p>
                <p class="text-xs text-green-600 mt-1 flex items-center">
                    <Icon name="lucide:arrow-up" class="w-3 h-3 mr-1" />
                    18% completion rate
                </p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-stone-600 font-medium">In Progress</p>
                    <Icon name="lucide:clock" class="w-5 h-5 text-stone-400" />
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ inProgressTasksCount }}</p>
                <p class="text-xs text-blue-600 mt-1">Active tasks</p>
            </div>
        </div>

        <!-- Filters and Bulk Actions -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <!-- Bulk Actions (shown when items selected) -->
                <div v-if="selectedTasks.length > 0" class="flex items-center space-x-2 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2">
                    <span class="text-sm font-medium text-amber-900">{{ selectedTasks.length }} selected</span>
                    <div class="h-4 w-px bg-amber-300"></div>
                    <button class="text-sm text-amber-700 hover:text-amber-900 font-medium transition-colors flex items-center space-x-1" @click="bulkMarkComplete">
                        <Icon name="lucide:check-circle" class="w-4 h-4" />
                        <span>Mark Complete</span>
                    </button>
                    <button class="text-sm text-amber-700 hover:text-amber-900 font-medium transition-colors flex items-center space-x-1" @click="bulkAssign">
                        <Icon name="lucide:user-plus" class="w-4 h-4" />
                        <span>Assign</span>
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
                        v-model="filters.search"
                        type="text"
                        placeholder="Search tasks..."
                        class="pl-10 pr-4 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
                </div>
                <!-- Status Filter -->
                <select v-model="filters.status" class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="overdue">Overdue</option>
                </select>
                <!-- Type Filter -->
                <select v-model="filters.type" class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option value="">All Types</option>
                    <option value="call">Call</option>
                    <option value="email">Email</option>
                    <option value="meeting">Meeting</option>
                    <option value="follow_up">Follow Up</option>
                    <option value="other">Other</option>
                </select>
                <!-- Priority Filter -->
                <select v-model="filters.priority" class="px-3 py-2 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
                    <option value="">All Priority</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>

        <!-- Tasks Table -->
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Task</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Related To</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Assigned To</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Due Date</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-stone-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-stone-200">
                        <tr v-for="task in filteredTasks" :key="task.id" :class="['hover:bg-stone-50 transition-colors', isTaskSelected(task.id) ? 'bg-amber-50/50' : '']">
                            <td class="px-6 py-4">
                                <input
                                    type="checkbox"
                                    :checked="isTaskSelected(task.id)"
                                    class="w-4 h-4 text-amber-600 bg-white border-stone-300 rounded focus:ring-amber-500 focus:ring-2 cursor-pointer"
                                    @change="toggleTaskSelection(task.id)" />
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-start">
                                    <div>
                                        <div class="text-sm font-medium text-stone-900">{{ task.title }}</div>
                                        <div v-if="task.description" class="text-sm text-stone-500 mt-0.5 line-clamp-1">{{ task.description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-stone-900">{{ task.related_to }}</div>
                                <div class="text-xs text-stone-500">{{ task.related_type }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-3 py-1 text-xs font-semibold rounded-full', getTypeClass(task.type)]">
                                    {{ getTypeLabel(task.type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-2 py-1 text-xs font-medium rounded-full', getPriorityClass(task.priority)]">
                                    {{ task.priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="['px-3 py-1 text-xs font-semibold rounded-full', getStatusClass(task.status)]">
                                    {{ getStatusLabel(task.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                {{ task.assigned_to }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div :class="['text-sm font-medium', getDueDateClass(task.due_date, task.status)]">
                                    {{ formatDate(task.due_date) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button v-if="task.status !== 'completed'" class="text-green-600 hover:text-green-900 transition-colors" @click="markComplete(task.id)">
                                        <Icon name="lucide:check" class="w-5 h-5" />
                                    </button>
                                    <button class="text-amber-600 hover:text-amber-900 transition-colors" @click="viewTask(task.id)">
                                        <Icon name="lucide:eye" class="w-5 h-5" />
                                    </button>
                                    <button class="text-stone-600 hover:text-stone-900 transition-colors" @click="editTask(task.id)">
                                        <Icon name="lucide:pencil" class="w-5 h-5" />
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 transition-colors" @click="deleteTask(task.id)">
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
        title: "Tasks | Mini CRM",
    });

    definePageMeta({
        layout: "default",
    });

    // State
    const showCreateTaskModal = ref(false);
    const selectedTasks = ref([]);

    const filters = ref({
        search: "",
        status: "",
        type: "",
        priority: "",
    });

    // Sample tasks data
    const tasks = ref([
        {
            id: 1,
            title: "Follow up call with Ahmad Hakim",
            description: "Discuss Enterprise CRM package pricing and implementation timeline",
            related_to: "Ahmad Hakim",
            related_type: "Lead",
            type: "call",
            priority: "High",
            status: "pending",
            assigned_to: "Sarah Lim",
            due_date: "2025-01-08",
        },
        {
            id: 2,
            title: "Send proposal to Tech Solutions",
            description: "Prepare and send detailed proposal with pricing breakdown",
            related_to: "Tech Solutions Sdn Bhd",
            related_type: "Deal",
            type: "email",
            priority: "High",
            status: "in_progress",
            assigned_to: "Ahmad Hakim",
            due_date: "2025-01-08",
        },
        {
            id: 3,
            title: "Schedule demo meeting",
            description: "Set up product demo for Smart Retail team",
            related_to: "Raj Kumar",
            related_type: "Lead",
            type: "meeting",
            priority: "Medium",
            status: "pending",
            assigned_to: "Raj Kumar",
            due_date: "2025-01-10",
        },
        {
            id: 4,
            title: "Contract review reminder",
            description: "Review contract terms before final signing",
            related_to: "Fashion Forward",
            related_type: "Deal",
            type: "follow_up",
            priority: "High",
            status: "overdue",
            assigned_to: "Emily Wong",
            due_date: "2025-01-05",
        },
        {
            id: 5,
            title: "Send welcome email to new client",
            description: "Send onboarding materials and welcome package",
            related_to: "Digital Marketing Pro",
            related_type: "Client",
            type: "email",
            priority: "Low",
            status: "completed",
            assigned_to: "Michelle Tan",
            due_date: "2025-01-07",
        },
        {
            id: 6,
            title: "Quarterly business review",
            description: "Prepare QBR presentation for Healthcare Solutions",
            related_to: "Healthcare Solutions",
            related_type: "Client",
            type: "meeting",
            priority: "Medium",
            status: "in_progress",
            assigned_to: "Siti Nurhaliza",
            due_date: "2025-01-12",
        },
        {
            id: 7,
            title: "Check in with inactive lead",
            description: "Re-engage with Food & Beverage Co to explore opportunities",
            related_to: "Kumar Rajan",
            related_type: "Lead",
            type: "call",
            priority: "Low",
            status: "pending",
            assigned_to: "Kumar Rajan",
            due_date: "2025-01-15",
        },
        {
            id: 8,
            title: "Product training session",
            description: "Conduct training for Construction Plus team on new features",
            related_to: "Construction Plus Sdn Bhd",
            related_type: "Client",
            type: "meeting",
            priority: "Medium",
            status: "pending",
            assigned_to: "Azman Ismail",
            due_date: "2025-01-09",
        },
        {
            id: 9,
            title: "Update CRM records",
            description: "Update contact information and interaction history",
            related_to: "Sarah Lim",
            related_type: "Lead",
            type: "other",
            priority: "Low",
            status: "completed",
            assigned_to: "Admin User",
            due_date: "2025-01-06",
        },
        {
            id: 10,
            title: "Renewal discussion",
            description: "Discuss contract renewal and upsell opportunities",
            related_to: "Startup Hub KL",
            related_type: "Client",
            type: "call",
            priority: "High",
            status: "pending",
            assigned_to: "Michelle Tan",
            due_date: "2025-01-08",
        },
    ]);

    // Computed
    const filteredTasks = computed(() => {
        return tasks.value.filter((task) => {
            const matchesSearch =
                !filters.value.search ||
                task.title.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                task.description.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                task.related_to.toLowerCase().includes(filters.value.search.toLowerCase());

            const matchesStatus = !filters.value.status || task.status === filters.value.status;
            const matchesType = !filters.value.type || task.type === filters.value.type;
            const matchesPriority = !filters.value.priority || task.priority.toLowerCase() === filters.value.priority;

            return matchesSearch && matchesStatus && matchesType && matchesPriority;
        });
    });

    const todayTasksCount = computed(() => {
        const today = new Date().toISOString().split("T")[0];
        return tasks.value.filter((t) => t.due_date === today && t.status !== "completed").length;
    });

    const overdueTasksCount = computed(() => {
        return tasks.value.filter((t) => t.status === "overdue").length;
    });

    const completedTasksCount = computed(() => {
        return tasks.value.filter((t) => t.status === "completed").length;
    });

    const inProgressTasksCount = computed(() => {
        return tasks.value.filter((t) => t.status === "in_progress").length;
    });

    const isAllSelected = computed(() => {
        return filteredTasks.value.length > 0 && selectedTasks.value.length === filteredTasks.value.length;
    });

    const isIndeterminate = computed(() => {
        return selectedTasks.value.length > 0 && selectedTasks.value.length < filteredTasks.value.length;
    });

    // Methods
    const toggleSelectAll = () => {
        if (isAllSelected.value) {
            selectedTasks.value = [];
        } else {
            selectedTasks.value = filteredTasks.value.map((t) => t.id);
        }
    };

    const toggleTaskSelection = (taskId) => {
        const index = selectedTasks.value.indexOf(taskId);
        if (index > -1) {
            selectedTasks.value.splice(index, 1);
        } else {
            selectedTasks.value.push(taskId);
        }
    };

    const isTaskSelected = (taskId) => {
        return selectedTasks.value.includes(taskId);
    };

    const clearSelection = () => {
        selectedTasks.value = [];
    };

    const bulkMarkComplete = () => {
        if (confirm(`Mark ${selectedTasks.value.length} tasks as complete?`)) {
            selectedTasks.value.forEach((id) => {
                const task = tasks.value.find((t) => t.id === id);
                if (task) {
                    task.status = "completed";
                }
            });
            clearSelection();
        }
    };

    const bulkAssign = () => {
        // This would open a modal to select assignee
        console.log("Bulk assign tasks:", selectedTasks.value);
    };

    const bulkDelete = () => {
        if (confirm(`Are you sure you want to delete ${selectedTasks.value.length} tasks? This action cannot be undone.`)) {
            tasks.value = tasks.value.filter((task) => !selectedTasks.value.includes(task.id));
            clearSelection();
        }
    };

    const markComplete = (taskId) => {
        const task = tasks.value.find((t) => t.id === taskId);
        if (task) {
            task.status = "completed";
        }
    };

    const getTypeClass = (type) => {
        const classes = {
            call: "bg-blue-100 text-blue-800",
            email: "bg-purple-100 text-purple-800",
            meeting: "bg-green-100 text-green-800",
            follow_up: "bg-amber-100 text-amber-800",
            other: "bg-stone-100 text-stone-800",
        };
        return classes[type] || "bg-stone-100 text-stone-800";
    };

    const getTypeLabel = (type) => {
        const labels = {
            call: "Call",
            email: "Email",
            meeting: "Meeting",
            follow_up: "Follow Up",
            other: "Other",
        };
        return labels[type] || type;
    };

    const getPriorityClass = (priority) => {
        const classes = {
            High: "bg-red-100 text-red-800",
            Medium: "bg-amber-100 text-amber-800",
            Low: "bg-blue-100 text-blue-800",
        };
        return classes[priority] || "bg-stone-100 text-stone-800";
    };

    const getStatusClass = (status) => {
        const classes = {
            pending: "bg-stone-100 text-stone-800",
            in_progress: "bg-blue-100 text-blue-800",
            completed: "bg-green-100 text-green-800",
            overdue: "bg-red-100 text-red-800",
        };
        return classes[status] || "bg-stone-100 text-stone-800";
    };

    const getStatusLabel = (status) => {
        const labels = {
            pending: "Pending",
            in_progress: "In Progress",
            completed: "Completed",
            overdue: "Overdue",
        };
        return labels[status] || status;
    };

    const getDueDateClass = (dueDate, status) => {
        if (status === "completed") return "text-stone-600";
        if (status === "overdue") return "text-red-600 font-semibold";

        const today = new Date();
        const due = new Date(dueDate);
        const diffTime = due - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays === 0) return "text-amber-600 font-semibold";
        if (diffDays < 0) return "text-red-600 font-semibold";
        if (diffDays <= 2) return "text-orange-600";

        return "text-stone-900";
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        const dateOnly = date.toISOString().split("T")[0];
        const todayOnly = today.toISOString().split("T")[0];
        const tomorrowOnly = tomorrow.toISOString().split("T")[0];

        if (dateOnly === todayOnly) return "Today";
        if (dateOnly === tomorrowOnly) return "Tomorrow";

        return date.toLocaleDateString("en-MY", { year: "numeric", month: "short", day: "numeric" });
    };

    const viewTask = (id) => {
        navigateTo(`/tasks/${id}`);
    };

    const editTask = (id) => {
        navigateTo(`/tasks/${id}/edit`);
    };

    const deleteTask = (id) => {
        if (confirm("Are you sure you want to delete this task?")) {
            tasks.value = tasks.value.filter((task) => task.id !== id);
        }
    };
</script>
