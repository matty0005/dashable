<template>
    <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> -->
    <div class="min-h-screen shadow-xl flex flex-col sm:justify-center items-center pt-6 sm:pt-0 object-cover bg-fixed" style="background-color:hsla(0,0%,100%,1);background-image:radial-gradient(at 80% 100%, hsla(240,100%,90%,1) 0px, transparent 50%),radial-gradient(at 90% 48%, hsla(343,100%,87%,1) 0px, transparent 50%);">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
