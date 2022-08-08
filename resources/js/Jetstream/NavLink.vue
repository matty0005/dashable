<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'focus:outline-none focus: transition text-primary'
        : 'text-gray-500 hover:text-gray-700 hover:text-primaryHover focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
});
</script>

<template>
    <Link :href="href" class="inline-flex h-fit items-center px-2 py-2 text-base font-semibold" :class="classes">
        <slot />
    </Link>
</template>
