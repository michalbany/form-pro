<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import { Badge } from "@/Components/ui/badge";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex selection:bg-blue-200 selection:text-red-300">
        <aside
            class="flex flex-col w-80 bg-gray-50 border-r p-2 min-h-screen h-full sticky top-0 left-0"
        >
            <div
                class="shrink-0 m-2 mb-6 flex items-center gap-2 transition hover:bg-gray-200 p-2 rounded-md"
            >
                <Link
                    :href="route('dashboard')"
                    class="rounded-full border p-1.5 bg-white"
                >
                    <ApplicationLogo class="block h-5 w-auto" />
                </Link>
                <h3 class="font-bold cursor-default">Blueprint</h3>
            </div>

            <p class="ml-2 my-2 text-xs text-gray-800 font-bold">
                This Project:
            </p>
            <slot name="project-settings" />
            <p class="ml-2 my-2 mt-4 text-xs text-gray-800 font-bold">List of Pages:</p>

            <div class="max-h-96">
                <slot name="page-list" />
            </div>
            <p class="ml-2 my-2 text-xs text-gray-800 font-bold">App Menu</p>
            <!-- <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p>
            <p class="text-xs ml-2 my-2 text-blue-200 font-bold">App Menu</p> -->
        </aside>

        <main class="flex-grow">
            <nav class="border-b flex w-full">
                <!-- <Badge variant="secondary" class="w-max h-max"> Edit Mode </Badge> -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <!-- Navigation Links -->
                            
                            <div
                            class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                            <!-- <slot name="breadcrumbs" /> -->
                            <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                                >
                                    <template #icon>
                                        <box-icon
                                            name="dashboard"
                                            type="solid"
                                        ></box-icon>
                                    </template>
                                    <template #title>Dashboard</template>
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                <box-icon
                                                    name="user"
                                                    class="mr-3 fill-blue-600 bg-gray-200 p-1 w-7 h-7 rounded-full"
                                                ></box-icon>

                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            <box-icon
                                                name="user"
                                                class="h-5 w-5 fill-gray-400 group-hover:fill-blue-500 transition"
                                            ></box-icon>
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            <box-icon
                                                name="power-off"
                                                class="h-5 w-5 fill-gray-400 group-hover:fill-red-300 transition"
                                            ></box-icon>
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <slot name="project-detail" />
        </main>
    </div>
</template>

<style>
.sm\:background-pattern {
    @media (min-width: 640px) {
        background-image: url("../../images/background.svg");
    }
}

.background-pattern {
    background-image: url("../../images/background.svg");
    background-size: 50%;
    background-position: center;
    position: relative;
    z-index: 1;
}

.background-pattern::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.2);
    background-size: 50%;
    background-position: center;
    z-index: -1;
}

::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background-color: #60a5fa;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #1d4ed8;
}
</style>
