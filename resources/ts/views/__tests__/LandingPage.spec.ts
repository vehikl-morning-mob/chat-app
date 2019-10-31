import {mount, Wrapper} from "@vue/test-utils";
import LandingPage from "../LandingPage.vue";
import flushPromises from "flush-promises";
import MockAdapter from "axios-mock-adapter";
import axios from 'axios';

describe('Landing Page - Feature', () => {
    it('Allows the user to login', async () => {
        const wrapper: Wrapper<LandingPage> = mount(LandingPage, {
            mocks: {
                $router: {
                    push: jest.fn()
                }
            }
        });
        const mockAdapter: MockAdapter = new MockAdapter(axios);
        mockAdapter.onPost('/login').reply(200);

        wrapper.find('#email-address').setValue('FooBar@gmail.com');
        wrapper.find('#password').setValue('secret');
        wrapper.find('#login').trigger('click');

        await flushPromises();

        expect(wrapper.vm.$router.push).toHaveBeenCalledWith('chat');
    });
});
