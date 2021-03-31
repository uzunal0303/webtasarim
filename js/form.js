$(document).ready(() => {
    $(".btn-success").click(() => {
        var control = $(".control").val();

        if (control.length <= 0) {
            swal("Üzgünüm!", "Mesajınız iletilemedi!Tekrar kontrol ediniz.", "error");
            return false;
        } else {
            swal("Tebrikler!", "Mesajınız gönderildi!", "success");
            return false;
        }

    })
})