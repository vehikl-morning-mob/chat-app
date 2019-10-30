import {shallowMount, Wrapper} from "@vue/test-utils";
import LoginForm from "../LoginForm.vue";

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
});
