"use strict";

var KTLaporansAddLaporan = function () {
    const modalElement = document.getElementById("kt_modal_add_laporan");
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_laporan_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            Judul: {
                validators: {
                    notEmpty: {
                        message: "Judul Laporan Harus Diisi"
                    },
                }
            },
            jenis_laporan: {
                validators: {
                    notEmpty: {
                        message: "Jenis Laporan Harus Diisi"
                    },
                }
            },
            gambar: {
                validators: {
                    notEmpty: {
                        message: "Gambar Harus Diisi"
                    },
                }
            },
            keterangan: {
                validators: {
                    notEmpty: {
                        message: "Harap Isi Keterangan"
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
    
    const submitButton = modalElement.querySelector('[data-kt-laporan-modal-action="submit"]');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
        formValidation.validate().then(function(status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
                setTimeout(function() {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
    
                    Swal.fire({
                        text: "Surat berhasil ditambahkan.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                        timer: 1500
                    }).then(() => {
                        formElement.submit();
                    });
                }, 500);
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
    const closeButton = modalElement.querySelector('[data-kt-laporan-modal-action="close"]');
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

KTUtil.onDOMContentLoaded(function () {
    KTLaporansAddLaporan.init();
});
