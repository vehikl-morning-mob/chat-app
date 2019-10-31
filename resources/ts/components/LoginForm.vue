<template>
    <form @submit.prevent
          class="flex flex-col justify-center shadow-md mx-auto max-w-lg p-12 py-8 rounded-lg bg-gray-100">
        <label for="email-address" class="sr-only">
            Email:
        </label>
        <input id="email-address" placeholder="Email" v-model="user.email" type="text"
               class="border border-gray-300 rounded p-3">

        <label for="password" class="sr-only">
            Password:
        </label>
        <input id="password" placeholder="Password" v-model="user.password" type="text"
               class="border border-gray-300 mt-4 rounded p-3">

        <button id="login" type="submit" @click="login" :disabled="! isReadyToSubmit"
                class="mt-6 hover:bg-green-700 bg-green-600 text-gray-300 w-1/3 mx-auto rounded-full p-1">Login
        </button>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import Client from "@ts/services/Client";

    @Component
    export default class LoginForm extends Vue {
        protected user = {
            email: '',
            password: ''
        };

        protected async login(): Promise<void> {
            await Client.login(this.user.email, this.user.password);
        }

        protected get isReadyToSubmit(): boolean {
            return !!this.user.email && !!this.user.password;
        }
    }
</script>

<style scoped>

</style>
