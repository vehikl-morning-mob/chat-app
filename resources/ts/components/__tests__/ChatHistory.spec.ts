import {mount} from "@vue/test-utils";
import MockAdapter from "axios-mock-adapter";
import * as flushPromises from 'flush-promises';
import axios from 'axios';
import ChatHistory from "../ChatHistory.vue";
import {GetAllMessagesResponse} from "../../types/backend";

describe('Chat History', () => {
    it('Shows existing messages on load', async () => {
        const messagesResponse: GetAllMessagesResponse = [
            {
                user: 'user1',
                message: 'message1',
            },
            {
                user: 'user2',
                message: 'message2',
            },
        ];
        const mockAdapter = new MockAdapter(axios);
        mockAdapter.onGet('/messages').reply(200, messagesResponse);
        const wrapper = mount(ChatHistory);

        await flushPromises();


        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].message);
        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].user);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].message);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].user);

    })
});
