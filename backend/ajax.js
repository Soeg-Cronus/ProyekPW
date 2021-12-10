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

const changeJumlah = () => {
    
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
            $.ajax({
                type: "post",
                url: "backend/ajaxcontroller.php",
                data: {
                    'mode': 'select cart',
                    'id': id,
                    'user': session
                },
                success: function (response) {
                    let hasil = JSON.parse(response)
                    $("#isi").html('');
                    $("#isi").append(hasil['view']);
                    $("#jmlbarang0").html(hasil['jumlah_item']+' items');
                    $("#jmlbarang1").html('ITEMS ' + hasil['jumlah_item']);
                    $("#totalharga").html(hasil['total']);
                    // console.log(hasil['view']);
                    // console.log(response);
                }
            });
        }
    });
}