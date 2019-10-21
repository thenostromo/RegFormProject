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
                <p v-if="!$v.userModel.username.required" class="help is-danger">
                    Поле должно содержать только латинские буквы, цифры и знаки припенания
                </p>
                <p v-if="$v.userModel.username.$error && !$v.userModel.username.required" class="help is-danger">
                    Поле должно содержать как минимум символа
                </p>
                <p v-if="$v.userModel.username.$error && !$v.userModel.username.required" class="help is-danger">
                    Разрешены только русские буквы и пробел
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
                    type="text"
                    :placeholder="interfaceMessages['registration_page.form_password_placeholder']"
                >
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
                    :placeholder="interfaceMessages['registration_page.form_email_placeholder']"
                >
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
                    :placeholder="interfaceMessages['registration_page.form_full_name_placeholder']"
                >
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox">
                    I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" v-on:click="submit()">Submit</button>
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
                friendGameRequestId: null
            }
        },
        validations: {
            userModel: {
                username: {
                    required,
                    noCyrillicLetters,
                    minLength: minLength(2),
                    maxLength: minLength(50)
                },
                password: {
                    required,
                    noCyrillicLetters,
                    minLength: minLength(6),
                    maxLength: minLength(30)
                },
                email: {
                    required,
                    email,
                    noCyrillicLetters,
                    minLength: minLength(6),
                    maxLength: minLength(100)
                },
                fullname: {
                    required,
                    ruDashSpace,
                    minLength: minLength(2),
                    maxLength: minLength(100)
                }
            },
        },
        methods: {
            submit: function() {
                this.$v.$touch();
                console.log(this.$v)
                if (this.$v.$invalid) {

                } else {
                    console.log('success')
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
            }
        }
    }
</script>
