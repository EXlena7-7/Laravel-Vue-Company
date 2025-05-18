<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DataTable from 'datatables.net-vue3';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import ButtonsPrint from 'datatables.net-buttons/js/buttons.print';
import Responsive from 'datatables.net-responsive';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import * as pdfFonts from 'pdfmake/build/vfs_fonts';

pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;

window.JSZip = JsZip;

DataTable.use(ButtonsHtml5);
DataTable.use(ButtonsPrint);
DataTable.use(Responsive);


const props = defineProps({
    departments: {type:Object},
    employees: {type:Object},
});

const columns1 = ref([]);
const columns2 = ref([]);
const buttons1 = ref([]);
const buttons2 = ref([]);
const report = ref('1');
const types = ref([{'id': '1', 'name': 'Employees'}, {'id': '2', 'name': 'Departments'}]);

columns1.value =[{data:null, render:function(data,type,row,meta)
    {return (meta.row+1)}},
    {data:'name'},
    {data:'email'},
    {data:'phone'},
    {data:'department'},
]

columns2.value =[{data:null, render:function(data,type,row,meta)
    {return (meta.row+1)}},
    {data:'name'},
]

buttons1.value =[
     {
        title:'Employees', extend:'excelHtml5', text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-green-700 focus:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-green-500'
     },
     {
        title:'Employees', extend:'pdfHtml5', text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        className:'inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700'
     },
     {
        title:'Employees', extend:'print', text:'<i class="fa-solid fa-print"></i> PRINT',
        className:'inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'
     },
     {
        title:'Employees', extend:'copy', text:'<i class="fa-solid fa-copy"></i> COPY',
        className:'inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'
     }
],

buttons2.value =[
    {
        title:'Departments', extend:'excelHtml5', text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-green-700 focus:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-green-500'
     },
     {
        title:'Departments', extend:'pdfHtml5', text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        className:'inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700'
     },
     {
        title:'Departments', extend:'print', text:'<i class="fa-solid fa-print"></i> PRINT',
        className:'inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'
     },
     {
        title:'Departments', extend:'copy', text:'<i class="fa-solid fa-copy"></i> COPY',
        className:'inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'
     }
]

</script>

<template>
    <Head title="Reports" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Reports
            </h2>
        </template>

        <div class="py-12">
            <div class=" mx-auto sm:px-6 lg:px-8">
                <div
                    class="px-6 py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                <InputLabel for="rep" Value="Report:"></InputLabel>
                <SelectInput id="rep" class="mt-1 block w-3/4" :options="types" v-model="report"  name="rep"></SelectInput>

                </div>
                <div v-if="report == '1'" class="px-6 py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <DataTable :data="employees" :columns="columns1"
                    class="w-full border-gray-400"
                    :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:buttons1}">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">NAME</th>
                            <th class="px-2 py-2">EMAIL</th>
                            <th class="px-2 py-2">PHONE</th>
                            <th class="px-2 py-2">DEPARTMENT</th>

                        </tr>
                    </thead>
                    </DataTable>
                </div>
                <div v-else class="px-6 py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
