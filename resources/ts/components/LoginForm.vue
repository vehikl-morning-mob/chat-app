<template>
    <form @submit.prevent>
        <label for="email-address">
            Email:
            <input id="email-address" v-model="user.email" type="text">
        </label>

        <label for="password">
            Password:
            <input id="password" v-model="user.password" type="text">
        </label>

        <button id="login" type="submit" @click="login">Register</button>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import axios from 'axios';

    @Component
    export default class LoginForm extends Vue {
        protected user = {
            email: '',
            password: ''
        };

        protected async login(): Promise<void> {
            await axios.post<void>('/login', this.user);
            this.$router.push('chat');
        }
    }
</script>

<style scoped>

</style>
