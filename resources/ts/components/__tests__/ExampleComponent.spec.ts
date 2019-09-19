import {mount, Wrapper} from "@vue/test-utils";
import ExampleComponent from "../ExampleComponent.vue";

describe('ExampleComponent', () => {
    it('mount', () => {
        const wrapper: Wrapper<ExampleComponent> = mount(ExampleComponent);

        expect(wrapper.vm).not.toBeUndefined();
    });
});
