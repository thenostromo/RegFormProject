<template>
    <div class="box">
        <div class="message is-danger" v-if="errorMessage">
            <div class="message-body">{{ errorMessage }}</div>
        </div>
        <div class="field">
            <label class="label">
                {{ interfaceMessages['login_page.form_username_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('username')"
                    type="text"
                    v-model="userModel.username"
                    :placeholder="interfaceMessages['login_page.form_username_placeholder']"
                >
                <p v-if="$v.userModel.username.$error && !$v.userModel.username.required" class="help is-danger">
                    {{ interfaceMessages['form_error.required_field'] }}
                </p>
                <p v-if="!$v.userModel.username.engCharsNumbersAndPunctuation" class="help is-danger">
                    {{ interfaceMessages['form_error.eng_chars_number_and_punct'] }}
                </p>
                <p v-if="!$v.userModel.username.minLength" class="help is-danger">
                    {{ interfaceMessages['form_error.min_length']}}: 3
                </p>
                <p v-if="!$v.userModel.username.maxLength" class="help is-danger">
                    {{ interfaceMessages['form_error.max_length']}}: 50
                </p>
            </div>
        </div>

        <div class="field">
            <label class="label">
                {{ interfaceMessages['login_page.form_password_label'] }}
            </label>
            <div class="control">
                <input
                    :class="getInputClass('password')"
                    type="password"
                    v-model="userModel.password"
                    :placeholder="interfaceMessages['login_page.form_password_placeholder']"
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

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" v-on:click="submit()">
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
    import { required, minLength, maxLength, email } from 'vuelidate/lib/validators';
    import engCharsNumbersAndPunctuation from "../vue/validators/engCharsNumbersAndPunctuation";
 
    export default {
        name: "app-auth-form",
        data: function () {
            return {
                userModel: userModel,
                interfaceMessages: interfaceMessages,
                url: {
                    authUser: urlAuthUser,
                    profileUser: urlProfileUser
                },
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
                }
            },
        },
        methods: {
            submit: function() {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    var data = new FormData();
                    data.append("username", this.userModel.username);
                    data.append("password", this.userModel.password);
                    var $this = this;
                    axios.post(this.url.authUser,
                        data,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function(response) {console.log(response)
                        var status = response.data.status;
                        if (status === 1) {
                            $this.errorMessage = response.data.message;
                        }
                        if (status === 0) {
                            window.location.href = $this.url.profileUser;
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
        }
    }
</script>
