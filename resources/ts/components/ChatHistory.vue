<template>
    <div>
        <div v-for="(message, id) in messages" :key="id" class="card">
            <h3 v-text="message.user"></h3>
            <p v-text="message.message"></p>
        </div>
    </div>
</template>

<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator';
    import {GetAllMessagesResponse, Message} from "../types/backend";
    import axios from "axios";

    @Component
    export default class ChatHistory extends Vue {
        protected messages: Message[] = [];

        created() {
            this.loadMessages();
            window.Echo.private('room').listen('.App\\Events\\NewMessageReceived', (newMessage: Message) => {
                this.messages.unshift(newMessage);
            });
        }

        protected async loadMessages() {
            try {
                const response = await axios.get<GetAllMessagesResponse>('/messages');
                this.messages = response.data;
            } catch (e) {
                console.error(e)
            }
        }
    };
</script>

<style scoped>

</style>
