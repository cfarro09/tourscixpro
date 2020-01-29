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
function initMap() {
    const centrar = {
        lat: (parseFloat($('#latitud').val()) ? parseFloat($('#latitud').val()) : -6.7626066620611445),
        lng: (parseFloat($('#latitud').val()) ? parseFloat($('#longitud').val()) : -79.83053383068847),
    };
    const map = new google.maps.Map(document.getElementById('mapa'), {
        center: centrar,
        zoom: 8,
        'mapTypeId': google.maps.MapTypeId.ROADMAP

    });
    const marker = new google.maps.Marker({
        'position': centrar,
        'map': map,
        'draggable': true
    });
    google.maps.event.addListener(marker, 'dragend', function () {
        $('#latitud').val(marker.getPosition().lat());
        $('#longitud').val(marker.getPosition().lng());
    });
}
$(document).ready(function () {
    if ($('#latitud').length > 0) {
        $('#btn_map').on('click', function () {
            if ($(this).val() == "VER MAPA") {
                $('#mapa').show('slow/400/slow');
                $(this).val("Ocultar Mapa");
            } else {
                $('#mapa').hide('slow/400/slow');
                $(this).val("VER MAPA");
                $(this).css("color", 'white');
            }
        });
        if(document.querySelector('#departamento')){
            document.querySelector('#departamento').addEventListener('change', e => {
                $('#provincia').empty();
                $('#provincia').append('<option disabled selected>Select</option>')
                fetch_post('lugar_turistico/get_provincias', `departamento=${e.target.value}`).then(res => {
                    if (res) {
                        res.forEach(provincia => {
                            $('#provincia').append(`<option value="${provincia.provincia}">${provincia.provincia}</option>`)
                        });
                    }
                })
            })
        }
        $('#register_lugar').on('submit', function (e) {
            e.preventDefault();
            console.log();
            fetch_post(e.target.dataset.action, $('#register_lugar').serialize()).then(res => {
                if (res) {
                    if (res.success) {
                        document.querySelector('#register_lugar').reset();
                        swal('Bien hecho!', res.msg, 'success')
                    } else {
                        swal('Oh!, hubo un error!', res.msg, 'error')
                    }
                } else {
                    swal('Oh!, hubo un error!', res.msg, 'error')
                }
            })
        })
    }
    if ($('.remove_list').length > 0) {
        $('.remove_list').on('click', function (e) {
            e.preventDefault();
            const tosend = $(this).data('tosend');
            const action = $(this).data('action');
            const tr = $(this).closest('tr');
            swal({
                title: '¿Estás seguro?',
                text: "No podrás revertir este cambio!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4fa7f3',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Si, eliminar!'
            }).then(function () {
                fetch_post(action, tosend).then(res => {
                    if (res) {
                        if (res.success) {
                            swal('Bien hecho!', res.msg, 'success');
                            tr.hide('slow/400/fast', function () {
                                tr.remove();
                            })
                        } else {
                            swal('Oh!, hubo un error!', res.msg, 'error');
                        }
                    } else {
                        swal('Oh!, hubo un error!', res.msg, 'error');
                    }
                })
            });
        })
    }
    if ($('#departamento').length > 0) {
        if ($('#departamento').val()) {
            fetch_post('lugar_turistico/get_provincias', `departamento=${$('#departamento').val()}`).then(res => {
                if (res) {
                    res.forEach(provincia => {
                        $('#provincia').append(`<option value="${provincia.provincia}" ${(provincia.provincia == $('#departamento').data('provincia') ? "selected" : "")}>${provincia.provincia}</option>`)
                    });
                }
            })
        }
    }
    $('#editar_lugar').on('submit', function (e) {
        e.preventDefault();
        let listImages = [];
        document.querySelectorAll(".checkImages").forEach(item => {
            if(item.checked){
                listImages.push(item.dataset.nameimage);
            }
        })
        document.querySelector("#listImages").value = JSON.stringify(listImages);
        console.log(document.querySelector("#listImages").value)
        if(listImages.length === 3){
            const action = $(this).data('action');
            fetch_post(action, $('#editar_lugar').serialize()).then(res => {
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
                            location.href = `${site_url}lugar_turistico/listar`;
                        });
                    } else {
                        swal('Oh!, hubo un error!', res.msg, 'error')
                    }
                } else {
                    swal('Oh!, hubo un error!', res.msg, 'error')
                }
            })
        }else{
            toast_error("Tienes que seleccionar 3 imagenes")
        }
    })
});