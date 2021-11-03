import {mount} from "@vue/test-utils";
import Welcome from "./Welcome"

describe('Welcome component', () => {
    it('has a text area for people to type new messages', () => {
        const wrapper = mount(Welcome);

        expect(wrapper.find('textarea').exists()).toBe(true);
    });

    it('shows text bubbles from other people at the right', () => {
        const wrapper = mount(Welcome, {
            props: {
                currentUser: {username: 'Bob'},
                messages: [
                    {content: 'Hello', username: 'Bob', time: '9:00pm'},
                    {
                        content: 'Hi there',
                        username: 'Kevin',
                        time: '9:01pm'
                    },]
            }
        })

        const bubbles = wrapper.findAll('li');

        const firstBubble = bubbles[0];
        const secondBubble = bubbles[1];

        expect(firstBubble.classes()).toContain('owner-message')
        expect(firstBubble.classes()).not.toContain('other-message')


        expect(secondBubble.classes()).not.toContain('owner-message')
        expect(secondBubble.classes()).toContain('other-message')
    });
});
