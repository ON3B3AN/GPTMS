import { Component, Input, OnChanges } from '@angular/core';
import { Course } from '../course';
import { GameService } from '../game.service';
import { UserService } from '../user.service';
import { FormBuilder, FormArray, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.sass']
})
export class GameComponent implements OnChanges {
  @Input() game;
  course: Course = new Course();
  party: any;
  players: any[];
  id: number[];
  scoreForms: FormGroup[] = new Array();

  constructor(private fb: FormBuilder,private gameService: GameService, private userService: UserService) {
  }


  ngOnChanges(): void {
    if (this.game) {
      let holes = this.game.hole.split('-');
      this.userService.getUsers().subscribe(data => {
        this.players = data.filter(u => this.game.email.split(',').indexOf(u.email)>-1);
      });
      this.gameService.getRound(this.game.id, this.game.course_id, holes[0], holes[1]).subscribe(data => {
        this.course.course_name = data[1].course_name;
        this.course.address = data[1].address;
        this.course.phone = data[1].phone;
        this.course.holes = data[1].holes;
        this.party = data[0]
        console.log(data);
        console.log(this.course);
        this.course.holes.map((item, index) => {
          this.addFormItem(item);
        });
      });
      this.gameService.getPosition().then(pos=>
        {
           console.log(`Positon: ${pos.lat} ${pos.lng}`);
        });
    }
  }

  addFormItem(item: any) {
    const scores = this.players.map(x =>
      this.fb.group({
        uid: [x.user_id],
        strokes: [""]
      })
    );

    const formItem = this.fb.group({
      party: [this.party.party_id],
      hole: [item.hole_id],
      scores: this.fb.array([...scores])
    });
    this.scoreForms.push(formItem);
  }

  addScore(hole){
    this.gameService.getPosition().then(pos=> {
         console.log(`Positon: ${pos.lat} ${pos.lng}`);
      });
    console.log(hole);
    console.log(this.scoreForms[hole]['value']);
  }

  serviceRequest() {
    console.log("User Requested Service");

}
endGame(): void {
  this.gameService.endGame()
    console.log("Game Ended");
}

}
