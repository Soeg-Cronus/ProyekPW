function wishlist(id,user_aktif){
    // alert(id)
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'id': id,
            'mode':'wishlist',
            'yg_aktif':user_aktif
        },
        success: function (response) {
            alert(response)
        }
    });
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function cart(session, id) {
    let jumlah = document.getElementById('jumlah').value
    if (session == "") {
        setCookie('cart', true, 1)
        setCookie('idnow', id, 1)
        window.location = "./login.php"
    }
    else {
        $.ajax({
            type: "post",
            url: "backend/ajaxcontroller.php",
            data: {
                'id': id,
                'jumlah':jumlah,
                'mode': 'cart',
                'user': session
            },
            success: function (response) {
                alert(response)
            }
        });
    }
}

const changeJumlah = (id, session, e) => {
    let jumlah = e.target.value;
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'id': id,
            'mode': 'update jumlah',
            'user': session,
            'new_jumlah': jumlah
        },
        success: function (response) {
            selectBarang(id, session)
        }
    });
}

const removeBarang = (id, session) => {
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'id': id,
            'mode': 'remove',
            'user': session
        },
        success: function (response) {
            selectBarang(id, session)
        }
    });
}

const selectBarang = (id, session) => {
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'mode': 'select cart',
            'id': id,
            'user': session
        },
        success: function (response) {
            $("#isi").html('');
            try {
                let hasil = JSON.parse(response)
                $("#isi").append(hasil['view']);
                $("#jmlbarang0").html(hasil['jumlah_item']+' items');
                $("#jmlbarang1").html('ITEMS ' + hasil['jumlah_item']);
                $("#totalharga").html(hasil['total']);
                changeShip()
            } catch {
                $("#isi").append('Keranjang kosong');
            }
        }
    });
}

const selectShip = () => {
    $.ajax({
        type: "get",
        url: "backend/ajaxcontroller.php",
        data: {
            'mode': 'select shipment'
        },
        success: function (response) {
            let data = JSON.parse(response)
            // console.log(data);
            $("#shipping").html('');
            data.forEach(e => {
                $("#shipping").append(`<option value='${e['id_pengiriman']}' class='text-muted'>${e['nama_pengiriman']} - ${e['harga']}</option>`);
            });
        }
    });
}

const changeShip = () => {
    let idDelivery = $("#shipping").val();
    let subtotal = $("#totalharga").html();
    subtotal = subtotal.replace(/[^\d]/g, '');
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'id_shipment': idDelivery,
            'mode': 'ganti shipment'
        },
        success: function (response) {
            let data = JSON.parse(response)
            let grandtotal = parseInt(data['harga']) + parseInt(subtotal)
            $("#paid").html(rupiah(grandtotal));
        }
    });
}

const checkout = () => {
    // TODO:
    console.log(tes);
    let delivery = $("#shipping").val();
    $.ajax({
        type: "post",
        url: "backend/ajaxcontroller.php",
        data: {
            'mode': 'cout',
            'id': session,
            'idShipping': delivery
        },
        success: function (response) {
            
        }
    });
}

const rupiah = (nominal) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(nominal) + ',-';
}

selectShip()
