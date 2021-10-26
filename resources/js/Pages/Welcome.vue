<template>
    <main class="h-screen pb-10 flex flex-col justify-between">
        <section class="flex flex-col mx-8 my-2">
            <ul class="flex flex-col">
                <li class="chat-bubble">Hey Bob, are you busy tonight?</li>
                <li class="chat-bubble self-end">No, not really... Just rewatching game of thrones</li>
                <li class="chat-bubble self-end">Man... the writing is really going down hill since Danny got to
                    Westeros.
                </li>
                <li class="chat-bubble">You said it, man.</li>
                <li class="chat-bubble">Yack... Season 8 sucks.</li>
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

<script>
import {Head} from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head
    }
}
</script>
