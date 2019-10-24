<template>
    <div>
        <div v-for="(message, id) in messages" :key="id" class="card">
            <h3 v-text="message.user"></h3>
            <p v-text="message.message"></p>
        </div>
    </div>
</template>

<script lang="ts">
    import {Component, Vue, Prop} from 'vue-property-decorator';
    import {GetAllMessagesResponse, Message} from "../types/backend";
    import axios from "axios";
    import {messagePollingIntervalMs} from '../settings';

    let startTime = (new Date()).getTime();

    @Component
    export default class ChatHistory extends Vue {
        protected messages: Message[] = [];
        protected interval;
        @Prop() name!: string;

        mounted() {
            this.loadMessages();
            this.interval = setInterval(this.loadMessages, messagePollingIntervalMs);
        }

        beforeDestroy() {
            clearInterval(this.interval);
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
