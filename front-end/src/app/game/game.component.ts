import { Component, Input, OnChanges } from '@angular/core';
import { Course } from '../course';
import { GameService } from '../game.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.sass']
})
export class GameComponent implements OnChanges {
  @Input() game;
  course: Course = {};

  constructor(private gameService: GameService) { }


  ngOnChanges(): void {
    if (this.game) {
      let holes = this.game.hole.split('-');
      this.gameService.getRound(this.game.course_id, holes[0], holes[1]).subscribe(data => {
        this.course.course_name = data[0].course_name;
        this.course.address = data[0].address;
        this.course.phone_number = data[0].phone;
        this.course.holes = [];
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
    }
  }

}
