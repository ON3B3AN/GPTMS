import { Component, OnInit } from '@angular/core';
import {UserService} from '../user.service';
import {AuthService} from '../auth.service';
import {User} from '../user';
@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.sass']
})
export class HistoryComponent implements OnInit {
  playerHistory: any;
  user: User;


  constructor(private userService: UserService, private authService: AuthService) {
    this.authService.currentUser.subscribe(u => {
      this.user = u;
    });
  }

  ngOnInit(): void {
    this.userService.getUserHistory(this.user.user_id)
      .subscribe(data => this.playerHistory = data);
  }

}
