<template>
    <div style="margin:auto">
        <h1>Authenticating..., please wait!</h1>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';
    export default {
        name: "LoginGithub",
        methods: {
            ...mapActions({
                login: 'loginSocialCallback',
            }),
            loginUser() {
                this.login({
                    code: this.$route.query.code,
                    provider:this.$route.params.provider
                }).then((resp) => {
                    if (resp.data.access_token) {
                            this.$router.push({name: 'setup'});
                    } else {
                        this.$router.push({
                            name: 'home'
                        })
                    }
                })
            },
        },
        created() {
            this.loginUser()
        }
    }
</script>

<style scoped>
</style>