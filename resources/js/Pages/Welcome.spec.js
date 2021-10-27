import {mount} from "@vue/test-utils";
import Welcome from "./Welcome"

describe('Welcome component', () => {
    it('has a text area for people to type new messages', () => {
        const wrapper = mount(Welcome);

        expect(wrapper.find('textarea').exists()).toBe(true);
    });
});
