export class User {
  user_id?: number;
  first_name: string;
  last_name: string;
  phone: string;
  email: string;
  password?: string;
  role?: any;
  constructor() {
    this.first_name = '';
    this.last_name = '';
    this.phone = '';
    this.email = '';
  }
}
