<template>
    <div class="min-h-screen bg-grey bg-cover flex bg-center block md:fixed w-full  shadow-md" :style="{ backgroundImage: `url(${image})` }">
        <div class="flex flex-col">
            <div class="text-10xl text-white  mt-12 ml-20">{{time}}</div>
            <div class="flex-grow"></div>
            <div class="flex flex-row">
                <div class="text-6xl mb-8 ml-12 mt-12 h-32 w-72 flex rounded-md bg-gray-50 bg-opacity-30 relative">
                    <div class="text-2xl text-white mt-1 ml-2 absolute">
                        {{weather.weather[0].main}}
                    </div>
                    <div class="text-white my-auto mx-auto">
                        {{ Math.round(weather.main.temp) }}°C
                    </div>
                </div>

                <div class="text-3xl mb-8 ml-12 mt-12 h-32 w-72 flex rounded-md bg-gray-50 bg-opacity-30 flex flex-col">
                    <div class="text-white mt-auto mx-auto flex flex-row">
                        <div class="text-2xl text-bottom mt-1 mr-2">Feels like:</div> {{Math.round(weather.main.feels_like)}}°C
                    </div>
                    <div class="text-white mb-auto mx-auto flex flex-row">
                        <div class="text-2xl text-bottom mt-1 mr-2">Humidity:</div> {{Math.round(weather.main.humidity)}}%
                    </div>
                </div>
   
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: String,
        timeformat24h: Boolean,
        weather: Object,
        config: Object
    },
    data: ()=> {
        return {
            time: ""
        }
    },
    mounted() {
        // this.clock()
        this.clock()
        setInterval(() => this.clock(), 1000)
    },
    methods: {
        clock() {
            var currentDate = new Date();

            var hours = currentDate.getHours();
            var minutes = currentDate.getMinutes();
            var seconds = currentDate.getSeconds();

            var amPm = "am"
            if (!this.timeformat24h) {
                if (hours > 12) {
                    hours = hours - 12
                    amPm = "pm"
                }
            }

            this.time = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}${this.config.time_include_seconds ? ':' + String(seconds).padStart(2, '0'):''} ${!this.timeformat24h ? amPm:''}`

        }
    }

}
</script>  