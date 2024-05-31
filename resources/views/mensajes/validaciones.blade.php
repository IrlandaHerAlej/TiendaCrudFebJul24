
@if(($message = Session::get('Seagrego')))
<script>
     const Toast = Swal.mixin({
     toast: true,
     position: "top-end",
     showConfirmButton: false,
     timer: 3000,
     timerProgressBar: true,
     didOpen: (toast) => {
     toast.onmouseenter = Swal.stopTimer;
     toast.onmouseleave = Swal.resumeTimer;
  }
});
    Toast.fire({
    icon: "success",
    title: "{{$Seagrego}}"
});
</script>
@endif

@if(($message = Session::get('mensaje')))
<script>
    Swal.fire({
         title: "Mensaje",
         text: "{{$message}}",
         icon: "success"
         });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                let clientId = this.getAttribute('data-id');
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, elimínalo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + clientId).submit();
                        Swal.fire({
                        title: "Eliminado!",
                        text: "El registro a sido eliminado.",
                        icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>

