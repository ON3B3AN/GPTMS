import { Component, OnInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import { AuthService } from '../auth.service';
import { GameService } from "../game.service";
import { Hole } from '../hole';
import {User} from "../user";

@Component({
  selector: 'app-play',
  templateUrl: './play.component.html',
  styleUrls: ['./play.component.sass']
})
export class PlayComponent implements OnInit {
  playForm: FormGroup;
  tees: any = [];
  holes: Hole[] = [];
  courses: Course[] = [];
  rounds = [{key: '1-9', value: 'Front 9'}, {key: '10-18', value: 'Back 9'}, {key: '1-18', value: 'Full 18'}];
  members: any = [];
  game: any;
  user: User;

  constructor(private courseService: CourseService, private gameService: GameService,
              private formBuilder: FormBuilder, private authService: AuthService) {
    this.game = JSON.parse(localStorage.getItem('game'));
    this.authService.currentUser.subscribe(u => {
      this.user = u;
    });
  }

  ngOnInit(): void {
    this.playForm  =  this.formBuilder.group({
      course_id: ['', [Validators.required]],
      hole: ['', [Validators.required]],
      email: ['']
    });
    this.members.push(this.user.email);
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }

  populateTees(e) {
    this.courseService.getTees(this.playForm.controls['course_id'].value)
      .subscribe(data => this.tees = data);
  }
  addPlayer(){
    this.members.push(this.playForm.controls['email'].value);
    this.playForm.controls['email'].setValue('');
  }

  removePlayer(member) {
    let index = this.members.indexOf(member);
    this.members.splice(index, 1);
  }
  start() {
    if (this.playForm.invalid || this.members.length < 1){
      return;
    }
    this.playForm.controls['email'].setValue(this.members.toString());
    let game = this.playForm.value;
    game['size'] = this.members.length;
    game.longitude = 0;
    game.latitude = 0;
    game.golf_cart = 1;
    game.handicap = 0;
    this.gameService.startGame(game).subscribe(data => {
      if (data) {
        this.game = game;
        this.game.id = data;
        console.log('HELLO WORLD');
        console.log(data);
        localStorage.setItem('game', JSON.stringify(this.game));
        this.playForm.reset();
        this.members = [];
      }
    });
  }

  back(): void {
    window.history.back();
  }

}



