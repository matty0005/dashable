<template>
    <div class="min-h-screen bg-grey bg-cover flex bg-center block md:fixed w-full  shadow-md" :style="{ backgroundImage: `url(${image})` }">
        <div class="text-10xl text-white font-semibold mt-12 ml-20">{{time}}</div>
    </div>
</template>

<script>
export default {
    props: {
        image: String,
        timeformat24h: Boolean
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

            this.time = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')} ${!this.timeformat24h ? amPm:''}`

        }
    }

}
</script>