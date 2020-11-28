<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Publications
            </h2>
        </template>

        <div class="container mx-auto py-12">
            <div class="flex justify-end">
                <inertia-link
                    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline"
                    :href="route('publications.create')"
                    >Create Publication</inertia-link
                >
            </div>

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">Title</th>
                        <th class="px-6 pt-6 pb-4" colspan="2">Created At</th>
                        <th></th>
                    </tr>
                    <tr
                        v-for="publication in publications.data"
                        :key="publication.id"
                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                    >
                        <td class="border-t">
                            <inertia-link
                                class="px-6 py-4 flex items-center focus:text-indigo-500"
                                href="#"
                            >
                                {{ publication.title }}
                            </inertia-link>
                        </td>

                        <td class="border-t">
                            <inertia-link
                                class="px-6 py-4 flex items-center"
                                href="#"
                                tabindex="-1"
                            >
                                {{ publication.created_at }}
                            </inertia-link>
                        </td>
                        <td class="flex justify-end border-t mr-5">
                            <inertia-link
                                class="text-indigo-600 hover:underline mr-5"
                              :href="route('publications.edit', publication.id)"
                            >
                                Edit
                            </inertia-link>
                            <button
                                class="text-red-600 hover:underline"
                                tabindex="-1"
                                type="button"
                                @click="destroy(publication)"
                            >
                                Delete Publication
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <pagination :links="publications.links" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Shared/Pagination";

export default {
    components: {
        AppLayout,
        Pagination
    },
    props: {
        publications: Object
    },

    methods: {
        destroy(publication) {
            if (confirm("Are you sure you want to delete this publication?")) {
                console.log(publication);
                this.$inertia.delete(
                    this.route("publications.destroy", publication)
                );
            }
        }
    }
};
</script>
