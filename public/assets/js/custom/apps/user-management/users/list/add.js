"use strict";

// var KTLevelsAddLevel = function () {
//     const modalElement = document.getElementById("kt_modal_add_level");
//     const formElement = modalElement && modalElement.querySelector("#kt_modal_add_level_form");
//     const modalInstance = modalElement && new bootstrap.Modal(modalElement);

//     if (!modalElement || !formElement || !modalInstance) {
//         console.error("Modal or form element not found for KTLevelsAddLevel");
//         return;
//     }

//     const formValidation = FormValidation.formValidation(formElement, {
//         fields: {
//             level_kode: {
//                 validators: {
//                     notEmpty: {
//                         message: "Level code is required"
//                     },
//                     stringLength: {
//                         min: 3,
//                         message: "Level code must be at least 3 characters long"
//                     },
//                     unique: {
//                         // Mengharuskan kode level unik, disarankan untuk menghandle validasi ini di sisi server
//                         message: "Level code must be unique"
//                     }
//                 }
//             },
//             level_nama: {
//                 validators: {
//                     notEmpty: {
//                         message: "Level name is required"
//                     },
//                     stringLength: {
//                         max: 100,
//                         message: "Level name must be at most 100 characters long"
//                     }
//                 }
//             }
//         },
//         plugins: {
//             trigger: new FormValidation.plugins.Trigger(),
//             bootstrap: new FormValidation.plugins.Bootstrap5({
//                 rowSelector: ".fv-row",
//                 eleInvalidClass: "",
//                 eleValidClass: ""
//             })
//         }
//     });

//     const submitButton = modalElement.querySelector('[data-kt-level-modal-action="submit"]');
//     submitButton.addEventListener("click", function(event) {
//         event.preventDefault();
//         formValidation.validate().then(function(status) {
//             if (status === "Valid") {
//                 submitButton.setAttribute("data-kt-indicator", "on");
//                 submitButton.disabled = true;

//                 // Simulasikan proses submit selama 2 detik
//                 setTimeout(function() {
//                     submitButton.removeAttribute("data-kt-indicator");
//                     submitButton.disabled = false;

//                     Swal.fire({
//                         text: "Level form has been successfully submitted!",
//                         icon: "success",
//                         buttonsStyling: false,
//                         confirmButtonText: "Ok, got it!",
//                         customClass: {
//                             confirmButton: "btn btn-primary"
//                         }
//                     }).then(function(result) {
//                         if (result.isConfirmed) {
//                             formElement.submit();
//                             modalInstance.hide();
//                         }
//                     });
//                 }, 2000);
//             } else {
//                 Swal.fire({
//                     text: "Sorry, looks like there are some errors detected, please try again.",
//                     icon: "error",
//                     buttonsStyling: false,
//                     confirmButtonText: "Ok, got it!",
//                     customClass: {
//                         confirmButton: "btn btn-primary"
//                     }
//                 });
//             }
//         });
//     });

//     // Menangani event close
//     const closeButton = modalElement.querySelector('[data-kt-level-modal-action="close"]');
//     closeButton.addEventListener("click", function(event) {
//         event.preventDefault();
//         Swal.fire({
//             text: "Are you sure you want to cancel?",
//             icon: "warning",
//             showCancelButton: true,
//             buttonsStyling: false,
//             confirmButtonText: "Yes, cancel it!",
//             cancelButtonText: "No, return",
//             customClass: {
//                 confirmButton: "btn btn-primary",
//                 cancelButton: "btn btn-active-light"
//             }
//         }).then(function(result) {
//             if (result.isConfirmed) {
//                 formElement.reset();
//                 modalInstance.hide();
//             }
//         });
//     });

//     return {
//         init: function () {
//             // Inisialisasi tambahan jika diperlukan
//         }
//     };
// }();

// KTUtil.onDOMContentLoaded(function () {
//     KTLevelsAddLevel.init();
// });
