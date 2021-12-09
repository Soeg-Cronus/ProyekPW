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
                'mode': 'cart',
                'user': session
            },
            success: function (response) {
                alert(response)
            }
        });
    }
}