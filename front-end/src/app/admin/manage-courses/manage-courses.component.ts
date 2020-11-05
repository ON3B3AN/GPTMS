import { Component, OnInit } from '@angular/core';
import {CourseService} from "../../course.service";
import {Course} from "../../course";

@Component({
  selector: 'app-manage-courses',
  templateUrl: './manage-courses.component.html',
  styleUrls: ['./manage-courses.component.sass']
})
export class ManageCoursesComponent implements OnInit {
  courses: Course[];

  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }

  editCourse(id): void {}

  deleteCourse(id): void {}

}
