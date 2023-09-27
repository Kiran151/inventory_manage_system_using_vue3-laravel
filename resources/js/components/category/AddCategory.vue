<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Category</h4>
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
                            <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.category" name="name"
                                    placeholder="Enter category name" id="example-text-input">
                                <small class="text-danger" v-if="errors.category">{{ errors.category[0] }}</small>

                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success" type="submit">Add Category</button>
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
            form:{
                category: null,
            },
            errors: {},
        }
    },
    mounted() {
        let id = this.$route.params.id;
        if (id) {
            axios.get('/api/category/edit_category/' + id)
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
                axios.patch('/api/category/update_category/' + id, this.form)
                    .then(res => {
                        console.log(res);
                        this.$router.push('/all_category')
                        Toast.fire({
                            icon: 'success',
                            title: 'Category updated successfully'
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
                axios.post('/api/category/add_category/', this.form)
                .then(res => {
                    console.log(res);
                    this.$router.push('/all_category')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category added successfully'
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
