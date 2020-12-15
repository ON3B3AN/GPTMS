export class User {
  user_id?: number;
  first_name: string;
  last_name: string;
  phone: string;
  email: string;
  password?: string;
  role?: Role;
  constructor() {
    this.first_name = '';
    this.last_name = '';
    this.phone = '';
    this.email = '';
  }
}

export interface Role {
  user_id?: number;
  course_id: number;
  security_lvl: number;
}
