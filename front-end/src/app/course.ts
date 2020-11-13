import {Hole} from './hole';

export interface Course {
  course?: any;
  course_id?: number;
  course_name?: string;
  address?: string;
  phone_number?: string;
  holes?: Hole[];
}
