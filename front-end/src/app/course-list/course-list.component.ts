import { Component, OnInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";


@Component({
  selector: 'app-course-list',
  templateUrl: './course-list.component.html',
  styleUrls: ['./course-list.component.sass']
})
export class CourseListComponent implements OnInit {
  courses: Course[];

  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }

}
