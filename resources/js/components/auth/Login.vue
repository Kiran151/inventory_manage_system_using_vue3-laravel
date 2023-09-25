
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
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin
                                        panel.
                                    </p>
                                </div>

                                <form action="#" @submit.prevent="login">
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input v-model="form.email" class="form-control" type="email" id="emailaddress"
                                            placeholder="Enter your email">
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input v-model="form.password" type="password" id="password"
                                                class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>

                                    </div>


                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>



                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="auth-recoverpw.html" class="text-white-50 ms-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <router-link to="/register"
                                        class="text-white ms-1"><b>Sign
                                            Up</b></router-link></p>
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
                email: null,
                password: null,
            },
            errors: {}

        }
    },
    methods: {
        login() {
            // console.log(this.form);
            axios.post('api/auth/login', this.form)
                .then(res => {
                    console.log(res);
                    User.responseAfterLogin(res)
                    // showing sidebar,topbar,footer
                        $('#sidebar').removeClass('d-none')
                        $('#header').removeClass('d-none')
                        $('#footer').removeClass('d-none')

                    //toaster
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })

                    this.$router.push('/')



                })
                .catch(error => {
                    this.errors = error.response.data.errors
                    Toast.fire({
                        icon: 'error',
                        title: 'Invalid Email Or Password'
                    })
                })

        }
    }
}
</script>
