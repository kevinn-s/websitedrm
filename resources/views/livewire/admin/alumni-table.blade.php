@php
    use Carbon\Carbon;
@endphp
<div>
    @csrf
    <section class="mt-10">

        <div class="max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white relative shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300="search" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div x-data="{
                        open: false,
                        selected:'Semua',
                        toggle: function(){
                            this.open = true;
                          
                        },
                        close: function(){
                            this.open = false;
                        }
                    }" class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                        <div >
                            @php
                                $buttons = [
                                    ['label' => 'Semua', 'action' => "\$set('status', null)"],
                                    ['label' => 'Rejected', 'action' => "\$set('status', " . json_encode(App\Models\Status::REJECTED->value) . ")"],
                                    ['label' => 'Pending', 'action' => "\$set('status', " . json_encode(App\Models\Status::PENDING->value) . ")"],
                                    ['label' => 'Verified', 'action' => "\$set('status', " . json_encode(App\Models\Status::VERIFIED->value) . ")"],
                                ];
                            @endphp
                            <button @click="toggle()" class="btn bg-gray-500 text-gray-100 hover:bg-gray-800">
                                <span class="max-xs:sr-only">Filter Status</span>
                            </button>
                            <x-dropdown-filter :buttons="$buttons"></x-dropdown-filter>

                        </div>

                        <button wire:click="callClearQuery" @click="selected = 'Semua'" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800">
                            <span class="max-xs:sr-only">Clear All Filters</span>

                        </button>

                        <!-- Datepicker built with flatpickr -->
                        <!-- <x-datepicker  /> -->
                        <!-- Add view button -->


                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-32">NIM</th>
                                <th scope="col" class="px-4 py-3 w-48">Nama Lengkap</th>
                                <th scope="col" class="px-4 py-3 w-60">Email</th>
                                <th scope="col" class="px-4 py-3 w-40">Tanggal Registrasi</th>
                                <th scope="col" class="px-4 py-3 w-24">Status</th>
                                <th scope="col" class="px-4 py-3 w-44">Alumni Terdaftar</th>
                                <th scope="col" class="px-4 py-3 w-32">
                                    <span>Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td colspan="7" class="text-center">


                                    <div role="status" wire:loading>
                                        <svg aria-hidden="true"
                                            class="w-8 h-8 my-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>


                                </td>
                            </tr>
                            @forelse ($alumni as $a)
                                <tr class="border-b" wire:loading.remove>
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $a->student_id }}
                                    </th>
                                    <td class="px-4 py-3 text-gray-900">{{ $a->name }}</td>
                                    <td class="px-4 py-3">{{ $a->email }}</td>
                                    <td class="px-4 py-3">{{ Carbon::parse($a->created_at)->format('d-m-Y')}}</td>
                                    <td class="px-4 py-3 font-bold text-gray-900">{{ $a->status}}</td>
                                    <td class="px-4 py-3 font-bold text-gray-900 uppercase">
                                        {{ $a->onOfficialAlumni ? 'Terdaftar' : 'Tidak Terdaftar'}}</td>
                                    <td class="px-4 py-3 flex items-center gap-2 w-32">

                                        <div x-data="{
                                                confirmOpen: false, 
                                                resetModal() {
                                                    this.confirmOpen = false;
                                                }
                                            }">
                                            <button
                                                class="px-1 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors"
                                                @click="confirmOpen = true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="#ffffff">
                                                    <g fill="#ffffff">
                                                        <path
                                                            d="M11.937 4.5H8.062A2.003 2.003 0 0 1 10 2a2.003 2.003 0 0 1 1.937 2.5Z" />
                                                        <path d="M4.5 5.5a1 1 0 0 1 0-2h11a1 1 0 1 1 0 2h-11Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 18.5a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1v10.5a1 1 0 0 0 1 1h9Zm-2-10a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7ZM10 8a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 1 0v-7A.5.5 0 0 0 10 8Zm-3.5.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7Z"
                                                            clip-rule="evenodd" />
                                                    </g>
                                                </svg>
                                            </button>
                                            <x-admin.modal-confirm :action="'delete'" :alumni="$a"></x-admin.modal-confirm>
                                        </div>
                                        @if ($a->status !== App\Models\Status::VERIFIED)

                                            <div class="">
                                                <x-admin.status-confirmation-modal
                                                    :alumni="$a"></x-admin.status-confirmation-modal>
                                                <x-admin.modal-error-message></x-admin.modal-error-message>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td wire:loading.remove colspan="7" class="px-4 py-3 text-center text-gray-500">
                                        Data Tidak Ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>





                    </table>
                </div>
            </div>
        </div>
    </section>

</div>