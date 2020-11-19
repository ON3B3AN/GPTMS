import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/user';
import { UserService } from 'src/app/user.service';

@Component({
  selector: 'app-manage-users',
  templateUrl: './manage-users.component.html',
  styleUrls: ['./manage-users.component.sass']
})
export class ManageUsersComponent implements OnInit {
  users: User[];
  selectedUser: number;
  showEditor = false;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.userService.getUsers()
      .subscribe(data => this.users = data);
  }

  editRole(id?: number): void {
    this.selectedUser = (id) ? id : null;
    this.showEditor = true;
  }

  closeModal(user: User) {
    this.showEditor = false;
    if (user) console.log("WOOT!");
  }

}
