import {shallowMount, Wrapper} from "@vue/test-utils";
import LoginForm from "../LoginForm.vue";
import Client from "@ts/services/Client";

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
        Client.login = jest.fn().mockResolvedValue({message: "You did it!!! Alright!"});

        const email = 'electric@boogaloo.taco';
        wrapper.find('#email-address').setValue(email);
        const password = 'password';
        wrapper.find('#password').setValue(password);

        wrapper.find('#login').trigger('click');

        expect(Client.login).toHaveBeenCalledWith(email, password);
    });

    it("Displays error modal upon connection failure", () => {

    });
});
