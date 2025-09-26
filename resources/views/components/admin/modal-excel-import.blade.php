<div x-data="{ 
    uploadOpen: false, 
    isDragOver: false, 
    selectedFile: null, 
    fileName: '', 
    fileSize: '',
    uploadStatus: 'idle', // idle, uploading, success, error
    errorMessage: '',
    _token: document.head.querySelector('meta[name=csrf-token]').content,
    selectFile(event) {
        const file = event.target.files[0];
        this.handleFile(file);
    },
    
    handleFile(file) {
        if (!file) return;
        
        // Check if it's an Excel file
        const allowedTypes = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            '.xlsx',
            '.xls'
        ];
        
        const isExcel = allowedTypes.some(type => 
            file.type === type || file.name.toLowerCase().endsWith(type)
        );
        
        if (!isExcel) {
            this.errorMessage = 'Please select a valid Excel file (.xlsx or .xls)';
            this.uploadStatus = 'error';
            return;
        }
        
        this.selectedFile = file;
        this.fileName = file.name;
        this.fileSize = this.formatFileSize(file.size);
        this.uploadStatus = 'idle';
        this.errorMessage = '';
    },
    
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    },
    
    removeFile() {
        this.selectedFile = null;
        this.fileName = '';
        this.fileSize = '';
        this.uploadStatus = 'idle';
        this.errorMessage = '';
        this.$refs.fileInput.value = '';
    },
    
    async uploadFile() {
  if (!this.selectedFile) return;

  this.uploadStatus = 'uploading';

  // 1. Create a FormData object
  const formData = new FormData();
  
  // 2. Append the selected file to the FormData object
  // The 'excel' key should match the name the server is expecting for the file
  formData.append('file', this.selectedFile); 

  try {
    // 3. Construct the fetch request with the POST method and FormData body
    const response = await fetch('{{ route('admin.alumni.import') }}', {
      method: 'POST',
      headers: {
                'X-CSRF-TOKEN':this._token
                // don't set Content-Type when sending FormData; browser does it
            },
      body: formData,
    });
    
    // 4. Handle the response
    if (response.ok) {
      this.uploadStatus = 'success';
 
    } else {
      // Handle server-side errors
      this.uploadStatus = 'error';
      this.errorMessage = 'Upload failed. Please try again.';
      // Optionally, get a more specific error message from the server response
      // const errorData = await response.json();
      // this.errorMessage = errorData.message || 'Upload failed.';
    }
  } catch (error) {
    // Handle network errors (e.g., no internet, CORS issues)
    this.uploadStatus = 'error';
    this.errorMessage = 'A network error occurred. Check your connection.';
    console.error('Error uploading file:', error);
  }
},
    
    handleDrop(event) {
        event.preventDefault();
        this.isDragOver = false;
        
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            this.handleFile(files[0]);
        }
    },
    
    resetModal() {
        this.removeFile();
        this.uploadOpen = false;
    }
}">
    <!-- Button -->
    <button
        class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-2 font-medium transition-colors"
        @click="uploadOpen = true" aria-controls="upload-modal">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
        Upload Excel File
    </button>

    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-gray-900/50 z-50 transition-opacity" x-show="uploadOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>

    <!-- Modal dialog -->
    <div id="upload-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center px-4 sm:px-6"
        role="dialog" aria-modal="true" x-show="uploadOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white border border-transparent overflow-hidden max-w-lg w-full rounded-xl shadow-2xl"
            @click.outside="resetModal()" @keydown.escape.window="resetModal()">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Upload Excel File</h3>
                    <button @click="resetModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <!-- Upload Area -->
                <div class="border-2 border-dashed rounded-lg p-8 text-center transition-colors" :class="{
                        'border-blue-400 bg-blue-50': isDragOver,
                        'border-gray-300': !isDragOver && !selectedFile,
                        'border-green-400 bg-green-50': selectedFile && uploadStatus !== 'error',
                        'border-red-400 bg-red-50': uploadStatus === 'error'
                    }" @dragover.prevent="isDragOver = true" @dragleave.prevent="isDragOver = false"
                    @drop.prevent="handleDrop($event)">
                    <!-- No file selected -->
                    <div x-show="!selectedFile" class="space-y-4">
                        <div class="mx-auto w-16 h-16 text-gray-400">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-medium text-gray-900">Drop your Excel file here
                            </p>
                            <p class="text-gray-500">or click to browse</p>
                            <p class="text-sm text-gray-400 mt-2">Supports .xlsx and .xls files</p>
                        </div>
                        <input type="file"
                            accept=".xlsx,.xls,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            class="hidden" x-ref="fileInput" @change="selectFile($event)">
                        <button type="button" @click="$refs.fileInput.click()"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Choose File
                        </button>
                    </div>

                    <!-- File selected -->
                    <div x-show="selectedFile" class="space-y-4">
                        <div class="mx-auto w-16 h-16 text-green-500">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900" x-text="fileName"></p>
                            <p class="text-sm text-gray-500" x-text="fileSize"></p>
                        </div>
                        <div class="flex gap-2 justify-center">
                            <button @click="removeFile()"
                                class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800 transition-colors">
                                Remove
                            </button>
                            <button @click="$refs.fileInput.click()"
                                class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 transition-colors">
                                Change
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div x-show="uploadStatus === 'error'"
                    class="mt-4 p-3 bg-red-100 border border-red-200 rounded-lg">
                    <p class="text-red-800 text-sm" x-text="errorMessage"></p>
                </div>

                <!-- Success Message -->
                <div x-show="uploadStatus === 'success'"
                    class="mt-4 p-3 bg-green-100 border border-green-200 rounded-lg">
                    <p class="text-green-800 text-sm">File uploaded successfully!</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
    <button @click="resetModal()"
        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
        x-show="uploadStatus !== 'success'">
        Cancel
    </button>
    
    <!-- Upload/Close Button -->
    <button 
        @click="uploadStatus === 'success' ? resetModal() : uploadFile()" 
        :disabled="!selectedFile || uploadStatus === 'uploading'"
        class="px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2"
        :class="{
            'bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white': uploadStatus !== 'success',
            'bg-green-600 hover:bg-green-700 text-white': uploadStatus === 'success'
        }">
        
        <!-- Loading spinner -->
        <svg x-show="uploadStatus === 'uploading'" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        
        <!-- Success icon -->
        <svg x-show="uploadStatus === 'success'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        
        <!-- Button text -->
        <span x-text="
            uploadStatus === 'uploading' ? 'Uploading...' : 
            uploadStatus === 'success' ? 'Close' : 
            'Upload'
        "></span>
    </button>
</div>
        </div>
    </div>
</div>