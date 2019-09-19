import {mount, Wrapper} from "@vue/test-utils";
import RegisterForm from "../RegisterForm.vue";
import {UserRegistrationPayload} from "../../types";
import MockAdapter from "axios-mock-adapter";
import * as flushPromises from 'flush-promises';
import axios from 'axios';

describe('RegisterForm', () => {
    it('allows a user to register when submit button is clicked', async () => {
        const mockAdapter: MockAdapter = new MockAdapter(axios);
        mockAdapter.onPost('/register').reply(201);

        const wrapper: Wrapper<RegisterForm> = mount(RegisterForm);
        const user: UserRegistrationPayload = {
            email: "fake@email.tacos",
            name: "tacoMan9000",
            password: "ISecretlyHateTacos"
        };

        wrapper.find('#email-address').setValue(user.email);
        wrapper.find('#name').setValue(user.name);
        wrapper.find('#password').setValue(user.password);

        wrapper.find('#register').trigger('click');
        await flushPromises();

        expect(JSON.parse(mockAdapter.history.post[0].data)).toEqual(user);
    });
});
