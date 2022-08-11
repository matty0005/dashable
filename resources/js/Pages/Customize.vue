

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customize
            </h2>
        </template>
   

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                    <div class="text-3xl">
                        Settings.
                    </div>
                    
                   
                    <Textfield class="mt-8" label="Weather city" v-model="city"/>

                    <Toggle title="Test"/>


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
import Toggle from '@/Shared/Toggle.vue';

export default {
    components: {
        AppLayout,
        Textfield,
        Toggle
    },
    data: () => {
        return {
            city: ""
        }
    },
    props: {
        currentCity: String
    },
    mounted() {
        this.city = this.currentCity
    },
    methods: {
        updateData() {

            var payload = {};
            payload["weather_city"] = this.city;
            
            this.$inertia.post(window.location.pathname, payload);

        }
    }
}
</script>