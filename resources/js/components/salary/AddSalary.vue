<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Salary</a></li>
                        <li class="breadcrumb-item active">Add Salary</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Salary</h4>
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
                            <label for="example-text-input" class="col-sm-2 col-form-label">employer</label>
                            <div class="col-sm-10">
                                <select @change="selectedEmployer(form.employee_id)" v-model="form.employee_id" id="select"
                                    class="form-control" data-toggle="select2" data-width="100%">
                                    <option disabled>Select</option>
                                    <option v-for="item in employers" :value="item.id">{{ item.name }}</option>
                                </select>
                                <small class="text-danger" v-if="errors.employee_id">{{ errors.employee_id[0] }}</small>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Salary Amount</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" v-model="form.amount" name="name"
                                    placeholder="Enter salary" id="example-text-input">
                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Given Month</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="month" v-model="form.date" name="name"
                                    id="example-text-input">
                                <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>

                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success" type="submit">Update Salary</button>
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
                employee_id: null,
                date: null,
                amount: null,

            },
            employers: {},
            errors: {},
        }
    },
    computed: {
        defaultMonth() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Adding leading zero if needed
            return `${currentYear}-${currentMonth}`;
        }
    },
    mounted() {
        this.setDefaultMonth()
        let id = this.$route.params.id;
        axios.get('/api/employee/all_employees/')
            .then(res => {
                console.log(res.data);
                this.employers = res.data
            })

        if (id) {
            axios.get('/api/salary/edit_salary/'+id)
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
            if (id > 0) {
                axios.patch('/api/salary/update_salary/' + id, this.form)
                    .then(res => {
                        console.log(res);
                        this.$router.push('/all_salary')
                        Toast.fire({
                            icon: 'success',
                            title: 'Salary updated successfully'
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

            } else {
                //inserting
                axios.post('/api/salary/add_salary/', this.form)
                    .then(res => {
                        console.log(res);
                        this.$router.push('/all_salary')
                        Toast.fire({
                            icon: 'success',
                            title: 'Salary added successfully'
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
        //default date for salary month field
        setDefaultMonth() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Adding leading zero if needed
            this.form.date = `${currentYear}-${currentMonth}`;
        },
        selectedEmployer(id) {
            axios.get('api/get_employee_salary/' + id)
                .then(res => {
                    this.form.amount = res.data.salary
                })
                .catch(error => {
                    alert('error');
                })
        }
    }
}
</script>
