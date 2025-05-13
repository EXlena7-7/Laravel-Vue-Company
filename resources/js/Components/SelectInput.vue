<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'options']);

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
    <select
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        :value="modelValue"
        @change="$event => $emit('update:modelValue', $event.target.value)"
        ref="input"
    >
    <option v-for="op in options" :key="op.i" :value="op.id">
        {{ op.name }}
    </option>
    </select>
</template>
