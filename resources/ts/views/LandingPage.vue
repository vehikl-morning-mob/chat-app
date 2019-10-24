<template>
    <div>
        This is the Landing Page
        <login-form></login-form>
        <register-form></register-form>
        <chat-history></chat-history>
        <message-form></message-form>
    </div>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import RegisterForm from "../components/RegisterForm.vue";
    import MessageForm from "../components/MessageForm.vue";
    import ChatHistory from "../components/ChatHistory.vue";
    import LoginForm from "../components/LoginForm.vue";

    @Component({
        components: {LoginForm, ChatHistory, MessageForm, RegisterForm}
    })
    export default class LandingPage extends Vue {
    };
</script>
