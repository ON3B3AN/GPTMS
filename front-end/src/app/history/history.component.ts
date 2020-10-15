import { Component, OnInit } from '@angular/core';
import {UserService} from '../user.service';
import {AuthService} from "../auth.service";
@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.sass']
})
export class HistoryComponent implements OnInit {
  playerHistory: any;

  constructor(private userService: UserService, private authService: AuthService) { }

  ngOnInit(): void {
    this.playerHistory = this.userService.getUserHistory(this.authService.currentUser.id);
  }

}
