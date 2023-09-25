class DeleteAlert {
    deleteRow(url,id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(url+id)
                    .then((res) => {
                        console.log(res);
                        // hiding row
                        if (res.data == 'success') {
                            const deleteButton = document.getElementById(`deleteButton-${id}`);
                            if (deleteButton) {
                                const tr = deleteButton.closest('tr');
                                if (tr) {
                                    tr.remove();
                                }
                            }
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    })
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
}
export default DeleteAlert = new DeleteAlert();