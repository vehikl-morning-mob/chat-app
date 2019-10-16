<template>
    <form @submit.prevent>
        <input v-model="input" type="text">

        <button type="submit" @click="sendMessage">Send</button>
    </form>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';
    import axios from 'axios';

    interface MessageResponse {
        message: string
    }

    @Component
    export default class MessageForm extends Vue {
        private input: string;

        private async sendMessage() {
            await axios.post<MessageResponse>("/messages", {
                content: this.input
            });
        }
    }
</script>

<style lang="scss" scoped></style>
