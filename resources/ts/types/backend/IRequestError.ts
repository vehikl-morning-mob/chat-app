export interface IRequestError {
    message: string;
    errors: {
        [fieldName: string]: string[]
    }
}
