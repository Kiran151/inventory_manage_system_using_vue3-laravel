<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Suppliers</a></li>
                        <li class="breadcrumb-item active">All Suppliers</li>
                    </ol>
                </div>
                <h4 class="page-title">All Suppliers</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <router-link to="/add_category">
                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2">
                                <i class="mdi mdi-plus-box me-1"></i> Add Supplier
                            </button>
                        </router-link>

                        <!-- <button @click="deleteRow" type="button" class="btn btn-light waves-effect mb-2">Export</button> -->
                    </div>
                    <table id="dataTable" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>CATEGORY</th>
                                <th>CREATED AT</th>
                                <th style="width: 125px;">ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</template>
  
<script>
export default {
    mounted() {
        this.initializeDataTable();
        const dataTableContainer = document.querySelector('.display');
        dataTableContainer.addEventListener('click', event => {//adding click event listener to buttons
            const target = event.target;
            if (target.classList.contains('edit-button')) {
                this.editRow(target.dataset.id);
            } else if (target.classList.contains('delete-button')) {
                this.deleteRow(target.dataset.id);
            }
        });
    },
    methods: {
        initializeDataTable() {
            const self = this;
            $('#dataTable').DataTable({
                responsive: true,
                processing: true,
                ajax: {
                    url: '/api/category/all_categories', // Adjust the URL to your Laravel API endpoint
                    type: 'GET',
                },
                //columns
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {

                            return `${meta.row + 1}`
                        }
                    },
                    { data: 'category' },
                    {
                        data: 'created_at',
                        render: function (data) {
                            const date = new Date(data);
                            return date.toISOString().slice(0, 10).replace('T', ' ');
                        }
                    },
                    {
                        data: null, orderable: false,
                        render: function (data, type, row) {
                            return `
           <div class="d-flex justify-content-evenly">
          <button class="edit-button btn btn-sm btn-primary" data-id="${row.id}">Edit</button>
          <button id="deleteButton-${row.id}" class="delete-button btn btn-sm btn-danger" data-id="${row.id}">Delete</button>
        </div`;
                        }
                    }

                ]
            });
        },
        deleteRow(id) {
            DeleteAlert.deleteRow('api/category/delete/', id);
        },
        editRow(id) {
            this.$router.push(`/add_category/${id}`)

        }
    },
};
</script>
