"use strict";

var KTLaporansEditLaporanStatus = function () {
    const id_laporan = document.getElementById("id_laporan").value;
    const modalElement = document.getElementById("kt_modal_add_laporan-accept-" + id_laporan);
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_laporan-accept_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            tanggal_proses: {
                validators: {
                    notEmpty: {
                        message: "Tanggal Proses Harus Diisi"
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
                    }
                }
            },
            tanggal_selesai: {
                validators: {
                    notEmpty: {
                        message: "Tanggal Selesai Harus Diisi"
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Format tanggal tidak valid'
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
    
    const submitButton = modalElement.querySelector('[data-kt-laporan-accept-modal-action="submit"]');
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
    const closeButton = modalElement.querySelector('[data-kt-laporan-accept-modal-action="close"]');
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
    KTLaporansEditLaporanStatus.init();
});
