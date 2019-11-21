import {mount, Wrapper} from "@vue/test-utils";
import MockAdapter from "axios-mock-adapter";
import flushPromises from 'flush-promises';
import axios from 'axios';
import ChatHistory from "../ChatHistory.vue";
import {GetAllMessagesResponse, MessageResponse} from "../../types/backend";
import {messagePollingIntervalMs} from "../../settings";
import MockEcho from "mock-echo"

jest.useFakeTimers();

describe('Chat History', () => {
    let wrapper: Wrapper<ChatHistory>;
    let mockEcho: MockEcho;

    beforeEach(() => {
        mockEcho = new MockEcho()
        window.Echo = mockEcho
    });

    afterEach(() => {
        delete window.Echo
    })

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
        wrapper = mount(ChatHistory);

        await flushPromises();

        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].message);
        expect(wrapper.findAll('.card').at(0).text()).toContain(messagesResponse[0].user);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].message);
        expect(wrapper.findAll('.card').at(1).text()).toContain(messagesResponse[1].user);
        mockAdapter.restore();
    });

    it('displays new messages when they are received', async () => {
        wrapper = mount(ChatHistory);
        const mockAdapter = new MockAdapter(axios);
        mockAdapter.onGet('/messages').reply(200, []);

        mockEcho.getChannel('private-room').broadcast('.App\\Events\\NewMessageReceived', {
            user: 'user1',
            message: 'Hello World'
        });

        expect(wrapper.findAll('.card').length).toEqual(1);
        mockAdapter.restore();
    });
});
