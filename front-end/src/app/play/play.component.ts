import { Component, OnInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-play',
  templateUrl: './play.component.html',
  styleUrls: ['./play.component.sass']
})
export class PlayComponent implements OnInit {
  playForm: FormGroup;
  isSubmitted  =  false;

  courses: Course[];
  tees = ['Blue', 'Gold', 'Black', 'White'];
  rounds = ['Front 9', 'Back 9', 'Whole 18'];


  constructor(private courseService: CourseService, private router: Router, private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.playForm  =  this.formBuilder.group({
      courseName: ['', [Validators.required]],
    });
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }
  get formControls() { return this.playForm.controls; }

  populateTees(e) {
    const selectedCourse = e.target.value;
    console.log(selectedCourse)
  }
  onSubmit() {
    this.isSubmitted = true;
    if (this.playForm.invalid){
      return;
    }
    else {
      alert(JSON.stringify(this.playForm.value))
    }

  }
  }



