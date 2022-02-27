<template>
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-fill p-2">
            <lx-input
                v-model="address.address"
                placeholder="Адрес:"
                name="address"
                :error="error['address']"
            ></lx-input>
        </div>
        <div class="d-flex">
            <div class="form-check form-switch fs-2">
                <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="address.main"
                    title="Основной"
                    @change="$emit('mainAddress', address)"
                >
            </div>
            <button
                class="btn border-0"
                title="Удалить адрес"
                @click="$emit('removeAddress', address)"
            >
                <i class="far text-danger fs-2 fa-times-circle"></i>
            </button>
        </div>
    </div>
</template>

<script>
import LxInput from './lx_input'
export default {
    props:{
        maddress: {type:Object, default:null},
        merror: {type:String, default:''}
    },
    data () {
        return{
            address: this.maddress,
            error: this.merror,
        }
    },
    model:{
        prop: ['maddress', 'merror'],
    },
    components:{LxInput},
}
</script>

<style>

</style>
