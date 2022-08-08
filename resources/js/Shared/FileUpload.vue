

<template>
    
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Upload photo</label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
        <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" @dragover.prevent="onDragOver" @drop.prevent="onDrop" @dragleave.prevent="onDragLeave">
            <div class="space-y-1 text-center">
            <svg v-if="!newUpload" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <img v-if="newUpload" class="max-w-48 max-h-48 mx-auto mb-5" :src="newUpload" />

                <div class="flex text-sm text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">

                    <span>Upload an image</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only" @input="file = $event.target.files[0]" @change="onFileChange($event, false)"/>
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
            <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
            </div>
        </div>
        </div>
    </div>


</template>

<script>


export default {
    data: () => {
        return {
            city: "",
            dropOverColor: "",
            file: null,
            newUpload: null
        }
    },
    props: {
        currentCity: String,
        maxFilesize: {
            type: Number, 
            default: 10000
        }
    },

    methods: {

        onDragOver() {
            this.dropOverColor = 'bg-gray-100'
        },
        onDragLeave() {
            this.dropOverColor = ''
        },
        onDrop(event) {

            if (event.dataTransfer.items) {

            
                this.dropOverColor = ''
                
                this.file = event.dataTransfer.items[0].getAsFile()

                if (this.validateFile(this.file)){
                    return false
                }

                this.onFileChange(event, true)   
            } 
        },

        onFileChange(event, isDrop) {
            let file = null

            if (isDrop) {

                file = event.dataTransfer.items[0].getAsFile()
            } else {
                file = event.target.files[0];

                if (this.validateFile(this.file)){
                    return false
                }
            }

            this.newUpload = URL.createObjectURL(file)
            this.$emit('file', this.file)
            
        },

        validateFile(file){

            let fileTypes = ['png', 'jpg']

            if (!fileTypes.includes(file.type)){
                this.showProgress = false;
                this.$emit('error', 'File Type not Allowed!')
                return false
            }

            if (file.size > this.maxFilesize){
                return false
            }

            return true
        },
    }
}
</script>