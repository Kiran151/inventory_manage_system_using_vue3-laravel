import './bootstrap';
import { createApp } from 'vue';
import router from './routes';
window.router = router;

//import user file
import User from './helpers/user';
window.User = User;
//import sweetalert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;
//delete alert
import DeleteAlert from './helpers/deleteAlert';
window.DeleteAlert = DeleteAlert;








const app = createApp({});
app.use(router)

app.mount('#app');
