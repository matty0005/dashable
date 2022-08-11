<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="text-3xl">
                        Your Dashboard.
                    </div>
                    
                    <div class="flex flex-row mt-8">
                        Link to your dashboard: <a :href="$page.props.dashboard_link" target="_blank" class="ml-2 text-indigo-600">{{$page.props.dashboard_link}}</a>
                    </div>

                    

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Textfield from '@/Shared/Textfield.vue';

export default {
    components: {
        AppLayout,
        Textfield
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