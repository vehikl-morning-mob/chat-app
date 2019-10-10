export interface Message {
    user: string;
    message: string;
}

export type GetAllMessagesResponse = Message[];
