import {Hole} from './hole';

export interface Course {
  tees: any;
  course: any;
  course_id: number;
  course_name: string;
  address: string;
  phone_number: string;
  course_tee: string;
  hole?: Hole[];
}
