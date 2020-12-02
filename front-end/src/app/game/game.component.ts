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
  watchId: number;

  constructor(private fb: FormBuilder, private gameService: GameService, private userService: UserService) {
  }


  ngOnChanges(): void {
    if (this.watchId) {
      navigator.geolocation.clearWatch(this.watchId);
      this.watchId = null;
    }
    if (this.game) {
      const holes = this.game.hole.split('-');
      this.userService.getUsers().subscribe(data => {
        this.players = data.filter(u => this.game.email.split(',').indexOf(u.email) > -1);
      });
      this.gameService.getRound(this.game.id, this.game.course_id, holes[0], holes[1]).subscribe(data => {
        this.course.course_name = data[1].course_name;
        this.course.address = data[1].address;
        this.course.phone = data[1].phone;
        this.course.holes = data[1].holes;
        this.party = data[0];
        console.log(data);
        console.log(this.course);
        this.course.holes.map((item, index) => {
          this.addFormItem(item);
        });
      });
      this.watchPosition();
    }
  }

  addFormItem(item: any): void {
    const scores = this.players.map(x =>
      this.fb.group({
        uid: [x.user_id],
        strokes: ['']
      })
    );

    const formItem = this.fb.group({
      party: [this.party.party_id],
      hole: [item.hole_id],
      scores: this.fb.array([...scores])
    });
    this.scoreForms.push(formItem);
  }

  watchPosition(): void {
    this.watchId = navigator.geolocation.watchPosition(
      (position) => {
        console.log(`Lat: ${position.coords.latitude}, Lon: ${position.coords.longitude}`);
        this.gameService.updatePartyGeo(this.party.party_id, position.coords.longitude, position.coords.latitude).subscribe();
      },
      (err) => {
        console.log(err);
      },{
        enableHighAccuracy: true,
        timeout: 60000,
        maximumAge: 0
      });
  }

  addScore(hole): void {
    console.log(hole);
    console.log(this.scoreForms[hole].value);
  }

  serviceRequest(): void {
    console.log('User Requested Service');

  }
  endGame(): void {
    this.gameService.endGame();
    console.log('Game Ended');
    if (this.watchId) {
      navigator.geolocation.clearWatch(this.watchId);
      this.watchId = null;
    }
  }

}
