import Client from "@ts/services/Client";
import MockAdapter from "axios-mock-adapter";
import axios from "axios";
import flushPromises from "flush-promises";
import {ILoginRequest, IRequestError} from "@ts/types";

describe('client', () => {
    const password = 'password';
    const email = 'email';
    let mockServer: MockAdapter;

    beforeEach(() => {
        mockServer = new MockAdapter(axios);
    });

    afterEach(() => {
        mockServer.restore();
    });

    it('follows the login contract ', async () => {
        mockServer.onPost('/login').reply(200);

        await Client.login(email, password);

        await flushPromises();

        const expectedPayload: ILoginRequest = {
            email,
            password
        };

        expect(JSON.parse(mockServer.history.post[0].data)).toEqual(expectedPayload);
    });

    it('relays the error message upon failed login', async () => {
        const laravelValidationErrorResponse: IRequestError = {
            message: 'The email you provided is invalid',
            errors: {
                "email": ["Your email sucks"],
            },
        };
        mockServer.onPost('/login').reply(422, laravelValidationErrorResponse);

        await expect(Client.login(email, password)).rejects.toThrow();
    });
});
