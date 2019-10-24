import {shallowMount} from "@vue/test-utils";
import MockAdapter from "axios-mock-adapter";
import flushPromises from 'flush-promises';
import axios from 'axios';
import MessageForm from "../MessageForm.vue";
import {MessageResponse} from "../../types/backend";

describe('MessageForm', () => {
    it('Sends a message that the user has typed to the backend', async () => {
        const mockAdapter: MockAdapter = new MockAdapter(axios);
        mockAdapter.onPost('/messages').reply((config) => {
            const message: string = JSON.parse(config.data).content;
            const response: MessageResponse = {message};
            return [201, response];
        });

        const wrapper = shallowMount(MessageForm);
        const input = 'electric boogaloo';
        wrapper.find('input').setValue(input);
        wrapper.find('button').trigger('click');

        await flushPromises();

        expect(JSON.parse(mockAdapter.history.post[0].data)).toEqual({content: input});
    });
});
