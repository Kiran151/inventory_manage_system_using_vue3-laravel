import { createWebHistory, createRouter } from "vue-router";
import AboutPage from "./components/AboutPage.vue";
import Login from "./components/auth/Login.vue";
import Register from "./components/auth/Register.vue";
import Home from "./components/Home.vue";
import Logout from "./components/auth/Logout.vue";
//employee
import AddEmployee from "./components/employee/AddEmployee.vue";
import AllEmployee from "./components/employee/AllEmployee.vue";
import EditEmployee from "./components/employee/EditEmployee.vue";

// supplier
import AllSupplier from "./components/supplier/AllSupplier.vue";
import AddSupplier from "./components/supplier/AddSupplier.vue";
//category
import AllCategory from "./components/category/AllCategory.vue";
import AddCategory from "./components/category/AddCategory.vue";
//product
import AllProduct from "./components/product/AllProducts.vue";
import AddProduct from "./components/product/AddProduct.vue";
//salary
import AddSalary from "./components/salary/AddSalary.vue";
import AllSalary from "./components/salary/AllSalary.vue";
//customer
import AddCustomer from "./components/customer/AddCustomer.vue";
import AllCustomer from "./components/customer/AllCustomer.vue";














const routes = [
    { path: '/about', component: AboutPage },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/logout', component: Logout },
    { path: '/', component: Home },
    //employee
    { path: '/add_employee', component: AddEmployee },
    { path: '/all_employee', component: AllEmployee },
    { path: '/edit_employee/:id', component: EditEmployee },

    // supplier
    { path: '/all_supplier', component: AllSupplier },
    { path: '/add_supplier/:id?', component: AddSupplier },
    // category
    { path: '/all_category', component: AllCategory },
    { path: '/add_category/:id?', component: AddCategory },
    //product
    { path: '/all_products', component: AllProduct },
    { path: '/add_product/:id?', component: AddProduct},
    //salary
    { path: '/add_salary/:id?', component: AddSalary},
    { path: '/all_salary/', component: AllSalary},
     //customer
     { path: '/add_customer/:id?', component: AddCustomer},
     { path: '/all_customers/', component: AllCustomer},












];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;