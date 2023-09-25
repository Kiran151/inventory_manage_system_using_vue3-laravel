<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                        <li class="breadcrumb-item active">Add Supplier</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Supplier</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="add" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.name" name="name"
                                    placeholder="Enter your name" id="example-text-input">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" name="email" placeholder="Enter your email"
                                    v-model="form.email">
                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.address" name="name"
                                    placeholder="Enter your address" id="example-text-input">
                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" v-model="form.phone" name="name"
                                    placeholder="Enter your number" id="example-text-input" min="0">
                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>


                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Shop Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.shop_name" name="name"
                                    placeholder="Enter your shop name" id="example-text-input">
                                <small class="text-danger" v-if="errors.nid">{{ errors.shop_name[0] }}</small>

                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success" type="submit">Update Employee</button>
                        </div>
                    </form>
                    <!-- end row -->

                </div>
            </div>
        </div> <!-- end col -->
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                address: null,
                phone: null,
                shop_name: null,
            },
            errors: {},
        }
    },
    mounted() {
        let id = this.$route.params.id;
        if (id) {
            axios.get('/api/supplier/edit_supplier/' + id)
                .then(res => {
                    console.log(res.data);
                    this.form = res.data
                })
        }

    },
    methods: {
        add() {
            let id = this.$route.params.id;
            //updating
            if (id>0) {
                axios.patch('/api/supplier/update_supplier/' + id, this.form)
                    .then(res => {
                        console.log(res);
                        this.$router.push('/all_supplier')
                        Toast.fire({
                            icon: 'success',
                            title: 'Supplier updated successfully'
                        });


                    })
                    .catch(error => {
                        console.log(error);
                        this.errors = error.response.data.errors
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occured!'
                        });
                    })

            }else{
                //inserting
                axios.post('/api/supplier/add_supplier/', this.form)
                .then(res => {
                    console.log(res);
                    this.$router.push('/all_supplier')
                    Toast.fire({
                        icon: 'success',
                        title: 'Supplier added successfully'
                    });


                })
                .catch(error => {
                    console.log(error);
                    this.errors = error.response.data.errors
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occured!'
                    });
                })
            }

        },
    }
}
</script>
