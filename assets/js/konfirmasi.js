function hapusMenu(url) {
    Swall.fire({
        title: 'Are you sure?',
        text: "Yakin ingin hapus menu?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtontext: 'Ya,hapus!',
    }).then((result) => {
        if (result.value) {
            document.location.href = url;
        }
    })
}

function hapusRole(url){
    Swal.fire({
        title: 'Are you sure',
        text: "Yakin ingin hapus Role?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ya, hapus!'
    }).then((result) => {
        if(result.value){
            document.location.href = url;
        }
    })
}