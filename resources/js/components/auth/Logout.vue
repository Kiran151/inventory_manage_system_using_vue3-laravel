<template></template>

<script>
import appStorage from '../../helpers/appStorage';
export default {
    created() {
        appStorage.clear();
        Toast.fire({
            icon: 'success',
            title: 'Logout successfully'
        })
        this.$router.push('/login')

    }
}
</script>
