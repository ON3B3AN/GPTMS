import { Component, OnInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import { AuthService } from '../auth.service';
import { GameService } from "../game.service";
import { Hole } from '../hole';

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

  constructor(private courseService: CourseService, private gameService: GameService, private formBuilder: FormBuilder) {
    this.game = JSON.parse(localStorage.getItem('game'));
  }

  ngOnInit(): void {
    this.playForm  =  this.formBuilder.group({
      course_id: ['', [Validators.required]],
      tee: ['', [Validators.required]],
      hole: ['', [Validators.required]],
      email: ['']
    });
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
  start() {
    if (this.playForm.invalid || this.members.length < 1){
      return;
    }
    this.playForm.controls['email'].setValue(this.members.toString());
    this.game = this.playForm.value;
    this.game['size'] = this.members.length;
    this.game.longitude = 0;
    this.game.latitude = 0;
    this.game.golf_cart = 1;
    this.gameService.startGame(this.game).subscribe();
    this.playForm.reset();
    this.members = [];
    localStorage.setItem('game', JSON.stringify(this.game));
  }

}



