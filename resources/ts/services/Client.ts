import axios from "axios";
import {ILoginRequest} from "@ts/types/backend";


export default class Client {
    public static async login(email: string, password: string): Promise<void> {
        try {
            const loginPayload: ILoginRequest = {
                email,
                password,
            };

            await axios.post("/login", loginPayload);
        } catch (error) {
            throw new Error(error.response.data);
        }
    }
}
