<style>

</style>

<template>
    <div class="page">
        <form>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <label>名称
                            <input type="text" placeholder="咖啡店名" v-model="$v.name.$model">
                        </label>
                        <span class="validation" v-if="$v.name.$dirty && !$v.name.required">咖啡店名错误</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>地址
                            <input type="text" placeholder="地址" v-model="$v.address.$model">
                        </label>
                        <span class="validation" v-if="$v.address.$dirty && !$v.address.required">地址错误</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>城市
                            <input type="text" placeholder="城市" v-model="$v.city.$model">
                        </label>
                        <span class="validation" v-if="$v.city.$dirty && !$v.city.required">城市错误</span>

                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>省份
                            <input type="text" placeholder="省份" v-model="$v.state.$model">
                        </label>
                        <span class="validation" v-if="$v.state.$dirty && !$v.state.required">省份错误</span>

                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>邮编
                            <input type="text" placeholder="邮编" v-model="$v.zip.$model">
                        </label>
                        <span class="validation" v-if="$v.zip.$dirty && !$v.zip.required">邮编错误</span>

                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="submitNewCafe()">提交</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {required, maxLength} from 'vuelidate/lib/validators'
    export default {
        data() {
            return {
                name: '',
                address: '',
                city: '',
                state: '',
                zip: ''
            }
        },
        validations: {
            name: {
              required,
              maxLength: maxLength(10)
            },
            address: {
                  required
            },
            city: {
                required
            },
            state: {
                required
            },
            zip: {
                required
            }
        },
        methods: {
            submitNewCafe: function () {
                this.$v.$touch();
                console.log(this.$v);
                if (!this.$v.$invalid) {
                    this.$store.dispatch('addCafe', {
                        name: this.name,
                        address: this.address,
                        city: this.city,
                        state: this.state,
                        zip: this.zip
                    });
                }
            }
        }
    }
</script>
