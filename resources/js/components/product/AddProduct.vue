<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="add" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-3 image-container">
                                <div class="image-preview">
                                    <img v-if="form.updatedImage" :src="form.updatedImage"
                                    alt="image" class="img-fluid avatar-xl border rounded shadow">
                                    <img v-if="form.updatedImage==null" :src="form.image == null ? '/assets/images/no_image.jpg' : `/uploads/product/${form.image}`"
                                    alt="image" class="img-fluid avatar-xl border rounded shadow">
                                    <i @click="removeImage" title="remove" class="mdi mdi-close-circle remove-button fs-3"></i>
                                </div>
                                <input style="opacity: 0;" class="form-control image-input mt-1 h-75 w-50 " @change="imageChange" type="file" id="inputGroupFile04">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.product_name" name="name"
                                    placeholder="Enter prouduct name" id="example-text-input">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Buying Price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" placeholder="Enter buying price"
                                    v-model="form.buying_price">
                                <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Selling Price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" placeholder="Enter selling price"
                                    v-model="form.selling_price">
                                <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier</label>
                            <div class="col-sm-10">
                                <select v-model="form.supplier_id" class="form-control" data-toggle="select2" data-width="100%">
                                    <option selected disabled>Select supplier</option>
                                    <option v-for="item in suppliers" :value="item.id">{{ item.name }}</option>
                                </select>
                                <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select v-model="form.category_id" class="form-control" data-toggle="select2" data-width="100%">
                                    <option selected disabled>Select category</option>
                                    <option v-for="item in categories" :value="item.id">{{ item.category }}</option>
                                </select>
                                <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Product quantity</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.product_qty" name="name"
                                    placeholder="Enter qty" id="example-text-input">
                                <small class="text-danger" v-if="errors.product_qty">{{ errors.product_qty[0] }}</small>

                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success" type="submit">Update Product</button>
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
                image: null,
                product_name: null,
                buying_price: null,
                selling_price: null,
                supplier_id: null,
                category_id: null,
                product_qty: null,
                updatedImage:null,

            },
            categories: {},
            suppliers: {},
            errors: {}
        }
    },
    mounted() {
        let id = this.$route.params.id;
        if (id) {
            axios.get('/api/product/edit_product/' + id)
                .then(res => {
                    console.log(res.data);
                    this.form = res.data
                })
        }

    },
    created() {
        //categories fetch
        axios.get('/api/category/all_categories')
            .then(res => {
                console.log(res);
                this.categories = res.data.data
            })
            .catch(error => {
                console.log(error);
            })

        //supplier fetch
        axios.get('/api/supplier/get_suppliers')
            .then(res => {
                console.log(res);
                this.suppliers = res.data
            })
            .catch(error => {
                console.log(error);
            })
    },


    methods: {
        add() {
            let id = this.$route.params.id;
            //updating
            if(id){
                axios.patch('/api/product/update_product/'+id,this.form)
                .then(res => {
                    console.log(res);
                        this.$router.push('/all_products')
                        Toast.fire({
                            icon: 'success',
                            title: 'Product Updated successfully'
                        });

                })
            }else{
                axios.post('/api/product/add_product/', this.form)
                .then(res => {
                    console.log(res);
                    if (res.data == 'success') {
                        this.$router.push('/all_products')
                        Toast.fire({
                            icon: 'success',
                            title: 'Product added successfully'
                        });

                    }
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
        imageChange(event) {
            let file = event.target.files[0];
            let file_size = file.size;
            if (file_size > 1048770) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Image size limit is 1 MB'
                })
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    let id = this.$route.params.id;
                    if(id){
                        this.form.updatedImage = event.target.result
                    }else{
                        this.form.image = event.target.result
                    }
                  
                }
                reader.readAsDataURL(file)
            }

        },
        removeImage() {
            let id = this.$route.params.id;
            if(id){
                this.form.updatedImage = null

            }else{
                this.form.image = null

            }
        }
    }
}
</script>
