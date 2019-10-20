<template>
    <div>
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" placeholder="Text input">
            </div>
        </div>

        <div class="field">
            <label class="label">Username</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                <span class="icon is-small is-left">
                                  <i class="fas fa-user"></i>
                                </span>
                <span class="icon is-small is-right">
                                  <i class="fas fa-check"></i>
                                </span>
            </div>
            <p class="help is-success">This username is available</p>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input is-danger" type="email" placeholder="Email input" value="hello@">
                <span class="icon is-small is-left">
                                  <i class="fas fa-envelope"></i>
                                </span>
                <span class="icon is-small is-right">
                                  <i class="fas fa-exclamation-triangle"></i>
                                </span>
            </div>
            <p class="help is-danger">This email is invalid</p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "app-reg-form",
        data: function () {
            return {
                friendGameRequestId: null
            }
        },
        methods: {
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
