"use strict";

var KTWargasAddWargaLokal = function () {
    window.updateGlobalIndex = function() {
        console.log("Nilai index saat ini:", index);
        const modalElement = document.getElementById("kt_modal_add_wargalokal");
        const formElement = document.getElementById("kt_modal_add_warga_form");

        console.log(`wargas[${index}][nama]`);
        const formValidation = FormValidation.formValidation(formElement, {
            fields: {
                [`wargas[${index}][nik]`]: {
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
                [`wargas[${index}][nama]`]: {
                    validators: {
                        notEmpty: {
                            message: "Nama Harus Diisi"
                        },
                    }
                },
                [`wargas[${index}][jenis_kelamin]`]: {
                    validators: {
                        notEmpty: {
                            message: "Jenis Kelamin Harus Dipilih"
                        }
                    }
                },
                [`wargas[${index}][tempat_lahir]`]: {
                    validators: {
                        notEmpty: {
                            message: "Tempat Lahir Harus Diisi"
                        }
                    }
                },
                [`wargas[${index}][tanggal_lahir]`]: {
                    validators: {
                        notEmpty: {
                            message: "Tanggal Lahir Harus Diisi"
                        }
                    }
                },
                [`wargas[${index}][agama]`]: {
                    validators: {
                        notEmpty: {
                            message: "Agama Harus Diisi"
                        }
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
        
        // Fungsi untuk mengambil data nik
        function fetchNIK() {
            const route = window.cekNIKRoute;

            return fetch(route)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Terjadi masalah dengan permintaan: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    return data.niks.map(nikObject => nikObject.nik);
                });
        }

        function checkNIK(inputNIK) {
            return fetchNIK()
                .then(niks => {
                    return niks.includes(inputNIK);
                });
        }
        
        function checkAllNIK() {
            const promises = [];
            let invalidNIKIndex = [];
        
            for (let i = 1; i <= index; i++) {
                const value = document.querySelector('#nik_' + i).value;
                promises.push(checkNIK(value).then((nikIsnotValid) => {
                    console.log("Nilai i:", i);
                    console.log("NIK Valid?", nikIsnotValid);
                    if (nikIsnotValid) {
                        invalidNIKIndex.push(i);
                    }
                    return !nikIsnotValid;
                }));
            }
        
            Promise.all(promises)
                .then((results) => {
                    const allNIKValid = results.every(nikIsnotValid => nikIsnotValid);
                    if (allNIKValid) {
                        if (!no) {
                            Swal.fire({
                                text: "Semua Warga berhasil ditambahkan.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                },
                                timer: 2000
                            });
                            no = true;
                        }
                        formElement.submit();
                    } else {
                        console.log("Ada NIK yang tidak valid.", invalidNIKIndex);
                        if (!no) {
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;
                            const errorMessage = "NIK pada kolom ke " + invalidNIKIndex.join(", ") + " tidak valid.";
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            no = true;
                        }
                    }
                })
                .catch((error) => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    console.error('Terjadi kesalahan saat memeriksa RT atau KK:', error);
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
        }

        const submitButton = modalElement.querySelector('[data-kt-wargalokal-modal-action="submit"]');
        submitButton.addEventListener("click", function(event) {
            event.preventDefault();
            formValidation.validate().then(function(status) {
                if (status === "Valid") {
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;
                    no = false;

                    checkAllNIK();
                } else {
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
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

        return {
            init: function () {
                // Inisialisasi tambahan jika diperlukan
            }
        };
    }
}();
