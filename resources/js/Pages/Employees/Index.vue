<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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
        form.post(route('employees.store'),{
            onSuccess: () => {ok('Employee created')}
        });
    }
    else{
        form.put(route('employees.update', id.value),{
        onSuccess: () => {ok('Employee created')}
        });
    }
}
const ok = (msj)=>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
}


const deleteEmployee = (id, name)=>{
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
            form.delete(route('employees.destroy', id),{
                onSuccess: () =>{ok('Employee deleted')}
            });
        }
    });
}

</script>

<template>
    <Head title=" Employees" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Employees
            </h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton @click="$event =>openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i>Add
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center overflow-x-auto">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">NAME</th>
                            <th class="px-2 py-2">EMAIL</th>
                            <th class="px-2 py-2">PHONE</th>
                            <th class="px-2 py-2">DEPARTMENT</th>
                            <th class="px-2 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="emp, i in employees.data" :key="emp.id">
                            <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ emp.name }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ emp.email }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ emp.phone }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ emp.department }}</td>
                            <td class="border border-gray-400 px-2 py-2">
                                <WarningButton @click="$event =>openModal(2,emp.name,emp.email,emp.phone,emp.department_id,emp.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>
                            </td>
                            <td class="border border-gray-400 px-2 py-2">
                                <DangerButton @click="$event => deleteEmployee(emp.id,emp.name)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="employees.current" :total="employees.total"
                    :per-page="employees.perPage"
                    @page-changed="onPageClick($event)"
                    >
                </VueTailwindPagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
