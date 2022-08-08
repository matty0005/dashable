

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Images
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                    <div class="text-3xl">
                        Your Images.
                    </div>

                    <div class="flex flex-row bg-slate-100 rounded-lg my-2 p-4 shadow-inner">
                        <div v-for="image in images" >
                            <ImagePreview :src="image.url"/>
                        </div>
                    </div>

                    
                    
                    <FileUpload @file="handleFile"/>

                    <button type="button" @click="updateData" class="mt-8 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Textfield from '@/Shared/Textfield.vue';
import FileUpload from '@/Shared/FileUpload.vue';
import ImagePreview from '@/Shared/ImagePreview.vue';

import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        Textfield,
        FileUpload,
        ImagePreview
    },
    data: () => {
        return {
            city: "",
        }
    },
    setup () {
        const form = useForm({
            image: null,
        })

        function submit() {
            form.post('/images/upload')
        }

        return { form, submit }
    },
    props: {
        currentCity: String,
        images: Array
    },
    mounted() {
        this.city = this.currentCity
    },
    methods: {
        handleFile(event) {
            this.form.image = event
        },
        updateData() {

            this.submit()

        },
 
    }
}
</script>