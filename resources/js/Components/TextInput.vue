<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() =>{
    if (input.value.hasAttribute('autofocus')){
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        :value="modelValue"
        @input="$event => $emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
