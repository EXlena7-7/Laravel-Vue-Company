<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name:''
});

</script>

<template>
    <Head title="Create Departments" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create Departments
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.post(route('departments.store'))"
                        class="mt-6 space-y-6 max-w-xl">
                        <InputLabel for="name" value="Department"></InputLabel>
                        <TextInput
                            id="name"
                            v-model="form.name"
                            autofocus
                            required
                            type="text"
                            class="mt-1 block w-full">
                        </TextInput>
                        <InputError
                            :message="form.errors.name"
                            class="mt-2"
                            type="text"
                        >
                        </InputError>
                        <PrimaryButton :disable="form.processing">
                            <i class="fa-solid fa-save"> Save</i>
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
