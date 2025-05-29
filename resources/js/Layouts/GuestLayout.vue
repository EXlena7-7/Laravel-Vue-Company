<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 bg-overlay"
         :style="{
        backgroundImage: 'url(fondo.jpg)',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
    }"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
<style>
.bg-overlay::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,0.6); /* Ajusta la opacidad aquí */
  z-index: 1;
  pointer-events: none;
}
.bg-overlay > * {
  position: relative;
  z-index: 2;
}
</style>
