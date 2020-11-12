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
  isSubmitted  =  false;
  tees: any = [];
  holes: Hole[] = [];
  courses: Course[] = [];
  rounds = [{key: '1-9', value: 'Front 9'}, {key: '10-18', value: 'Back 9'}, {key: '1-18', value: 'Whole 18'}];
  id: number;
  start: number;
  end: number;



  constructor(private courseService: CourseService, private gameService: GameService, private router: Router, private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.playForm  =  this.formBuilder.group({
      course: ['', [Validators.required]],
      tee: ['', [Validators.required]],
      hole: ['', [Validators.required]]
    });
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);

    this.courseService.getHoles(this.id)
      .subscribe(data => this.holes = data);
  }

  populateTees(e) {
    this.courseService.getTees(this.playForm.controls['course'].value)
    .subscribe(data => this.tees = data);
  }

  onSubmit() {
    this.isSubmitted = true;
    if (this.playForm.invalid){
      return;
    }

}

}



