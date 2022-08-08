<template>
    <div class="m-2">
        <img class="rounded-md" :src="src" :class="`${h} ${w}`"/>
        
    </div>
</template>

<script>
export default {
    props: {
        src: String,
        h: {
            type: String,
            default: "h-24"
        },
        w: {
            type: String,
            default: "w-24"
        }

    }
}
</script>