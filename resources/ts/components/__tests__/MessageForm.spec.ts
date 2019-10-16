import {shallowMount} from "@vue/test-utils";
import MockAdapter from "axios-mock-adapter";
import * as flushPromises from 'flush-promises';
import axios from 'axios';
import MessageForm from "../MessageForm.vue";

describe('MessageForm', () => {
    it('Sends a message that the user has typed to the backend', async () => {
        const mockAdapter: MockAdapter = new MockAdapter(axios);
        mockAdapter.onPost('/messages').reply(201);

        const wrapper = shallowMount(MessageForm);
        const input = 'electric boogaloo';
        wrapper.find('input').setValue(input);
        wrapper.find('button').trigger('click');

        await flushPromises();

        expect(JSON.parse(mockAdapter.history.post[0].data)).toEqual({content: input});
    });
});
