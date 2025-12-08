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
                        <Icon name="lucide:users" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Lead Management</h3>
                    <p class="text-stone-600">Capture, qualify, and convert leads with automatic activity tracking and follow-up reminders.</p>
                </div>

                <!-- Feature Card 2 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 border border-stone-200 hover:border-emerald-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-emerald-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <Icon name="lucide:bar-chart-3" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Sales Pipeline</h3>
                    <p class="text-stone-600">Visual kanban board to track deals through every stage from first contact to closed won.</p>
                </div>

                <!-- Feature Card 3 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-rose-50 transition-all duration-300 border border-stone-200 hover:border-rose-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-rose-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <Icon name="lucide:check-square" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Task Management</h3>
                    <p class="text-stone-600">Schedule calls, meetings, and follow-ups. Get reminded so nothing falls through the cracks.</p>
                </div>

                <!-- Feature Card 4 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-sky-50 transition-all duration-300 border border-stone-200 hover:border-sky-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-sky-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <Icon name="lucide:package" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Product Catalog</h3>
                    <p class="text-stone-600">Manage your products and services. Quickly add them to deals with auto-calculated values.</p>
                </div>

                <!-- Feature Card 5 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-violet-50 transition-all duration-300 border border-stone-200 hover:border-violet-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-violet-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <Icon name="lucide:shield" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Team Roles</h3>
                    <p class="text-stone-600">Admin, Sales Manager, and Salesperson roles with proper access control and permissions.</p>
                </div>

                <!-- Feature Card 6 -->
                <div class="group p-8 bg-stone-50 rounded-2xl hover:bg-orange-50 transition-all duration-300 border border-stone-200 hover:border-orange-200 hover:shadow-xl transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-orange-600 rounded-xl mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <Icon name="lucide:layout-dashboard" class="w-7 h-7 text-white" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Dashboard</h3>
                    <p class="text-stone-600">Real-time insights on leads, pipeline value, tasks, and team performance at a glance.</p>
                </div>
            </div>
        </div>
    </section>
</template>
