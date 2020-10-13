import { Component, OnInit } from '@angular/core';
import {UserService} from '../user.service';
@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.sass']
})
export class HistoryComponent implements OnInit {
  playerhistory: any;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.playerhistory = this.userService.getUserHistory(1);
  }

}
