import Client from "@ts/services/Client";
import MockAdapter from "axios-mock-adapter";
import axios from "axios";
import flushPromises from "flush-promises";
import {ILoginRequest} from "@ts/types/backend";

describe('client', () => {
    it('follows the login contract ', async () => {
        const mockServer: MockAdapter = new MockAdapter(axios);
        mockServer.onPost('/login').reply(200);

        const password = 'password';
        const email = 'email';
        await Client.login(email, password);

        await flushPromises();

        const expectedPayload: ILoginRequest = {
            email,
            password
        };
        
        expect(JSON.parse(mockServer.history.post[0].data)).toEqual(expectedPayload);
    });
});
