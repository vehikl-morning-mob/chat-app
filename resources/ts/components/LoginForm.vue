<template>
    <form @submit.prevent
          class="login-form flex flex-col justify-center shadow-md mx-auto max-w-lg p-12 py-8 rounded-lg bg-gray-100">
        <label for="email-address" class="sr-only">
            Email:
        </label>
        <input id="email-address" placeholder="Email" v-model="user.email" type="text"
               :class="{'with-errors': this.errorResponse}"
               class="border border-gray-300 rounded p-3">

        <label for="password" class="sr-only">
            Password:
        </label>
        <input id="password" placeholder="Password" v-model="user.password" type="password"
               :class="{'with-errors': this.errorResponse}"
               class="border border-gray-300 mt-4 rounded p-3">

        <button id="login" type="submit" @click="login" :disabled="! isReadyToSubmit"
                class="mt-6 hover:bg-green-700 bg-green-600 text-gray-300 w-1/3 mx-auto rounded-full p-1">Login
        </button>

        <div class="error-container"
             v-text="errorResponse"
             v-show="errorResponse"></div>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import Client from "@ts/services/Client";
    import {IRequestError} from '@ts/types';

    @Component
    export default class LoginForm extends Vue {
        protected errorResponse?: IRequestError = null;
        protected user = {
            email: '',
            password: ''
        };

        protected async login(): Promise<void> {
            try {
                await Client.login(this.user.email, this.user.password);
                this.$emit('login');
            } catch (error) {
                this.errorResponse = error.response?.data;
                setTimeout(() => this.errorResponse = null, 1000);
            }
        }

        protected get isReadyToSubmit(): boolean {
            return !!this.user.email && !!this.user.password;
        }
    }
</script>

<style scoped>
    .login-form {
        --shake-intensity: 3%;
    }

    .with-errors {
        animation: shake 200ms linear 2
    }

    @keyframes shake {
        25% {
            transform: translateX(calc(var(--shake-intensity) * -1));
        }

        75% {
            transform: translateX(var(--shake-intensity));
        }

        100% {
            transform: translateX(0);
        }
    }
</style>
