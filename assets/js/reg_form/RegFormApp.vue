<template>
    <div class="box">
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
                    Поле должно быть заполнено
                </p>
                <p v-if="!$v.userModel.username.noCyrillicLetters" class="help is-danger">
                    Поле должно содержать только латинские буквы, цифры и знаки припенания
                </p>
                <p v-if="!$v.userModel.username.minLength" class="help is-danger">
                    Поле должно содержать как минимум 2 символа
                </p>
                <p v-if="!$v.userModel.username.maxLength" class="help is-danger">
                    Превышен допустимый лимит 50 символов
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
                    Поле должно быть заполнено
                </p>
                <p v-if="!$v.userModel.password.noCyrillicLetters" class="help is-danger">
                    Поле должно содержать только латинские буквы, цифры и знаки припенания
                </p>
                <p v-if="!$v.userModel.password.minLength" class="help is-danger">
                    Поле должно содержать как минимум 6 символов
                </p>
                <p v-if="!$v.userModel.password.maxLength" class="help is-danger">
                    Превышен допустимый лимит 30 символов
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
                    Поле должно быть заполнено
                </p>
                <p v-if="!$v.userModel.email.email" class="help is-danger">
                    Проверьте корректность введенного email
                </p>
                <p v-if="!$v.userModel.email.noCyrillicLetters" class="help is-danger">
                    Поле должно содержать только латинские буквы, цифры и знаки припенания
                </p>
                <p v-if="!$v.userModel.email.minLength" class="help is-danger">
                    Поле должно содержать как минимум 6 символов
                </p>
                <p v-if="!$v.userModel.email.maxLength" class="help is-danger">
                    Превышен допустимый лимит 30 символов
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
                    Поле должно быть заполнено
                </p>
                <p v-if="!$v.userModel.fullname.ruDashSpace" class="help is-danger">
                    Поле должно содержать только русские буквы и пробелы
                </p>
                <p v-if="!$v.userModel.fullname.minLength" class="help is-danger">
                    Поле должно содержать как минимум 2 символа
                </p>
                <p v-if="!$v.userModel.fullname.maxLength" class="help is-danger">
                    Превышен допустимый лимит 100 символов
                </p>
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
                <button class="button is-link" v-on:click="submit()" :disabled="isDisabledSubmit">Submit</button>
            </div>
            <div class="control">
                <button class="button is-link is-light">Cancel</button>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import { required, minLength, maxLength, email } from 'vuelidate/lib/validators';
    import noCyrillicLetters from "../vue/validators/noCyrillicLetters";
    import ruDashSpace from "../vue/validators/ruDashSpace";
 
    export default {
        name: "app-reg-form",
        data: function () {
            return {
                userModel: userModel,
                interfaceMessages: interfaceMessages,
                friendGameRequestId: null,
                url: {
                    createUser: urlCreateUser
                },
                isAgreeWithTerms: false
            }
        },
        validations: {
            userModel: {
                username: {
                    required,
                    noCyrillicLetters,
                    minLength: minLength(2),
                    maxLength: maxLength(30)
                },
                password: {
                    required,
                    noCyrillicLetters,
                    minLength: minLength(6),
                    maxLength: maxLength(30)
                },
                email: {
                    required,
                    email,
                    noCyrillicLetters,
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
            submit: function() {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    console.log('success')
                    var data = new FormData();
                    data.append("username", this.userModel.username);
                    data.append("password", this.userModel.password);
                    data.append("email", this.userModel.email);
                    data.append("fullname", this.userModel.fullname);
                    axios.post(this.url.createUser,
                        data,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function(response) {
                        var status = response.data.status;
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
            },
            clearPromoCode: function() {
                let $this = this;
            },
            makePaymentRequest: function() {
                var data = new FormData();
                data.append("gameId", this.applied.gameModel.id);
                axios.post(this.url.makePaymentRequest,
                    data,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(response) {
                    var status = response.data.status;
                })
                    .catch((error) => {
                        console.log(error);
                    });
            }

        },
        computed: {
            staticDataGameLevelChoice: function() {
                //return defaultValue.staticData.gameLevelChoice
            },
            isDisabledSubmit: function() {
                return !this.isAgreeWithTerms;
            }
        }
    }
</script>
