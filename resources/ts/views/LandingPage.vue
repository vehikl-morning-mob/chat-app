<template>
    <div>
        This is the Landing Page
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

    @Component({
        components: {ChatHistory, MessageForm, RegisterForm}
    })
    export default class LandingPage extends Vue {
    };
</script>
