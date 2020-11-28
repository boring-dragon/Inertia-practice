<template>
    <app-layout>
        <div class="flex justify-center mt-10">
            <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="submit">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input
                            v-model="form.title"
                            :errors="$page.errors.title"
                            class="pr-6 pb-8 w-full lg:w-1/2"
                            label="Title"
                        />
                        <text-input
                            v-model="form.author"
                            :errors="$page.errors.author"
                            class="pr-6 pb-8 w-full lg:w-1/2"
                            label="Author"
                        />
                          <VueTrix v-model="form.content" placeholder="Enter content"/>
                    </div>
                    <div
                        class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
                    >
                        <loading-button
                            :loading="sending"
                            class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                            type="submit"
                            >Update Publication</loading-button
                        >
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import VueTrix from "vue-trix";

export default {
    components: {
        AppLayout,
        TextInput,
        LoadingButton,
        VueTrix
    },

      props: {
    publication: Object,
  },

    data() {
        return {
            sending: false,
            form: {
                title: this.publication.title,
                author: this.publication.author,
                content: this.publication.content
            }
        };
    },
    methods: {
        submit() {
            this.sending = true;
            this.$inertia
                .put(this.route("publications.update", this.publication.id), this.form)
                .then(() => (this.sending = false));
        }
    }
};
</script>
