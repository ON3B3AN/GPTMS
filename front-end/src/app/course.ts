import {Hole} from './hole';

export class Course {
  course?: any;
  course_id?: number;
  course_name: string;
  address: string;
  phone: string;
  holes?: Hole[];
  constructor() {
    this.course_name = '';
    this.address = '';
    this.phone = '';
  }
}
