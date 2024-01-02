<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageList from './Partials/PageList.vue';
import PageDetail from './Partials/PageDetail.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head title="Project Setup" />

    <AuthenticatedLayout>


        <!-- NOTE: fix this to components (3) -->
        <div class="flex">

            <aside class="w-1/5 bg-white p-2">
                <nav class="mt-5">
                    <ul>
                        <li class="my-1">
                            <a href="#" class="inline-flex gap-1 w-full items-center px-3 py-2 bg-white rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="hover:bg-gray-200 p-1 rounded-md transition ease-in-out duration-150">
                                    <svg height="10px" width="10px" stroke="#777" stroke-width="28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 330 330" xml:space="preserve">
                                    <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001
                                        c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213
                                        C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606
                                        C255,161.018,253.42,157.202,250.606,154.389z"/>
                                    </svg>
                                </i>
                        
                            Home</a>
                        </li>
                        <li class="my-1">
                            <a href="#" class="inline-flex gap-1 w-full items-center px-3 py-2 bg-white rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="hover:bg-gray-200 p-1 rounded-md transition ease-in-out duration-150">
                                    <svg height="10px" width="10px" stroke="#777" stroke-width="28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 330 330" xml:space="preserve">
                                    <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001
                                        c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213
                                        C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606
                                        C255,161.018,253.42,157.202,250.606,154.389z"/>
                                    </svg>
                                </i>
                        
                            Home</a>
                        </li>
                    </ul>
                </nav>
                <PageList />
            </aside>

            <aside class="w-4/5">

            <PageDetail />
            </aside>
            
        </div>

    </AuthenticatedLayout>
</template>
