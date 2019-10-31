<template>
    <login-form class="mt-20" @login="redirectToChat"></login-form>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import LoginForm from "../components/LoginForm.vue";

    @Component({
        components: {LoginForm}
    })
    export default class LandingPage extends Vue {
        protected redirectToChat(): void {
            this.$router.push('chat');
        }
    };
</script>
