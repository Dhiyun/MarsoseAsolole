"use strict";

var KTSigninGeneral = function() {
    var e, t, i;

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
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                t.disabled = true;
                                setTimeout(function() {
                                    document.getElementById('kt_sign_in_form').submit();
                                }, 0);
                            } else {
                                Swal.fire({
                                    text: "Maaf, username atau password salah.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, dimengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    } else {
                        Swal.fire({
                            text: "Mohon periksa kembali data yang dimasukkan.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, dimengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
            
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});
