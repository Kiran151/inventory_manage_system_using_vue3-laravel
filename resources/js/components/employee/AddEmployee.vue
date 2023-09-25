<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                        <li class="breadcrumb-item active">Add Employee</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Employee</h4>
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
                            <div class="col-sm-3">
                                <img :src="form.image == null ? 'assets/images/no_image.jpg' : form.image" alt="image"
                                    class="img-fluid avatar-xl border rounded shadow">
                                <input class="form-control mt-1" @change="imageChange" type="file" id="inputGroupFile04">
                            </div>
                        </div>
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
                            <label for="example-text-input" class="col-sm-2 col-form-label">Salary</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.salary" name="name"
                                    placeholder="Enter your salary" id="example-text-input">
                                <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">NID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" v-model="form.nid" name="name"
                                    placeholder="Enter your NID" id="example-text-input">
                                <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>

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
export default {
    data() {
        return {
            form: {
                image: null,
                name: null,
                email: null,
                address: null,
                phone: null,
                salary: null,
                nid: null,
            },
            errors: {}
        }
    },
    methods: {
        add() {
            axios.post('/api/employee/add_employee', this.form)
                .then(res => {
                    console.log(res);
                    if (res.data == 'success') {
                        this.$router.push('/all_employee')
                        Toast.fire({
                            icon: 'success',
                            title: 'Employee added successfully'
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
                    this.form.image = event.target.result

                }
                reader.readAsDataURL(file)
            }

        }
    }
}
</script>
