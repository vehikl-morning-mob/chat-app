import axios from "axios";
import {ILoginRequest} from "@ts/types/backend";

export default class Client {
    public static async login(email: string, password: string): Promise<void> {
        const loginPayload: ILoginRequest = {
            email,
            password,
        };

        console.log({loginPayload});

        await axios.post("/login", loginPayload);
        console.log('I succeeded');
    }
}
