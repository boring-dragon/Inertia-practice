<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>

                <div class="mt-10 w-64 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col items-center">
                        <h1 class="text-xl font-bold">Total Publication</h1>
                        <h2 class="text-3xl font-bold text-indigo-600">{{stats.publication}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },

        props: {
            stats: Object
        }
    }
</script>
