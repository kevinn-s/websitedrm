<x-app-layout>
<div class="">

        <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'AD/ART Asosiasi Alumni DRM', 'url' => route('ad-art-asosiasi')],
        ]" />
        <div>
            <div class="flex flex-col mb-4 justify-center">
                <!-- Icon -->
                <div class="w-10 h-10 mb-2" 
                style="
                    background-image: url('{{ url('/images/page_icon.webp') }}');
                    background-size: cover;
                    background-position: -40px 0px;
                    background-repeat: no-repeat;
                ">
                </div>

                <!-- Title -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[24px] md:text-[36px] text-[#03563D]">
                    Rekening Asosiasi Alumni DRM
                </h2>

                <!-- Description -->
                <!-- <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b text-center">
                                    Dokumen resmi Rekening Asosiasi Alumni DRM BINUS University
                                </p> -->

                <!-- Bank Account Information Section -->
                <div class="w-full max-w-full md:max-w-[50%] mt-4">
                    <!-- Bank Information Fields -->
                    <div class="flex flex-col space-y-4 mb-16 ">
                        <!-- Bank Name -->
                        <div class="flex flex-col">
                            <label class="text-sm text-gray-600 mb-1">Nama Bank</label>
                            <div class="flex items-center">
                                <div class="flex-grow bg-gray-200 rounded-lg p-3 text-gray-800 font-bold">
                                    Bank BCA
                                </div>
                                <button class="ml-2 p-2 bg-amber-100 rounded-lg hover:bg-amber-200 transition"
                                    onclick="copyToClipboard('Bank Mandiri')" title="Copy to clipboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm text-gray-600 mb-1">Nomor Rekening</label>
                            <div class="flex items-center">
                                <div class="flex-grow bg-gray-200 rounded-lg p-3 text-gray-800 font-bold">
                                    594-188-8811
                                </div>
                                <button class="ml-2 p-2 bg-amber-100 rounded-lg hover:bg-amber-200 transition"
                                    onclick="copyToClipboard('594188811')" title="Copy to clipboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm text-gray-600 mb-1">Nama Rekening</label>
                            <div class="flex items-center">
                                <div class="flex-grow font-bold bg-gray-200 rounded-lg p-3 text-gray-800">
                                    PERKUMPULAN ALUMNI DOKTOR RISET MANAJEMEN
                                </div>
                                <button class="ml-2 p-2 bg-amber-100 rounded-lg hover:bg-amber-200 transition"
                                    onclick="copyToClipboard('Asosiasi Alumni DRM Binus University')"
                                    title="Copy to clipboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm text-gray-600 mb-1">Nama Cabang</label>
                            <div class="flex items-center">
                                <div class="flex-grow bg-gray-200 rounded-lg p-3 text-gray-800 font-bold">
                                    Cabang Cipondoh
                                </div>
                                <button class="ml-2 p-2 bg-amber-100 rounded-lg hover:bg-amber-200 transition"
                                    onclick="copyToClipboard('Cabang Cipondoh')" title="Copy to clipboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <h2 class="text-[20px] md:text-[30px] font-bold tracking-[-1px]">
                            <span class="text-[#03563D]">Iuran</span> Alumni
                        </h2>
                        <div class="mt-4 text-[14px] md:text-[16px] flex flex-col gap-4 mb-8 border-b border-gray-300 pb-4">
                            <p>
                                Anda dapat berpartisipasi dalam iuran alumni untuk mendukung terlaksananya berbagai program dan kegiatan, sebagai wujud komitmen terhadap pengembangan serta keberlanjutan organisasi.
                            </p>
                            <p>
                                Anda dapat berkontribusi secara bulanan maupun tahunan sesuai dengan keinginan Anda. Setiap kontribusi yang Anda berikan akan sangat berarti bagi kemajuan dan keberlanjutan Asosiasi Alumni DRM.
                            </p>
                        </div>
                        <form 
                            action=""
                            method="POST"
                            enctype="multipart/form-data"
                            x-data="{
                                    message: '',
                                    state: {
                                        validasi_nominal_iuran: ''
                                    },
                                    nama_lengkap: '',
                                    nim: '',
                                    jenis_iuran: '',
                                    nominal_iuran: '',
                                    upload_bukti: null,
                                    isSubmitting: false,
                                    
                                    formatCurrency(value) {
                                        return new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0
                                        }).format(value);
                                    },
                                    
                                    // Validation function
                                    cek_nominal_iuran(iuran) {
                                        this.state.validasi_nominal_iuran = '';
                                        this.message = '';
                                        
                                        const nominal = parseInt(iuran.toString().replace(/[^\d]/g, '')) || 0;
                                        
                                        if (nominal === 0) {
                                            this.state.validasi_nominal_iuran = 'danger';
                                            this.message = 'Nominal iuran tidak boleh kosong';
                                            return;
                                        }
                                        
                                        if (this.jenis_iuran === 'BULANAN') {
                                            if (nominal < 10000) {
                                                this.state.validasi_nominal_iuran = 'warning';
                                                this.message = 'Nominal iuran bulanan minimal adalah ' + this.formatCurrency(10000);
                                            } else {
                                                this.state.validasi_nominal_iuran = 'success';
                                                this.message = 'Nominal iuran valid';
                                            }
                                        } else if (this.jenis_iuran === 'TAHUNAN') {
                                            if (nominal < 100000) {
                                                this.state.validasi_nominal_iuran = 'warning';
                                                this.message = 'Nominal iuran tahunan minimal adalah ' + this.formatCurrency(100000);
                                            } else {
                                                this.state.validasi_nominal_iuran = 'success';
                                                this.message = 'Nominal iuran valid';
                                            }
                                        }
                                    },
                                    
                                    // Format input as currency
                                    formatInput() {
                                        let value = this.nominal_iuran.replace(/[^\d]/g, '');
                                        if (value) {
                                            this.nominal_iuran = parseInt(value).toLocaleString('id-ID');
                                        }
                                    },
                                    
                                    // Submit form
                                    submitForm() {
                                        if (!this.nama_lengkap || !this.jenis_iuran || !this.nominal_iuran) {
                                            alert('Mohon lengkapi semua field yang diperlukan');
                                            return;
                                        }
                                        
                                        if (this.state.validasi_nominal_iuran === 'warning' || this.state.validasi_nominal_iuran === 'danger') {
                                            alert('Mohon perbaiki nominal iuran terlebih dahulu');
                                            return;
                                        }
                                        
                                        if (!this.upload_bukti) {
                                            alert('Mohon upload bukti transfer');
                                            return;
                                        }
                                        
                                        this.isSubmitting = true;
                                        $refs.submitForm.submit();
                                    }
                                }" x-ref="submitForm">
                            <div class="max-w-full md:max-w-md mt-4">
                                @csrf
                                
                                <!-- Display Success/Error Messages -->
                                @if(session('success'))
                                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                
                                @if($errors->any())
                                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                                        <ul class="list-disc list-inside">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <!-- Nama Lengkap -->
                                <div class="mb-4">
                                    <label class="mb-2 text-slate-900 font-medium text-base block">Nama Lengkap</label>
                                    <input 
                                        type="text" 
                                        name="nama_lengkap"
                                        x-model="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}"
                                        placeholder="Silahkan masukkan nama lengkap anda"
                                        class="px-4 py-2 text-base rounded-md bg-white border border-gray-500 w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                                        required
                                    />
                                </div>
                                
                                <!-- NIM (Optional) -->
                                <div class="mb-4">
                                    <label class="mb-2 text-slate-900 font-medium text-base block">NIM (Opsional)</label>
                                    <input 
                                        type="text" 
                                        name="nim"
                                        x-model="nim"
                                        value="{{ old('nim') }}"
                                        placeholder="Nomor Induk Mahasiswa (opsional)"
                                        class="px-4 py-2 text-base rounded-md bg-white border border-gray-500 w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    />
                                </div>
                                
                                <!-- Jenis Iuran -->
                                <div class="mb-4">
                                    <label class="mb-2 text-slate-900 font-medium text-base block">Pilih Jenis Iuran</label>
                                    <select 
                                        name="jenis_iuran"
                                        x-model="jenis_iuran"
                                        @change="cek_nominal_iuran(nominal_iuran)"
                                        class="bg-gray-50 border border-gray-500 rounded block w-full p-2.5 text-slate-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                        required
                                    >
                                        <option value="" disabled>Silahkan pilih Jenis iuran</option>
                                        <option value="BULANAN" {{ old('jenis_iuran') == 'BULANAN' ? 'selected' : '' }}>Bulanan</option>
                                        <option value="TAHUNAN" {{ old('jenis_iuran') == 'TAHUNAN' ? 'selected' : '' }}>Tahunan</option>
                                    </select>
                                </div>

                                <!-- Nominal Iuran -->
                                <div class="mb-4">
                                    <label class="mb-2 text-slate-900 font-medium text-base block">Nominal Iuran</label>
                                    <input 
                                        type="text" 
                                        name="nominal_iuran"
                                        x-model="nominal_iuran"
                                        value="{{ old('nominal_iuran') }}"
                                        @input="formatInput(); cek_nominal_iuran(nominal_iuran)" 
                                        placeholder="Masukkan nominal iuran"
                                        class="px-4 py-2 text-base rounded-md bg-white border border-gray-500 w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                        :aria-describedby="state.validasi_nominal_iuran ? 'validation-message' : null" 
                                        aria-invalid="false"
                                        required
                                    />
                                    
                                    <!-- Validation Message -->
                                    <div
                                        x-show="state.validasi_nominal_iuran"
                                        x-transition
                                        :class="'rvt-inline-alert rvt-inline-alert--' + state.validasi_nominal_iuran"
                                        role="status" 
                                        aria-live="polite"
                                        id="validation-message"
                                        class="mt-2"
                                    >
                                        <span class="rvt-inline-alert__icon">
                                            <template x-if="state.validasi_nominal_iuran === 'success'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M7 11.414 11.914 6.5 10.5 5.086 7 8.586l-1.5-1.5L4.086 8.5 7 11.414Z"/>
                                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2 8a6 6 0 1 1 12 0A6 6 0 0 1 2 8Z"/>
                                                </svg>
                                            </template>
                                            <template x-if="state.validasi_nominal_iuran === 'warning'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 7H4v2h8V7Z"/>
                                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2 8a6 6 0 1 1 12 0A6 6 0 0 1 2 8Z"/>
                                                </svg>
                                            </template>
                                            <template x-if="state.validasi_nominal_iuran === 'danger'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="m8 6.586-2-2L4.586 6l2 2-2 2L6 11.414l2-2 2 2L11.414 10l-2-2 2-2L10 4.586l-2 2Z"/>
                                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2 8a6 6 0 1 1 12 0A6 6 0 0 1 2 8Z"/>
                                                </svg>
                                            </template>
                                            <template x-if="state.validasi_nominal_iuran === 'info'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M9 7v5H7V7h2ZM8 4a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z"/>
                                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6a6 6 0 1 0 0 12A6 6 0 0 0 8 2Z"/>
                                                </svg>
                                            </template>
                                        </span>
                                        <span class="rvt-inline-alert__message" x-text="message"></span>
                                    </div>
                                </div>

                                <!-- Upload File -->
                                <div class="mb-6">
                                    <label class="text-base text-slate-900 font-medium mb-3 block">Upload Bukti Pembayaran</label>
                                    <input 
                                        type="file"
                                        name="bukti_transfer"
                                        x-model="upload_bukti"
                                        accept="image/png,image/jpg,image/jpeg,image/svg+xml,image/webp,image/gif"
                                        class="w-full text-slate-500 font-medium text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-slate-500 rounded focus:border-blue-500" 
                                        required
                                    />
                                    <p class="text-xs text-slate-500 mt-2">PNG, JPG, SVG, WEBP, dan GIF diperbolehkan. Maksimal 5MB.</p>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit"
                                    :disabled="isSubmitting"
                                    :class="isSubmitting ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700'"
                                    class="w-full text-white font-medium py-2 px-4 rounded-md transition duration-200"
                                >
                                    <span x-show="!isSubmitting">Submit</span>
                                    <span x-show="isSubmitting">Mengirim...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function () {
                const notification = document.createElement('div');
                notification.textContent = 'Copied to clipboard!';
                notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transition-opacity duration-300';
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 2000);
            });
        }
    </script>
</x-app-layout>