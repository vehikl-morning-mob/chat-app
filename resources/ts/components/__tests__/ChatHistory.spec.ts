import {mount, Wrapper} from "@vue/test-utils";
import MockAdapter from "axios-mock-adapter";
import flushPromises from 'flush-promises';
import axios from 'axios';
import ChatHistory from "../ChatHistory.vue";
import {GetAllMessagesResponse, MessageResponse} from "../../types/backend";
import {messagePollingIntervalMs} from "../../settings";

jest.useFakeTimers();

describe('Chat History', () => {
    let wrapper: Wrapper<ChatHistory>;

    afterEach(() => {
        wrapper.destroy();
    });

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
        wrapper = mount(ChatHistory, {propsData: {name: 'test1'}});

        await flushPromises();

        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].message);
        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].user);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].message);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].user);
        mockAdapter.restore();
    });

    it('polls for messages', async () => {
        const messageOne: GetAllMessagesResponse = [
            {
                user: 'user1',
                message: 'message1',
            },
        ];
        const messageTwo: GetAllMessagesResponse = [...messageOne, {
            user: 'user2',
            message: 'message2',
        }];

        const mockAdapter = new MockAdapter(axios);
        mockAdapter
            .onGet('/messages').replyOnce(200, messageOne)
            .onGet('/messages').replyOnce(200, messageTwo)
            .onGet('/messages').replyOnce(200, []);

        wrapper = mount(ChatHistory, {propsData: {name: 'test2'}});

        await flushPromises();

        expect(wrapper.text()).toContain(messageOne[0].message);
        expect(wrapper.text()).not.toContain(messageTwo[1].message);

        jest.advanceTimersByTime(messagePollingIntervalMs);
        await flushPromises();

        expect(wrapper.text()).toContain(messageTwo[1].message);
        mockAdapter.restore();
    });
});
