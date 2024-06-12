var KTKKsEditKK = function () {
    const id_kk = document.getElementById("id_kk").value;
    const modalElement = document.getElementById("kt_modal_edit_kk-" + id_kk);
    const formElement = modalElement && modalElement.querySelector("#kt_modal_edit_kk_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);
    
    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            no_kk: {
                validators: {
                    notEmpty: {
                        message: "No KK Harus Diisi"
                    },
                    stringLength: {
                        min: 16,
                        max: 16,
                        message: "No KK Harus 16 Nomer"
                    },
                }
            },
            kepala_keluarga: {
                validators: {
                    notEmpty: {
                        message: "Kepala Keluarga Harus Diisi"
                    },
                }
            },
            nik: {
                validators: {
                    notEmpty: {
                        message: "NIK Harus Diisi"
                    },
                    stringLength: {
                        min: 16,
                        max: 16,
                        message: "No NIK Harus 16 Nomer"
                    },
                }
            },
            jenis_kelamin: {
                validators: {
                    notEmpty: {
                        message: "Jenis Kelamin Harus Dipilih"
                    }
                }
            },
            tempat_lahir: {
                validators: {
                    notEmpty: {
                        message: "Tempat Lahir Harus Diisi"
                    }
                }
            },
            tanggal_lahir: {
                validators: {
                    notEmpty: {
                        message: "Tanggal Lahir Harus Diisi"
                    }
                }
            },
            agama: {
                validators: {
                    notEmpty: {
                        message: "Agama Harus Diisi"
                    }
                }
            },
            alamat: {
                validators: {
                    notEmpty: {
                        message: "Alamat Harus Diisi"
                    },
                }
            },
            no_rt: {
                validators: {
                    notEmpty: {
                        message: "No RT Harus Diisi"
                    },
                }
            },
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

    // Fungsi untuk mengambil data kk
    function fetchKK() {
        const route = window.cekKKRoute;

        return fetch(route)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi masalah dengan permintaan: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                return data.kks.map(kkObject => kkObject.no_kk);
            });
    }

    function checkKK(inputKK) {
        return fetchKK()
            .then(kks => {
                return kks.includes(inputKK);
            });
    }
    
    const submitButton = modalElement.querySelector('[data-kt-kk-modal-action="submit"]');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
        formValidation.validate().then(function(status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
    
                checkKK(document.querySelector('#no_kk').value)
                .then(( kkDoesNotExist) => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    if (!kkDoesNotExist) {
                        Swal.fire({
                            text: "KK berhasil ditambahkan.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            },
                            timer: 2000
                        });
                        formElement.submit();
                    } else {
                        let errorMessage = '';
                        if (kkDoesNotExist) {
                            errorMessage = "KK sudah terdaftar. Silakan coba lagi.";
                        }
                        Swal.fire({
                            text: errorMessage,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                })
                .catch(error => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    console.error('Terjadi kesalahan saat memeriksa KK:', error);
                    Swal.fire({
                        text: "Terjadi kesalahan saat memeriksa RT atau KK. Silakan coba lagi.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                });
            } else {
                Swal.fire({
                    text: "Terdapat kesalahan dalam form, silakan coba lagi.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        });
    });

    // Menangani event close
    const closeButton = modalElement.querySelector('[data-kt-kk-modal-action="close"]');
    closeButton.addEventListener("click", function(event) {
        event.preventDefault();
        Swal.fire({
            text: "Are you sure you want to cancel?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, cancel it!",
            cancelButtonText: "No, return",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                formElement.reset();
                modalInstance.hide();
            }
        });
    });

    return {
        init: function () {
            // Inisialisasi tambahan jika diperlukan
        }
    };
}();
