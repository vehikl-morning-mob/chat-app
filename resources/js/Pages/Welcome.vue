<template>
    <main class="h-screen pb-10 flex flex-col justify-between">
        <section class="flex flex-col mx-8 my-2">
            <ul class="flex flex-col">
                <li v-for="message in messages" class="chat-bubble">
                    {{ message.owner_name }} said at {{ message.time }}: {{ message.content }}
                </li>
            </ul>
        </section>
        <section>
            <form class="flex items-end mx-8">
                <textarea class="bg-gray-100 flex-1 rounded-xl mr-2"/>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                    Send
                </button>
            </form>
        </section>
    </main>
</template>

<script setup>
import {ref} from "vue";

const messages = ref([
    {owner_name: "Bob", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"},
    {owner_name: "Kevin", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"},
    {owner_name: "Bob", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"},
    {owner_name: "Kevin", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"},
    {owner_name: "Bob", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"},
    {owner_name: "Kevin", content: " No, not really... Just rewatching game of thrones", time: "9:06pm"}
]);
</script>
