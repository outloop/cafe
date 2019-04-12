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
                        <span class="validation" v-show="$v.name.$dirty && !$v.name.required">名称错误</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>网址
                            <input type="text" placeholder="网址" v-model="$v.website.$model">
                        </label>
                        <span class="validation" v-show="$v.website.$dirty && (!$v.website.required || !$v.website.url)">网址错误</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>简介
                            <input type="text" placeholder="简介" v-model="$v.description.$model">
                        </label>
                    </div>
                </div>
                <div class="grid-x grid-padding-x" v-for="(location, key) in $v.locations.$each.$iter">
                    <div class="large-12 medium-12 small-12 cell">
                        <h3>位置</h3>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>位置名称
                            <input type="text" placeholder="位置名称" v-model="location.name.$model">
                        </label>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>详细地址
                            <input type="text" placeholder="详细地址" v-model="location.address.$model">
                        </label>
                        <span class="validation" v-show="location.address.$dirty && !location.address.required">地址错误</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>城市
                            <input type="text" placeholder="城市" v-model="location.city.$model">
                        </label>
                        <span class="validation" v-show="location.city.$dirty && !location.city.required">城市错误</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>省份
                            <input type="text" placeholder="省份" v-model="location.state.$model">
                        </label>
                        <span class="validation" v-show="location.state.$dirty && !location.state.required">省份错误</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>邮编
                            <input type="text" placeholder="邮编" v-model="location.zip.$model">
                        </label>
                        <span class="validation" v-show="location.zip.$dirty && !location.zip.required">邮编错误</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>支持的冲泡方法</label>
                        <span class="brew-method" v-for="brewMethod in brewMethods">
                        <input v-bind:id="'brew-method-'+brewMethod.id+'-'+key" type="checkbox"
                               v-bind:value="brewMethod.id"
                               v-model="location.methodsAvailable.$model">
                        <label v-bind:for="'brew-method-'+brewMethod.id+'-'+key">{{ brewMethod.method }}</label>
                    </span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <tags-input v-bind:unique="key"></tags-input>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="removeLocation(key)">移除位置</a>
                    </div>
                </div>
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="addLocation()">新增位置</a>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="submitNewCafe()">提交表单</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {required, maxLength, url} from 'vuelidate/lib/validators'
    import TagsInput from '../components/global/forms/TagsInput'
    import { EventBus } from '../event-bus.js';

    export default {
        created(){
            this.$store.dispatch('loadBrewMethods');
        },
        data() {
            return {
                name: '',
                locations: [],
                website: '',
                description: '',
                roaster: false,
            }
        },
        validations: {
            name: {
                required,
                maxLength: maxLength(10)
            },
            website: {
                required,
                url
            },
            description: {

            },
            roaster: {
                required
            },
            locations: {
                required,
                $each: {
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
                    },
                    name: {},
                    methodsAvailable: {},
                    tags:{}
                }
            }
        },
        methods: {
            submitNewCafe: function () {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.$store.dispatch('addCafe', {
                        name: this.name,
                        locations: this.locations,
                        website: this.website,
                        description: this.description,
                        roaster: this.roaster
                    });
                }
            },
            removeLocation(key) {
                this.locations.splice(key, 1);
                EventBus.$emit('clear-tags');
            },
            addLocation() {
                this.locations.push({name: '', address: '', city: '', state: '', zip: '', methodsAvailable: []});
            }
        },
        computed: {
            brewMethods() {
                return this.$store.getters.getBrewMethods;
            }
        },
        components:{
            TagsInput
        },
        mounted() {
            EventBus.$on('tags-edited', function (tagsAdded) {
                this.locations[tagsAdded.unique].tags = tagsAdded.tags;
            }.bind(this));
        },
    }
</script>
