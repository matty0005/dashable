<template>
    <div>
        <div class="flex">
            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{ label }}</label>
            <span class="ml-1 text-sm text-red-400" id="email-optional" v-if="required">*</span>
        </div>
        <label v-if="hint != ''" for="email" class="block text-sm font-medium leading-5 text-gray-400">{{ hint }}</label>
        <label v-if="phone" for="email" class="block text-sm font-medium leading-5 text-gray-400">Must be in international format with area code</label>

        <div class="mt-1 relative rounded-md shadow-sm">
            <div v-if="price" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">
                    $
                </span>
            </div>
            <input @blur="blur" :type="getType" v-model="inputVal" :disabled="disabled" :class="''.concat(disabled ?'bg-gray-200':'').concat(error ? 'border-red-400 border-2 focus:border-red-600':'').concat(price ? 'pl-7 pr-12':'')" class="form-input rounded-md border-gray-200 focus:ring-gray-100 focus:border-none block w-full sm:text-sm sm:leading-5" :placeholder="placeholder">
            <div v-if="price || time" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm" id="price-currency">
                    {{ time ? 'Min' : 'AUD'}}
                </span>
            </div>
        </div>
        <div class="m-1 text-gray-400 text-sm" v-if="characterCount != 0">{{inputVal.length}}/{{ characterCount }}</div>
        <div class="m-1 text-red-400 text-sm" v-if="error">{{ error }}</div>

    </div>
</template>

<script>
export default {
    props: {
        placeholder: String, 
        label: String,
        modelValue: String,
        hint: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        error: {
            type: Object,
            default: null
        },
        disabled: {
            type: Boolean,
            default: false
        },
        password: {
            type: Boolean,
            default: false
        },
        number: {
            type: Boolean,
            default: false
        },
        price: {
            type: Boolean,
            default: false
        },
        time: {
            type: Boolean,
            default: false
        },
        characterCount: {
            type: Number,
            default: 0
        },
        help: {
            type: String, 
            default: ""
        },
        phone: {
            type: Boolean,
            default: false
        }
    },
    emits: ['update:modelValue'],
    computed: {
        getType() {
            if (this.password) {
                return 'password'
            }
            // if (this.number) {
            //     return 'number'
            // }
            return 'text'
        },
        blur () {
            this.$emit('onBlur')
        },
        inputVal: {
            get () {
                return this.modelValue
            },
            set (val) {
                // Strip out all non numeric digits if a number type
                if (this.number) {
                    val = val.replace(/[^\d.]/g,'');
                }
                this.$emit('update:modelValue', val.trim())
            }
        }
    }
}
</script>

<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>