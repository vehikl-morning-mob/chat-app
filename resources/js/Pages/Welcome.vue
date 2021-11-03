<template>
    <main class="h-screen pb-10 flex flex-col justify-between">
        <section class="flex flex-col mx-8 my-2">
            <ul class="flex flex-col">
                <li v-for="message in messages"
                    :class="{'chat-bubble': true, 'owner-message': message.username === currentUser.username, 'other-message': message.username !== currentUser.username}">
                    {{ message.username }} said at {{ message.time }}: {{ message.content }}
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
const props = defineProps({
    currentUser: Object,
    messages: Array
})

</script>

<style lang="postcss">
.owner-message {
    @apply self-end;
}

.other-message {
    @apply self-start;
}
</style>
