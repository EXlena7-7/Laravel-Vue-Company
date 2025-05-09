<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    departments: {type:Object}
});

const form = useForm({
    id:''
});

const deleteDepartment = (id, name)=>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Are you sure delete '+name+'?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Yes,delete',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancel'
    }).then((result) =>{
        if(result.isConfirmed){
            form.delete(route('departments.destroy', id));
        }
    });
}

</script>

<template>
    <Head title=" Departments" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Departments
            </h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('departments.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border roundend-md font-semibold text-xs'" >
                    <i class="fa-solid fa-plus-circle"></i>
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">

                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
