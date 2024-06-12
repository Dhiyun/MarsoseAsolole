<!--begin::Card body-->
<div class="card-body py-4" id="kt_modal_add_wargalokal">
    <form method="POST" id="kt_modal_add_warga_form" class="form" action="{{ route('kkwarga-admin.storeMany', ['id_kk' => $kk->id_kk, 'rt' => $rtNumber]) }}">
        @csrf
        <!--begin::Row-->
        <div class="row" id="kt_card_add_warga">
        </div>
        <!--end::Row-->
        <div class="text-center pt-15" id="submitBtnContainer" style="display: none;">
            <button type="submit" class="btn btn-primary btn-sm" data-kt-wargalokal-modal-action="submit">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>
<!--end::Card body-->

<script>
    let wargaCount = 0;
    let index = 0;
    let no = false;

    const submitBtnContainer = document.getElementById('submitBtnContainer');

    function addWargaForm() {
        const container = document.getElementById('kt_card_add_warga');
        
        const newEntry = document.createElement('div');
        newEntry.classList.add('col-lg-4');

        index++;
        
        wargaCount++;

        if (index > 0) {
            submitBtnContainer.style.display = 'block';
        }
        
        newEntry.innerHTML = `
            <div class="card mb-5 mb-xl-10" id="kt_card_add_warga_${index}">
                <div class="card-header border-0 mt-5">
                    <h3 class="card-title">Warga #${wargaCount}</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-icon btn-active-color-danger" onclick="removeWargaForm(this)">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_warga_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_warga_header" data-kt-scroll-wrappers="#kt_modal_add_warga_scroll" data-kt-scroll-offset="300px">
                        <!-- NIK -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nik_${index}">NIK</label>
                            <input type="number" id="nik_${index}" name="wargas[${index}][nik]" class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                        <!-- Nama -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nama_${index}">Nama</label>
                            <input type="text" id="nama_${index}" name="wargas[${index}][nama]" class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="jenis_kelamin_${index}">Jenis Kelamin</label>
                            <select id="jenis_kelamin_${index}" name="wargas[${index}][jenis_kelamin]" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!-- Tempat Lahir -->
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2" for="tempat_lahir_${index}">Tempat Lahir</label>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Isi Tempat Kelahiran Seperti Kota">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span></a>
                                        <input type="text" id="tempat_lahir_${index}" name="wargas[${index}][tempat_lahir]" class="form-control form-control-solid mb-3 mb-lg-0" required />
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col">
                                <!-- Tanggal Lahir -->
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2" for="tanggal_lahir_${index}">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir_${index}" name="wargas[${index}][tanggal_lahir]" class="form-control form-control-solid mb-3 mb-lg-0" required />
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!-- Agama -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="agama_${index}">Agama</label>
                            <select id="agama_${index}" name="wargas[${index}][agama]" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                        </div>
                        <!-- Status Keluarga -->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5" for="status_keluarga_${index}">Status Keluarga</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_keluarga]" type="radio" value="kepala_keluarga" id="status_kepala_keluarga_${index}" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_kepala_keluarga_${index}">
                                        <div class="fw-bold text-gray-800">Kepala Keluarga</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_keluarga]" type="radio" value="istri" id="status_istri_${index}" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_istri_${index}">
                                        <div class="fw-bold text-gray-800">Istri</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_keluarga]" type="radio" value="anak" id="status_anak_${index}" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_anak_${index}">
                                        <div class="fw-bold text-gray-800">Anak</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_keluarga]" type="radio" value="lainnya" id="status_lainnya_${index}" checked />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_lainnya_${index}">
                                        <div class="fw-bold text-gray-800">Lainnya</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5" for="status_kependudukan_${index}">Status Kependudukan</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_kependudukan]" type="radio" value="asli" id="status_asli_${index}" checked />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_asli_${index}">
                                        <div class="fw-bold text-gray-800">Asli</div>
                                        <div class="text-gray-600">Menandakan Penduduk Asli atau Tinggal Di Daerah Tersebut</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="wargas[${index}][status_kependudukan]" type="radio" id="status_pendatang_${index}" value="pendatang" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="status_pengunjung_${index}">
                                        <div class="fw-bold text-gray-800">Pendatang</div>
                                        <div class="text-gray-600">Menandakan Menempati Daerah Tersebut Secara Sementara</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
            </div>
        `;
        
        container.appendChild(newEntry);
        
        window.updateGlobalIndex();
    }

    function removeWargaForm(button) {
        const entry = button.closest('.col-lg-4');
        
        entry.remove();

        index--;

        wargaCount--;
        
        const cards = document.querySelectorAll('#kt_card_add_warga .card');
        cards.forEach((card, i) => {
            card.querySelector('.card-title').innerText = `Warga #${i + 1}`;
            card.querySelectorAll('input, select').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, `[${i+1}]`);
                    input.setAttribute('name', newName);
                }
                const id = input.getAttribute('id');
                if (id) {
                    const newId = id.replace(/_\d+$/, `_${i+1}`);
                    input.setAttribute('id', newId);
                    input.setAttribute('for', newId);
                }
            });
        });
        
        if (index === 0) {
            submitBtnContainer.style.display = 'none';
        }

        window.updateGlobalIndex();
    }
</script>

<script src="{{ asset('assets/js/custom/bymyself/admin/warga-lokal/add.js') }}"></script>
