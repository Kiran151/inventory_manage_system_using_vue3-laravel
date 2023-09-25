<template>
    <body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </a>

                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes
                                        less
                                        than a minute</p>
                                </div>

                                <form @submit.prevent="signUp()">

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" v-model="form.name" id="fullname"
                                            placeholder="Enter your name">
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>

                                    </div>
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" v-model="form.email" type="email" name="email"
                                            id="emailaddress" placeholder="Enter your email">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" v-model="form.password" name="password"
                                                class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" v-model="form.password_confirmation" id="password"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                            <label class="form-check-label" for="checkbox-signup">I accept <a
                                                    href="javascript: void(0);" class="text-dark">Terms and
                                                    Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-success" type="submit"> Sign Up </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-primary text-primary"><i
                                                    class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-danger text-danger"><i
                                                    class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                                    class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-secondary text-secondary"><i
                                                    class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account? <router-link to="/login"
                                        class="text-white ms-1"><b>Sign
                                            In</b></router-link></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </body>
</template>

<script>
import axios from 'axios';

export default {
    created() {
        $('.content-page').hide()
        if (User.loggedIn()) {
            this.$router.push('/home')
        }
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errors: {}
        }
    },
    methods: {
        signUp() {
            //   console.log(this.form);
            axios.post('api/auth/register', this.form)
                .then(res => {
                    // console.log(res);
                    User.responseAfterLogin(res)
                    // showing sidebar,topbar,footer
                    $('#sidebar').removeClass('d-none')
                    $('#header').removeClass('d-none')
                    $('#footer').removeClass('d-none')

                    //toaster
                    Toast.fire({
                        icon: 'success',
                        title: 'Registered and Signed in successfully'
                    })

                    this.$router.push('/')



                })
                .catch(error =>
                    this.errors = error.response.data.errors
                )
        }
    }
}
</script>