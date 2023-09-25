<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                        <li class="breadcrumb-item active">All Employees</li>
                    </ol>
                </div>
                <h4 class="page-title">All Employees</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-dark waves-effect waves-light mb-2 me-1">
                            <i class="mdi mdi-filter me-1"></i> Filter
                            </button>
                        <router-link to="/add_employee">
                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2">
                                <i class="mdi mdi-plus-box me-1"></i> Add Employee
                            </button>
                        </router-link>

                        <!-- <button @click="deleteRow" type="button" class="btn btn-light waves-effect mb-2">Export</button> -->
                    </div>
                    <DataTable :data="data" :columns="columns" :options="options" class="display">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th style="width: 175px;">IMAGE</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>SALARY</th>
                                <th>STATUS</th>
                                <th style="width: 125px;">ACTION</th>
                            </tr>
                        </thead>
                    </DataTable>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</template>
  
<script>
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
DataTable.use(DataTablesCore);

const options = {
  responsive: true,
  processing: true ,
};



const columns = [
    {
        data: null, render: function (data, type, row, meta) {

            return `${meta.row + 1}`
        }
    },
    {
        data: 'image', orderable: false,
        render: function (data, type, row) {
            const imageUrl = data !== null ? `uploads/employee/${data}` : 'assets/images/no_image.jpg';
            return `
                        <img src="${imageUrl}" class="me-2 rounded-circle" height="40" width="40">
                           <a class="text-body fw-semibold">${row.name}</a>`;
        }
    },
    { data: 'email' },
    { data: 'phone' },
    { data: 'salary' },
    {
        data: 'status', render: function (data) {
            if (data === 1) {
                return `<h5><span class="badge bg-info">Active</span></h5>`;
            } else if (data === 0) {
                return `<h5><span class="badge bg-danger">Inactive</span></h5>`;
            }
        }
    },
    {
        data: null, orderable: false,
        render: function (data, type, row) {
            return `
           <div class="d-flex justify-content-evenly">
          <button class="edit-button btn btn-sm btn-primary" data-id="${row.id}">Edit</button>
          <button class="delete-button btn btn-sm btn-danger" data-id="${row.id}">Delete</button>
        </div`;
        }
    }

];

export default {
    components: { DataTable },//this is important
    data() {
        return {
            columns,
            options,
            data: [],
        };
    },
    mounted() {
        // Fetch data from your API
        this.fetchData();
        const dataTableContainer = document.querySelector('.display');
        dataTableContainer.addEventListener('click', event => {
            const target = event.target;
            if (target.classList.contains('edit-button')) {
                this.editRow(target.dataset.id);
            } else if (target.classList.contains('delete-button')) {
                this.deleteRow(target.dataset.id);
            }
        });
    },
    methods: {
        fetchData() {
            const apiUrl = '/api/employee/all_employees';
            axios.get(apiUrl)
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        editRow(id) {
            this.$router.push(`/edit_employee/${id}`)
        },
        deleteRow(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/employee/delete/' + id)
                        .then((res) => {
                            console.log(res);
                            this.data = this.data.filter(item => item.id !== id);
                            this.fetchData();

                        })
                        .catch((error) => {
                            console.log(error);
                        })

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        }
    }
};
</script>
<style>
@import 'datatables.net-dt';
</style>