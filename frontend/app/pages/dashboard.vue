<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-stone-900">Dashboard</h1>
                <p class="text-stone-600 mt-1">Welcome back! Here's what's happening today.</p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="px-4 py-2.5 border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Export</span>
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Leads -->
            <div class="bg-white rounded-xl border border-stone-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-linear-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+12.5%</span>
                </div>
                <h3 class="text-stone-600 text-sm font-medium mb-1">Total Leads</h3>
                <p class="text-3xl font-bold text-stone-900">245</p>
                <p class="text-xs text-stone-500 mt-2">32 new this month</p>
            </div>

            <!-- Active Deals -->
            <div class="bg-white rounded-xl border border-stone-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-linear-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+8.2%</span>
                </div>
                <h3 class="text-stone-600 text-sm font-medium mb-1">Active Deals</h3>
                <p class="text-3xl font-bold text-stone-900">89</p>
                <p class="text-xs text-stone-500 mt-2">RM 452K in pipeline</p>
            </div>

            <!-- Total Clients -->
            <div class="bg-white rounded-xl border border-stone-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-linear-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+15.3%</span>
                </div>
                <h3 class="text-stone-600 text-sm font-medium mb-1">Total Clients</h3>
                <p class="text-3xl font-bold text-stone-900">156</p>
                <p class="text-xs text-stone-500 mt-2">18 new this month</p>
            </div>

            <!-- Revenue -->
            <div class="bg-white rounded-xl border border-stone-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-linear-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">+23.1%</span>
                </div>
                <h3 class="text-stone-600 text-sm font-medium mb-1">Revenue (MTD)</h3>
                <p class="text-3xl font-bold text-stone-900">RM 187K</p>
                <p class="text-xs text-stone-500 mt-2">Target: RM 250K</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pipeline Overview -->
            <div class="lg:col-span-2 bg-white rounded-xl border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-stone-900">Sales Pipeline</h2>
                    <button class="text-sm text-amber-600 hover:text-amber-700 font-medium">View All</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="font-medium text-stone-900">New</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-stone-900">23</p>
                            <p class="text-xs text-stone-500">RM 125K</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                            <span class="font-medium text-stone-900">Contacted</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-stone-900">34</p>
                            <p class="text-xs text-stone-500">RM 189K</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span class="font-medium text-stone-900">Proposal</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-stone-900">18</p>
                            <p class="text-xs text-stone-500">RM 98K</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <span class="font-medium text-stone-900">Negotiation</span>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-stone-900">14</p>
                            <p class="text-xs text-stone-500">RM 76K</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Tasks -->
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-stone-900">Today's Tasks</h2>
                    <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">8 pending</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3 p-3 bg-stone-50 rounded-lg hover:bg-stone-100 transition-colors cursor-pointer">
                        <input type="checkbox" class="mt-1 w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-stone-900">Follow up with ABC Corp</p>
                            <p class="text-xs text-stone-500 mt-0.5">Due in 2 hours</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-stone-50 rounded-lg hover:bg-stone-100 transition-colors cursor-pointer">
                        <input type="checkbox" class="mt-1 w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-stone-900">Send proposal to XYZ Ltd</p>
                            <p class="text-xs text-stone-500 mt-0.5">Due in 4 hours</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-stone-50 rounded-lg hover:bg-stone-100 transition-colors cursor-pointer">
                        <input type="checkbox" class="mt-1 w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-stone-900">Meeting with Tech Startup</p>
                            <p class="text-xs text-stone-500 mt-0.5">Due in 6 hours</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-stone-50 rounded-lg hover:bg-stone-100 transition-colors cursor-pointer">
                        <input type="checkbox" class="mt-1 w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500" />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-stone-900">Review deal pipeline</p>
                            <p class="text-xs text-stone-500 mt-0.5">Due today</p>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-4 px-4 py-2.5 text-sm text-amber-600 hover:bg-amber-50 rounded-lg transition-colors font-medium">View All Tasks</button>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl border border-stone-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-stone-900">Recent Activity</h2>
                <button class="text-sm text-amber-600 hover:text-amber-700 font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start space-x-4 pb-4 border-b border-stone-100 last:border-0 last:pb-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-stone-900"><span class="font-semibold">John Doe</span> created a new lead</p>
                        <p class="text-xs text-stone-500 mt-1">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 pb-4 border-b border-stone-100 last:border-0 last:pb-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-stone-900"><span class="font-semibold">Sarah Johnson</span> won a deal worth RM 45,000</p>
                        <p class="text-xs text-stone-500 mt-1">15 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 pb-4 border-b border-stone-100 last:border-0 last:pb-0">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-stone-900"><span class="font-semibold">Mike Chen</span> scheduled a meeting with Tech Corp</p>
                        <p class="text-xs text-stone-500 mt-1">1 hour ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    useHead({
        title: "Dashboard | Mini CRM",
    });
</script>
