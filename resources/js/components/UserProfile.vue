<template>
    <div>
        <div v-if="profileSave" class="alert alert-success" role="alert">
            Данные успешно сохранены.
        </div>
        <div class="mb-3">
            <div class="row align-items-center">
                <div class="col-3 text-center">
                    <img class="rounded" :src="`/images/users/${user.avatar}`" alt="Аватар пользователя" style="height: 12em;">
                </div>
                <div class="col-9">
                    <input class="form-control form-control-lg align-self-center"
                        :class="{'is-invalid': errors['avatar']}"
                        type="file"
                        ref="file"
                        @change="handleFileUpload"
                        >
                    <div v-if="errors['avatar']" class="invalid-feedback">
                        {{errors.avatar}}
                    </div>
                </div>
            </div>
        </div>
        <lx-input
            v-model="user.name"
            placeholder="Имя"
            name="name"
            :error="errors['name']"
        ></lx-input>
        <lx-input
            v-model="user.email"
            input-type="email"
            placeholder="Электронная почта"
            name="email"
            :error="errors['email']"
        ></lx-input>
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses" type="button" role="tab" aria-controls="addresses" aria-selected="true">Адреса</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pass-tab" data-bs-toggle="tab" data-bs-target="#pass" type="button" role="tab" aria-controls="pass" aria-selected="false">Сменить пароль</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-3 p-2" id="addresses" role="tabpanel" aria-labelledby="home-tab">
                <h3>Список адресов {{user.addresses.length?':':'пуст !'}}
                    <button class="btn btn-outline-warning float-end" @click="addAddress">Добавить адрес</button>
                </h3>
                <address-line
                    v-for="(address,idx) in user.addresses"
                    :key="address.id"
                    :maddress="address"
                    :merror="errors[`addresses.${idx}.address`]"
                    @removeAddress="removeAddress"
                    @mainAddress="mainAddress"
                >
                </address-line>
            </div>
            <div class="tab-pane fade mt-3 p-2" id="pass" role="tabpanel" aria-labelledby="profile-tab">
                <lx-input
                    v-model="current_password"
                    input-type="password"
                    placeholder="Текущий пароль"
                    name="current_password"
                    :error="errors['current_password']"
                ></lx-input>
                <lx-input
                    v-model="password"
                    input-type="password"
                    placeholder="Новый пароль"
                    name="password"
                    :error="errors['password']"
                ></lx-input>
                <lx-input
                    v-model="password_confirmation"
                    input-type="password"
                    placeholder="Подтверждение пароля"
                    name="password_confirmation"
                ></lx-input>
            </div>
        </div>

        <button
            v-if='equal'
            class="btn btn-success mt-3 w-100"
            @click="submitUser"
        >Сохранить</button>
        <button
            v-else
            class="btn btn-outline-success mt-3 w-100"
            disabled
        >Сохранить</button>
    </div>
</template>

<script>
import LxInput from './ui/lx_input'
import AddressLine from './ui/address_line'
export default {
    props:{
        muser: {type: Object, default:null}
    },
    data(){
        return {
            user: this.muser,
            file: '',
            password: null,
            current_password: null,
            password_confirmation:null,
            errors: {},
            startUser: JSON.parse(JSON.stringify(this.muser)),
            profileSave: false,
        }
    },
    components:{LxInput,AddressLine},
    computed: {
        equal:function(){
            return !_.isEqual(this.user,this.startUser) || (this.password && this.current_password && this.password_confirmation && this.password === this.password_confirmation) || this.file
        }
    },
    methods:{
        submitUser(){
            let fData = new FormData()
            fData.append('_method', 'PUT')

            for(let idx in this.user){
                if(!_.isEqual(this.user[idx],this.startUser[idx])){
                    if(idx == 'addresses') {
                        fData.append(idx, JSON.stringify(this.user[idx]))
                    } else fData.append(idx, this.user[idx])
                }
            }
            if(this.password && this.current_password && this.password_confirmation && this.password === this.password_confirmation){
                fData.append('current_password', this.current_password)
                fData.append('password', this.password)
                fData.append('password_confirmation', this.password_confirmation)
            }
            if(this.file) fData.append('avatar', this.file)

            axios.post(`/profile/${this.user.id}`,
                    fData,
                    {
                        headers: {"Content-Type": "multipart/form-data"}
                    }
                )
                .then(response => {
                    this.profileSave = true;
                    this.$refs.file.value=null;
                    this.user.avatar = response.data.avatar
                    this.startUser = JSON.parse(JSON.stringify(this.user))
                    this.password = ''
                    this.current_password = ''
                    this.password_confirmation = ''
                    this.errors = {}
                    setTimeout(()=>{this.profileSave = false},2000)
                })
                .catch(error => {
                    let err = error.response.data.errors
                    for(let idx in err){
                        this.errors[idx] = err[idx].join('; ')
                    }
                    this.errors = {...this.errors}
                })
                .finally(() => {})
        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0]
        },
        removeAddress(add){
            this.user.addresses = this.user.addresses.filter(address => !_.isEqual(address,add))
            if(add.main && this.user.addresses.length > 0) this.user.addresses[0].main = true
        },
        mainAddress(main_add){
            if(main_add.main) {
                this.user.addresses.forEach(address => {
                    if(!_.isEqual(main_add, address)) address.main = false
                })
            } else {
                this.user.addresses[0].main = true
            }
        },
        addAddress(){
            this.user.addresses.push({
                id: null,
                address: '',
                main: false,
                user_id: this.user.id,
            })
        }
    },
}
</script>

<style>

</style>
