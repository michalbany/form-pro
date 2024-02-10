<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <!--Colors:
        blue-200: #bfdbfe
        blue-400: #60a5fa
        blue-500: #3b82f6
        blue-700: #1d4ed8
        blue-800: #1e40af
        red-300: #fc8181
    
    -->

    <div
        class="min-h-screen bg-dots-darker bg-center bg-white selection:bg-blue-200 selection:text-red-300"
    >
        <div v-if="canLogin" class="p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-800 hover:text-gray-600 transition"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-800 hover:text-gray-600 transition"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 py-2 px-3 rounded-md font-semibold bg-blue-700 text-white hover:bg-blue-500 hover:btn-shadow transition focus:bg-blue-700"
                    >Get Started</Link
                >
            </template>
        </div>

        <div
            class="flex flex-col items-center justify-center text-gray-900"
        >
            <div
                class="text-center border rounded-full px-5 py-0.5 mb-2 text-blue-700 bg-blue-200"
            >
                Bring
                <span class="text-blue-800">sense</span> to
                your <span class=" text-blue-800">forms</span>
            </div>
            <h1 class="text-6xl font-bold mb-3 text-center font-serif">
                Empower Your <br />Data Collection.
            </h1>
            <p class="mt-4 text-xl text-center text-gray-600">
                Optimize and enhance your form processing with cutting-edge,<br />
                user-friendly technology for smoother operations.
            </p>

            <div class="flex justify-center mt-8 gap-4 pb-6">
                <Link
                    :href="route('register')"
                    class="inline-flex items-center font-semibold px-4 py-2 border border-transparent text-sm leading-5 cursor-pointer font-md rounded-md text-white bg-blue-700 hover:bg-blue-500 hover:btn-shadow transition focus:bg-blue-700"
                    >Find Projects
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        class="stroke-white w-5 h-5 ml-2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                        />
                    </svg>
                </Link>

                <Link
                    :href="route('login')"
                    class="group inline-flex items-center text-sm cursor-pointer font-medium rounded-md text-gray-800 hover:text-red-300 focus:outline-none transition ease-in-out duration-150"
                    >Read Docs
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        class="group-hover:stroke-red-300 stroke-gray-800 w-5 h-5 ml-2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                        />
                    </svg>
                </Link>
            </div>

            <div class="sm:my-16 py-16 sm:py-24 sm:background-pattern w-full">
                <div class="flex flex-wrap max-w-7xl container mx-auto px-6 bg-white sm:py-14 rounded-lg">
                    <!-- max-w-7xl mx-auto p-6 lg:p-8  -->
                    <!-- Feature 1 -->
                    <div class="group w-full md:w-1/2 px-4 mb-8">
                        <div class="flex items-start">
                            <div
                                class="bg-blue-500 p-2 rounded-lg group-hover:scale-110 group-hover:rotate-6 group-hover:bg-blue-800 transition"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    class="w-7 h-7 fill-white group-hover:fill-red-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M18 22a2 2 0 0 0 2-2V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12zM13 4l5 5h-5V4zM7 8h3v2H7V8zm0 4h10v2H7v-2zm0 4h10v2H7v-2z"
                                    />
                                </svg>
                            </div>
                            <div class="text-blue-600">
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">
                                    Document Clarity
                                </h3>
                                <p class="mt-1">
                                    Experience enhanced clarity in document
                                    management. Organize and access your forms
                                    with ease, ensuring every document is just a
                                    click away
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="group w-full md:w-1/2 px-4 mb-8">
                        <div class="flex items-start">
                            <div
                                class="bg-blue-500 p-2 rounded-lg group-hover:scale-110 group-hover:rotate-6 group-hover:bg-blue-800 transition"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    class="w-7 h-7 fill-white group-hover:fill-red-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20 13.01h-7V10h1c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h1v3.01H4V18H3v4h4v-4H6v-2.99h5V18h-1v4h4v-4h-1v-2.99h5V18h-1v4h4v-4h-1v-4.99zM10 8V4h4l.002 4H10z"
                                    />
                                </svg>
                            </div>
                            <div class="text-blue-600">
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">
                                    Hierarchical Forms
                                </h3>
                                <p class="mt-1">
                                    Build forms with depth using our
                                    hierarchical structure. Create sub-forms and
                                    nested fields to capture complex data
                                    efficiently.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="group w-full md:w-1/2 px-4 mb-8">
                        <div class="flex items-start">
                            <div
                                class="bg-blue-500 p-2 rounded-lg group-hover:scale-110 group-hover:rotate-6 group-hover:bg-blue-800 transition"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    class="w-7 h-7 fill-white group-hover:fill-red-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm10 0h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM10 13H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm8 1h-2v2h-2v2h2v2h2v-2h2v-2h-2z"
                                    />
                                </svg>
                            </div>
                            <div class="text-blue-600">
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">
                                    Customizable Form Elements
                                </h3>
                                <p class="mt-1">
                                    Tailor each form element to your needs. Set
                                    text lengths, adjust field sizes, and
                                    configure options to create the perfect
                                    place for your data collection.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="group w-full md:w-1/2 px-4 mb-8">
                        <div class="flex items-start">
                            <div
                                class="bg-blue-500 p-2 rounded-lg group-hover:scale-110 group-hover:rotate-6 group-hover:bg-blue-800 transition"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    class="w-7 h-7 fill-white group-hover:fill-red-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.433 17.325 3.079 19.8a1 1 0 0 0 1.131 1.131l2.475-.354C7.06 20.524 8 18 8 18s.472.405.665.466c.412.13.813-.274.948-.684L10 16.01s.577.292.786.335c.266.055.524-.109.707-.293a.988.988 0 0 0 .241-.391L12 14.01s.675.187.906.214c.263.03.519-.104.707-.293l1.138-1.137a5.502 5.502 0 0 0 5.581-1.338 5.507 5.507 0 0 0 0-7.778 5.507 5.507 0 0 0-7.778 0 5.5 5.5 0 0 0-1.338 5.581l-7.501 7.5a.994.994 0 0 0-.282.566zM18.504 5.506a2.919 2.919 0 0 1 0 4.122l-4.122-4.122a2.919 2.919 0 0 1 4.122 0z"
                                    />
                                </svg>
                            </div>
                            <div class="text-blue-600">
                                <i class="fas fa-upload fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">
                                    Secure Sharing
                                </h3>
                                <p class="mt-1">
                                    Share your forms securely with generated
                                    keys. Provide controlled access to your
                                    clients, ensuring data integrity and
                                    confidentiality.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sponzors-->
            <div class="pb-20 sm:mt-5 sm:pb-24">
                <div
                    class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-3"
                >
                    <div class="max-w-2xl">
                        <h2
                            class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                        >
                        Our Core Team & Partners
                        </h2>
                        <p class="mt-6 leading-8 text-gray-600">
                            Our journey is created by exceptional developers and
                            key partners who joined forces to turn our dream
                            into reality.
                        </p>
                    </div>
                    <ul
                        role="list"
                        class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2"
                    >
                        <li>
                            <a href="https://www.instagram.com/michal_bany" target="_blank"
                                 class="group flex items-center gap-x-6">
                                <img
                                    class="group-hover:scale-110 transition h-16 w-16 rounded-full"
                                    src="https://www.marf.cz/media/_thumb/669/michal-nova_200_200_crop.jpeg?v=1706661507"
                                    alt="Michael Bany"
                                />
                                <div>
                                    <h3
                                        class="text-base font-semibold leading-7 tracking-tight text-gray-900"
                                    >
                                        Michael Bany
                                    </h3>
                                    <p
                                        class="text-sm font-semibold leading-6 text-blue-400"
                                    >
                                        System Founder
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.marf.cz/" target="_blank" 
                                 class="group flex items-center gap-x-6">
                                <img
                                    class="group-hover:scale-110 transition h-16 w-16 rounded-full"
                                    src="https://media.licdn.com/dms/image/C4D0BAQFqmw6flMAsbw/company-logo_200_200/0/1630503595068/marf_sro_logo?e=1715817600&v=beta&t=fyTv587wvaerYbCXZ6llZwR5jEfBt0WT_-mMP3QNnuc"
                                    alt=""
                                />
                                <div>
                                    <h3
                                        class="text-base font-semibold leading-7 tracking-tight text-gray-900"
                                    >
                                        Marf s.r.o.
                                    </h3>
                                    <p
                                        class="text-sm font-semibold leading-6 text-blue-400"
                                    >
                                        General Partner
                                    </p>
                                </div>
                            </a>
                        </li>

                        <!-- More people... -->
                    </ul>
                </div>
            </div>

            <div
                class="flex justify-center w-full mt-10 mb-5 px-6 sm:items-center sm:justify-between"
            >
                <div class="text-center text-sm text-gray-500 sm:text-start">
                    <div class="flex items-center gap-4">
                        Author: Michael Bany
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-gray-500 sm:text-end sm:ms-0"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* .bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
} */

.hover\:btn-shadow:hover {
    box-shadow: -4px 4px 0px #fc8181;
}

.sm\:background-pattern {
    @media (min-width: 640px) {
        background-image: url('../../images/background.svg');
    }
}

/* 
::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

::-webkit-scrollbar-track {
    background: lightgrey; 
}

::-webkit-scrollbar-thumb {
    background-color: rgb(16 185 129);
    border-radius: 6px;             
    border: 2px solid lightgray;   
}

::-webkit-scrollbar-thumb:hover {
    background-color: rgb(5 150 105);
} */
</style>
