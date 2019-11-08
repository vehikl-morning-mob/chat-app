import {shallowMount, Wrapper} from "@vue/test-utils";
import LoginForm from "../LoginForm.vue";
import Client from "@ts/services/Client";
import flushPromises from "flush-promises";
import {IRequestError} from "@ts/types";

jest.mock('@ts/services/Client');

describe('LoginForm', () => {
    let wrapper: Wrapper<LoginForm>;

    beforeEach(() => {
        wrapper = shallowMount(LoginForm);
    });

    it('starts with the login button disabled', () => {
        expect(wrapper.find('#login').attributes('disabled')).toBeTruthy();
    });

    it('enables the login button after the user provided email and password', () => {
        wrapper.find('#email-address').setValue('electric@boogaloo.taco');
        wrapper.find('#password').setValue('password');

        expect(wrapper.find('#login').attributes('disabled')).toBeFalsy();
    });

    it('sends correct payload when user submits', () => {
        Client.login = jest.fn();

        const email = 'electric@boogaloo.taco';
        wrapper.find('#email-address').setValue(email);
        const password = 'password';
        wrapper.find('#password').setValue(password);

        wrapper.find('#login').trigger('click');

        expect(Client.login).toHaveBeenCalledWith(email, password);
    });

    it('emits a login event after a successful login ', async () => {
        Client.login = jest.fn();

        const email = 'electric@boogaloo.taco';
        wrapper.find('#email-address').setValue(email);
        const password = 'password';
        wrapper.find('#password').setValue(password);

        wrapper.find('#login').trigger('click');
        await flushPromises();

        expect(wrapper.emitted('login')).toBeTruthy();
    });

    it('does not emit a login event after an unsuccessful login', async () => {
        Client.login = jest.fn().mockRejectedValue({error: 'error'});

        const email = 'electric@boogaloo.taco';
        wrapper.find('#email-address').setValue(email);
        const password = 'password';
        wrapper.find('#password').setValue(password);

        wrapper.find('#login').trigger('click');
        await flushPromises();

        expect(wrapper.emitted('login')).toBeFalsy();
    });

    it('displays the error message given when login is unsuccessful', async () => {

        const error: IRequestError = {
            message: 'The password provided is invalid',
            errors: {}
        };

        Client.login = jest.fn().mockRejectedValue({response: {data: error}});

        const email = 'electric@boogaloo.taco';
        wrapper.find('#email-address').setValue(email);
        const password = 'password';
        wrapper.find('#password').setValue(password);

        wrapper.find('#login').trigger('click');
        await flushPromises();

        expect(wrapper.find('.error-container').text()).toContain(error.message);
    });
});
