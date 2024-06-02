"use strict";

var KTLevelsAddLevel = function () {
    const modalElement = document.getElementById("kt_modal_add_level");
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_level_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    if (!modalElement || !formElement || !modalInstance) {
        console.error("Modal or form element not found for KTLevelsAddLevel");
        return;
    }

    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            level_kode: {
                validators: {
                    notEmpty: {
                        message: "Level code is required"
                    },
                    stringLength: {
                        min: 3,
                        message: "Level code must be at least 3 characters long"
                    },
                    unique: {
                        // Mengharuskan kode level unik, disarankan untuk menghandle validasi ini di sisi server
                        message: "Level code must be unique"
                    }
                }
            },
            level_nama: {
                validators: {
                    notEmpty: {
                        message: "Level name is required"
                    },
                    stringLength: {
                        max: 100,
                        message: "Level name must be at most 100 characters long"
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

    const submitButton = modalElement.querySelector('[data-kt-level-modal-action="submit"]');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
        formValidation.validate().then(function(status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // Simulasikan proses submit selama 2 detik
                setTimeout(function() {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    Swal.fire({
                        text: "Level form has been successfully submitted!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            formElement.submit();
                            modalInstance.hide();
                        }
                    });
                }, 2000);
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

    // Menangani event close
    const closeButton = modalElement.querySelector('[data-kt-level-modal-action="close"]');
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
    KTLevelsAddLevel.init();
});

var KTKKsAddKK = function () {
    const modalElement = document.getElementById("kt_modal_add_kk");
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_kk_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    if (!modalElement || !formElement || !modalInstance) {
        console.error("Modal or form element not found for KTKKsAddKK");
        return;
    }

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
            alamat: {
                validators: {
                    notEmpty: {
                        message: "Alamat Harus Diisi"
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
                // Mengatur indikator loading dan menonaktifkan tombol submit
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
    
                checkKK(document.querySelector('#no_kk').value)
                .then((kkDoesNotExist) => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
    
                    // Jika RT ada dan KK belum ada, tambahkan KK
                    if (!kkDoesNotExist) {
                        Swal.fire({
                            text: "KK berhasil ditambahkan.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => formElement.submit());
                    } else {
                        // Menampilkan pesan error jika RT tidak ada atau KK sudah ada
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
                    // Menangani kesalahan dan menampilkan pesan error
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

KTUtil.onDOMContentLoaded(function () {
    KTKKsAddKK.init();
});

var KTWargasAddWarga = function () {
    const modalElement = document.getElementById("kt_modal_add_warga");
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_warga_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    if (!modalElement || !formElement || !modalInstance) {
        console.error("Modal or form element not found for KTWargasAddWarga");
        return;
    }

    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            nik: {
                validators: {
                    notEmpty: {
                        message: "NIK Harus Diisi"
                    },
                    stringLength: {
                        max: 16,
                        message: "No NIK Harus 16 Nomer"
                    },
                }
            },
            nama: {
                validators: {
                    notEmpty: {
                        message: "Nama Harus Diisi"
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

    function checkNIK(inputNIK) {
        return fetchNIK()
            .then(niks => {
                return niks.includes(inputNIK);
            });
    }

    function checkKK(inputKK) {
        if (inputKK === null || inputKK.trim() === "") {
            return Promise.resolve(true);
        } else {
            return fetchKK()
            .then(kks => {
                return kks.includes(inputKK);
            });
        }
    }

    const submitButton = modalElement.querySelector('[data-kt-warga-modal-action="submit"]');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
        formValidation.validate().then(function(status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // Memerika NIK dan KK apakah sesuai
                Promise.all([
                    checkNIK(document.querySelector('#nik').value),
                    checkKK(document.querySelector('#no_kk').value)
                ])
                .then(([nikDoesNotExist, noKKExists]) => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    // JIka KK ada dan NIK belum ada, tambahkan Warga
                    if (noKKExists && !nikDoesNotExist) {
                        Swal.fire({
                            text: "Warga berhasil ditambahkan.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => formElement.submit());
                    } else {
                        // Menampilkan pesan error jika RT tidak ada atau KK sudah ada
                        let errorMessage = '';
                        if (!noKKExists && nikDoesNotExist){
                            errorMessage = "RT atau KK tidak sesuai. Silakan coba lagi.";
                        } else if (!noKKExists) {
                            errorMessage = "KK tidak terdaftar. Silakan coba lagi.";
                        } else if (nikDoesNotExist) {
                            errorMessage = "NIK sudah terdaftar. Silakan coba lagi.";
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
                    // Menangani kesalahan dan menampilkan pesan error
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

    // Menangani event close
    const closeButton = modalElement.querySelector('[data-kt-warga-modal-action="close"]');
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
    KTWargasAddWarga.init();
});

var KTWargasAddWargaLokal = function () {
    const modalElement = document.getElementById("kt_modal_add_wargalokal");
    const formElement = modalElement && modalElement.querySelector("#kt_modal_add_wargalokal_form");
    const modalInstance = modalElement && new bootstrap.Modal(modalElement);

    if (!modalElement || !formElement || !modalInstance) {
        console.error("Modal or form element not found for KTWargasAddWarga");
        return;
    }

    const formValidation = FormValidation.formValidation(formElement, {
        fields: {
            nik: {
                validators: {
                    notEmpty: {
                        message: "NIK Harus Diisi"
                    },
                    stringLength: {
                        max: 16,
                        message: "No NIK Harus 16 Nomer"
                    },
                }
            },
            nama: {
                validators: {
                    notEmpty: {
                        message: "Nama Harus Diisi"
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
        return fetch('admin/warga/cek_nik')
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

    const submitButton = modalElement.querySelector('[data-kt-wargalokal-modal-action="submit"]');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
        formValidation.validate().then(function(status) {
            if (status === "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                // Memerika NIK apakah sesuai
                checkNIK(document.querySelector('#nik').value)
                .then((nikDoesNotExist) => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;

                    // JIka NIK belum ada, tambahkan Warga
                    if (!nikDoesNotExist) {
                        Swal.fire({
                            text: "Warga berhasil ditambahkan.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(() => formElement.submit());
                    } else {
                        let errorMessage = '';
                        if (nikDoesNotExist){
                            errorMessage = "NIK sudah terdaftar. Silakan coba lagi.";
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
                    // Menangani kesalahan dan menampilkan pesan error
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    console.error('Terjadi kesalahan saat memeriksa NIK:', error);
                    Swal.fire({
                        text: "Terjadi kesalahan saat memeriksa NIK. Silakan coba lagi.",
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

    // Menangani event close
    const closeButton = modalElement.querySelector('[data-kt-wargalokal-modal-action="close"]');
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
    KTWargasAddWargaLokal.init();
});
