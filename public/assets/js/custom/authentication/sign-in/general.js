"use strict";

var KTSigninGeneral = function() {
    var e, t, i;

    var tampilkanPesan = function(pesan) {
        Swal.fire({
            text: pesan,
            icon: "error",
            heightAuto: false,
            buttonsStyling: false,
            confirmButtonText: "Ok, dimengerti!",
            customClass: {
                confirmButton: "btn btn-marsose"
            }
        });
    };

    return {
        init: function() {
            e = document.querySelector("#kt_sign_in_form");
            t = document.querySelector("#kt_sign_in_submit");
            i = FormValidation.formValidation(e, {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: "Tolong isi username"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Jangan lupa passwordnya"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            t.addEventListener("click", function(n) {
                n.preventDefault();
                i.validate().then(function(validation) {
                    if (validation === "Valid") {
                        var username = e.querySelector('[name="username"]').value;
                        var password = e.querySelector('[name="password"]').value;
                        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
                        fetch('/check_login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                username: username,
                                password: password
                            })
                        })
                        .then(response => {
                            if (response.status === 429) {
                                return { success: false, message: "Terlalu banyak percobaan masuk. Silakan tunggu 1 menit, lalu coba lagi." };
                            }

                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                t.disabled = true;
                                setTimeout(function() {
                                    document.getElementById('kt_sign_in_form').submit();
                                }, 0);
                            } else if (data.message && data.message.indexOf("Terlalu") === 0) {
                                tampilkanPesan(data.message);
                            } else {
                                tampilkanPesan("Maaf, username atau password salah.");
                            }
                        })
                        .catch(() => {
                            tampilkanPesan("Tidak dapat terhubung ke server. Periksa koneksi Anda, lalu coba lagi.");
                        });
                    } else {
                        tampilkanPesan("Mohon periksa kembali data yang dimasukkan.");
                    }
                });
            });
            
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});
