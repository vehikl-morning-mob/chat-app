export * from "./ILoginRequest";
export * from "./IRequestError";

export interface Message {
    user: string;
    message: string;
}

export type GetAllMessagesResponse = Message[];

export interface MessageResponse {
    message: string
}
