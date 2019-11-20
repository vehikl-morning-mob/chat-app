<template>
    <div>
        <chat-history></chat-history>
        <message-form></message-form>
    </div>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import ChatHistory from "@ts/components/ChatHistory.vue";
    import MessageForm from "@ts/components/MessageForm.vue";

    @Component({
        components: {MessageForm, ChatHistory}
    })
    export default class ChatPage extends Vue {
    };
</script>
