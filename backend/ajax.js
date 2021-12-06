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