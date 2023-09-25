<template>
    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
    <a href="javascript:void(0);" class="action-icon" @click="delete"> <i class="mdi mdi-delete"></i></a>
</template>

<script>
export default {
   methods:{
    delete(){
        this.$emit('clicked')
    }
   }
}
</script>
