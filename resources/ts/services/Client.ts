import axios from "axios";
import {ILoginRequest} from "@ts/types/backend";


export default class Client {
    public static async login(email: string, password: string): Promise<void> {
        const loginPayload: ILoginRequest = {
            email,
            password,
        };

        await axios.post("/login", loginPayload);
    }
}
