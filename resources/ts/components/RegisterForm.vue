<template>
    <form @submit.prevent>
        <label for="email-address">
            Email:
            <input id="email-address" v-model="user.email" type="text">
        </label>

        <label for="name">
            Name:
            <input id="name" v-model="user.name" type="text">
        </label>

        <label for="password">
            Password:
            <input id="password" v-model="user.password" type="text">
        </label>

        <button id="register" type="submit" @click="submitRegistration">Register</button>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import axios from 'axios';
    import {UserRegistrationPayload} from "../types";

    @Component
    export default class RegisterForm extends Vue {
        private user: UserRegistrationPayload = {
            name: "",
            email: "",
            password: ""
        };

        protected async submitRegistration(): Promise<void> {
            await axios.post<void>('/register', this.user);
        }
    }
</script>
