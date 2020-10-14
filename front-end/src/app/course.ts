import {Hole} from "./hole";

export interface Course {
  id: number;
  name: string;
  address: string;
  hole?: Hole[];
}
