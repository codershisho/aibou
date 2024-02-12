export interface IMessage {
  id: number;
  text: string;
  state?: IMessageState;
}

interface IMessageState {
  color?: string;
  timeout?: number;
}
