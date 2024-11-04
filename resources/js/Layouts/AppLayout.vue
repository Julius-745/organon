<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';

defineProps({
    title: String,
});

const showingSidebar = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />
        <div class="min-h-screen bg-base-200 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-base-100 p-4 lg:block"
                :class="{ 'hidden': !showingSidebar, 'block': showingSidebar }">
                <!-- Logo -->
                <div class="mb-4">
                    <Link :href="route('dashboard')">
                    <ApplicationMark class="h-10 w-auto" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <ul class="menu">
                    <li>
                        <Link :href="route('dashboard')" :class="{ 'active': route().current('dashboard') }">
                        Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('profile.show')" :class="{ 'active': route().current('profile.show') }">
                        Profile
                        </Link>
                    </li>
                    <!-- Additional Links -->
                </ul>
            </aside>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Header -->
                <header class="bg-base-100 p-4 shadow-lg flex items-center">
                    <button class="btn btn-ghost lg:hidden" @click="showingSidebar = !showingSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path :class="{ 'hidden': showingSidebar, 'inline-flex': !showingSidebar }"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !showingSidebar, 'inline-flex': showingSidebar }"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h1 class="text-lg font-bold">{{ title }}</h1>


                    <!-- Profile Dropdown -->
                    <div class="dropdown ms-auto">
                        <label tabindex="0" class="btn btn-ghost w-full justify-between">
                            {{ $page.props.auth.user.name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </label>
                        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <Link :href="route('profile.show')">Profile</Link>
                            </li>
                            <li>
                                <form method="POST" @submit.prevent="logout">
                                    <button class="w-full text-left">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!-- Teams Dropdown -->
                    <div class="dropdown" v-if="$page.props.jetstream.hasTeamFeatures">
                        <label tabindex="0" class="btn btn-ghost w-full justify-between">
                            {{ $page.props.auth.user.current_team.name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </label>
                        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <Link :href="route('teams.show', $page.props.auth.user.current_team)">Team Settings
                                </Link>
                            </li>
                            <li v-if="$page.props.jetstream.canCreateTeams">
                                <Link :href="route('teams.create')">Create New Team</Link>
                            </li>
                            <li v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                <form @submit.prevent="switchToTeam(team)">
                                    <button class="w-full text-left flex items-center">
                                        <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                            class="h-5 w-5 text-green-400 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ team.name }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
