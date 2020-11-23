import { Component, Input, OnChanges } from '@angular/core';
import { Course } from '../course';
import { GameService } from '../game.service';
import { UserService } from '../user.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.sass']
})
export class GameComponent implements OnChanges {
  @Input() game;
  course: Course = new Course();
  players: any[];
  id: number[];

  constructor(private gameService: GameService, private userService: UserService) { }


  ngOnChanges(): void {
    if (this.game) {
      let holes = this.game.hole.split('-');
      this.userService.getUsers().subscribe(data => {
        this.players = data.filter(u => this.game.email.split(',').indexOf(u.email)>-1);
      });
      this.gameService.getRound(this.game.id, this.game.course_id, holes[0], holes[1]).subscribe(data => {
        this.course.course_name = data[0].course_name;
        this.course.address = data[0].address;
        this.course.phone = data[0].phone;
        this.course.holes = [];
        console.log(data);
        for (const datum of data) {
          const i = this.course.holes.findIndex(h => h.hole_number === datum.hole_number);
          if (i >= 0) {
            this.course.holes[i].tees.push({name: datum.tee_name, distance: datum.distance_to_pin})
          } else {
            this.course.holes.push({
              hole_number: datum.hole_number,
              hole_par: datum.hole_par,
              avg_pop: datum.avg_pop,
              tees: [{
                name: datum.tee_name,
                distance: datum.distance_to_pin
              }]
            })
          }
        }
        console.log(this.course);
      });
      this.gameService.getPosition().then(pos=>
        {
           console.log(`Positon: ${pos.lat} ${pos.lng}`);
        });
    }
  }
  getLocation(){
    this.gameService.getPosition().then(pos=> {
         console.log(`Positon: ${pos.lat} ${pos.lng}`);
      });
  }

  serviceRequest() {
    console.log("User Requested Service");

}
endGame(): void {
  this.gameService.endGame()
    console.log("Game Ended");
}

}
