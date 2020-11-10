import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.sass']
})
export class GameComponent implements OnInit {
  holes = [1,2,3,4,5,6,7,8,9];

  constructor() { }
  

  ngOnInit(): void {
  }

}
