<template>
    <div class="box">
        <div class="message is-danger" v-if="errorMessage">
            <div class="message-body">{{ errorMessage }}</div>
        </div>
        <div class="field">
            <label class="label">
                {{ interfaceMessages['registration_page.form_username_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('username')"
                    type="text"
                    v-model="userModel.username"
                    :placeholder="interfaceMessages['registration_page.form_username_placeholder']"
                >
                <p v-if="$v.userModel.username.$error && !$v.userModel.username.required" class="help is-danger">
                    {{ interfaceMessages['form_error.required_field'] }}
                </p>
                <p v-if="!$v.userModel.username.engCharsNumbersAndPunctuation" class="help is-danger">
                    {{ interfaceMessages['form_error.eng_chars_number_and_punct'] }}
                </p>
                <p v-if="!$v.userModel.username.minLength" class="help is-danger">
                    {{ interfaceMessages['form_error.min_length'] }}: 2
                </p>
                <p v-if="!$v.userModel.username.maxLength" class="help is-danger">
                    {{ interfaceMessages['form_error.max_length']}}: 50
                </p>
            </div>
        </div>

        <div class="field">
            <label class="label">
                {{ interfaceMessages['registration_page.form_password_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('password')"
                    type="password"
                    v-model="userModel.password"
                    :placeholder="interfaceMessages['registration_page.form_password_placeholder']"
                >
                <p v-if="$v.userModel.password.$error && !$v.userModel.password.required" class="help is-danger">
                    {{ interfaceMessages['form_error.required_field'] }}
                </p>
                <p v-if="!$v.userModel.password.engCharsNumbersAndPunctuation" class="help is-danger">
                    {{ interfaceMessages['form_error.eng_chars_number_and_punct'] }}
                </p>
                <p v-if="!$v.userModel.password.minLength" class="help is-danger">
                    {{ interfaceMessages['form_error.min_length']}}: 6
                </p>
                <p v-if="!$v.userModel.password.maxLength" class="help is-danger">
                    {{ interfaceMessages['form_error.max_length']}}: 30
                </p>
            </div>
        </div>

        <div class="field">
            <label class="label">
                {{ interfaceMessages['registration_page.form_email_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('email')"
                    type="text"
                    v-model="userModel.email"
                    :placeholder="interfaceMessages['registration_page.form_email_placeholder']"
                >
                <p v-if="$v.userModel.email.$error && !$v.userModel.email.required" class="help is-danger">
                    {{ interfaceMessages['form_error.required_field'] }}
                </p>
                <p v-if="$v.userModel.email.$error && !$v.userModel.email.emailCheck" class="help is-danger">
                    {{ interfaceMessages['form_error.incorrect_email']}}
                </p>
                <p v-if="!$v.userModel.email.minLength" class="help is-danger">
                    {{ interfaceMessages['form_error.min_length']}}: 6
                </p>
                <p v-if="!$v.userModel.email.maxLength" class="help is-danger">
                    {{ interfaceMessages['form_error.max_length']}}: 30
                </p>
            </div>
        </div>

        <div class="field">
            <label class="label">
                {{ interfaceMessages['registration_page.form_full_name_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('fullname')"
                    type="text"
                    v-model="userModel.fullname"
                    :placeholder="interfaceMessages['registration_page.form_full_name_placeholder']"
                >
                <p v-if="$v.userModel.fullname.$error && !$v.userModel.fullname.required" class="help is-danger">
                    {{ interfaceMessages['form_error.required_field'] }}
                </p>
                <p v-if="!$v.userModel.fullname.ruDashSpace" class="help is-danger">
                    {{ interfaceMessages['form_error.only_cyrillic_dash_space'] }}
                </p>
                <p v-if="!$v.userModel.fullname.minLength" class="help is-danger">
                    {{ interfaceMessages['form_error.min_length']}}: 2
                </p>
                <p v-if="!$v.userModel.fullname.maxLength" class="help is-danger">
                    {{ interfaceMessages['form_error.max_length']}}: 100
                </p>
            </div>
        </div>

        <div class="field">
            <div v-if="!userModel.avatar">
                <vue-clip
                        :options="clipOptions"
                        :on-complete="complete"
                        >
                    <template slot="clip-uploader-action">
                        <div class="uploader-action" style="padding: 50px; color: grey;">
                            <p class="dz-message">
                                {{ interfaceMessages['registration_page.form_image_plugin_placeholder'] }}
                            </p>
                        </div>
                    </template>
                </vue-clip>
            </div>
            <div v-else class="second-stage__files-area">
                <img :src=userModel.avatar style="width: 200px;">
                <button @click="deleteDoc()">X</button>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" v-model="isAgreeWithTerms">
                    {{ interfaceMessages['registration_page.form_agree_with_terms'] }}
                </label>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" v-on:click="submit()" :disabled="isDisabledSubmit">
                    {{ interfaceMessages['form_button.submit'] }}
                </button>
            </div>
            <div class="control">
                <a href="">
                    <button class="button is-link is-light">
                        {{ interfaceMessages['form_button.cancel'] }}
                    </button>
                </a>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import { required, minLength, maxLength } from 'vuelidate/lib/validators';
    import engCharsNumbersAndPunctuation from "../vue/validators/engCharsNumbersAndPunctuation";
    import ruDashSpace from "../vue/validators/ruDashSpace";
    import emailCheck from "../vue/validators/emailCheck";
 
    export default {
        name: "app-reg-form",
        data: function () {
            return {
                userModel: userModel,
                interfaceMessages: interfaceMessages,
                url: {
                    createUser: urlCreateUser,
                    loginPage: urlLoginPage
                },
                clipOptions: {
                    url: urlSaveFile,
                    maxFiles: {
                        limit: 1,
                        message: 'Можно загрузить только один файл'
                    },
                    acceptedFiles: {
                        extensions: ['image/png, image/jpg, image/jpeg, image/gif'],
                        message: 'Неверный формат файла!'
                    },
                    maxFilesize: 5
                },
                isAgreeWithTerms: false,
                errorMessage: null
            }
        },
        validations: {
            userModel: {
                username: {
                    required,
                    engCharsNumbersAndPunctuation,
                    minLength: minLength(2),
                    maxLength: maxLength(30)
                },
                password: {
                    required,
                    engCharsNumbersAndPunctuation,
                    minLength: minLength(6),
                    maxLength: maxLength(30)
                },
                email: {
                    required,
                    emailCheck,
                    minLength: minLength(6),
                    maxLength: maxLength(30)
                },
                fullname: {
                    required,
                    ruDashSpace,
                    minLength: minLength(2),
                    maxLength: maxLength(100)
                }
            },
        },
        methods: {
            complete: function(file, status, xhr) {
                if (status === 'success') {
                    const res = JSON.parse(xhr.response);
                    this.userModel.avatar = res.filePath;
                }
            },
            deleteDoc: function () {
                this.userModel.avatar = null
            },
            submit: function() {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    var data = new FormData();
                    data.append("username", this.userModel.username);
                    data.append("password", this.userModel.password);
                    data.append("email", this.userModel.email);
                    data.append("fullname", this.userModel.fullname);
                    data.append("avatar", this.userModel.avatar);
                    var $this = this;
                    axios.post(this.url.createUser,
                        data,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function(response) {
                        var status = response.data.status;
                        if (status === 1) {
                            $this.errorMessage = response.data.message;
                        }
                        if (status === 0) {
                            window.location.href = $this.url.loginPage;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },
            getInputClass: function(field) {
                var inputClass = "input"
                if (this.$v.userModel[field].$dirty) {
                    inputClass += (this.$v.userModel[field].$error ? " is-danger" : " is-success");
                }
                return inputClass;
            }
        },
        computed: {
            isDisabledSubmit: function() {
                return !this.isAgreeWithTerms;
            }
        }
    }
</script>
