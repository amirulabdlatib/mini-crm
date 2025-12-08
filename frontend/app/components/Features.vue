<template>
    <!-- Features Grid -->
    <section id="features" class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-stone-900 mb-4">Everything you need to sell</h2>
                <p class="text-xl text-stone-600">Simple tools that actually work together</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-amber-50 transition-all duration-300 border border-stone-200 hover:border-amber-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-amber-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Lead Management</h3>
                    <p class="text-stone-600">Capture, qualify, and convert leads with automatic activity tracking and follow-up reminders.</p>
                </div>

                <!-- Feature Card 2 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 border border-stone-200 hover:border-emerald-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-emerald-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Sales Pipeline</h3>
                    <p class="text-stone-600">Visual kanban board to track deals through every stage from first contact to closed won.</p>
                </div>

                <!-- Feature Card 3 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-rose-50 transition-all duration-300 border border-stone-200 hover:border-rose-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-rose-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Task Management</h3>
                    <p class="text-stone-600">Schedule calls, meetings, and follow-ups. Get reminded so nothing falls through the cracks.</p>
                </div>

                <!-- Feature Card 4 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-sky-50 transition-all duration-300 border border-stone-200 hover:border-sky-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-sky-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Product Catalog</h3>
                    <p class="text-stone-600">Manage your products and services. Quickly add them to deals with auto-calculated values.</p>
                </div>

                <!-- Feature Card 5 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-violet-50 transition-all duration-300 border border-stone-200 hover:border-violet-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-violet-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Team Roles</h3>
                    <p class="text-stone-600">Admin, Sales Manager, and Salesperson roles with proper access control and permissions.</p>
                </div>

                <!-- Feature Card 6 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-orange-50 transition-all duration-300 border border-stone-200 hover:border-orange-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-orange-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Dashboard</h3>
                    <p class="text-stone-600">Real-time insights on leads, pipeline value, tasks, and team performance at a glance.</p>
                </div>
            </div>
        </div>
    </section>
</template>
