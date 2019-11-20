import {mount, Wrapper} from "@vue/test-utils";

import ChatHistory from '../../components/ChatHistory.vue';
import ChatPage from "../ChatPage.vue";
import MessageForm from '../../components/MessageForm.vue';


describe('Chat Page - Feature', () => {
    it('renders ChatHistory', async () => {
        const wrapper: Wrapper<ChatPage> = mount(ChatPage);

        expect(wrapper.find(ChatHistory).exists()).toBeTruthy();
    });

    it('renders MessageForm', async () => {
        const wrapper: Wrapper<ChatPage> = mount(ChatPage);

        expect(wrapper.find(MessageForm).exists()).toBeTruthy();
    });
});
