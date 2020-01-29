const fetch_post_file = async (url, data) => {
    $("#loading-circle-overlay").show();
    const response = await fetch(`${site_url}/${url}`, {
        method: 'POST',
        body: data,
    });
    $("#loading-circle-overlay").hide();
    if (response.ok) {
        try {
            return await response.json();
        } catch (e) {
            toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
        }
    } else {
        toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
    }
}
const fetch_post = async (url, data) => {
    $("#loading-circle-overlay").show();
    const response = await fetch(`${site_url}/${url}`, {
        method: 'POST',
        body: data,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    });
    $("#loading-circle-overlay").hide();
    if (response.ok) {
        try {
            return await response.json();
        } catch (e) {
            toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
        }
    } else {
        toast_error('¡Oh, hubo un error!', 'Vuelva a intentarlo.');
    }
}
$(document).ready(function () {
    $('.remove_foto').on('click', function(e){
        e.preventDefault();
        const cod_foto = $(this).data('cod_foto');
        const action = $(this).data('action');
        const name_foto = $(this).data('name_foto');
        const tr = $(this).closest('tr');
        // delete_foto_fest
        fetch_post(action, `cod_foto=${cod_foto}&name_foto=${name_foto}`).then(res => {
            if (res) {
                if (res.success) {
                    tr.hide('slow/400/fast', function () {
                        tr.remove();
                    })
                    swal('Bien hecho!', res.msg, 'success');
                } else {
                    swal('Oh!, hubo un error!', res.msg, 'error');
                }
            } else {
                swal('Oh!, hubo un error!', res.msg, 'error');
            }
        })  
    })
    $('#register_foto_lugar').on('submit', function(e){
        e.preventDefault();
        const action = $(this).data('action');
        const data = new FormData(document.getElementById('register_foto_lugar'));
        fetch_post_file(action, data).then(res => {
            if (res) {
                if (res.success) {
                    swal('Bien hecho!', res.msg, 'success')
                } else {
                    swal('Oh!, hubo un error!', res.msg, 'error')
                }
            } else {
                swal('Oh!, hubo un error!', res.msg, 'error')
            }
        })  
    })
    $('#editar_foto_lugar').on('submit', function(e){
        e.preventDefault();
        const action = $(this).data('action');
        const data = new FormData(document.getElementById('editar_foto_lugar'));
        fetch_post_file(action, data).then(res => {
            if (res) {
                if (res.success) {
                    swal({
                        title: 'Bien Hecho!',
                        text: res.msg,
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#4fa7f3',
                        cancelButtonColor: '#d57171',
                        confirmButtonText: 'Ir a la Lista!'
                    }).then(function () {
                        location.href = `${site_url}foto_lugar/listar`;
                    });
                } else {
                    swal('Oh!, hubo un error!', res.msg, 'error')
                }
            } else {
                swal('Oh!, hubo un error!', res.msg, 'error')
            }
        })  
    })
});