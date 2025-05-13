<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import Modal from '@/Components/Modal.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref();

const props = defineProps({
    employees: {type:Object},
    departments: {type:Object}
});

const form = useForm({
    name:'', email:'', phone:'', department_id:''
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('employees.index', {page:event}));
}
const openModal = (op,name,email,phone,department,employee)=>{
    modal.value = true;
    nextTick( ()=>nameInput.value.focus);
    operation.value = op;
    id.value = employee;
    if(op == 1){
        title.value = 'Create employee';
    }
    else{
        title.value = 'Edit employee';
        form.name=name;
        form.email=email;
        form.phone=phone;
        form.department_id=department;
    }
}
const closeModal = () => {
    modal.value = false;
    form.reset();
}

const save = () =>{
    if(operation.value == 1){
        form.post();
    }
    else{

    }
}

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
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">#</th>
                            <th class="px-4 py-4">DEPARTMENT</th>
                            <th class="px-4 py-4"></th>
                            <th class="px-4 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dep, i in departments" :key="dep.id">
                            <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ dep.name }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                                <Link :href="route('departments.edit', dep.id)"
                                :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'" >
                                <i class="fa-solid fa-edit"></i>
                                </Link>
                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="$event => deleteDepartment(dep.id,dep.name)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
