import { Component, OnInit } from '@angular/core';
import {MatCardModule} from '@angular/material/card';
import {Course} from "../course";
import {CourseService} from "../course.service";


@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.sass']
})
export class CourseComponent implements OnInit {
  courses: Course[];
  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }

}
