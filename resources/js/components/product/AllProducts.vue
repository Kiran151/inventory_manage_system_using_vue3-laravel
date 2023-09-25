<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                        <li class="breadcrumb-item active">All Products</li>
                    </ol>
                </div>
                <h4 class="page-title">All Products</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <router-link to="/add_product">
                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2">
                                <i class="mdi mdi-plus-box me-1"></i> Add Product
                            </button>
                        </router-link>

                        <!-- <button @click="deleteRow" type="button" class="btn btn-light waves-effect mb-2">Export</button> -->
                    </div>
                    <table id="dataTable" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>PRODUCT</th>
                                <th>PRICE</th>
                                <th>CATEGORY</th>
                                <th>SUPPLIER</th>
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
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: {
                    url: '/api/product/all_product', // Adjust the URL to your Laravel API endpoint
                    type: 'post',
                },
                //columns
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {

                            return `${meta.row + 1}`
                        }
                    },
                    {
                        data: 'product_name', orderable: false,
                        render: function (data, type, row) {
                            const imageUrl = row.image !== null ? `uploads/product/${row.image}` : 'assets/images/no_image.jpg';
                            return `
                        <img src="${imageUrl}" class="me-2 rounded-circle" height="40" width="40">
                           <a class="text-body fw-semibold">${data}</a>`;
                        }
                    },
                    { data: 'selling_price' },
                    { data: 'category' },
                    {
                        data: 'supplier', render: function (data, type, row) {
                            return row.supplier_id !== null ? data : 'no supplier';
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

                ],

            });
        },
        deleteRow(id) {
            DeleteAlert.deleteRow('api/product/delete/', id);
        },
        editRow(id) {
            this.$router.push(`/add_product/${id}`)

        }
    },
};


</script>
