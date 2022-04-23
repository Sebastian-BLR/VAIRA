function alertEliminarUsuario (id) {
    Swal.fire({
        title: 'Seguro que quieres eliminar este usuario?',
        icon: 'question',
        iconColor: 'red',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = 'configuracion.php?id='+id
        }
    })
}

let Load =()=>{

}

document.addEventListener("DOMContentLoaded",Load);