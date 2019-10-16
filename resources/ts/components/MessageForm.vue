<template>
    <form @submit.prevent>
        <input v-model="messageBody" type="text">

        <button type="submit" @click="sendMessage">Send</button>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';
    import axios from 'axios';
    import {MessageResponse} from "../types/backend";

    @Component
    export default class MessageForm extends Vue {
        private messageBody: string = '';

        private async sendMessage() {
            const response = await axios.post<MessageResponse>("/messages", {
                content: this.messageBody
            });
        }
    }
</script>

<style lang="scss" scoped></style>
