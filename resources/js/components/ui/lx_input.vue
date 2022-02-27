<template>
    <div class="form-floating mb-3">
        <input v-if="inputShow"
            class="form-control"
            :id="'form-'+name"
            :class="{'is-invalid': error.length}"
            :disabled="disabled"
            :required="required"
            :type="inputType"
            :placeholder="placeholder"
            v-model="val"
            @input="$emit('input', $event.target.value)"
            @blur="inputShow = !inputShow"
            autofocus
        >
        <div v-else
            @click="inputShow = !inputShow"
            class="form-control w-100 border-secondary border-bottom bg-transparent"
            :class="{
                'border-0': !inputShow,
                'is-invalid': error.length
            }"
        >
            {{ (this.inputType === 'password')?strReplace:val }}
        </div>
        <label :for="'form-'+name">{{placeholder}}</label>

        <div v-if="error.length" class="invalid-feedback">
            {{error}}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {type: [String,Number], default:null},
        name: {type: String, default:''},
        inputType: {type: String, default:'text'},
        placeholder: {type: String, default:'Введите значение'},
        required: {type: Boolean, default:false},
        disabled: {type: Boolean,default:false},
        error: {type:String,default:''}
    },
    data () {
        return{
            val: this.modelValue,
            inputShow: false,
        }
    },
    model: {
        prop: 'modelValue',
        event: 'input'
    },
    computed:{
        strReplace(){
            let reg = /\S/gi
            let pass = this.val ?? ''
            return pass.replace(reg,'*')
        }
    }
}
</script>

<style>

</style>
